<?php
// 1. Tắt hiển thị lỗi ra màn hình (tránh làm hỏng JSON)
error_reporting(0);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=utf-8');

try {
    // 2. Kiểm tra file config
    $configPath = __DIR__ . '/../app/config/config.php';
    if (!file_exists($configPath)) {
        throw new Exception("Không tìm thấy file config tại: $configPath");
    }
    require_once $configPath;

    // 3. Khởi động Session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // 4. Kết nối Database (Thêm options để xử lý lỗi Unicode và Exception)
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);

    // 5. Lấy thông tin User hiện tại
    $user_id = $_SESSION['user_id'] ?? 0;
    $user_role = $_SESSION['user_role'] ?? 'guest';
    $action = $_POST['action'] ?? '';

    // --- CASE 1: ADMIN LẤY DANH SÁCH USER ---
    if ($action === 'get_users') {
        if ($user_role !== 'admin') {
            echo json_encode(['users' => []]); // Không phải admin trả về rỗng
            exit;
        }

        // QUERY CHUẨN: Group By cả id và full_name để tránh lỗi only_full_group_by
        $sql = "SELECT u.id, u.full_name, MAX(m.created_at) as last_msg_time,
                (SELECT COUNT(*) FROM messages WHERE sender_id = u.id AND receiver_id = 999 AND is_read = 0) as unread
                FROM users u
                LEFT JOIN messages m ON (m.sender_id = u.id AND m.receiver_id = 999) OR (m.sender_id = 999 AND m.receiver_id = u.id)
                WHERE u.role != 'admin'
                GROUP BY u.id, u.full_name
                ORDER BY last_msg_time DESC";
                
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();
        
        echo json_encode(['users' => $users]);
        exit;
    }

    // --- CASE 2: GỬI TIN NHẮN ---
    if ($action === 'send') {
        if ($user_id === 0) throw new Exception("Bạn chưa đăng nhập");
        
        $msg = trim($_POST['message'] ?? '');
        if (!$msg) throw new Exception("Tin nhắn rỗng");

        // FIX LOGIC: Nếu là Admin gửi -> Ép sender_id = 999 (ID ảo của hệ thống Admin)
        // Nếu là User gửi -> sender_id = user_id thật
        $sender = ($user_role === 'admin') ? 999 : $user_id;

        // Nếu là Admin -> gửi cho user được chọn (to_user)
        // Nếu là User -> luôn gửi cho Admin (999)
        $receiver = ($user_role === 'admin') ? ($_POST['to_user'] ?? 0) : 999;
        
        if ($receiver == 0) throw new Exception("Người nhận không hợp lệ");

        $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message, is_read, created_at) VALUES (?, ?, ?, 0, NOW())");
        $stmt->execute([$sender, $receiver, $msg]);
        
        echo json_encode(['status' => 'ok']);
        exit;
    }

    // --- CASE 3: LẤY NỘI DUNG CHAT ---
    if ($action === 'get') {
        if ($user_id === 0) throw new Exception("Chưa đăng nhập");

        // Xác định đối tượng chat
        $target_id = ($user_role === 'admin') ? ($_POST['target_id'] ?? 0) : $user_id;
        if ($target_id == 0) {
            echo json_encode(['messages' => []]);
            exit;
        }

        // Mark read (Đánh dấu đã đọc tin nhắn từ target_id gửi cho mình)
        // Nếu mình là Admin (999), đánh dấu tin từ target_id gửi cho 999
        // Nếu mình là User, đánh dấu tin từ 999 gửi cho User
        $my_id_in_chat = ($user_role === 'admin') ? 999 : $target_id;
        $sender_id_to_mark = ($user_role === 'admin') ? $target_id : 999;
        $receiver_id_to_mark = ($user_role === 'admin') ? 999 : $user_id;

        $stmt = $pdo->prepare("UPDATE messages SET is_read = 1 WHERE sender_id = ? AND receiver_id = ?");
        $stmt->execute([$sender_id_to_mark, $receiver_id_to_mark]);

        // Lấy tin nhắn
        $stmt = $pdo->prepare("
            SELECT * FROM messages 
            WHERE (sender_id = ? AND receiver_id = 999) 
               OR (sender_id = 999 AND receiver_id = ?)
            ORDER BY created_at ASC
        ");
        $stmt->execute([$target_id, $target_id]);
        $msgs = $stmt->fetchAll();

        $messages = [];
        foreach ($msgs as $m) {
            // Xác định tin nhắn là "của tôi" hay "của họ"
            // Nếu là Admin: tin có sender_id = 999 là của tôi
            // Nếu là User: tin có sender_id = user_id là của tôi
            if ($user_role === 'admin') {
                $is_me = ($m['sender_id'] == 999);
            } else {
                $is_me = ($m['sender_id'] == $user_id);
            }

            $messages[] = [
                'id' => $m['id'],
                'msg' => htmlspecialchars($m['message']),
                'is_me' => $is_me,
                'time' => date('H:i d/m', strtotime($m['created_at']))
            ];
        }

        echo json_encode(['messages' => $messages]);
        exit;
    }
    
    // --- CASE 4: ĐẾM TIN CHƯA ĐỌC (BADGE) ---
    if ($action === 'count') {
        $count = 0;
        if ($user_role === 'admin') {
            $stmt = $pdo->query("SELECT COUNT(*) FROM messages WHERE receiver_id = 999 AND is_read = 0");
            $count = $stmt->fetchColumn();
        } else {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM messages WHERE sender_id = 999 AND receiver_id = ? AND is_read = 0");
            $stmt->execute([$user_id]);
            $count = $stmt->fetchColumn();
        }
        echo json_encode(['unread' => $count]);
        exit;
    }

} catch (Exception $e) {
    // Nếu có lỗi, trả về JSON lỗi để Frontend biết
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

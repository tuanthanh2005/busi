<?php
require_once __DIR__ . '/app/config/config.php';

echo "<h1>🌱 ĐANG TẠO TIN NHẮN MẪU...</h1>";

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Tạo vài user giả nếu chưa có (để chat với admin)
    $dummyUsers = [
        ['Khách Hàng A', 'clientA@gmail.com'],
        ['Nguyễn Văn B', 'clientB@gmail.com'],
        ['Hot Girl C', 'clientC@gmail.com']
    ];
    
    foreach ($dummyUsers as $u) {
        $stmt = $pdo->prepare("INSERT IGNORE INTO users (full_name, email, password, role) VALUES (?, ?, ?, 'user')");
        $stmt->execute([$u[0], $u[1], password_hash('123456', PASSWORD_DEFAULT)]);
    }

    // Lấy ID các user vừa tạo
    $stmt = $pdo->query("SELECT id, full_name FROM users WHERE role = 'user' LIMIT 5");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 2. Xóa tin nhắn cũ (để test cho sạch)
    $pdo->exec("TRUNCATE TABLE messages");

    // 3. Tạo hội thoại
    $adminId = 999; // ID ảo của Admin trong hệ thống chat

    foreach ($users as $user) {
        $uid = $user['id'];
        $name = $user['full_name'];

        // Tin nhắn 1: User hỏi (Đã đọc)
        $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message, is_read, created_at) VALUES (?, ?, ?, 1, DATE_SUB(NOW(), INTERVAL 2 HOUR))")
            ->execute([$uid, $adminId, "Chào shop, tool này giá bao nhiêu vậy ạ?"]);

        // Tin nhắn 2: Admin trả lời
        $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message, is_read, created_at) VALUES (?, ?, ?, 1, DATE_SUB(NOW(), INTERVAL 1 HOUR))")
            ->execute([$adminId, $uid, "Chào bạn, tool giá 150$ trọn đời nhé!"]);

        // Tin nhắn 3: User hỏi tiếp (CHƯA ĐỌC - Sẽ hiện số đỏ 🔴)
        $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message, is_read, created_at) VALUES (?, ?, ?, 0, NOW())")
            ->execute([$uid, $adminId, "Admin ơi check inbox giúp mình với! Mình muốn mua ngay."]);
            
        echo "<p>✅ Đã tạo tin nhắn từ <b>$name</b> (Có 1 tin chưa đọc 🔴)</p>";
    }

    echo "<h3>🎉 HOÀN TẤT! Hãy vào trang Admin Chat để kiểm tra.</h3>";
    echo "<p><a href='http://localhost:8000/admin_chat.php' target='_blank'>👉 Đi tới Admin Chat</a></p>";

} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}

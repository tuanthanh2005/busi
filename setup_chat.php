<?php
require_once __DIR__ . '/app/config/config.php';

echo "<h1>🛠️ SETUP CHAT SYSTEM</h1>";

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Tạo bảng messages
    $sql = "CREATE TABLE IF NOT EXISTS messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        sender_id INT NOT NULL,      -- ID người gửi
        receiver_id INT NOT NULL,    -- ID người nhận (0 là Admin nhận từ Guest/User, hoặc ID user cụ thể)
        message TEXT NOT NULL,
        is_read TINYINT DEFAULT 0,   -- 0: Chưa đọc, 1: Đã đọc
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX (sender_id),
        INDEX (receiver_id),
        INDEX (is_read)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    
    $pdo->exec($sql);
    echo "<h3 style='color:green'>✅ Tạo bảng 'messages' thành công!</h3>";

    // Thêm vài tin nhắn mẫu (User ID 1 gửi cho Admin ID 999 hoặc ngược lại)
    // Giả sử Admin ID là 1 (nếu bạn đã set role admin cho user 1)
    
} catch (PDOException $e) {
    echo "<h2 style='color:red'>❌ LỖI: " . $e->getMessage() . "</h2>";
}

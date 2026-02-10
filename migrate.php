<?php
// 🚀 DigitalPro Auto Migration Tool
require_once 'app/config/config.php';

// Cấu hình kết nối trực tiếp để tạo Database trước
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'busi';

try {
    // 1. Kết nối không chọn DB để tạo Database
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "--- 🔄 Đang khởi tạo Database... ---\n";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "✅ Database '$dbname' đã sẵn sàng.\n";

    // 2. Kết nối vào Database vừa tạo
    $pdo->exec("USE $dbname");

    // 3. Đọc và chạy file SQL migration
    $sql = file_get_contents('app/database/migration.sql');
    
    // Loại bỏ các dòng comment và chia nhỏ các câu lệnh
    $pdo->exec($sql);
    
    echo "✅ Migration thành công! Bảng 'users' đã được tạo.\n";
    echo "🚀 Bây giờ bạn có thể truy cập http://localhost:8000/auth/register để sử dụng.\n";

} catch (PDOException $e) {
    echo "❌ Lỗi: " . $e->getMessage() . "\n";
    echo "💡 Hãy đảm bảo MySQL (XAMPP/WAMP) đang bật.\n";
}

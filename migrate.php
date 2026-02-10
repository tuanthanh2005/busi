<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 🚀 DigitalPro Auto Migration Tool
require_once 'app/config/config.php';

// Cấu hình kết nối từ Config (server)
$host = Config::DB_HOST;
$user = Config::DB_USER;
$pass = Config::DB_PASS;
$dbname = Config::DB_NAME;

try {
    // 1. Kết nối trực tiếp vào DB (hosting thường đã tạo sẵn)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Đã kết nối Database.\n";

    // 3. Đọc và chạy file SQL migration
    $sql = file_get_contents('app/database/migration.sql');
    
    // Loại bỏ các dòng comment và chia nhỏ các câu lệnh
    $pdo->exec($sql);
    
    echo "✅ Migration thành công!\n";

} catch (PDOException $e) {
    echo "❌ Lỗi: " . $e->getMessage() . "\n";
    echo "💡 Kiểm tra lại thông tin DB trên server.\n";
}

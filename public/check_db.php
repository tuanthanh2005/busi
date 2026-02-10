<?php
// Kiểm tra môi trường PHP và Database
require_once '../app/config/config.php';

echo "<h1>🚀 Kiểm Tra Môi Trường DigitalPro</h1>";

// 1. Kiểm tra PHP Version
echo "<h3>1. PHP Version: " . phpversion() . "</h3>";

// 2. Kiểm tra Extension PDO
if (extension_loaded('pdo_mysql')) {
    echo "<h3 style='color:green'>✅ PDO MySQL Extension: OK</h3>";
} else {
    echo "<h3 style='color:red'>❌ PDO MySQL Extension: Missing! (Bật trong php.ini)</h3>";
}

// 3. Kiểm tra Session
if (session_start()) {
    $_SESSION['test'] = "DigitalPro Session Here";
    echo "<h3 style='color:green'>✅ Session: Working (Set 'test' value)</h3>";
} else {
    echo "<h3 style='color:red'>❌ Session: Failed to start!</h3>";
}

// 4. Kiểm tra Kết Nối Database 'busi'
try {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<h3 style='color:green'>✅ Database Connection ('" . DB_NAME . "'): Success!</h3>";
    
    // Kiểm tra bảng 'users'
    $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() > 0) {
        echo "<h3 style='color:green'>✅ Table 'users': Exists!</h3>";
        
        // Count users
        $stmt = $pdo->query("SELECT COUNT(*) FROM users");
        $count = $stmt->fetchColumn();
        echo "<p>Số lượng user hiện tại: <strong>$count</strong></p>";
    } else {
        echo "<h3 style='color:red'>❌ Table 'users': Missing! (Hãy chạy lại php migrate.php)</h3>";
    }

} catch (PDOException $e) {
    echo "<h3 style='color:red'>❌ Database Connection Failed: " . $e->getMessage() . "</h3>";
    echo "<p>Cấu hình hiện tại: Host=" . DB_HOST . ", User=" . DB_USER . ", DB=" . DB_NAME . "</p>";
}

echo "<hr>";
echo "<a href='" . BASE_URL . "auth/register' style='font-size:20px'>👉 Thử Đăng Ký Lại</a> | ";
echo "<a href='" . BASE_URL . "auth/login' style='font-size:20px'>👉 Thử Đăng Nhập Lại</a>";

<?php
require_once __DIR__ . '/app/config/config.php';

echo "<h1>👑 SETUP ADMIN ROLE</h1>";

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    
    // Set user đầu tiên hoặc user có email admin@gmail.com thành admin
    $sql = "UPDATE users SET role = 'admin' WHERE email LIKE '%admin%' OR id = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        echo "<h3 style='color:green'>✅ Đã cấp quyền ADMIN cho tài khoản!</h3>";
        echo "<p>Vui lòng <b>Đăng xuất và Đăng nhập lại</b> để cập nhật quyền.</p>";
        echo "<a href='" . BASE_URL . "auth/logout'>👉 Đăng xuất ngay</a>";
    } else {
        echo "<h3>⚠️ Chưa tìm thấy user nào để set admin. Hãy đăng ký tài khoản trước!</h3>";
    }

} catch (PDOException $e) {
    echo "❌ Lỗi: " . $e->getMessage();
}

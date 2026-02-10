<?php
// TEST ĐĂNG KÝ - BỎ QUA TOÀN BỘ HỆ THỐNG
echo "<h1>TEST ĐĂNG KÝ TRỰC TIẾP</h1>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=busi", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, 'user')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['full_name'],
            $_POST['email'],
            password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]);
        
        echo "<h2 style='color:green'>✅ THÀNH CÔNG! ID: " . $pdo->lastInsertId() . "</h2>";
        echo "<p>Hãy kiểm tra HeidiSQL - bảng users!</p>";
        
    } catch (Exception $e) {
        echo "<h2 style='color:red'>❌ LỖI: " . $e->getMessage() . "</h2>";
    }
    exit;
}
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"></head><body style="padding:50px; font-family:Arial;">
<h2>Form Test</h2>
<form method="POST">
    <p><input name="full_name" placeholder="Tên" required style="padding:8px; width:250px;"></p>
    <p><input name="email" type="email" placeholder="Email" required style="padding:8px; width:250px;"></p>
    <p><input name="password" type="password" placeholder="Pass" required style="padding:8px; width:250px;"></p>
    <button type="submit" style="padding:10px 20px; background:#667eea; color:white; border:none;">ĐĂNG KÝ</button>
</form>
</body></html>

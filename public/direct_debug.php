<?php
// DEBUG TRỰC TIẾP - Không qua MVC
require_once '../app/config/config.php';

echo "<h1>🔍 DEBUG ĐĂNG KÝ TRỰC TIẾP</h1>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<h2>✅ Form đã submit!</h2>";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    
    // Kết nối DB trực tiếp
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=busi", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<h2>✅ Kết nối DB thành công!</h2>";
        
        $name = $_POST['full_name'];
        $email = $_POST['email'];
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, 'user')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $pass]);
        
        echo "<h2 style='color:green'>✅ LƯU VÀO DB THÀNH CÔNG!</h2>";
        echo "<p>ID mới: " . $pdo->lastInsertId() . "</p>";
        echo "<a href='http://localhost:8000/direct_debug.php'>Đăng ký tiếp</a>";
        
    } catch (PDOException $e) {
        echo "<h2 style='color:red'>❌ LỖI: " . $e->getMessage() . "</h2>";
    }
    
} else {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Debug Direct</title>
</head>
<body style="font-family: Arial; padding: 20px;">
    <h1>Đăng ký TRỰC TIẾP (Không qua MVC)</h1>
    <form method="POST">
        <p><input type="text" name="full_name" placeholder="Họ tên" required style="padding:10px; width:300px;"></p>
        <p><input type="email" name="email" placeholder="Email" required style="padding:10px; width:300px;"></p>
        <p><input type="password" name="password" placeholder="Mật khẩu" required style="padding:10px; width:300px;"></p>
        <p><button type="submit" style="padding:10px 20px; background:#667eea; color:white; border:none; cursor:pointer;">ĐĂNG KÝ</button></p>
    </form>
</body>
</html>
<?php } ?>

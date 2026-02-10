<?php
echo "<h1>KIỂM TRA KẾT NỐI DATABASE</h1>";

try {
    $pdo = new PDO("mysql:host=localhost;dbname=busi", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2 style='color:green'>✅ KẾT NỐI DATABASE THÀNH CÔNG!</h2>";
    
    // Kiểm tra bảng users
    $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() > 0) {
        echo "<h3 style='color:green'>✅ Bảng 'users' TỒN TẠI</h3>";
        
        // Đếm số user
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM users");
        $count = $stmt->fetch(PDO::FETCH_OBJ)->total;
        echo "<p>Số lượng users hiện tại: <strong>$count</strong></p>";
        
        // Hiển thị danh sách
        if ($count > 0) {
            echo "<h3>Danh sách users:</h3>";
            echo "<table border='1' cellpadding='10' style='border-collapse:collapse;'>";
            echo "<tr><th>ID</th><th>Tên</th><th>Email</th><th>Role</th><th>Ngày tạo</th></tr>";
            
            $stmt = $pdo->query("SELECT id, full_name, email, role, created_at FROM users");
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                echo "<tr>";
                echo "<td>{$row->id}</td>";
                echo "<td>{$row->full_name}</td>";
                echo "<td>{$row->email}</td>";
                echo "<td>{$row->role}</td>";
                echo "<td>{$row->created_at}</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        
        echo "<hr>";
        echo "<h3>TEST INSERT:</h3>";
        echo "<p>Thử insert 1 user test:</p>";
        
        $testEmail = "test_" . time() . "@test.com";
        $sql = "INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, 'user')";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([
            "Test User " . date('H:i:s'),
            $testEmail,
            password_hash("123456", PASSWORD_DEFAULT)
        ]);
        
        if ($result) {
            echo "<h3 style='color:green'>✅ INSERT THÀNH CÔNG!</h3>";
            echo "<p>ID mới: " . $pdo->lastInsertId() . "</p>";
            echo "<p>Email: $testEmail</p>";
            echo "<p><a href=''>Refresh để xem</a></p>";
        }
        
    } else {
        echo "<h3 style='color:red'>❌ Bảng 'users' KHÔNG TỒN TẠI</h3>";
        echo "<p>Hãy chạy: <code>php migrate.php</code></p>";
    }
    
} catch (PDOException $e) {
    echo "<h2 style='color:red'>❌ LỖI KẾT NỐI: " . $e->getMessage() . "</h2>";
    echo "<p>Kiểm tra:</p>";
    echo "<ul>";
    echo "<li>MySQL đã bật chưa? (XAMPP/WAMP)</li>";
    echo "<li>Database 'busi' đã tồn tại chưa?</li>";
    echo "<li>User: root, Pass: (trống)</li>";
    echo "</ul>";
}
?>

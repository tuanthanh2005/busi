<?php
// Test xem Auth controller có hoạt động không
echo "<h1>🧪 TEST AUTH CONTROLLER</h1>";

echo "<h3>1. Kiểm tra file Auth.php tồn tại:</h3>";
if (file_exists('../app/Controllers/Auth.php')) {
    echo "✅ File Auth.php TỒN TẠI<br>";
    require_once '../app/Controllers/Auth.php';
    
    echo "<h3>2. Kiểm tra class Auth:</h3>";
    if (class_exists('Auth')) {
        echo "✅ Class Auth TỒN TẠI<br>";
        
        $auth = new Auth();
        echo "✅ Khởi tạo Auth thành công<br>";
        
        echo "<h3>3. Kiểm tra method postRegister:</h3>";
        if (method_exists($auth, 'postRegister')) {
            echo "✅ Method postRegister TỒN TẠI<br>";
        } else {
            echo "❌ Method postRegister KHÔNG TỒN TẠI<br>";
        }
        
        echo "<h3>4. Kiểm tra method register (view):</h3>";
        if (method_exists($auth, 'register')) {
            echo "✅ Method register TỒN TẠI<br>";
        } else {
            echo "❌ Method register KHÔNG TỒN TẠI<br>";
        }
        
    } else {
        echo "❌ Class Auth KHÔNG TỒN TẠI<br>";
    }
    
} else {
    echo "❌ File Auth.php KHÔNG TỒN TẠI<br>";
    echo "Đường dẫn kiểm tra: " . realpath('../app/Controllers/Auth.php');
}

echo "<hr>";
echo "<h3>5. Test Form Submit:</h3>";
echo '<form action="http://localhost:8000/auth/postRegister" method="POST">
    <input type="text" name="full_name" value="Test User" required><br>
    <input type="email" name="email" value="test@test.com" required><br>
    <input type="password" name="password" value="123456" required><br>
    <button type="submit">Gửi Test</button>
</form>';

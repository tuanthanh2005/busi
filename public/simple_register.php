<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Test Đăng Ký - DigitalPro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background: #5568d3;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>🧪 Test Đăng Ký (No JavaScript)</h1>
    <p>Trang này không có JavaScript, chỉ test thuần backend.</p>
    
    <?php
    session_start();
    if(isset($_SESSION['error'])) {
        echo '<div class="error">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
    if(isset($_SESSION['success'])) {
        echo '<div class="success">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }
    ?>
    
    <form action="http://localhost:8000/auth/postRegister" method="POST">
        <div class="form-group">
            <label>Họ và tên:</label>
            <input type="text" name="full_name" value="Trần Thanh Tuấn" required>
        </div>
        
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="admin@gmail.com" required>
        </div>
        
        <div class="form-group">
            <label>Mật khẩu:</label>
            <input type="password" name="password" value="123456" required>
        </div>
        
        <div class="form-group">
            <label>Xác nhận mật khẩu:</label>
            <input type="password" name="confirm_password" value="123456" required>
        </div>
        
        <button type="submit">Đăng Ký Ngay</button>
    </form>
    
    <hr>
    <p><a href="http://localhost:8000/auth/login">← Về trang đăng nhập chính</a></p>
</body>
</html>

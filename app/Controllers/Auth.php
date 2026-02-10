<?php
require_once '../app/Models/User.php';

class Auth
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // 📄 Hiển thị trang đăng ký
    public function register()
    {
        require_once '../app/Views/auth/register.php';
    }

    // 📄 Hiển thị trang đăng nhập
    public function login()
    {
        require_once '../app/Views/auth/login.php';
    }

    // ✅ Xử lý đăng ký
    public function doRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            header('Location: ' . BASE_URL . 'auth/register');
            exit();
        }

        $full_name = trim($_POST['full_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        // Validate
        if (empty($full_name) || empty($email) || empty($password)) {
            $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin';
            header('Location: ' . BASE_URL . 'auth/register');
            exit();
        }

        // Check email tồn tại
        if ($this->userModel->findUserByEmail($email)) {
            $_SESSION['error'] = 'Email này đã được sử dụng';
            header('Location: ' . BASE_URL . 'auth/register');
            exit();
        }

        // Đăng ký
        if ($this->userModel->register($full_name, $email, $password)) {
            $_SESSION['success'] = 'Đăng ký thành công! Hãy đăng nhập.';
            header('Location: ' . BASE_URL . 'auth/login');
        } else {
            $_SESSION['error'] = 'Có lỗi xảy ra, vui lòng thử lại';
            header('Location: ' . BASE_URL . 'auth/register');
        }
        exit();
    }

    // ✅ Xử lý đăng nhập
    public function doLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            header('Location: ' . BASE_URL . 'auth/login');
            exit();
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = $this->userModel->login($email, $password);

        if ($user) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->full_name;
            $_SESSION['user_role'] = $user->role;

            // Phân quyền chuyển hướng
            if ($user->role === 'admin') {
                header('Location: ' . BASE_URL . 'admin');
            } else {
                header('Location: ' . BASE_URL);
            }
        } else {
            $_SESSION['error'] = 'Email hoặc mật khẩu không chính xác';
            header('Location: ' . BASE_URL . 'auth/login');
        }
        exit();
    }

    // 🚪 Đăng xuất
    public function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URL);
        exit();
    }
}

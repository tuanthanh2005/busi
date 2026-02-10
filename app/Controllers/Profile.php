<?php
require_once __DIR__ . '/../Models/User.php';

class Profile
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // 🛡️ Guard: Phải đăng nhập mới xem được trang cá nhân
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Vui lòng đăng nhập để xem thông tin cá nhân';
            header('Location: ' . Config::url('auth/login'));
            exit();
        }
    }

    public function index()
    {
        $user = $this->userModel->getUserById($_SESSION['user_id']);
        
        $data = [
            'title' => 'Trang Cá Nhân - DigitalPro',
            'active' => 'profile',
            'user' => $user
        ];

        require_once __DIR__ . '/../Views/profile/index.php';
    }

    // 🔄 Cập nhật thông tin (Tính năng mở rộng sau này)
    public function update()
    {
        // Xử lý update profile ở đây
    }
}

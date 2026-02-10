<?php

class Admin
{
    public function __construct()
    {
        // Khởi tạo session nếu chưa có
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // 🛡️ Kiểm tra phân quyền: Chỉ cho phép admin truy cập
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            $_SESSION['error'] = 'Bạn không có quyền truy cập trang này!';
            header('Location: ' . BASE_URL . 'auth/login');
            exit();
        }
    }

    // 📊 Trang Dashboard Quản Trị
    public function index()
    {
        $data = [
            'title' => 'Admin Dashboard - DigitalPro',
            'active' => 'admin'
        ];
        require_once '../app/Views/admin/dashboard.php';
    }

    // Các tính năng quản lý khách hàng, đơn hàng... sẽ thêm ở đây
}

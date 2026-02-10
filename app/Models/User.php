<?php
require_once '../app/Core/Database.php';

class User extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    // Đăng ký user mới
    public function register($full_name, $email, $password)
    {
        try {
            $this->query("INSERT INTO users (full_name, email, password, role) VALUES (:full_name, :email, :password, 'user')");
            $this->bind(':full_name', $full_name);
            $this->bind(':email', $email);
            $this->bind(':password', password_hash($password, PASSWORD_DEFAULT));
            
            return $this->execute();
        } catch (Exception $e) {
            error_log("Register Error: " . $e->getMessage());
            return false;
        }
    }

    // Đăng nhập
    public function login($email, $password)
    {
        $this->query("SELECT * FROM users WHERE email = :email LIMIT 1");
        $this->bind(':email', $email);
        $user = $this->single();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }

    // Kiểm tra email đã tồn tại
    public function findUserByEmail($email)
    {
        $this->query("SELECT id FROM users WHERE email = :email LIMIT 1");
        $this->bind(':email', $email);
        $this->single();
        
        return $this->rowCount() > 0;
    }

    // Lấy thông tin user theo ID
    public function getUserById($id)
    {
        $this->query("SELECT * FROM users WHERE id = :id LIMIT 1");
        $this->bind(':id', $id);
        return $this->single();
    }
}

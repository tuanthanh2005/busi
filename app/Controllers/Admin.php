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
            header('Location: ' . Config::url('auth/login'));
            exit();
        }
    }

    // 📊 Trang Dashboard Quản Trị
    public function index()
    {
        require_once __DIR__ . '/../Models/Product.php';
        $productModel = new ProductModel();
        $products = $productModel->getAll();

        $data = [
            'title' => 'Admin Dashboard - DigitalPro',
            'active' => 'admin',
            'products' => $products
        ];
        require_once __DIR__ . '/../Views/admin/dashboard.php';
    }

    // 🛍️ Quản lý sản phẩm (CRUD)
    public function product($action = null)
    {
        require_once __DIR__ . '/../Models/Product.php';
        $productModel = new ProductModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($action === 'store') {
                $image = 'default.png';
                if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                    $docRoot = isset($_SERVER['DOCUMENT_ROOT']) ? rtrim($_SERVER['DOCUMENT_ROOT'], '/\\') : '';
                    $target_dir = $docRoot !== '' ? ($docRoot . '/uploads/') : (__DIR__ . '/../../public/uploads/');
                    if (!file_exists($target_dir)) {
                        mkdir($target_dir, 0777, true);
                    }
                    // Sanitize filename
                    $filename = str_replace([' ', '#', '+', '%'], '_', basename($_FILES["image"]["name"]));
                    $image = time() . '_' . $filename;
                    
                    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $image)) {
                         $image = 'default.png';
                         error_log("Upload failed for file: " . $_FILES["image"]["name"]);
                    }
                } elseif (isset($_FILES['image']) && $_FILES['image']['error'] !== 0 && $_FILES['image']['error'] !== 4) {
                     error_log("Upload error code: " . $_FILES['image']['error']);
                }
                
                $data = [
                    'name' => $_POST['name'],
                    'price' => $_POST['price'],
                    'category' => $_POST['category'],
                    'description' => $_POST['description'],
                    'image' => $image
                ];
                $productModel->add($data);
                header('Location: ' . BASE_URL . 'admin');
                exit;
            } elseif ($action === 'update') {
               $id = $_POST['id'];
               $image = $_POST['existing_image'] ?? 'default.png';
               
               if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                    $docRoot = isset($_SERVER['DOCUMENT_ROOT']) ? rtrim($_SERVER['DOCUMENT_ROOT'], '/\\') : '';
                    $target_dir = $docRoot !== '' ? ($docRoot . '/uploads/') : (__DIR__ . '/../../public/uploads/');
                    if (!file_exists($target_dir)) {
                        mkdir($target_dir, 0777, true);
                    }
                    // Sanitize filename
                    $filename = str_replace([' ', '#', '+', '%'], '_', basename($_FILES["image"]["name"]));
                    $new_image = time() . '_' . $filename;
                    
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $new_image)) {
                        $image = $new_image;
                    } else {
                        error_log("Upload failed for file: " . $_FILES["image"]["name"]);
                    }
               } elseif (isset($_FILES['image']) && $_FILES['image']['error'] !== 0 && $_FILES['image']['error'] !== 4) {
                    error_log("Upload error code: " . $_FILES['image']['error']);
               }
               
               $data = [
                   'id' => $id,
                   'name' => $_POST['name'],
                   'price' => $_POST['price'],
                   'category' => $_POST['category'],
                   'description' => $_POST['description'],
                   'image' => $image
               ];
               $productModel->update($data);
               header('Location: ' . BASE_URL . 'admin');
               exit;
            }
        }

        $data = [];
        if ($action === 'add') {
             $data['title'] = 'Thêm Sản Phẩm Mới';
            require_once __DIR__ . '/../Views/admin/product_form.php';
        } elseif ($action === 'edit') {
             $id = $_GET['id'] ?? null;
             if ($id) {
                 $product = $productModel->getById($id);
                 $data['product'] = $product;
                 $data['title'] = 'Sửa Sản Phẩm';
                require_once __DIR__ . '/../Views/admin/product_form.php';
             } else {
                 header('Location: ' . BASE_URL . 'admin');
             }
        } elseif ($action === 'delete') {
             $id = $_GET['id'] ?? null;
             if ($id) {
                 $productModel->delete($id);
             }
             header('Location: ' . BASE_URL . 'admin');
        } else {
             header('Location: ' . BASE_URL . 'admin');
        }
    }
}

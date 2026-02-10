<?php
require_once '../app/Models/Product.php';

class Product
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // 🛍️ Trang Danh Sách Sản Phẩm
    public function index($category = null)
    {
        // Xử lý lọc danh mục
        if ($category) {
            $products = $this->productModel->getByCategory($category);
            $activeCat = $category;
        } else {
            $products = $this->productModel->getAll();
            $activeCat = 'all';
        }

        $data = [
            'title' => 'Cửa Hàng - DigitalPro',
            'active' => 'products',
            'products' => $products,
            'activeCat' => $activeCat
        ];

        require_once '../app/Views/product/index.php';
    }
    
    // 🔍 Chi tiết sản phẩm (Mở rộng sau này)
    public function detail($id) {
        // Logic detail
    }
}

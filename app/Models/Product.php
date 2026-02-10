<?php
require_once '../app/Core/Database.php';

class ProductModel extends Database
{
    public function __construct() {
        parent::__construct();
    }

    // 📦 Lấy tất cả sản phẩm
    public function getAll()
    {
        $this->query("SELECT * FROM products ORDER BY id DESC");
        return $this->resultSet();
    }

    // 🔍 Lọc theo danh mục
    public function getByCategory($cat)
    {
        $this->query("SELECT * FROM products WHERE category = :cat ORDER BY id DESC");
        $this->bind(':cat', $cat);
        return $this->resultSet();
    }
}

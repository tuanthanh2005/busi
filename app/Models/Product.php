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

    // 🔍 Lấy chi tiết sản phẩm
    public function getById($id)
    {
        $this->query("SELECT * FROM products WHERE id = :id");
        $this->bind(':id', $id);
        return $this->single();
    }

    // ➕ Thêm sản phẩm mới
    public function add($data)
    {
        $this->query("INSERT INTO products (name, price, image, category, description) VALUES (:name, :price, :image, :category, :description)");
        $this->bind(':name', $data['name']);
        $this->bind(':price', $data['price']);
        $this->bind(':image', $data['image']);
        $this->bind(':category', $data['category']);
        $this->bind(':description', $data['description']);
        return $this->execute();
    }

    // ✏️ Cập nhật sản phẩm
    public function update($data)
    {
        $this->query("UPDATE products SET name = :name, price = :price, image = :image, category = :category, description = :description WHERE id = :id");
        $this->bind(':id', $data['id']);
        $this->bind(':name', $data['name']);
        $this->bind(':price', $data['price']);
        $this->bind(':image', $data['image']);
        $this->bind(':category', $data['category']);
        $this->bind(':description', $data['description']);
        return $this->execute();
    }

    // ❌ Xóa sản phẩm
    public function delete($id)
    {
        $this->query("DELETE FROM products WHERE id = :id");
        $this->bind(':id', $id);
        return $this->execute();
    }
}

<?php
require_once __DIR__ . '/../app/config/config.php';

echo "<h1>🖼️ ĐANG SETUP HỆ THỐNG QUẢN LÝ ẢNH...</h1>";

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Tạo bảng site_images
    $sql = "CREATE TABLE IF NOT EXISTS site_images (
        id INT AUTO_INCREMENT PRIMARY KEY,
        image_key VARCHAR(50) UNIQUE NOT NULL, -- Mã định danh (vd: logo_header)
        image_path VARCHAR(255) NOT NULL,      -- Đường dẫn ảnh
        label VARCHAR(100) NOT NULL,           -- Tên hiển thị (vd: Logo Website)
        dimension VARCHAR(50) NOT NULL,        -- Kích thước gợi ý (vd: 200x50 px)
        page VARCHAR(50) NOT NULL,             -- Thuộc trang nào (vd: Global, Home, About)
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "<p>✅ Đã tạo bảng 'site_images'.</p>";

    // 2. Dữ liệu mẫu (Lấy theo giao diện hiện tại)
    $images = [
        // GLOBAL
        ['logo_main', 'img/logo/logo-text.png', 'Logo Chính (Header)', '180x50 px', 'Global'],
        ['favicon', 'img/favicon.png', 'Favicon (Icon tab)', '32x32 px', 'Global'],
        
        // HOME PAGE
        ['home_hero_bg', 'img/hero/hero-bg.jpg', 'Ảnh Nền Hero (Trang chủ)', '1920x1080 px', 'Home'],
        ['home_about_img', 'img/about/about-1.jpg', 'Ảnh Giới Thiệu (Nhỏ)', '600x600 px', 'Home'],
        
        // SERVICES
        ['service_banner', 'img/banner/service-banner.jpg', 'Banner Trang Dịch Vụ', '1920x400 px', 'Service'],
        
        // CONTACT
        ['contact_bg', 'img/bg/contact-bg.jpg', 'Ảnh Nền Liên Hệ', '1920x800 px', 'Contact']
    ];

    $stmt = $pdo->prepare("INSERT IGNORE INTO site_images (image_key, image_path, label, dimension, page) VALUES (?, ?, ?, ?, ?)");
    
    foreach ($images as $img) {
        $stmt->execute($img);
        echo "<p>➕ Đã thêm vị trí: <b>{$img[2]}</b> (Kích thước: {$img[3]})</p>";
    }

    echo "<h3>🎉 HOÀN TẤT SETUP!</h3>";

} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}

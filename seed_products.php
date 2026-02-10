<?php
// Sử dụng đường dẫn tuyệt đối hoặc tương đối từ root
require_once __DIR__ . '/app/config/config.php';

echo "🔄 Đang khởi tạo bảng 'products'...\n";

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Tạo bảng products
    $sql = "CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        slug VARCHAR(255),
        description TEXT,
        price DECIMAL(10, 2) DEFAULT 0,
        category ENUM('tool', 'ebook', 'ai', 'service') DEFAULT 'tool',
        image VARCHAR(255) DEFAULT 'default_product.jpg',
        status TINYINT DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    
    $pdo->exec($sql);
    echo "✅ Tạo bảng 'products' thành công!\n";

    // 2. Xóa dữ liệu cũ (để tránh trùng lặp khi chạy lại)
    $pdo->exec("TRUNCATE TABLE products");

    // 3. Thêm dữ liệu mẫu (Theo yêu cầu của bạn)
    $products = [
        [
            'name' => 'Telegram Seeding Bot Pro',
            'description' => 'Tool tự động tăng member, view, tương tác cho Group/Channel Telegram. Hỗ trợ đa luồng, proxy sock5.',
            'price' => 150.00,
            'category' => 'tool',
            'image' => 'https://cdn-icons-png.flaticon.com/512/2111/2111646.png'
        ],
        [
            'name' => 'Ebook: Bí Mật MMO 2026',
            'description' => 'Trọn bộ bí kíp kiếm tiền online từ con số 0. Case study thực tế về Dropshipping và Affiliate.',
            'price' => 29.99,
            'category' => 'ebook',
            'image' => 'https://cdn-icons-png.flaticon.com/512/3389/3389081.png'
        ],
        [
            'name' => 'AI Content Generator VIP',
            'description' => 'Phần mềm viết bài chuẩn SEO tự động bằng AI. Tích hợp GPT-5, tạo ảnh minh họa, auto post WordPress.',
            'price' => 99.00,
            'category' => 'ai',
            'image' => 'https://cdn-icons-png.flaticon.com/512/1693/1693746.png'
        ],
        [
            'name' => 'Crypto Trading Bot Signal',
            'description' => 'Bot bắn tín hiệu Long/Short tự động trên Binance/Bybit. Tỷ lệ thắng 78%. Backtest dữ liệu 5 năm.',
            'price' => 200.00,
            'category' => 'tool',
            'image' => 'https://cdn-icons-png.flaticon.com/512/2272/2272825.png'
        ],
        [
            'name' => 'Ebook: TikTok Shop Master',
            'description' => 'Hướng dẫn xây kênh TikTok triệu view và tối ưu chuyển đổi đơn hàng cho TikTok Shop.',
            'price' => 19.99,
            'category' => 'ebook',
            'image' => 'https://cdn-icons-png.flaticon.com/512/3046/3046121.png'
        ],
        [
            'name' => 'AI Avatar Creator',
            'description' => 'Tạo video người ảo MC, phục vụ làm content marketing không cần lộ mặt. Giọng đọc tiếng Việt tự nhiên.',
            'price' => 49.00,
            'category' => 'ai',
            'image' => 'https://cdn-icons-png.flaticon.com/512/4712/4712009.png'
        ]
    ];

    $insertSql = "INSERT INTO products (name, description, price, category, image) VALUES (:name, :description, :price, :category, :image)";
    $stmt = $pdo->prepare($insertSql);

    foreach ($products as $prod) {
        $stmt->execute($prod);
    }
    
    echo "✅ Đã thêm " . count($products) . " sản phẩm mẫu!\n";
    echo "🚀 Hoàn tất setup products!\n";

} catch (PDOException $e) {
    echo "❌ LỖI: " . $e->getMessage() . "\n";
}

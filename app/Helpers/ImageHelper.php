<?php
class ImageHelper {
    private static $cache = [];

    public static function get($key, $default = '') {
        // Nếu đã cache thì trả về ngay (tránh query nhiều lần)
        if (isset(self::$cache[$key])) {
            return BASE_URL . self::$cache[$key];
        }

        try {
            // Kết nối DB (tạo kết nối riêng để độc lập)
            $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $stmt = $pdo->prepare("SELECT image_path FROM site_images WHERE image_key = ?");
            $stmt->execute([$key]);
            $path = $stmt->fetchColumn();

            if ($path) {
                self::$cache[$key] = $path;
                return BASE_URL . $path; // Trả về đường dẫn đầy đủ
            }
        } catch (Exception $e) {
            // Lỗi thì dùng default
        }

        // Nếu không tìm thấy trong DB, trả về default (nếu có) hoặc placeholder
        return $default ? BASE_URL . $default : 'https://placehold.co/600x400?text=No+Image';
    }
}

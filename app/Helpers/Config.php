<?php
class Config {
    
    // ============== BASE URL & PATHS ==============
    // Tự động detect BASE_URL từ $_SERVER
    private static $baseUrl = null;
    private static $protocol = null;
    private static $host = null;
    private static $baseDir = null;
    private static $publicBasePath = null;
    
    // ============== DATABASE ==============
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = '';
    const DB_NAME = 'busi';
    
    // ============== HOSTING CONFIG (CHỈNH TẠI ĐÂY KHI LÊN SERVER) ==============
    // Nếu muốn hardcode BASE_URL, bỏ comment dòng dưới:
    // const FORCE_BASE_URL = 'https://yourdomain.com/';
    
    const FORCE_BASE_URL = null; // null = tự động detect
    
    // ============== METHODS ==============
    
    public static function baseUrl() {
        if (self::$baseUrl === null) {
            if (self::FORCE_BASE_URL !== null) {
                self::$baseUrl = self::FORCE_BASE_URL;
            } else {
                self::$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
                self::$host = $_SERVER['HTTP_HOST'];
                self::$baseDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/';
                self::$publicBasePath = self::detectPublicBasePath();
                self::$baseUrl = self::$protocol . '://' . self::$host . self::$publicBasePath;
            }
        }
        return self::$baseUrl;
    }

    private static function detectPublicBasePath() {
        if (self::$publicBasePath !== null) {
            return self::$publicBasePath;
        }

        $docRoot = isset($_SERVER['DOCUMENT_ROOT']) ? rtrim($_SERVER['DOCUMENT_ROOT'], '/\\') : '';
        $hasDirectAssets = $docRoot !== '' && is_dir($docRoot . DIRECTORY_SEPARATOR . 'css') && is_dir($docRoot . DIRECTORY_SEPARATOR . 'js');
        $hasPublicAssets = $docRoot !== '' && is_dir($docRoot . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'css');

        if ($hasDirectAssets) {
            self::$publicBasePath = '/';
            return self::$publicBasePath;
        }

        if ($hasPublicAssets) {
            self::$publicBasePath = '/public/';
            return self::$publicBasePath;
        }

        self::$publicBasePath = self::$baseDir ?: '/';
        if (self::$publicBasePath[0] !== '/') {
            self::$publicBasePath = '/' . self::$publicBasePath;
        }
        if (substr(self::$publicBasePath, -1) !== '/') {
            self::$publicBasePath .= '/';
        }

        return self::$publicBasePath;
    }
    
    public static function url($path = '') {
        return self::baseUrl() . ltrim($path, '/');
    }
    
    public static function css($file) {
        return self::url('css/' . ltrim($file, '/'));
    }
    
    public static function js($file) {
        return self::url('js/' . ltrim($file, '/'));
    }
    
    public static function image($file) {
        return self::url('img/' . ltrim($file, '/'));
    }
    
    public static function upload($file) {
        return self::url('uploads/' . ltrim($file, '/'));
    }
    
    public static function lib($file) {
        return self::url('lib/' . ltrim($file, '/'));
    }
    
    public static function route($controller, $action = '', $params = []) {
        $path = ltrim($controller, '/');
        
        if (!empty($action)) {
            $path .= '/' . ltrim($action, '/');
        }
        
        if (!empty($params)) {
            $queryString = http_build_query($params);
            $path .= '?' . $queryString;
        }
        
        return self::url($path);
    }
    
    public static function asset($path) {
        return self::url(ltrim($path, '/'));
    }
    
    // ============== CSS & JS LIBRARY CONSTANTS ==============
    // Có thể disable library bằng cách set = false
    
    const LIBS = [
        'animate_css' => true,
        'lightbox_css' => true,
        'owlcarousel_css' => true,
        'bootstrap_css' => true,
        'style_css' => true,
        'wow_js' => true,
        'easing_js' => true,
        'waypoints_js' => true,
        'owlcarousel_js' => true,
        'lightbox_js' => true,
        'main_js' => true,
        'enhancements_js' => true,
    ];
    
    // ============== CSS/JS ASSET METHODS ==============
    
    public static function getCssLibs() {
        $libs = [];
        
        if (self::LIBS['animate_css']) {
            $libs[] = self::lib('animate/animate.min.css');
        }
        if (self::LIBS['lightbox_css']) {
            $libs[] = self::lib('lightbox/css/lightbox.min.css');
        }
        if (self::LIBS['owlcarousel_css']) {
            $libs[] = self::lib('owlcarousel/assets/owl.carousel.min.css');
        }
        if (self::LIBS['bootstrap_css']) {
            $libs[] = self::css('bootstrap.min.css');
        }
        if (self::LIBS['style_css']) {
            $libs[] = self::css('style.css');
        }
        
        return $libs;
    }
    
    public static function getJsLibs() {
        $libs = [];
        
        if (self::LIBS['wow_js']) {
            $libs[] = self::lib('wow/wow.min.js');
        }
        if (self::LIBS['easing_js']) {
            $libs[] = self::lib('easing/easing.min.js');
        }
        if (self::LIBS['waypoints_js']) {
            $libs[] = self::lib('waypoints/waypoints.min.js');
        }
        if (self::LIBS['owlcarousel_js']) {
            $libs[] = self::lib('owlcarousel/owl.carousel.min.js');
        }
        if (self::LIBS['lightbox_js']) {
            $libs[] = self::lib('lightbox/js/lightbox.min.js');
        }
        if (self::LIBS['main_js']) {
            $libs[] = self::js('main.js');
        }
        if (self::LIBS['enhancements_js']) {
            $libs[] = self::js('enhancements.js');
        }
        
        return $libs;
    }
    
    public static function renderCssLibs() {
        foreach (self::getCssLibs() as $css) {
            echo '<link href="' . $css . '" rel="stylesheet">' . "\n";
        }
    }
    
    public static function renderJsLibs() {
        foreach (self::getJsLibs() as $js) {
            echo '<script src="' . $js . '"></script>' . "\n";
        }
    }
    
    // ============== VIEW HELPERS ==============
    
    public static function header() {
        require_once __DIR__ . '/../Views/layout/header.php';
    }
    
    public static function footer() {
        require_once __DIR__ . '/../Views/layout/footer.php';
    }
    
    // ============== DATABASE CONFIG ==============
    
    public static function dbConfig() {
        return [
            'host' => self::DB_HOST,
            'user' => self::DB_USER,
            'pass' => self::DB_PASS,
            'name' => self::DB_NAME,
        ];
    }
    
    public static function dbDsn() {
        return "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME;
    }
}

// Định nghĩa BASE_URL constant để compatible với code cũ
define('BASE_URL', Config::baseUrl());

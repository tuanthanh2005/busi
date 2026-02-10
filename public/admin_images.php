<?php
require_once __DIR__ . '/../app/config/config.php';
session_start();

// Kiểm tra quyền Admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ' . BASE_URL . 'auth/login');
    exit;
}

$message = '';
$msg_class = '';

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Xử lý Upload & Auto Crop
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['new_image'])) {
        $key = $_POST['image_key'];
        $file = $_FILES['new_image'];
        
        if ($file['error'] === UPLOAD_ERR_OK) {
            // 1. Lấy thông tin kích thước mục tiêu từ DB
            $stmt = $pdo->prepare("SELECT dimension FROM site_images WHERE image_key = ?");
            $stmt->execute([$key]);
            $dimString = $stmt->fetchColumn(); // Vd: "1920x600 px" or "200x50"

            $targetW = 0; 
            $targetH = 0;
            if (preg_match('/^(\d+)x(\d+)/', $dimString, $matches)) {
                $targetW = (int)$matches[1];
                $targetH = (int)$matches[2];
            }

            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
            
            if (in_array($ext, $allowed)) {
                $uploadDir = __DIR__ . '/img/uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                
                $newName = $key . '_' . time() . '.' . $ext;
                $dest = $uploadDir . $newName;

                // --- LOGIC CROP ẢNH (Nếu có kích thước chuẩn) ---
                $cropped = false;
                if ($targetW > 0 && $targetH > 0 && extension_loaded('gd') && in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    // Load ảnh gốc
                    list($srcW, $srcH) = getimagesize($file['tmp_name']);
                    $srcImg = null;
                    switch($ext) {
                        case 'jpg': case 'jpeg': $srcImg = imagecreatefromjpeg($file['tmp_name']); break;
                        case 'png': $srcImg = imagecreatefrompng($file['tmp_name']); break;
                        case 'webp': $srcImg = imagecreatefromwebp($file['tmp_name']); break;
                    }

                    if ($srcImg) {
                        // Tính toán tỷ lệ để Crop (Cover Strategy)
                        $srcRatio = $srcW / $srcH;
                        $targetRatio = $targetW / $targetH;

                        if ($srcRatio > $targetRatio) {
                            // Ảnh gốc rộng hơn -> Cắt 2 bên
                            $newH = $targetH;
                            $newW = $targetH * $srcRatio;
                        } else {
                            // Ảnh gốc cao hơn -> Cắt trên dưới
                            $newW = $targetW;
                            $newH = $targetW / $srcRatio;
                        }

                        // Resize trước
                        $tempImg = imagecreatetruecolor($newW, $newH);
                        
                        // Giữ trong suốt cho PNG/WEBP
                        if ($ext == 'png' || $ext == 'webp') {
                            imagealphablending($tempImg, false);
                            imagesavealpha($tempImg, true);
                        }

                        imagecopyresampled($tempImg, $srcImg, 0, 0, 0, 0, $newW, $newH, $srcW, $srcH);

                        // Crop trung tâm (Center Crop)
                        $finalImg = imagecreatetruecolor($targetW, $targetH);
                        if ($ext == 'png' || $ext == 'webp') {
                            imagealphablending($finalImg, false);
                            imagesavealpha($finalImg, true);
                        }

                        $srcX = ($newW - $targetW) / 2;
                        $srcY = ($newH - $targetH) / 2;

                        imagecopy($finalImg, $tempImg, 0, 0, $srcX, $srcY, $targetW, $targetH);

                        // Lưu ảnh
                        switch($ext) {
                            case 'jpg': case 'jpeg': imagejpeg($finalImg, $dest, 90); break;
                            case 'png': imagepng($finalImg, $dest); break;
                            case 'webp': imagewebp($finalImg, $dest, 90); break;
                        }

                        imagedestroy($srcImg);
                        imagedestroy($tempImg);
                        imagedestroy($finalImg);
                        $cropped = true;
                    }
                }

                // Nếu không crop được (do lỗi GD hoặc GIF) thì move file thường
                if (!$cropped) {
                    move_uploaded_file($file['tmp_name'], $dest);
                }
                
                // Update DB
                $dbPath = 'img/uploads/' . $newName;
                $stmt = $pdo->prepare("UPDATE site_images SET image_path = ? WHERE image_key = ?");
                $stmt->execute([$dbPath, $key]);
                
                $message = "Đã cập nhật & crop ảnh thành công!";
                $msg_class = "success";

            } else {
                $message = "Định dạng file không hỗ trợ.";
                $msg_class = "warning";
            }
        }
    }

    // Lấy danh sách ảnh
    $stmt = $pdo->query("SELECT * FROM site_images ORDER BY page DESC, id ASC");
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Lỗi kết nối: " . $e->getMessage());
}

require_once __DIR__ . '/../app/Views/layout/header.php';
?>

<div class="container-fluid py-5" style="background:#0f0c29; min-height:100vh; margin-top:80px;">
    <div class="container">
        
        <div class="d-flex justify-content-between align-items-center mb-5 border-bottom border-secondary pb-3">
            <div>
                <h2 class="fw-bold text-white text-uppercase">🖼️ Quản Lý Hình Ảnh & Slide</h2>
                <p class="text-white-50 mb-0">Thay đổi Banner, Logo và các hình ảnh toàn trang.</p>
            </div>
            <a href="<?= BASE_URL ?>admin" class="btn btn-outline-light"><i class="fas fa-arrow-left me-2"></i>Dashboard</a>
        </div>

        <?php if($message): ?>
            <div class="alert alert-<?= $msg_class ?> alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-info-circle me-2"></i><?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            <?php foreach ($images as $img): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 bg-dark border-secondary shadow-lg overflow-hidden position-relative group-hover">
                    <!-- Preview Ảnh -->
                    <div class="ratio ratio-16x9 bg-black border-bottom border-secondary position-relative">
                        <img src="<?= BASE_URL . $img['image_path'] ?>?v=<?= time() ?>" 
                             class="img-fluid object-fit-contain" 
                             alt="<?= $img['label'] ?>">
                             
                        <!-- Badge Kích Thước -->
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-info text-dark shadow-sm border border-white">
                                <i class="fas fa-ruler-combined me-1"></i><?= $img['dimension'] ?>
                            </span>
                        </div>
                        
                        <!-- Badge Trang -->
                        <div class="position-absolute top-0 start-0 m-2">
                            <span class="badge bg-primary bg-gradient shadow-sm"><?= $img['page'] ?></span>
                        </div>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title text-white fw-bold mb-1"><?= $img['label'] ?></h5>
                        <code class="text-muted d-block mb-3 small"><?= $img['image_key'] ?></code>
                        
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="image_key" value="<?= $img['image_key'] ?>">
                            
                            <label class="btn btn-outline-info w-100 position-relative overflow-hidden">
                                <i class="fas fa-cloud-upload-alt me-2"></i>Chọn Ảnh Mới
                                <input type="file" name="new_image" class="position-absolute opacity-0 top-0 start-0 w-100 h-100" 
                                       onchange="if(confirm('Bạn có chắc muốn thay đổi ảnh này?')) this.form.submit();" accept="image/*">
                            </label>
                            
                            <div class="text-center mt-2">
                                <small class="text-white-50" style="font-size: 11px;">
                                    <i class="fas fa-info-circle me-1"></i>Tự động upload khi chọn file
                                </small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
    </div>
</div>

<?php require_once __DIR__ . '/../app/Views/layout/footer.php'; ?>

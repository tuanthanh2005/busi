<?php Config::header(); ?>

<!-- 🛍️ Product Header -->
<div class="container-fluid py-5" style="margin-top: 80px;">
    <div class="container py-5 text-center wow fadeIn" data-wow-delay="0.1s">
        <h1 class="display-4 text-white mb-3 animated slideInDown">Cửa Hàng Công Nghệ</h1>
        <p class="text-white-50 lead mb-5">Khám phá các giải pháp AI, Tool Marketing và Ebook MMO chất lượng cao.</p>
        
        <!-- 🔥 Category Filter Buttons -->
        <div class="d-flex justify-content-center gap-3 flex-wrap mb-5">
            <a href="<?= Config::url() ?>product" class="btn btn-outline-primary rounded-pill px-4 py-2 <?= (!isset($_GET['cat']) ? 'active bg-primary text-white' : '') ?>">Tất Cả</a>
            <a href="<?= Config::url() ?>product?cat=ai" class="btn btn-outline-info rounded-pill px-4 py-2 <?= ((isset($_GET['cat']) && $_GET['cat'] == 'ai') ? 'active bg-info text-white' : '') ?>"><i class="fas fa-robot me-2"></i>AI Tools</a>
            <a href="<?= Config::url() ?>product?cat=tool" class="btn btn-outline-success rounded-pill px-4 py-2 <?= ((isset($_GET['cat']) && $_GET['cat'] == 'tool') ? 'active bg-success text-white' : '') ?>"><i class="fab fa-telegram me-2"></i>Tool Bot</a>
            <a href="<?= Config::url() ?>product?cat=ebook" class="btn btn-outline-warning rounded-pill px-4 py-2 <?= ((isset($_GET['cat']) && $_GET['cat'] == 'ebook') ? 'active bg-warning text-white' : '') ?>"><i class="fas fa-book me-2"></i>Ebooks</a>
        </div>
    </div>
</div>

<!-- 📦 Product Grid -->
<div class="container-fluid py-2">
    <div class="container">
        <div class="row g-4">
            <?php
            // Logic lọc cơ bản tại View (hoặc Controller đã lọc rồi)
            $catFilter = $_GET['cat'] ?? null;
            $displayProducts = $data['products'];
            
            if ($catFilter) {
                // Nếu Controller chưa lọc (trường hợp dùng chung index), lọc lại ở đây cho chắc
                // Nhưng Controller ở trên đã chuẩn bị sẵn data rồi.
                // Ở đây ta giả sử data['products'] là kết quả cuối cùng.
            }
            
            if (empty($displayProducts)): 
            ?>
                <div class="col-12 text-center text-white-50 py-5">
                    <h3>Chưa có sản phẩm nào trong danh mục này.</h3>
                </div>
            <?php else: ?>
                <?php foreach ($displayProducts as $prod): ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item glass-bg rounded-4 overflow-hidden h-100 border border-white-50 shadow-lg position-relative group">
                            <!-- 🏷️ Badge -->
                            <div class="position-absolute top-0 end-0 m-3 badge bg-<?= $prod->category == 'ai' ? 'info' : ($prod->category == 'tool' ? 'success' : 'warning') ?> rounded-pill px-3 py-2 shadow-sm">
                                <?= strtoupper($prod->category) ?>
                            </div>

                            <!-- 🖼️ Image -->
                            <div class="position-relative overflow-hidden text-center p-4">
                                <img class="img-fluid rounded-3 service-img" 
                                     src="<?= BASE_URL . 'uploads/' . ($prod->image ?? 'default.png') ?>" 
                                     alt="<?= htmlspecialchars($prod->name) ?>" 
                                     style="height: 200px; object-fit: contain; transition: transform 0.5s;">
                            </div>

                            <!-- 📝 Content -->
                            <div class="p-4 text-center">
                                <h5 class="text-white mb-2 text-uppercase fw-bold"><?= $prod->name ?></h5>
                                <p class="text-white-50 mb-3 small" style="min-height: 60px;">
                                    <?= substr($prod->description, 0, 100) ?>...
                                </p>
                                
                                <h3 class="text-primary mb-4 fw-bold">$<?= number_format($prod->price, 2) ?></h3>

                                <div class="d-flex justify-content-center gap-2">
                                    <a href="https://t.me/specademy" target="_blank" class="btn btn-primary rounded-pill px-3 py-2 hover-scale flex-grow-1">
                                        <i class="fab fa-telegram-plane me-1"></i>Telegram
                                    </a>
                                    <a href="https://zalo.me/0708910952" target="_blank" class="btn btn-info text-white rounded-pill px-3 py-2 hover-scale flex-grow-1" style="background-color: #0068FF; border-color: #0068FF;">
                                        <i class="fas fa-comment-dots me-1"></i>Chat Zalo
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php Config::footer(); ?>

<style>
/* CSS bổ sung cho trang Product */
.hover-scale { transition: transform 0.2s; }
.hover-scale:hover { transform: scale(1.1); }
.glass-bg:hover .service-img { transform: scale(1.1) rotate(2deg); }
</style>

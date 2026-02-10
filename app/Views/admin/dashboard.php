<?php Config::header(); ?>

<div class="container-fluid py-5" style="margin-top: 100px;">
    <div class="container py-5">
        <div class="row g-4">
            <!-- Sidebar / Quick Actions -->
            <div class="col-lg-3 wow fadeInLeft" data-wow-delay="0.1s">
                <div class="glass-bg p-4 rounded-3 border border-white-50 shadow-lg">
                    <h5 class="text-primary mb-4 text-center text-uppercase">Admin Panel</h5>
                    <div class="nav flex-column nav-pills">
                        <a href="<?= Config::url() ?>admin" class="nav-link active btn btn-primary mb-2 text-start"><i class="fas fa-chart-line me-2"></i>Dashboard</a>
                        <a href="<?= Config::url() ?>admin/users" class="nav-link text-white mb-2"><i class="fas fa-users me-2"></i>Quáº£n LÃ½ User</a>
                        <a href="<?= Config::url() ?>admin/tool" class="nav-link text-white mb-2"><i class="fas fa-cubes me-2"></i>Quáº£n LÃ½ Tool</a>
                        <a href="<?= Config::url() ?>admin_chat.php" class="nav-link text-info fw-bold mb-2 bg-white bg-opacity-10 d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-comment-dots me-2"></i>Quáº£n LÃ½ Tin Nháº¯n</span>
                            <span id="sidebar-msg-badge" class="badge bg-danger rounded-pill shadow-sm" style="display:none;">0</span>
                        </a>
                        <a href="<?= Config::url() ?>admin/order" class="nav-link text-white mb-2"><i class="fas fa-shopping-cart me-2"></i>ÄÆ¡n HÃ ng</a>
                        <a href="<?= Config::url() ?>admin_images.php" class="nav-link text-white mb-2"><i class="fas fa-images me-2"></i>Quáº£n LÃ½ HÃ¬nh áº¢nh</a>
                        <hr class="text-white-50">
                        <a href="<?= Config::url() ?>auth/logout" class="nav-link text-danger"><i class="fas fa-sign-out-alt me-2"></i>ÄÄƒng Xuáº¥t</a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9 wow fadeInRight" data-wow-delay="0.2s">
                <div class="glass-bg p-5 rounded-3 border border-white-50 shadow-lg">
                    <div class="title mb-4">
                        <div class="title-left">
                            <h5>ChÃ o Admin, <?= $_SESSION['user_name'] ?></h5>
                            <h1>Há»‡ Thá»‘ng Quáº£n Trá»‹ DigitalPro</h1>
                        </div>
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-md-4">
                            <div class="p-4 bg-primary bg-opacity-10 border border-primary rounded-3 text-center">
                                <h2 class="text-primary counter">1,250</h2>
                                <p class="text-white-50 mb-0">Tá»•ng KhÃ¡ch HÃ ng</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 bg-success bg-opacity-10 border border-success rounded-3 text-center">
                                <h2 class="text-success counter">45</h2>
                                <p class="text-white-50 mb-0">ÄÆ¡n HÃ ng Má»›i</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 bg-info bg-opacity-10 border border-info rounded-3 text-center">
                                <h2 class="text-info counter">$12,400</h2>
                                <p class="text-white-50 mb-0">Doanh Thu ThÃ¡ng</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <h4 class="text-white mb-0">Quản Lý Sản Phẩm</h4>
                            <a href="<?= Config::url() ?>admin/product/add" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Thêm Sản Phẩm</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-white border-white-50 align-middle">
                            <thead>
                                <tr class="text-primary">
                                    <th>ID</th>
                                    <th>Hình Ảnh</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Giá</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($data['products'])): ?>
                                    <?php foreach ($data['products'] as $product): ?>
                                        <tr>
                                            <td>#<?= $product->id ?></td>
                                            <td>
                                                <img src="<?= BASE_URL . 'uploads/' . ($product->image ?? 'default.png') ?>" 
                                                     alt="<?= htmlspecialchars($product->name) ?>" 
                                                     class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                            </td>
                                            <td><?= htmlspecialchars($product->name) ?></td>
                                            <td class="text-info font-weight-bold">
                                                <?= number_format($product->price ?? 0) ?> đ
                                            </td>
                                            <td>
                                                <a href="<?= Config::url() ?>admin/product/edit?id=<?= $product->id ?>" class="btn btn-sm btn-outline-warning me-2" title="Sửa"><i class="fas fa-edit"></i></a>
                                                <a href="<?= Config::url() ?>admin/product/delete?id=<?= $product->id ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" title="Xóa"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-white-50 py-4">
                                            <i class="fas fa-box-open fa-3x mb-3 d-block opacity-50"></i>
                                            Chưa có sản phẩm nào.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const CHECK_INTERVAL = 5000;
    let pollTimer = null;

    function checkAdminMessages() {
        fetch('<?= Config::url() ?>ajax_chat.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'action=count'
        })
        .then(res => res.json())
        .then(data => {
            const badge = document.getElementById('sidebar-msg-badge');
            if (badge) {
                if (data.unread > 0) {
                    badge.innerText = data.unread;
                    badge.style.display = 'inline-block';
                    badge.classList.add('animate__animated', 'animate__pulse'); // Animation nếu có thư viện animate
                } else {
                    badge.style.display = 'none';
                }
            }
        })
        .catch(err => console.log('Chat check error: ', err));
    }

    function startPolling() {
        if (pollTimer) return;
        pollTimer = setInterval(checkAdminMessages, CHECK_INTERVAL);
    }

    function stopPolling() {
        if (!pollTimer) return;
        clearInterval(pollTimer);
        pollTimer = null;
    }

    // Check ngay khi load và lặp lại
    checkAdminMessages();
    startPolling();

    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            stopPolling();
        } else {
            checkAdminMessages();
            startPolling();
        }
    });
});
</script>
<?php Config::footer(); ?>


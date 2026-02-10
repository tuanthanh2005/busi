<?php require_once '../app/Views/layout/header.php'; ?>

<div class="container-fluid py-5" style="margin-top: 100px;">
    <div class="container py-5">
        <div class="row g-4">
            <!-- Sidebar / Quick Actions -->
            <div class="col-lg-3 wow fadeInLeft" data-wow-delay="0.1s">
                <div class="glass-bg p-4 rounded-3 border border-white-50 shadow-lg">
                    <h5 class="text-primary mb-4 text-center text-uppercase">Admin Panel</h5>
                    <div class="nav flex-column nav-pills">
                        <a href="<?= BASE_URL ?>admin" class="nav-link active btn btn-primary mb-2 text-start"><i class="fas fa-chart-line me-2"></i>Dashboard</a>
                        <a href="<?= BASE_URL ?>admin/users" class="nav-link text-white mb-2"><i class="fas fa-users me-2"></i>Quáº£n LÃ½ User</a>
                        <a href="<?= BASE_URL ?>admin/tool" class="nav-link text-white mb-2"><i class="fas fa-cubes me-2"></i>Quáº£n LÃ½ Tool</a>
                        <a href="<?= BASE_URL ?>admin_chat.php" class="nav-link text-info fw-bold mb-2 bg-white bg-opacity-10 d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-comment-dots me-2"></i>Quáº£n LÃ½ Tin Nháº¯n</span>
                            <span id="sidebar-msg-badge" class="badge bg-danger rounded-pill shadow-sm" style="display:none;">0</span>
                        </a>
                        <a href="<?= BASE_URL ?>admin/order" class="nav-link text-white mb-2"><i class="fas fa-shopping-cart me-2"></i>ÄÆ¡n HÃ ng</a>
                        <a href="<?= BASE_URL ?>admin_images.php" class="nav-link text-white mb-2"><i class="fas fa-images me-2"></i>Quáº£n LÃ½ HÃ¬nh áº¢nh</a>
                        <hr class="text-white-50">
                        <a href="<?= BASE_URL ?>auth/logout" class="nav-link text-danger"><i class="fas fa-sign-out-alt me-2"></i>ÄÄƒng Xuáº¥t</a>
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

                    <h4 class="text-white mb-4">Hoáº¡t Ä‘á»™n gáº§n Ä‘Ã¢y</h4>
                    <div class="table-responsive">
                        <table class="table text-white border-white-50">
                            <thead>
                                <tr class="text-primary">
                                    <th>ID</th>
                                    <th>KhÃ¡ch HÃ ng</th>
                                    <th>Dá»‹ch Vá»¥</th>
                                    <th>Tráº¡ng ThÃ¡i</th>
                                    <th>NgÃ y</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#101</td>
                                    <td>Nguyá»…n VÄƒn A</td>
                                    <td>Crypto Bot</td>
                                    <td><span class="badge bg-success">HoÃ n thÃ nh</span></td>
                                    <td>10/02/2026</td>
                                </tr>
                                <tr>
                                    <td>#102</td>
                                    <td>LÃª VÄƒn B</td>
                                    <td>Web Design</td>
                                    <td><span class="badge bg-warning">Chá» xá»­ lÃ½</span></td>
                                    <td>09/02/2026</td>
                                </tr>
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
        fetch('<?= BASE_URL ?>ajax_chat.php', {
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
<?php require_once '../app/Views/layout/footer.php'; ?>


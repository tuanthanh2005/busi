<?php require_once '../app/Views/layout/header.php'; ?>

<div class="container-fluid py-5" style="margin-top: 100px; min-height: 80vh;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="glass-bg p-5 rounded-3 border border-1 border-white-50 shadow-lg">
                    <div class="text-center mb-4">
                        <h2 class="text-white mb-2">Đăng Ký Tài Khoản</h2>
                        <p class="text-white-50">Gia nhập DigitalPro ngay hôm nay</p>
                    </div>
                    
                    <?php if(isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= BASE_URL ?>auth/doRegister" method="POST">
                        <div class="mb-3">
                            <label class="form-label text-white">Họ và tên</label>
                            <input type="text" name="full_name" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-white">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-white">Mật khẩu</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-2 mt-3">Đăng Ký</button>
                    </form>
                    
                    <div class="text-center mt-4">
                        <p class="text-white-50">
                            Đã có tài khoản? 
                            <a href="<?= BASE_URL ?>auth/login" class="text-primary">Đăng nhập ngay</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/Views/layout/footer.php'; ?>

<?php Config::header(); ?>

<div class="container-fluid py-5" style="margin-top: 100px; min-height: 85vh;">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Sidebar: User Avatar & Quick Info -->
            <div class="col-lg-4 wow fadeInLeft" data-wow-delay="0.1s">
                <div class="glass-bg p-5 rounded-4 border border-white-50 shadow-lg text-center h-100">
                    <div class="mb-4 position-relative d-inline-block">
                        <img src="<?= Config::url() ?>img/profile-placeholder.jpg" 
                             onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode($data['user']->full_name) ?>&size=200&background=764ba2&color=fff'"
                             class="rounded-circle border border-primary border-4 p-1 shadow-lg" 
                             style="width: 150px; height: 150px; object-fit: cover;">
                        <span class="position-absolute bottom-0 end-0 bg-success border border-white border-3 rounded-circle" 
                              style="width: 25px; height: 25px;"></span>
                    </div>
                    <h3 class="text-white mb-1"><?= $data['user']->full_name ?></h3>
                    <p class="text-primary mb-4 text-uppercase fw-bold"><?= $data['user']->role ?></p>
                    
                    <div class="d-flex justify-content-center gap-2 mb-4">
                        <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit me-1"></i> Edit Avatar</button>
                    </div>
                    
                    <hr class="text-white-50 my-4">
                    
                    <div class="text-start mb-4">
                        <p class="text-white-50 mb-1"><i class="fas fa-envelope me-2 text-primary"></i>Email</p>
                        <p class="text-white mb-3"><?= $data['user']->email ?></p>
                        
                        <p class="text-white-50 mb-1"><i class="fas fa-calendar-alt me-2 text-primary"></i>Ngày tham gia</p>
                        <p class="text-white mb-0"><?= date('d/m/Y', strtotime($data['user']->created_at)) ?></p>
                    </div>
                </div>
            </div>

            <!-- Main Content: History & Stats -->
            <div class="col-lg-8 wow fadeInRight" data-wow-delay="0.2s">
                <div class="glass-bg p-5 rounded-4 border border-white-50 shadow-lg h-100">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <h2 class="text-white mb-0">Dashboard Cá Nhân</h2>
                        <a href="<?= Config::url() ?>auth/logout" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-sign-out-alt me-1"></i> Đăng xuất
                        </a>
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-sm-4">
                            <div class="p-4 bg-primary bg-opacity-10 border border-primary rounded-3 text-center h-100">
                                <h2 class="text-primary mb-1">0</h2>
                                <p class="text-white-50 mb-0 small">Tools của tôi</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="p-4 bg-info bg-opacity-10 border border-info rounded-3 text-center h-100">
                                <h2 class="text-info mb-1">0</h2>
                                <p class="text-white-50 mb-0 small">Đơn hàng</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="p-4 bg-success bg-opacity-10 border border-success rounded-3 text-center h-100">
                                <h2 class="text-success mb-1">FREE</h2>
                                <p class="text-white-50 mb-0 small">Hạng thành viên</p>
                            </div>
                        </div>
                    </div>

                    <h4 class="text-white mb-4">Hoạt động gần đây</h4>
                    <div class="p-5 text-center bg-white bg-opacity-5 rounded-3 border border-white-10">
                        <i class="fas fa-ghost fa-3x text-white-50 mb-3 d-block"></i>
                        <p class="text-white-50 mb-0">Chưa có hoạt động nào được ghi lại.</p>
                        <a href="<?= Config::url() ?>" class="btn btn-primary mt-4">Khám phá dịch vụ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php Config::footer(); ?>

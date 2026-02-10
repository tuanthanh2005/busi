<?php Config::header(); ?>
        <div class="page-header pb-5">
            <div class="container text-center py-5">
                <span class="badge bg-info text-dark px-3 py-2 rounded-pill mb-3">Giới thiệu DigitalPro</span>
                <h1 class="display-4 text-uppercase mb-3 animated slideInDown">Tụi Mình Là Ai?</h1>
                <p class="text-white-50 lead mb-4">Chúng tôi xây dựng hệ sinh thái giải pháp số: AI Tools, Marketing Automation, và nội dung tăng trưởng bền vững.</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="<?= Config::url() ?>product" class="btn btn-primary rounded-pill px-4 py-2">Xem Sản Phẩm</a>
                    <a href="<?= Config::url() ?>home/service" class="btn btn-outline-light rounded-pill px-4 py-2">Dịch Vụ</a>
                </div>
                <nav aria-label="breadcrumb animated slideInDown" class="mt-4">
                    <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                        <li class="breadcrumb-item"><a class="text-white" href="<?= Config::url() ?>">Trang chủ</a></li>
                        <li class="breadcrumb-item text-primary active" aria-current="page">Giới thiệu</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- About Start -->
    <div class="container-fluid">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-7 pb-0 pb-lg-5 py-5">
                    <div class="pb-0 pb-lg-5 py-5">
                        <div class="title wow fadeInUp" data-wow-delay="0.1s">
                            <div class="title-left">
                                <h5>Câu chuyện</h5>
                                <h1>Đơn giản hóa tăng trưởng số</h1>
                            </div>
                        </div>
                        <p class="mb-4 wow fadeInUp" data-wow-delay="0.2s">DigitalPro khởi đầu từ nhu cầu thật: doanh nghiệp cần một bộ công cụ hiệu quả để tạo khách hàng, giữ chân người dùng và tối ưu chi phí. Chúng tôi kết hợp AI, automation và tư duy growth để tạo ra giải pháp vận hành gọn gàng, đo được kết quả.</p>
                        <ul class="list-group list-group-flush mb-5 wow fadeInUp" data-wow-delay="0.3s">
                            <li class="list-group-item bg-dark text-body border-secondary ps-0">
                                <i class="fa fa-check-circle text-primary me-1"></i> Giải pháp theo mục tiêu: tăng doanh số, tăng user, tối ưu vận hành.
                            </li>
                            <li class="list-group-item bg-dark text-body border-secondary ps-0">
                                <i class="fa fa-check-circle text-primary me-1"></i> Quy trình rõ ràng, đo lường minh bạch.
                            </li>
                            <li class="list-group-item bg-dark text-body border-secondary ps-0">
                                <i class="fa fa-check-circle text-primary me-1"></i> Cam kết hiệu suất, hỗ trợ dài hạn.
                            </li>
                        </ul>
                        <div class="row g-3 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="col-6">
                                <a href="<?= Config::url() ?>product" class="btn btn-outline-primary border-2 py-3 w-100">Khám phá tool</a>
                            </div>
                            <div class="col-6">
                                <a href="<?= Config::url() ?>home/service" class="btn btn-primary py-3 w-100">Tư vấn dịch vụ</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.5s">
                    <!-- TODO: Thêm ảnh brand/đội ngũ, tỉ lệ 4:5, size 900x1125 px -->
                    <img class="img-fluid rounded-4 shadow-lg" src="<?= Config::url() ?>img/about.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Highlights Start -->
    <div class="container-fluid py-5 bg-secondary">
        <div class="container py-5">
            <div class="row g-4 text-center">
                <div class="col-md-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="glass-card p-4 rounded-4 h-100">
                        <div class="display-6 text-primary fw-bold">120+</div>
                        <div class="text-white-50">Doanh nghiệp đã triển khai</div>
                    </div>
                </div>
                <div class="col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="glass-card p-4 rounded-4 h-100">
                        <div class="display-6 text-info fw-bold">3.5x</div>
                        <div class="text-white-50">Tăng tỉ lệ chuyển đổi</div>
                    </div>
                </div>
                <div class="col-md-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="glass-card p-4 rounded-4 h-100">
                        <div class="display-6 text-warning fw-bold">24/7</div>
                        <div class="text-white-50">Hỗ trợ & vận hành</div>
                    </div>
                </div>
                <div class="col-md-3 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="glass-card p-4 rounded-4 h-100">
                        <div class="display-6 text-success fw-bold">6</div>
                        <div class="text-white-50">Ngành nghề phục vụ</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Highlights End -->


    <!-- Values Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center">
                <div class="title wow fadeInUp" data-wow-delay="0.1s">
                    <div class="title-center">
                        <h5>Giá trị cốt lõi</h5>
                        <h1>Làm đúng, làm nhanh, làm sâu</h1>
                    </div>
                </div>
            </div>
            <div class="row g-4 mt-3">
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="glass-card p-4 rounded-4 h-100">
                        <h5 class="text-uppercase mb-2">Hiệu suất đo được</h5>
                        <p class="text-white-50 mb-0">Mọi hoạt động đều có KPI rõ ràng và báo cáo theo thời gian thực.</p>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="glass-card p-4 rounded-4 h-100">
                        <h5 class="text-uppercase mb-2">Hệ thống hóa</h5>
                        <p class="text-white-50 mb-0">Chuẩn hóa quy trình để tăng tốc triển khai, giảm lỗi vận hành.</p>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="glass-card p-4 rounded-4 h-100">
                        <h5 class="text-uppercase mb-2">Đồng hành dài hạn</h5>
                        <p class="text-white-50 mb-0">Không chỉ giao sản phẩm, chúng tôi cùng bạn tối ưu liên tục.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Values End -->


    <!-- CTA Start -->
    <div class="container-fluid py-5 bg-secondary">
        <div class="container py-5 text-center">
            <div class="title wow fadeInUp" data-wow-delay="0.1s">
                <div class="title-center">
                    <h5>Liên hệ</h5>
                    <h1>Bắt đầu lộ trình tăng trưởng</h1>
                </div>
            </div>
            <p class="fs-5 mb-4 wow fadeInUp" data-wow-delay="0.2s">Gửi mục tiêu kinh doanh, DigitalPro sẽ đề xuất gói phù hợp trong 24 giờ.</p>
            <a href="<?= Config::url() ?>home/contact" class="btn btn-primary rounded-pill px-5 py-3 wow fadeInUp" data-wow-delay="0.3s">Nhận tư vấn</a>
        </div>
    </div>
    <!-- CTA End -->


    <!-- Footer Start -->
<?php Config::footer(); ?>

<style>
.glass-card {
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(12px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.25);
}
</style>

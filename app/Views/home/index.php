<?php Config::header(); ?>
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="<?= Config::url() ?>img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="title mx-5 px-5 animated slideInDown">
                            <div class="title-center">
                                <h5>Chào Mừng Đến Với</h5>
                                <h1 class="display-1">Giải Pháp Số Toàn Diện</h1>
                            </div>
                        </div>
                        <p class="fs-5 mb-5 animated slideInDown">Chúng tôi cung cấp các giải pháp công nghệ tiên tiến: Blockchain, Web Design, và Marketing.</p>
                        <a href="<?= Config::url() ?>home/service" class="btn btn-outline-primary border-2 py-3 px-5 animated slideInDown">Xem Dịch Vụ</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="<?= Config::url() ?>img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="title mx-5 px-5 animated slideInDown">
                            <div class="title-center">
                                <h5>Công Nghệ Đỉnh Cao</h5>
                                <h1 class="display-1">Blockchain & Automation</h1>
                            </div>
                        </div>
                        <p class="fs-5 mb-5 animated slideInDown">Tối ưu hóa quy trình kinh doanh của bạn với các công cụ tự động hóa thông minh.</p>
                        <a href="<?= Config::url() ?>home/team" class="btn btn-outline-primary border-2 py-3 px-5 animated slideInDown">Xem Công Cụ</a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Header End -->


    <!-- About Start -->
    <div class="container-fluid bg-secondary">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-7 pb-0 pb-lg-5 py-5">
                    <div class="pb-0 pb-lg-5 py-5">
                        <div class="title wow fadeInUp" data-wow-delay="0.1s">
                            <div class="title-left">
                                <h5>Chúng Tôi Là Ai</h5>
                                <h1>Tiên Phong Công Nghệ Số</h1>
                            </div>
                        </div>
                        <p class="mb-4 wow fadeInUp" data-wow-delay="0.2s">DigitalPro là đơn vị hàng đầu cung cấp giải pháp chuyển đổi số toàn diện cho doanh nghiệp. Từ phát triển Blockchain, thiết kế Website đến các chiến dịch Marketing mạng xã hội.</p>
                        <ul class="list-group list-group-flush mb-5 wow fadeInUp" data-wow-delay="0.3s">
                            <li class="list-group-item bg-dark text-body border-secondary ps-0">
                                <i class="fa fa-check-circle text-primary me-1"></i> Giải Pháp Blockchain & Smart Contract
                            </li>
                            <li class="list-group-item bg-dark text-body border-secondary ps-0">
                                <i class="fa fa-check-circle text-primary me-1"></i> Thiết Kế Website Chuyên Nghiệp & Chuẩn SEO
                            </li>
                            <li class="list-group-item bg-dark text-body border-secondary ps-0">
                                <i class="fa fa-check-circle text-primary me-1"></i> Tăng Tương Tác & Quảng Cáo Mạng Xã Hội
                            </li>
                        </ul>
                        <div class="row wow fadeInUp" data-wow-delay="0.4s">
                            <div class="col-6">
                                <a href="<?= Config::url() ?>home/team" class="btn btn-outline-primary border-2 py-3 w-100">Mua Tool Ngay</a>
                            </div>
                            <div class="col-6">
                                <a href="<?= Config::url() ?>home/contact" class="btn btn-primary py-3 w-100">Liên Hệ Tư Vấn</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.5s">
                    <img class="img-fluid" src="<?= Config::url() ?>img/about.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Service Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center">
                <div class="title wow fadeInUp" data-wow-delay="0.1s">
                    <div class="title-center">
                        <h5>Dịch Vụ</h5>
                        <h1>Giải Pháp Của Chúng Tôi</h1>
                    </div>
                </div>
            </div>
            <div class="service-item service-item-left">
                <div class="row g-0 align-items-center">
                    <div class="col-md-5">
                        <div class="service-img p-5 wow fadeInRight" data-wow-delay="0.2s">
                            <img class="img-fluid rounded-circle" src="<?= Config::url() ?>img/service-1.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="service-text px-5 px-md-0 py-md-5 wow fadeInRight" data-wow-delay="0.5s">
                            <h3 class="text-uppercase">Blockchain & DApps</h3>
                            <p class="mb-4">Phát triển ứng dụng phi tập trung (DApps), Smart Contracts, và tích hợp ví điện tử. Cung cấp các công cụ hỗ trợ giao dịch và quản lý tài sản số an toàn, hiệu quả.</p>
                            <a class="btn btn-outline-primary border-2 px-4" href="<?= Config::url() ?>home/service">Chi Tiết <i
                                    class="fa fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="service-item service-item-right">
                <div class="row g-0 align-items-center">
                    <div class="col-md-5 order-md-1 text-md-end">
                        <div class="service-img p-5 wow fadeInLeft" data-wow-delay="0.2s">
                            <img class="img-fluid rounded-circle" src="<?= Config::url() ?>img/service-2.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="service-text px-5 px-md-0 py-md-5 text-md-end wow fadeInLeft" data-wow-delay="0.5s">
                            <h3 class="text-uppercase">Thiết Kế Website</h3>
                            <p class="mb-4">Thiết kế website bán hàng, doanh nghiệp với giao diện hiện đại, chuẩn SEO và tối ưu trải nghiệm người dùng (UX/UI). Hỗ trợ tích hợp cổng thanh toán và quản lý đơn hàng.</p>
                            <a class="btn btn-outline-primary border-2 px-4" href="<?= Config::url() ?>home/service">Chi Tiết <i
                                    class="fa fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="service-item service-item-left">
                <div class="row g-0 align-items-center">
                    <div class="col-md-5">
                        <div class="service-img p-5 wow fadeInRight" data-wow-delay="0.2s">
                            <img class="img-fluid rounded-circle" src="<?= Config::url() ?>img/service-3.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="service-text px-5 px-md-0 py-md-5 wow fadeInRight" data-wow-delay="0.5s">
                            <h3 class="text-uppercase">Dịch Vụ Mạng Xã Hội</h3>
                            <p class="mb-4">Cung cấp dịch vụ tăng tương tác, like, follow cho Facebook, TikTok, Instagram. Chạy quảng cáo đa nền tảng giúp tiếp cận khách hàng tiềm năng tối đa.</p>
                            <a class="btn btn-outline-primary border-2 px-4" href="<?= Config::url() ?>home/service">Chi Tiết <i
                                    class="fa fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="service-item service-item-right">
                <div class="row g-0 align-items-center">
                    <div class="col-md-5 order-md-1 text-md-end">
                        <div class="service-img p-5 wow fadeInLeft" data-wow-delay="0.2s">
                            <img class="img-fluid rounded-circle" src="<?= Config::url() ?>img/service-4.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="service-text px-5 px-md-0 py-md-5 text-md-end wow fadeInLeft" data-wow-delay="0.5s">
                            <h3 class="text-uppercase">Cung Cấp Tool MMO</h3>
                            <p class="mb-4">Các bộ công cụ hỗ trợ kiếm tiền online (MMO), tool nuôi tài khoản, tool auto tương tác và các phần mềm hỗ trợ marketing tự động.</p>
                            <a class="btn btn-outline-primary border-2 px-4" href="<?= Config::url() ?>home/team">Chi Tiết <i
                                    class="fa fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Banner Start -->
    <div class="container-fluid py-5 bg-secondary">
        <div class="container py-5">
            <div class="row g-0 justify-content-center">
                <div class="col-lg-7 text-center">
                    <div class="title mx-5 px-5 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="title-center">
                            <h5>Liên Hệ</h5>
                            <h1>Cần Tư Vấn Giải Pháp?</h1>
                        </div>
                    </div>
                    <p class="fs-5 mb-5 wow fadeInUp" data-wow-delay="0.2s">Để lại email của bạn, chúng tôi sẽ gửi báo giá và tư vấn giải pháp phù hợp nhất cho doanh nghiệp của bạn ngay lập tức.</p>
                    <div class="position-relative wow fadeInUp" data-wow-delay="0.3s">
                        <input class="form-control border-0 bg-dark rounded-pill w-100 py-4 ps-4 pe-5" type="text"
                            placeholder="Email của bạn">
                        <button type="button" class="btn btn-primary py-3 px-4 position-absolute top-0 end-0 me-2"
                            style="margin-top: 7px;">Đăng Ký</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->


    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center">
                <div class="title wow fadeInUp" data-wow-delay="0.1s">
                    <div class="title-center">
                        <h5>Sản Phẩm</h5>
                        <h1>Công Cụ & Giải Pháp Nổi Bật</h1>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="team-body">
                            <div class="team-before">
                                <span>Platform</span>
                                <span>Phiên Bản</span>
                                <span>Giá</span>
                            </div>
                            <img class="img-fluid" src="<?= Config::url() ?>img/team-1.jpg" alt="">
                            <div class="team-after">
                                <span>Windows</span>
                                <span>v2.4.0</span>
                                <span>$99/mo</span>
                            </div>
                        </div>
                        <a class="team-name" href="#">
                            <h5 class="text-uppercase mb-0">Auto Facebook Tool</h5>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item">
                        <div class="team-body">
                            <div class="team-before">
                                <span>Platform</span>
                                <span>Phiên Bản</span>
                                <span>Giá</span>
                            </div>
                            <img class="img-fluid" src="<?= Config::url() ?>img/team-2.jpg" alt="">
                            <div class="team-after">
                                <span>Web</span>
                                <span>v1.0.2</span>
                                <span>Liên hệ</span>
                            </div>
                        </div>
                        <a class="team-name" href="#">
                            <h5 class="text-uppercase mb-0">Smart Contract Audit</h5>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item">
                        <div class="team-body">
                            <div class="team-before">
                                <span>Platform</span>
                                <span>Phiên Bản</span>
                                <span>Giá</span>
                            </div>
                            <img class="img-fluid" src="<?= Config::url() ?>img/team-3.jpg" alt="">
                            <div class="team-after">
                                <span>All OS</span>
                                <span>v5.1</span>
                                <span>$150</span>
                            </div>
                        </div>
                        <a class="team-name" href="#">
                            <h5 class="text-uppercase mb-0">TikTok Seeding Bot</h5>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item">
                        <div class="team-body">
                            <div class="team-before">
                                <span>Platform</span>
                                <span>Phiên Bản</span>
                                <span>Giá</span>
                            </div>
                            <img class="img-fluid" src="<?= Config::url() ?>img/team-4.jpg" alt="">
                            <div class="team-after">
                                <span>Web/App</span>
                                <span>Cloud</span>
                                <span>$200/mo</span>
                            </div>
                        </div>
                        <a class="team-name" href="#">
                            <h5 class="text-uppercase mb-0">Crypto Trading Bot</h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->
    <div class="container-fluid py-5 bg-secondary">
        <div class="container py-5">
            <div class="text-center">
                <div class="title wow fadeInUp" data-wow-delay="0.1s">
                    <div class="title-center">
                        <h5>Đánh Giá</h5>
                        <h1>Khách Hàng Nói Gì Về Chúng Tôi</h1>
                    </div>
                </div>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.3s">
                <div class="testimonial-item text-center"
                    data-dot="<img class='img-fluid' src='<?= Config::url() ?>img/testimonial-1.jpg' alt=''>">
                    <p class="fs-5">Dịch vụ thiết kế web rất chuyên nghiệp, giao diện đẹp và tốc độ tải trang nhanh. Đội ngũ hỗ trợ nhiệt tình.</p>
                    <h5 class="text-uppercase">Nguyễn Văn A</h5>
                    <span class="text-primary">CEO - TechStart</span>
                </div>
                <div class="testimonial-item text-center"
                    data-dot="<img class='img-fluid' src='<?= Config::url() ?>img/testimonial-2.jpg' alt=''>">
                    <p class="fs-5">Tool nuôi nick Facebook chạy rất ổn định, giúp tôi tiết kiệm được rất nhiều thời gian và chi phí nhân sự.</p>
                    <h5 class="text-uppercase">Trần Thị B</h5>
                    <span class="text-primary">Marketing Manager</span>
                </div>
                <div class="testimonial-item text-center"
                    data-dot="<img class='img-fluid' src='<?= Config::url() ?>img/testimonial-3.jpg' alt=''>">
                    <p class="fs-5">Tư vấn giải pháp Blockchain rất chi tiết. Smart Contract được audit kỹ càng, đảm bảo an toàn cho dự án.</p>
                    <h5 class="text-uppercase">Lê Văn C</h5>
                    <span class="text-primary">Project Owner</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
    <?php Config::footer(); ?>

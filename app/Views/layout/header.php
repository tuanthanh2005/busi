<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Poseify - Modeling Agency Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?= BASE_URL ?>img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;700&family=Work+Sans:wght@400;600&display=swap&subset=vietnamese"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= BASE_URL ?>lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= BASE_URL ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= BASE_URL ?>css/style.css" rel="stylesheet">
    
    <!-- Particles.js for VIP Background Effect -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
</head>

<body>
    <!-- 💫 Particles Background -->
    <div id="particles-js"></div>
    
    <script>
    // 🚀 VIP PRO Particles Configuration
    particlesJS('particles-js', {
        particles: {
            number: {
                value: 80,
                density: {
                    enable: true,
                    value_area: 800
                }
            },
            color: {
                value: ['#667eea', '#764ba2', '#00f2fe', '#4facfe']
            },
            shape: {
                type: ['circle', 'triangle'],
                stroke: {
                    width: 0,
                    color: '#000000'
                }
            },
            opacity: {
                value: 0.5,
                random: true,
                anim: {
                    enable: true,
                    speed: 1,
                    opacity_min: 0.1,
                    sync: false
                }
            },
            size: {
                value: 3,
                random: true,
                anim: {
                    enable: true,
                    speed: 2,
                    size_min: 0.1,
                    sync: false
                }
            },
            line_linked: {
                enable: true,
                distance: 150,
                color: '#667eea',
                opacity: 0.4,
                width: 1
            },
            move: {
                enable: true,
                speed: 2,
                direction: 'none',
                random: false,
                straight: false,
                out_mode: 'out',
                bounce: false,
                attract: {
                    enable: true,
                    rotateX: 600,
                    rotateY: 1200
                }
            }
        },
        interactivity: {
            detect_on: 'canvas',
            events: {
                onhover: {
                    enable: true,
                    mode: 'grab'
                },
                onclick: {
                    enable: true,
                    mode: 'push'
                },
                resize: true
            },
            modes: {
                grab: {
                    distance: 140,
                    line_linked: {
                        opacity: 1
                    }
                },
                push: {
                    particles_nb: 4
                }
            }
        },
        retina_detect: true
    });
    </script>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Header Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-lg-5">
                <a href="<?= BASE_URL ?>" class="navbar-brand ms-4 ms-lg-0">
                    <img src="<?= BASE_URL ?>img/logo/logo-text.png" alt="Logo DigitalPro" style="height: 40px;">
                </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto p-4 p-lg-0">
                    <a href="<?= BASE_URL ?>" class="nav-item nav-link <?= ($active ?? '') == 'home' ? 'active' : '' ?>">Trang Chủ</a>
                    <a href="<?= BASE_URL ?>home/about" class="nav-item nav-link <?= ($active ?? '') == 'about' ? 'active' : '' ?>">Giới Thiệu</a>
                    <a href="<?= BASE_URL ?>home/service" class="nav-item nav-link <?= ($active ?? '') == 'service' ? 'active' : '' ?>">Dịch Vụ</a>
<a href="<?= BASE_URL ?>product" class="nav-item nav-link <?= ($active ?? '') == 'products' ? 'active' : '' ?>">Sản Phẩm</a>
                    <a href="<?= BASE_URL ?>home/contact" class="nav-item nav-link <?= ($active ?? '') == 'contact' ? 'active' : '' ?>">Liên Hệ</a>
                </div>
                <div class="d-none d-lg-flex align-items-center">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle btn btn-outline-primary border-2 py-2 px-4 me-3" data-bs-toggle="dropdown">
                                <i class="fa fa-user-circle me-1"></i>Hi, <?= explode(' ', $_SESSION['user_name'])[0] ?>
                            </a>
                            <div class="dropdown-menu m-0">
                                <?php if($_SESSION['user_role'] === 'admin'): ?>
                                    <a href="<?= BASE_URL ?>admin" class="dropdown-item text-primary fw-bold">Trang Quản Trị</a>
                                <?php endif; ?>
                                <a href="<?= BASE_URL ?>profile" class="dropdown-item">Thông Tin</a>
                                <a href="<?= BASE_URL ?>auth/logout" class="dropdown-item text-danger">Đăng Xuất</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a class="nav-item nav-link me-3 <?= ($active ?? '') == 'login' ? 'text-primary' : '' ?>" href="<?= BASE_URL ?>auth/login">Login</a>
                        <a class="btn btn-outline-primary border-2 py-2 px-4" href="<?= BASE_URL ?>auth/register">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>


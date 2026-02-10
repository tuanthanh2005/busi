/**
 * 🚀 DigitalPro - VIP PRO JavaScript Enhancements
 * Advanced interactions and animations
 */

(function ($) {
    "use strict";

    // 🌟 Navbar Scroll Effect
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $('.navbar').addClass('bg-dark shadow-lg');
        } else {
            $('.navbar').removeClass('bg-dark shadow-lg');
        }
    });

    // 💫 Smooth Scroll for Navigation
    $('a[href^="#"]').on('click', function (e) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 80
            }, 1000, 'easeInOutExpo');
        }
    });

    // 🎨 Dynamic Gradient Background Animation
    let gradientAngle = 0;
    setInterval(() => {
        gradientAngle = (gradientAngle + 1) % 360;
        // Background already animated via CSS, this is for future enhancements
    }, 100);

    // ✨ Add Sparkle Effect on Click
    $(document).on('click', function (e) {
        createSparkle(e.pageX, e.pageY);
    });

    function createSparkle(x, y) {
        const sparkle = $('<div class="sparkle"></div>');
        sparkle.css({
            left: x + 'px',
            top: y + 'px',
            position: 'absolute',
            width: '10px',
            height: '10px',
            background: 'radial-gradient(circle, #00f2fe, transparent)',
            borderRadius: '50%',
            pointerEvents: 'none',
            zIndex: 9999,
            animation: 'sparkleAnimation 0.6s ease-out forwards'
        });

        $('body').append(sparkle);

        setTimeout(() => {
            sparkle.remove();
        }, 600);
    }

    // 🎯 Product Card Enhanced Hover
    $('.team-item').hover(
        function () {
            $(this).find('img').css('filter', 'brightness(1.1) contrast(1.1)');
        },
        function () {
            $(this).find('img').css('filter', 'brightness(1) contrast(1)');
        }
    );

    // 🌈 Service Card Parallax Effect
    $('.service-item').each(function () {
        $(this).on('mousemove', function (e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const deltaX = (x - centerX) / centerX;
            const deltaY = (y - centerY) / centerY;

            $(this).find('.service-img').css({
                transform: `perspective(1000px) rotateY(${deltaX * 5}deg) rotateX(${-deltaY * 5}deg) scale(1.05)`
            });
        });

        $(this).on('mouseleave', function () {
            $(this).find('.service-img').css({
                transform: 'perspective(1000px) rotateY(0) rotateX(0) scale(1)'
            });
        });
    });

    // 🎪 Testimonial Enhanced Animation
    $('.testimonial-carousel').owlCarousel({
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        smartSpeed: 1000,
        center: true,
        dots: true,
        loop: true,
        margin: 25,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 1
            },
            768: {
                items: 1
            },
            992: {
                items: 1
            }
        }
    });

    // 🔥 Button Ripple Effect
    $('.btn').on('click', function (e) {
        const button = $(this);
        const ripple = $('<span class="ripple"></span>');

        const diameter = Math.max(button.width(), button.height());
        const radius = diameter / 2;

        const offset = button.offset();
        const x = e.pageX - offset.left - radius;
        const y = e.pageY - offset.top - radius;

        ripple.css({
            width: diameter,
            height: diameter,
            left: x + 'px',
            top: y + 'px'
        });

        button.append(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 600);
    });

    // 💎 Glassmorphism Cursor Follower (Optional - can be enabled)
    let cursorFollower = null;
    const enableCursorFollower = false; // Set to true to enable

    if (enableCursorFollower) {
        cursorFollower = $('<div class="cursor-follower"></div>');
        cursorFollower.css({
            position: 'fixed',
            width: '20px',
            height: '20px',
            borderRadius: '50%',
            background: 'radial-gradient(circle, rgba(0, 242, 254, 0.3), transparent)',
            border: '2px solid rgba(0, 242, 254, 0.5)',
            pointerEvents: 'none',
            zIndex: 10000,
            transition: 'transform 0.1s ease'
        });

        $('body').append(cursorFollower);

        $(document).on('mousemove', function (e) {
            cursorFollower.css({
                left: e.pageX - 10 + 'px',
                top: e.pageY - 10 + 'px'
            });
        });

        $('a, button, .btn').hover(
            function () {
                cursorFollower.css('transform', 'scale(2)');
            },
            function () {
                cursorFollower.css('transform', 'scale(1)');
            }
        );
    }

    // 🎬 Scroll Progress Indicator
    const progressBar = $('<div class="scroll-progress"></div>');
    progressBar.css({
        position: 'fixed',
        top: 0,
        left: 0,
        height: '3px',
        background: 'linear-gradient(90deg, #667eea 0%, #764ba2 50%, #00f2fe 100%)',
        zIndex: 10000,
        boxShadow: '0 0 10px rgba(0, 242, 254, 0.8)',
        transition: 'width 0.1s ease'
    });

    $('body').prepend(progressBar);

    $(window).on('scroll', function () {
        const scrollTop = $(window).scrollTop();
        const docHeight = $(document).height() - $(window).height();
        const scrollPercent = (scrollTop / docHeight) * 100;

        progressBar.css('width', scrollPercent + '%');
    });

    // 🌟 Counter Animation for Stats (if you add stats section)
    function animateCounter(element, target, duration = 2000) {
        const start = 0;
        const increment = target / (duration / 16);
        let current = start;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            $(element).text(Math.floor(current));
        }, 16);
    }

    // 📱 Mobile Menu Enhancement
    $('.navbar-toggler').on('click', function () {
        $(this).toggleClass('active');
    });

    // 🎨 Form Input Focus Effect
    $('.form-control').on('focus', function () {
        $(this).parent().addClass('input-focused');
    }).on('blur', function () {
        if (!$(this).val()) {
            $(this).parent().removeClass('input-focused');
        }
    });

    // ⚡ Lazy Loading Images Enhancement
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.classList.add('loaded');
                    observer.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // 🎯 Back to Top Button Enhanced
    const backToTop = $('.back-to-top');

    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            backToTop.fadeIn('slow');
        } else {
            backToTop.fadeOut('slow');
        }
    });

    backToTop.click(function () {
        $('html, body').animate({ scrollTop: 0 }, 1000, 'easeInOutExpo');
        return false;
    });

    // 🎪 WOW.js Initialization
    new WOW().init();

    // 🎨 Add Custom Animations on Scroll
    const animateOnScroll = () => {
        $('.service-item, .team-item, .testimonial-item').each(function () {
            const elementTop = $(this).offset().top;
            const elementBottom = elementTop + $(this).outerHeight();
            const viewportTop = $(window).scrollTop();
            const viewportBottom = viewportTop + $(window).height();

            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $(this).addClass('in-viewport');
            }
        });
    };

    $(window).on('scroll', animateOnScroll);
    animateOnScroll(); // Initial check

    // 🔊 Console Welcome Message
    console.log('%c🚀 DigitalPro - VIP PRO Edition', 'font-size: 20px; font-weight: bold; color: #00f2fe; text-shadow: 0 0 10px #00f2fe;');
    console.log('%cGiải Pháp Số Toàn Diện', 'font-size: 14px; color: #667eea;');
    console.log('%cPowered by Advanced Technology & Innovation', 'font-size: 12px; color: #764ba2;');

})(jQuery);

// 🎨 Add Sparkle Animation Keyframes
const style = document.createElement('style');
style.textContent = `
    @keyframes sparkleAnimation {
        0% {
            transform: scale(0) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: scale(3) rotate(180deg);
            opacity: 0;
        }
    }
    
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: scale(0);
        animation: rippleAnimation 0.6s ease-out;
        pointer-events: none;
    }
    
    @keyframes rippleAnimation {
        to {
            transform: scale(2);
            opacity: 0;
        }
    }
    
    .in-viewport {
        animation: fadeInScale 0.6s ease-out;
    }
    
    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
`;
document.head.appendChild(style);

$(document).ready(function () {
    $('.hamburger').click(function () {
        $(this).toggleClass('active');
        $('.navigation').toggleClass('active');
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 1) {
            $('.header').addClass('active');
        }

        else {
            $('.header').removeClass('active');
        }
    });

    $('.dropdown-menu').on('click', function () {
        if ($(window).width() <= 767) {
            $(this).toggleClass('open-menu');
        }
    });

    $(window).resize(function () {
        if ($(window).width() >= 1200) {
            $('.hamburger').removeClass('active');
            $('.navigation').removeClass('active');
        }
    });

    $('.banner').slick({
        arrows: false,
        dots: true,
        mobileFirst: true,
        autoplay: true,
    });
});
$(window).load(function () {
    $('.tabbing').children('.open1').hide();
    $('.tabbing').children('.open1').eq(0).show();
    $('ul.tab li').children('a').eq(0).addClass('active');
});

$(document).ready(function () {
    var topbar = jQuery('#header');
    jQuery(window).scroll(function () {
        if (jQuery(window).scrollTop() >= 4) {
            topbar.addClass('smaller');
        } else {
            topbar.removeClass('smaller');
        }
    });
    var scrolled_val = $(document).scrollTop().valueOf();
    if (scrolled_val >= 4) {
        topbar.addClass('smaller');
    }

    $('.right_bar span').click(function () {
        $('body').css('overflow', 'hidden');
        $('.menu-part').addClass('open_menu');
    });
    $('.close-m').click(function () {
        $('body').css('overflow', 'auto');
        $('.menu-part').removeClass('open_menu');
    });

    var wid = $(document).width();
    $(document).on('click', '.menu-sec h2', function (e) {
        $('.menu-sec h2').removeClass('active');
        $(this).addClass('active');
        if (wid <= 767) {
            if ($(this).siblings('ul').css('display') == 'block') {
                $('.menu-sec ul').slideUp();
                $('.menu-sec h2').removeClass('active');
                return false;
            }
            $('.menu-sec ul').slideUp();
            $(this).siblings('ul').slideDown();
        }
        else {
            $('.menu-sec ul').css('display', 'block');
        }
    });

    $('ul.tab li').click(function () {
        $('ul.tab li').children('a').removeClass('active');
        $('.tabbing').children('.open1').hide();
        $(this).children('a').addClass('active');
        $('.tabbing').children('.open1').eq($(this).index()).show();
    });

    $("#scrolled").click(function () {
        $('html,body').animate({
            scrollTop: $(".home").offset().top - 48
        }, 'slow');
    });





});
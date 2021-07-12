// ==============================
//  スティッキーヘッダー
//  ふわっと表示（フェードイン）
//  ローディング
// ==============================
jQuery(document).ready(function($) {

    //  スティッキーヘッダー
    // var $win = $(window),
    //   $main = $('main'),
    //   $nav = $('nav'),
    //   navHeight = $nav.outerHeight(),
    //   navPos = $nav.offset().top,
    //   fixedClass = 'is-fixed',
    //   animationClass = 'is-animation';

    // $win.on('load scroll', function () {
    //   var value = $(this).scrollTop();
    //   if (value > navPos) {
    //     $nav.addClass(fixedClass);
    //     $nav.addClass(animationClass);
    //     $main.css('margin-top', navHeight);
    //   } else {
    //     $nav.removeClass(animationClass);
    //     $nav.removeClass(fixedClass);
    //     $main.css('margin-top', '0');
    //   }
    // });
    //  ふわっと表示（フェードイン）
    $(window).scroll(function() {
        $('.fadein').each(function() {

            var targetElement = $(this).offset().top;
            var scroll = $(window).scrollTop();
            var windowHeight = $(window).height();

            if (scroll > targetElement - windowHeight + 200) {
                $(this).css('opacity', '1');
                $(this).css('transform', 'translateY(0)');
            }

        });
    });

    // ローディング
    $('.loader').fadeOut();
    $('.l-loader').delay(350).fadeOut('slow');

    // スライダー
    $('.carousel').carousel();

    // スマートフォン時、.tel-link クラスに a 要素を追加する ※タップしてTELすることができる
    var device = navigator.userAgent;
    if ((device.indexOf('iPhone') > 0 && device.indexOf('iPad') == -1) || device.indexOf('iPod') > 0 || device.indexOf('Android') > 0) {
        $('.tel-link').each(function() {
            var str = $(this).text();
            $(this).html($('<a class="">').attr('href', 'tel:' + str.replace(/-/g, '')).append(str + '</a>'));
        });
    }

    // toPageTop スクリプト
    var topBtn = $('#toPageTop');
    topBtn.hide();
    // スクロールが500に達したらボタン表示
    $(window).scroll(function() {
        if ($(this).scrollTop() > 500) {
            topBtn.fadeIn();
        } else {
            topBtn.fadeOut();
        }
    });
    topBtn.click(function() {
        $('body,html').animate({
            scrollTop: 0
        }, 500);
        return false;
    });

    // ページ内リンク
    var offset = 100;
    // $('a[href^*="#"]').click(function() {
    $('a[class*="pagelink"]').click(function() {
        var speed = 800;
        var href = jQuery(this).attr("href");
        var target = jQuery(href == "#" || href == "" ? 'html' : href);
        var position = target.offset().top - offset;
        jQuery('body,html').animate({
            scrollTop: position
        }, speed, 'swing');
        return false;
    });

    // アコーディオンの文言変更
    // <a class="btn-accordion" id="accordion-01" data-val="すべて表示する" data-toggle="collapse" href="#accordion01" aria-controls="#accordion01" aria-expanded="false">すべて表示する</a>
    $(".btn-accordion").each(function() {
        var idMei = $(this).attr("id");
        document.getElementById(idMei).onclick = handleClick;

        function handleClick() {
            var originText = $(this).data('val');
            this.text = (this.text == originText ? '閉じる' : originText);
        }
    });

    // ドロップダウンメニュー
    $('.dropdown > .nav-link').click(function() {
        $(this).next().toggle(500);
        $(this).toggleClass('open');
    });

    // グローバルナビ
    $('.nav-link').on('click', function(event) {
        console.log(event)
        $('.navbar-toggler').click();
    });

});
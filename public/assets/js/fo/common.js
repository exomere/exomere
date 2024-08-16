/* 전역 스크립트 */

// swiper
const swipers = document.querySelectorAll('.swiper:not(.main-swiper)');
//
// if(swipers.length) {
//     var swiper = new Swiper(".swiper:not(.main-swiper):not(.m-swiper)", {
//         loop: true,
//         fraction: true,
//         effect: 'fade',
//         parallax: true,
//         autoplay: false,
//         navigation: {
//             nextEl: ".swiper-button-next",
//             prevEl: ".swiper-button-prev",
//         },
//     });
// }


/* gnb*/

// gnb 마우스 오버
$(".nav_1deps_item").on('mouseenter click',
    function (e) {
        $('#header').addClass('on');
        $('.nav').addClass('on');
    }
);
$(".nav").on('mouseleave',
    function (e) {
        $('.nav').removeClass('on');
        $('#header').removeClass('on');
    }
);

// 언어선택
$(".language_select").on('click', function (e) {
    var $languageSelect = $(this);

    // 다른 열린 목록을 닫기 위해 전체 언어 선택 목록에서 'on' 클래스 제거
    $('.language_select').not($languageSelect).removeClass('on');

    // 클릭한 항목의 'on' 클래스 토글
    $languageSelect.toggleClass('on');

    // 다른 목록을 열고 닫기 위한 전환을 위한 자연스러운 애니메이션
    if ($languageSelect.hasClass('on')) {
        $languageSelect.find('.language_list').slideDown(100);
    } else {
        $languageSelect.find('.language_list').slideUp(100);
    }
});

// 클릭 시 목록 외부를 클릭하면 목록 닫기
$(document).on('click', function (e) {
    if (!$(e.target).closest('.language_select').length) {
        $('.language_select').removeClass('on').find('.language_list').slideUp(100);
    }
});


// 햄버거 lnb

// 언어변경

// 서치

// 위로가기
$(function () {
    AOS.init({
        duration: 1000,
        once: false,
    });
    window.addEventListener('load', function () {
        AOS.refresh();
    });

    const aosAnimation = document.querySelectorAll('[data-aos]');
    observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.intersectionRatio > 0) {
                entry.target.classList.add('aos-animate');
            } else {
                entry.target.classList.remove('aos-animate');
            }
        });
    });
    aosAnimation.forEach(aosObject => {
        observer.observe(aosObject);
    });


    // Top button 생성 및 추가
    var $topBtn = $("<a href='javascript:void(0)' class='top_btn z-[200]'><span class='sr-only'>TOP</span></a>").appendTo("body");
    var $specialMenu = $(".special_menu");
    var $footer = $("#footer");
    var documentHeight = $(document).height();
    var windowHeight = window.innerHeight;

    // 스크롤 이벤트 핸들러
    $(window).scroll(function () {
        var windowTop = window.scrollY;
        var footerHeight = $footer.outerHeight();
        var threshold = documentHeight - windowHeight - footerHeight - 20;

        // Top 버튼 표시/숨김
        if (windowTop > 100) {
            $topBtn.fadeIn();
        } else {
            $topBtn.fadeOut();
        }

        // Top 버튼 위치 조정
        if (windowTop >= threshold) {
            $topBtn.addClass("bottom").css({
                bottom: "auto",
                top: (threshold + windowHeight) - windowTop - 70 + "px"
            });
            $specialMenu.css({bottom: (footerHeight + 98) + "px"});
        } else {
            $topBtn.removeClass("bottom").css({top: "auto", bottom: ""});
            $specialMenu.css({bottom: ""});
        }
    });

    // Top 버튼 클릭 이벤트
    $topBtn.click(function () {
        $("html, body").animate({scrollTop: 0}, 400);
    });



    $(window).scroll(function () {
        const header = document.querySelector('#header'),
            ww = document.body.scrollWidth;

            let scTop = window.pageYOffset;
            if (scTop > 0) {
                header.classList.add('scroll');
            } else {
                header.classList.remove('scroll');
            }

    })

    /*modal*/
    window.openModal = function (modalId) {
        document.getElementById(modalId).style.display = 'block'
        document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
    }

    window.closeModal = function (modalId) {
        document.getElementById(modalId).style.display = 'none'
        document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
    }

    // Close all modals when press ESC
    document.onkeydown = function (event) {
        event = event || window.event;
        if (event.keyCode === 27) {
            document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
            let modals = document.getElementsByClassName('modal');
            Array.prototype.slice.call(modals).forEach(i => {
                i.style.display = 'none'
            })
        }
    };

});

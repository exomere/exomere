/* 전역 스크립트 */

/* gnb*/

// gnb 마우스 오버
$(".__nav").on('mouseenter click',
    function (e) {
        $('#header').addClass('on');
        $('.__nav').addClass('on');
    }
);
$(".__nav").on('mouseleave',
    function (e) {
        $('.__nav').removeClass('on');
        $('#header').removeClass('on');
    }
);

// 서치

// 위로가기
$(function () {
    AOS.init({
        duration: 700,
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
    var $topBtn = $("<a href='javascript:void(0)' class='top_btn right-[1rem] lg:right-[8rem] z-[200]'><span class='sr-only'>TOP</span></a>").appendTo("body");
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
        // if (windowTop >= threshold) {
        //     $topBtn.addClass("bottom").css({
        //         bottom: "auto",
        //         top: (threshold + windowHeight) - windowTop - 70 + "px"
        //     });
        // } else {
        //     $topBtn.removeClass("bottom").css({top: "auto", bottom: ""});
        // }
    });

    // Top 버튼 클릭 이벤트
    $topBtn.click(function () {
        $("html, body").animate({scrollTop: 0}, 400);
    });


    /*header scroll*/
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

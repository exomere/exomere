/* 홈페이지 */

// 모바일용 스와이퍼
let swiperInstance;

function initializeSwiper() {
    swiperInstance = new Swiper('.m-swiper', {
        // Swiper options
        loop: true,
        fraction: true,
        effect: 'fade',
        parallax: true,
        navigation: {
            nextEl: '.m-swiper .swiper-button-next',
            prevEl: '.m-swiper .swiper-button-prev',
        },
    });
}

function destroySwiper() {
    if (swiperInstance) {
        swiperInstance.destroy(true, true);
        swiperInstance = null;
    }
}

function handleResize() {
    const isMobile = window.innerWidth <= 1024;

    if (isMobile && !swiperInstance) {
        initializeSwiper();
    } else if (!isMobile && swiperInstance) {
        destroySwiper();
    }
}

// Initial check
handleResize();

// Listen for resize events
window.addEventListener('resize', handleResize);



$(document).ready(function () {
    const progressLine = document.querySelector('.main-swiper .autoplay-progress svg')
    const mainSwiper = new Swiper(".main-swiper", {
        speed: 500,
        loop: true,
        touchEventsTarget: 'swiper-wrapper',

        //자동 재생
        autoplay: {
            delay: 10000000,
            disableOnInteraction: false,
        },

        // bullet
        pagination: {
            el: ".main-swiper .swiper-pagination",
            clickable: false,
            type: "custom",
            renderCustom: function (swiper, current, total) {
                return (
                    '<span class="text-black">' + (current < 10 ? '0' : '') + current + '</span>' +
                    '<span class="text-black">' + (total < 10 ? '0' : '') + total + '</span>'
                );
            }
        },

        //arrow
        navigation: {
            nextEl: ".main-swiper .swiper-button-next",
            prevEl: ".main-swiper .swiper-button-prev",
        },
        on: {
            autoplayTimeLeft(s, time, progress) {
                progressLine.style.setProperty("--progress", 1 - progress)
            },
            activeIndexChange: function () {
                const currentSlide = this.slides[this.activeIndex];
                const video = currentSlide.querySelector('video');
                video.currentTime = 0;
                video.play();
            },
        }
    });

    const progressLine2 = document.querySelector('.material-swiper .autoplay-progress svg')
    const mainSwiper2 = new Swiper(".material-swiper", {
        speed: 500,
        loop: true,
        fraction: true,
        effect: 'fade',
        parallax: true,
        touchEventsTarget: 'swiper-wrapper',

        //자동 재생
        autoplay: {
            delay: 15000,
            disableOnInteraction: false,
        },

        // bullet
        pagination: {
            el: ".material-swiper .swiper-pagination",
            clickable: false,
            type: "custom",
            renderCustom: function (swiper, current, total) {
                return (
                    '<span class="text-black">' + (current < 10 ? '0' : '') + current + '</span>' +
                    '<span class="text-black">' + (total < 10 ? '0' : '') + total + '</span>'
                );
            }
        },

        //arrow
        navigation: {
            nextEl: ".material-swiper .swiper-button-next",
            prevEl: ".material-swiper .swiper-button-prev",
        },

        on: {
            autoplayTimeLeft(s, time, progress) {
                progressLine2.style.setProperty("--progress", 1 - progress)
            },
        }
    });




})

/* 홈페이지 */
$(document).ready(function () {
    const progressLine = document.querySelector('.autoplay-progress svg')
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
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
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

})

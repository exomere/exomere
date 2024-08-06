
//main.js
function playHz(idn) {
    document.getElementById(idn).play();
    document.getElementById(idn).controls = true;
    setInterval(function(){
        if($('#'+idn).prop("ended")){
            $('#'+idn).siblings(".play_btn").fadeIn();
            document.getElementById(idn).controls = false;
        }
    },200);
}
function pauseHz(idn) {
    document.getElementById(idn).pause();
    document.getElementById(idn).controls = false;
}

$(".play_btn").click(function(){
    $(this).fadeOut();
});
$(".interview_video_2 .btn_more").click(function(){
    $(this).siblings(".video").children(".play_btn").fadeIn();
})

$('.btn_right').click(function(){
    offsetY = window.pageYOffset;
    $('body').addClass('scrollDisable').css({top: -offsetY + "px"});
    $('.interview_video_2').addClass('on');
});
$('.btn_left').click(function(){
    $('body').removeClass('scrollDisable').css({top:""})
    $(window).scrollTop(offsetY);
    $('.interview_video_2').removeClass('on');
});


// KV �섏젙
if($(".main_kv_swiper .swiper-slide").length > 1){
    var mainkvSwiper = new Swiper(".main_kv_swiper", {
        speed:500,
        loop:true,
        autoplay: {
            delay: main_kv_time,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.main_kv_next',
            prevEl: '.main_kv_prev',
        },
        touchEventsTarget: 'swiper-wrapper',
        on:{
            // * 23.01.16
            slideChangeTransitionEnd:function(){
                var active_num = $(".main_kv_swiper .swiper-slide-active").index()
                if(active_num%2 == 0){
                    $(".main_kv_progress_bar p:nth-child(2)").addClass("active").css({"transition-duration":main_kv_time+"ms"}).siblings().css({"transition-duration":"0ms"}).removeClass("active")
                } else {
                    $(".main_kv_progress_bar p:nth-child(1)").addClass("active").css({"transition-duration":main_kv_time+"ms"}).siblings().css({"transition-duration":"0ms"}).removeClass("active")
                }

                if($(".main_kv_swiper .swiper-slide-active").find('a').length) {
                    var activeButton =  $(".main_kv_swiper .swiper-slide-active").find('a');
                    var button =  $(".main_kv_swiper .swiper-slide:not(.swiper-slide-active) a")
                    activeButton.attr('tabindex','0');
                    button.attr('tabindex','-1');
                }
            },
            activeIndexChange:function(){
                var num = this.activeIndex;
                if(this.slides[num].getElementsByTagName('video').length) {
                    var video = this.slides[num].getElementsByTagName('video')[0]
                    video.currentTime = 0
                    video.play()
                }else {
                    var video = $(".main_kv_swiper .swiper-slide .video").find('video');
                    video.each(function(){
                        if(!$(this).paused) {
                            video.get(0).currentTime = 0
                            video.get(0).pause()
                        }
                    })
                }
                //dev add
                if($("#header").hasClass("dark")===true){
                    $('#header').removeClass("dark")
                }
                $('#header').addClass(this.slides[num].getAttribute('data-col'))
            },
            // 23.01.16 *
        },
        pagination:{
            el:'.main_kv_pagination',
            type:'custom',
            renderCustom: function (mainkvSwiper, current, total) {
                var customPaginationHtml = "";
                if(total < 10){
                    total = "0" + total
                }
                if(current < 10){
                    current = "0" + current
                }
                var fraction =  '<span class="num_current">'+current+'</span><span class="num_total">'+total+'</span>';
                return  fraction;
            }
        }
    });

    $(".main_kv_progress_bar p:nth-child(1)").addClass("active").css({"transition-duration":main_kv_time+"ms"})

} else { //23.01.17
    $(".main_kv_controller, .main_kv_arrowkey").hide();
    $(".main_kv_swiper .swiper-slide").addClass("swiper-slide-active");
}

let keyvisualSliderActive = true;
$(".main_kv_pause").click(function() {
    if (keyvisualSliderActive) {
        mainkvSwiper.autoplay.stop();
        keyvisualSliderActive = false;
        this.innerHTML = 'PLAY';
        $(this).addClass("pause")
        $(".main_kv_progress_bar").addClass("pause")
    } else {
        mainkvSwiper.autoplay.start();
        keyvisualSliderActive = true;
        this.innerHTML = 'PAUSE';
        $(this).removeClass("pause")
        $(".main_kv_progress_bar").removeClass("pause")
    }
});
var etcservicesSwiper = new Swiper(".etcservices_swiper", {
    slidesPerView:3,
    spaceBetween:40,
    breakpoints: {
        320: {
            slidesPerView:1.2,
            spaceBetween:15, // 221229 �섏젙
            centeredSlides: true, //23.02.02 異붽�
        },
        769: {
            slidesPerView:3,
            spaceBetween:40,
            centeredSlides: false, //23.02.02 異붽�
        }
    },
});

// * 23.01.16 �섏젙 ~
function optimizeAnimation(callback) {
    let ticking = false;
    return () => {
        if (!ticking) {
            ticking = true;
            requestAnimationFrame(() => {
                callback();
                ticking = false;
            });
        }
    };
}
// scroll active
var videoFlag = false;
function scrollActive() {
    var position = $(window).scrollTop();
    $('.scroll_ani').each(function (e) {
        var posY = $(this).offset().top - window.innerHeight / 3;
        var posYb = $(this).offset().top + $(this).height();

        // 220104 �섏젙
        if(position < window.innerHeight / 3) {
            $(".products").removeClass('active');
        }
        if($(this).hasClass('products')) {
            posY = $(this).offset().top - window.innerHeight;
        }
        // 220104 �섏젙 END
        if (position >= posY && posYb > position)  {
            $(this).addClass('active');
            if($(this).hasClass("etcservices")){
                $(".banner_item").addClass("hidden");
            }
        }else {
            $(this).removeClass('active');
            $(".banner_item").removeClass('hidden');
        }
    })

    $('.scroll_ani_half').each(function (e) {
        var posY = $(this).offset().top - window.innerHeight / 2;
        var posYb = $(this).offset().top + $(this).height();
        if (position >= posY && posYb > position)  {
            $(this).addClass('active')
        }else {
            $(this).removeClass('active');
        }
    })

    $('.scroll_ani_last').each(function (e) {
        var posY = $(this).offset().top - $(this).innerHeight() - $('#footer').innerHeight();
        var posYb = $(this).offset().top + $(this).height();
        if (position >= posY && posYb > position)  {
            $(this).addClass('active')
        }else {
            $(this).removeClass('active');
        }
    })
}

scrollActive();
window.addEventListener('scroll', optimizeAnimation(scrollActive), { passive: true })
// 23.01.16 �섏젙 *

// <!-- 221216 (publisher) -->
var UserAgent = navigator.platform;
$(".btn_scroll").click(function(){
    $("body,html").animate({scrollTop:$(".scroll_positon").offset().top - 82}, 500);
})
if (UserAgent.match(/i(Phone|Pod)/i) != null ){

}

// 220104 �덉씠�댄뙘�� �몄텧 �ㅽ겕由쏀듃 �섏젙
// �덉씠�댄뙘�� �몄텧
var layerPopupOpen = function(){
    $("body").append("<div class='layer_dim'></div>").addClass("scrollDisable")
    $(".layer_dim").show()

    // 23.02.26 �섏젙 ~
    if($('.layer_swiper .swiper-slide').length > 1) {
        var layerPopupTime = 13000
        var layerSwiper = new Swiper(".layer_swiper", {
            speed:500,
            loop:true,
            slidesPerView: 1,
            touchEventsTarget: 'swiper-wrapper', // 23.01.31 異붽�
            autoplay: {
                delay:layerPopupTime,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.layer_next',
                prevEl: '.layer_prev',
            },
            pagination:{
                el:'.layer_pagination',
                type:'fraction',
            }
        });
        var layerProgressbar = new Swiper(".layer_swiper", {
            loop:true,
            slidesPerView: 1,
            pagination:{
                el:'.layer_progress_bar',
                type:'progressbar',
            },
        });
        layerSwiper.controller.control = layerProgressbar;
        layerProgressbar.controller.control = layerSwiper;
    } else {
        $('.layer_swiper').addClass('disabled')
    }
    // ~ 23.02.26

    // 23.01.31 ~
    $(".layer_popup").attr('tabindex','0').focus();
    $(".layer_popup .btn_close").keydown(function(e){
        if (e.keyCode === 9) {
            if(e.shiftKey) {
                $('.today_hide input').focus()
            }else {
                $(".layer_popup").focus()
            }
        }
    })
    $(".layer_popup").keydown(function(e){
        // ESCAPE
        if (e.keyCode === 27) {
            layerPopupClose();
        }
        if (e.keyCode === 9) {
            if(e.shiftKey) {
                $(".layer_popup .btn_close").focus()
            }
        }
    })
    $('.layer_dim').click(function(){
        $(".layer_popup .btn_close").focus()
    })

    $('.today_hide input').keypress(function(e) {
        if (e.keyCode == 13) {
            $('.today_hide label').click();
            return e.preventDefault();
        }
    })
    // ~ 23.01.31
}

// �덉씠�댄뙘�� �リ린
var layerPopupClose = function(){
    $("body").removeClass("scrollDisable")
    $(".layer_dim").hide()
    $(".layer_popup").hide().removeAttr('tabindex')
    //23.02.02 ��젣

    //dev add
    if($('#todayhide').prop('checked')){
        setCookieToday('mainPopup','done')
    }

}

// layerPopupOpen()

// 23.02.09 異붽�
if($('.scroll_ani_half button,.scroll_ani_half a').length) {
    $('.scroll_ani_half button,.scroll_ani_half a').focus(function(){
        $(this).parents('.scroll_ani_half').addClass('focus')
    })
    $('.scroll_ani_half button,.scroll_ani_half a').blur(function(){
        $(this).parents('.scroll_ani_half').removeClass('focus')
    })
}

function setCookieToday(name, value, expiredays) {
    var todayDate = new Date();
    todayDate = new Date(parseInt(todayDate.getTime() / 86400000) * 86400000 + 54000000);
    if (todayDate > new Date()) {
        expiredays = expiredays - 1;
    }
    todayDate.setDate(todayDate.getDate() + expiredays);
    document.cookie = name+'='+encodeURIComponent(value)+'; path=/; expires='+todayDate.toGMTString()
}


//dev add

$(function(){
    getPopupData()
    getRecommendProductData()

    //kv 泥섏쓬吏꾩엯��
    // $('#header').addClass($(".main_kv_swiper .swiper-slide")[0].getAttribute('data-col'))

    for(var i=0; i<$(".main_kv_swiper .swiper-slide").length; i++){
        if($(".main_kv_swiper .swiper-slide")[i].getAttribute('data-swiper-slide-index') === "0" || $(".main_kv_swiper .swiper-slide")[i].getAttribute('data-swiper-slide-index') === null){
            $('#header').addClass($(".main_kv_swiper .swiper-slide")[i].getAttribute('data-col'))
            break;
        }
    }
})

function getPopupData(){
    // $.ajax({
    //     url: "/kr/ko/adm/pop/popup.json",
    //     dataType : "JSON",
    //     async : false,
    //     success: function(result){
    //         if(result.useYn == 'T' && result.list.length > 0 && document.cookie.indexOf('mainPopup') == -1){
    //             result.list = result.list.filter(function(_date){return _date.startDate <= today && today <= _date.endDate})
    //             if(result.list.length > 0){
    //                 drawPopup(result)
    //             }
    //         }
    //     }
    // })
}

function drawPopup(item){
    console.log('item', item)
    var txt = ''
    for(var i=0;i<item.list.length;i++){
        txt += '<div class="swiper-slide">'
        txt += '    <a href="'+item.list[i].url+'" '+(item.list[i].url && item.list[i].target == 'T' ? 'target="_blank"' : '')+' >'
        txt += '        <img src="'+item.list[i].img+'" alt="'+item.list[i].imgAlt+'">'
        txt += '    </a>'
        txt += '</div>'
    }
    $('#pop-list').html(txt)
    $('.layer_popup').show()
    layerPopupOpen()
}

function getRecommendProductData(){

    // $.ajax({
    //     url: "/kr/ko/adm/main/products/recommendProduct.json",
    //     dataType : "JSON",
    //     async : false,
    //     success: function(result){
    //         result.list = result.list.filter(function(_date){return _date.startDate <= today && today <= _date.endDate})
    //         drawRecommendProduct(result)
    //     }
    // })
}

function drawRecommendProduct(data){
    var txt = ''
    var item = data.list

    for(var i = 0 ; i < item.length; i++){
        txt += '<li class="product_item">'
        txt += '    <a href="'+item[i].url + (item[i].option ? '?option='+item[i].option : '')+'" ap-click-area="Product" ap-click-name="click Product Detail Link" ap-click-data="'+item[i].title+'">'
        txt += '            <!-- �몃꽕�� �대�吏� -->'
        txt += '            <div class="img">'
        txt += '                <img src="'+item[i].img+'" alt="'+item[i].imgAlt+'">'
        txt += '                <!-- 留덉슦�ㅼ삤踰� �대�吏� -->'
        txt += '                <span>'
        txt += '                    <img src="'+item[i].hover+'" alt="'+item[i].hoverAlt+'">'
        txt += '                </span>'
        txt += '            </div>'
        txt += '            <!-- �쒗뭹 �뺣낫 -->'
        txt += '            <div class="info">'
        txt += '            <!-- flag 理쒕� 2媛� �몄텧 -->'
        txt += '            <ul class="flag">'
        txt += '                '+(!!item[i].badge[0] ? (item[i].badge[0].startDate <= today && today <= item[i].badge[0].endDate ? '<li>'+item[i].badge[0].flag+'</li>' : '') : '')+'</li>'
        txt += '                '+(!!item[i].badge[1] ? (item[i].badge[1].startDate <= today && today <= item[i].badge[1].endDate ? '<li>'+item[i].badge[1].flag+'</li>' : '') : '')+'</li>'
        txt += '            </ul>'
        txt += '            <!-- �쒗뭹紐� -->'
        txt += '            <p class="name">'
        txt += '            <!-- �쇱씤紐� -->'
        txt += '                <strong>'+item[i].lineName+'</strong>'
        txt += '                <!-- �쒗뭹紐� -->'
        txt += '                <strong>'+item[i].title+'</strong>'
        txt += '            </p>'
        txt += '            <!-- �먰룷�명듃 臾멸뎄 -->'
        txt += '            <em>'+item[i].sub+'</em>'
        txt += '        </div>'
        txt += '    </a>'
        txt += '</li>'
        if(i == 2 && data.hoverImg){
            txt += '<li class="pic">'
            txt += '    <div class="img">'
            txt += '        <img src="'+data.hoverImg+'" alt="'+data.hoverAlt+'">'
            txt += '    </div>'
            txt += '</li>'
        }
    }
    $('#recommend_product h3>p').html(data.title)
    $('#main_product').html(txt)
}
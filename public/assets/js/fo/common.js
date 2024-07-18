// common.js
(function(d) {
    var config = {
            kitId: 'yyd2kyt',
            scriptTimeout: 3000,
            async: true
        },
        h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
})(document);

$(function(){
    // $("body").append("<p class='width_size'></p>")

    //dev add
    getMenuList()
    getLanguageList()
    getSpecialMenuList()
})

var bodyFixed = function(){
    offsetY = window.pageYOffset;
    $("#header").addClass("expanded")
    $("body").css({
        position:"fixed",
        width:"100%",
        height:"100%",
        top: -offsetY + "px"
    });
}
var bodyFixedClose = function(){
    offsetY = window.pageYOffset;
    $("body").css({
        position: "",
        width: "",
        height: "",
        top:""
    });
    $(window).scrollTop(offsetY);
    $("#header").removeClass("expanded");
}


var apInterview = function(){
    bodyFixed()
    $("#wrap").addClass("scroll");
}

var apInterviewClose = function(){
    bodyFixedClose()
    $("#wrap").removeClass("scroll");
}

var searchShow = function(){
    globalSearchReset();
    var wrap = $("#wrap") // 23.01.12
    if(wrap.hasClass("search-show")){
        wrap.removeClass("search-show");
        $(".btn_search").removeClass("active")
        $("header .search_wrap").removeClass("active").slideUp(300)
        $(".dim").fadeOut(300);
        $("#header").removeClass("search")
    } else {
        wrap.addClass("search-show");
        $(".btn_search").addClass("active")
        $("header .search_wrap").addClass("active").slideDown(300)
        $(".dim").fadeIn(300);
        $("#header").addClass("search")
    }
}
var searchHide = function(){
    globalSearchReset();
    $("#wrap").removeClass("search-show");
    $(".btn_search").removeClass("active")
    $("header .search_wrap").slideUp(300)
    $(".dim").hide();
    $("#header").removeClass("search")
}

//dev add
var deviceChk = /iPhone|iPod|iPad|BlackBerry|Android|Windows CE|LG|MOT|SAMSUNG|SonyEricsson/i.test(navigator.userAgent) ? 'MOBILE' : 'PC';

//dev add
function globalSearchReset(){
    $('#global-search').val('');
    $('.autocomplete').hide();
    $('#global_search_del').removeClass('on');
}

function resizeContent() {
    var windowHeight = $(window).height();
    var windowWidth = $(window).width();
    var headerHeight = $("header").outerHeight(true);
    var footerHeight = $("footer").outerHeight(true);
    $("main").css({minHeight:(windowHeight-footerHeight)*0.1+"rem"})
    var docHeight = windowHeight-footerHeight
    var contentHeight = $("#container").height() - 75
    if(docHeight > contentHeight){
        $("#content").css({paddingBottom:"7.5rem"})
    }
    var features_itemHeight = $(".pdp .features_item .img img").height();
    $(".pdp .features_item .img, .product_details").css({height:features_itemHeight+"px"});
    $("#content").css({marginTop:headerHeight+"px"})
    $(".errors .layout_inner").css({minHeight:(windowHeight-(headerHeight+footerHeight))*0.1+"rem"})
    // 23.02.06 소스 삭제
    /* 23.01.17 주석처리 ~
    if($(".our_story").length){
        $(".our_story .breadcrumbs").css({top:(headerHeight+20)+"px"})
        $(".our_story .story_keyvisual").css({paddingTop:headerHeight+"px"})
    }
    */

    if($(".main_keyvisual").length){
        // var UserAgent = navigator.platform;
        // if (UserAgent.match(/i(Phone|Pod)/i) != null ){
        //     $(".btn_scroll").click(function(){
        //         $("body,html").animate({scrollTop:windowHeight+60}, 500);
        //     })
        // } else{
        //     $(".btn_scroll").click(function(){
        //         $("body,html").animate({scrollTop:windowHeight+40}, 500);
        //     })
        // }
        // $(".btn_scroll").click(function(){
        //     $("body,html").animate({scrollTop:windowHeight+60}, 500);
        // })
    }
    var newitemHeight = $(".newness .product_item:nth-of-type(1)").outerHeight(true)
    if($(".newness").length){
        $(".banner_item").css({minHeight:(newitemHeight*0.1)+"rem"})
    }
    // 23.01.11
    $(function(){
        $(".newness_content .item:first-child .banner_item").addClass("on")
    })
    if(windowWidth > 1280){
        $("#wrap").removeClass("mobile");
        $("#wrap").addClass("normal");
        $("#header").removeClass("expanded");
        bodyFixedClose();
        searchHide()
        $(".gnb-1dep-item").removeClass("open");
        $(".utility").css({top:""})
        // 23.01.11 수정
        if($('#wrap').hasClass('scroll')) {
            $("#gnb .nv_btn").css({width:windowWidth+"px", top:82+"px"}) // 23.02.08 수정
            $(".search_wrap").css({top:82+"px"})
        }else {
            $("#gnb .nv_btn").css({width:windowWidth+"px", top:156+"px"}) // 23.02.08 수정
            $(".search_wrap").css({top:156+"px"})
        }
        $(".gnb-1dep-item").hover(
            function(e){
                searchHide()
                $(this).closest("#header").addClass("hover")
                $(this).addClass("hover")
                if($(this).find('.gnb-2dep li').length > 0){
                    $(this).children(".lnb").addClass("hover")
                    $(this).siblings('.gnb-1dep-item').children(".lnb").removeClass("hover") // 23.01.31 추가
                    $(this).parents("nav").children(".nv_btn").addClass("hover") // 23.02.08 수정
                    $(".dim").show()
                }
                e.stopImmediatePropagation();
            },
            function(e){
                $(this).closest("#header").removeClass("hover")
                $(this).removeClass("hover")
                $(this).parents("nav").children(".nv_btn").removeClass("hover") // 23.02.08 수정
                $(this).children(".lnb").removeClass("hover")
                $(".dim").hide()
                e.stopImmediatePropagation();
            }
        );

        // 23.01.31 keyboard 이동 script ~
        $(".gnb-1dep-item > a").focus(
            function(e){
                var item = $(this).parent('.gnb-1dep-item')
                searchHide()
                item.closest("#header").addClass("hover")
                item.addClass("hover")
                if(item.find('.gnb-2dep li').length > 0){
                    item.children(".lnb").addClass("hover")
                    item.siblings(".gnb-1dep-item").removeClass("hover")
                    item.parents("nav").children(".nv_btn").addClass("hover") // 23.02.08 수정
                    $(".dim").show()
                }
                e.stopImmediatePropagation();
            }
        );

        $(".gnb-1dep-item .last a").focus(
            function(e){
                var item = $(this).parents('.gnb-1dep-item')
                item.closest("#header").addClass("hover")
                item.addClass("hover")
                item.children(".lnb").addClass("hover")
                item.siblings(".gnb-1dep-item").removeClass("hover")
                item.parents("nav").children(".nv_btn").addClass("hover") // 23.02.08 수정
                $(".dim").show()
                e.stopImmediatePropagation();
            }
        );

        $(".logo ,.language .btn_open, .utility_item a").focus(function(e){
            $("#header").removeClass("hover")
            $(".gnb-1dep-item").removeClass("hover")
            $("#header nav").children(".nv_btn").removeClass("hover") // 23.02.08 수정
            $("#header").children(".lnb").removeClass("hover")
            $(".dim").hide()
            e.stopImmediatePropagation();
        })

        $(".special_menu .open_btn").focus(function(e){
            if($("header .search_wrap.active").length) {
                $("header .search_wrap").removeClass("active").slideUp(300)
                $(".dim").hide()
            }
        })
        //  ~ 23.01.31
        // $(".language .btn_open").click(function(){
        //     if($(this).parents(".language").hasClass("active")){
        //         $(this).parents(".language").removeClass("active");
        //         // $(this).siblings(".box").slideUp(300)
        //     } else {
        //         $(this).parents(".language").addClass("active");
        //         // $(this).siblings(".box").slideDown(300)
        //     }
        //     e.stopImmediatePropagation();
        // });
    }else if(windowWidth <= 1280){
        $("#wrap").removeClass("normal");
        $("#wrap").addClass("mobile");

        $(".language").removeClass("active");
        $(".language .box").slideUp(0)

        $("#gnb .nv_btn").click(function(e){ // 23.02.08 수정
            bodyFixed()
            searchHide()
            e.stopImmediatePropagation();
        });
        $(".gnb_close").click(function(){
            bodyFixedClose()
        });
        $(".btn_search").click(function(){
            bodyFixedClose()
        })

        // lnb
        $(".gnb-1dep-item .btn_lnb").click(function(e){
            var gnb_item = $(this).parent(".gnb-1dep-item")
            if($(gnb_item).hasClass("open")){
                $(gnb_item).removeClass("open");
                $(this).siblings(".lnb").slideUp()
            } else {
                $(gnb_item).addClass("open");
                $(this).siblings(".lnb").slideDown()
                $(gnb_item).siblings().removeClass("open")
                $(gnb_item).siblings().children(".lnb").slideUp()
            }
            e.stopImmediatePropagation();
        });

        // $(".language .btn_open").click(function(e){
        //     $(this).parents(".language").addClass("active")
        //     // $(this).siblings(".box").show()
        //     $(".utility").css({zIndex:"999"})
        //     $(".gnb_close").css({zIndex:"10"})
        //     e.stopImmediatePropagation();
        // })
        // $(".language .language_close").click(function(e){
        //     $(this).parents(".language").removeClass("active")
        //     // $(this).parents(".language").children(".box").hide()
        //     $(".utility").css({zIndex:""})
        //     $(".gnb_close").css({zIndex:""})
        //     e.stopImmediatePropagation();
        // })
    }
    if(windowWidth < 768){
        if($(".newness_content").length){
            $(".newness_content .banner").css({height:$(".newness_content .product_item").height()})
        }
        if($(".main").length){
            //var slidHwight = $(".etcservices .swiper-slide:nth-child(1) img").height()
            //$(".etcservices .swiper-slide .img").css({height:slidHwight+"px"})

            var snsservicesWidth = $(".snsservices > div").width()
            $(".snsservices ul").css({height:snsservicesWidth+"px"})
        }
    }


    if($("#content.sitemap").length){
        $("#content.sitemap").css({minHeight:(windowHeight-(headerHeight+footerHeight))*0.1+"rem"})
    }
}
window.addEventListener("load", resizeContent)
window.addEventListener("resize", resizeContent)

$(window).scroll(function(){
    // 23.02.01 수정
    var contMinHeight = $(window).height() + $("header").height()
    var contHeight = $("#wrap").height()
    if ($(this).scrollTop() >= 1 && contMinHeight < contHeight) {
        $("#wrap").addClass("scroll")
        var headerHeight = $("header").outerHeight(true);
        $("#content").css({marginTop:headerHeight+"px"})
        if($(window).width() > 1280){
            $("#gnb .nv_btn").css({top:82+"px"})  // 23.02.08 수정
            $(".search_wrap").css({top:82+"px"})
        }
        if($(".progress_indicator").length){
            $(".progress_indicator").css({top:(headerHeight)*0.1+"rem"})
        }
    } else {
        $("#wrap").removeClass("scroll")
        var headerHeight = $("header").outerHeight(true);
        $("#content").css({marginTop:headerHeight+"px"})
        if($(window).width() > 1280){
            // 23.01.11 수정
            $("#gnb .nv_btn").css({top:156+"px"})  // 23.02.08 수정
            $(".search_wrap").css({top:156+"px"})
        }
        if($(".progress_indicator").length){
            $(".progress_indicator").css({top:(headerHeight)*0.1+"rem"})
        }
    }
});

// 자동완성 레이어
var autocomplete_layer = function(){
    $(".search_box input").focus(function(){
        $(this).closest(".search_box").addClass("focus")
    })
    $('.btn_search, .keyword_item button').blur(function(){
        $(".search_box").removeClass("focus")
    })
    $(document).mouseup(function(e){
        var autocomplete_layer = $(".search_box");
        if(autocomplete_layer.has(e.target).length === 0){
            autocomplete_layer.removeClass("focus");
        }
    });
}

// 특정 스크롤에서 클래스명
var scroll_motion = function(){
    var $contents = $('.scroll_ani');

    window.addEventListener('scroll', function() {
        var scltop = $(window).scrollTop();

        $contents.each(function(idx, item){
            var $target   = $contents.eq(idx),
                i         = $target.index(),
                targetTop = $target.offset().top + $target.outerHeight(true) / 2 - $(window).height();
            targetBottom = $target.offset().top + $target.outerHeight(true);
            if (targetTop <= scltop && targetBottom > scltop) {
                $contents.eq(idx).addClass('on');
                // 23.01.16 추가
                if($(this).find('.video').length) {
                    $(this).find('video').get(0).play();
                }
            }else {
                $contents.eq(idx).removeClass('on');
                // 23.01.16 추가
                if($(this).find('.video').length) {
                    $(this).find('video').get(0).pause();
                }
            }
        })
    });
}
var key_motion = function(){
    var $contents = $('.key_ani');
    var scltop = $(window).scrollTop();
    var headerHeight = $("header").outerHeight(true);
    if($(window).scrollTop() >= 0) {
        $contents.each(function(idx, item){
            var $target   = $contents.eq(idx),
                targetBottom = $target.offset().top + $target.outerHeight(true) - headerHeight;
            if (0 <= scltop && targetBottom > scltop) {
                $contents.eq(idx).addClass('on');
                // 23.01.16 추가
                if($(this).find('.video').length) {
                    $(this).find('video').get(0).play();
                }
            }else {
                $contents.eq(idx).removeClass('on');
                // 23.01.16 추가
                if($(this).find('.video').length) {
                    $(this).find('video').get(0).pause();
                }
            }
        })
    }
    window.addEventListener('scroll', function() {
        var scltop = $(window).scrollTop();
        var headerHeight = $("header").outerHeight(true);
        $contents.each(function(idx, item){
            var $target   = $contents.eq(idx),
                targetBottom = $target.offset().top + $target.outerHeight(true) - headerHeight;
            if (0 <= scltop && targetBottom > scltop) {
                $contents.eq(idx).addClass('on');
            }else {
                $contents.eq(idx).removeClass('on');
            }
        })
    });
}

$(function(){
    $(".btn_search").click(function(){
        searchShow()
    });
    $(".btn_close, .dim").click(function(){
        searchHide()
        bodyFixedClose()
    })

    if($(".search_box").length){
        autocomplete_layer()
    }
    if($(".scroll_ani").length){
        scroll_motion()
    }
    if($(".key_ani").length){
        key_motion()
    }
    if($(".search_box").length){
        $(".search_box .input").each(function(){
            // html에 넣음
            // $(this).append("<button class='search_del'>del</button>")
            // 23.01.11 추가
            if ($(".search_box .input input").val() !== '') {
                $(".search_del").addClass("on");
            }
            $(".search_del").on("click", function(){
                // 23.02.03 수정
                $(this).siblings("label").find("input").val("")
                // 23.01.10 추가
                $(".search_del").removeClass("on")
                //dev add
                $(".autocomplete").hide();
                if($('#query').val() !== ''){
                    $('#query_search_del').addClass("on");
                }
            })
        })
    }

    // 23.01.10 추가
    $(".search_box .input input").on("input", function() {
        if ($(this).val() !== '') {
            $(".search_del").addClass("on");
            //dev add ( global search에서 검색할때 search page에 값 없으면 query_search_del 버튼 삭제)
            if($('#query').val() === ''){
                $('#query_search_del').removeClass("on");
            }
        }
        else {
            $(".search_del").removeClass("on");
        }
    })

    $(".language .btn_open").click(function(){
        if($(this).parents(".language").hasClass("active")){
            $(this).parents(".language").removeClass("active");
            $(".utility").css({zIndex:""})
            $(".gnb_close").css({zIndex:""})
        } else {
            $(this).parents(".language").addClass("active");
            $(".utility").css({zIndex:"999"})
            $(".gnb_close").css({zIndex:"10"})
        }
    });
    $(".language .language_close").click(function(e){
        $(this).parents(".language").removeClass("active")
        $(".utility").css({zIndex:""})
        $(".gnb_close").css({zIndex:""})
    })

    if($(".special_menu").length){
        $(".special_menu .open_btn, .special_menu strong").click(function(){ // 23.02.08 수정
            var menu = $(this).parents(".special_menu")
            var menuWidth = $(menu).width()
            if($(menu).hasClass("open")){
                $(menu).animate({right:"-"+(menuWidth-48)}, 300).removeClass("open")
                $(".special_menu .open_btn").text("open")
            } else {
                $(menu).animate({right:0}, 300).addClass("open")
                $(".special_menu .open_btn").text("close")
            }
        });
    }


});


$(function() {
    $("body").append("<a href='javascript:void(0)' class='to_top'>TOP</a>")

    $(window).scroll(function(){
        var windowTop = window.scrollY;
        var footerHeight = $("#footer").outerHeight()
        var val = $(document).height() - window.innerHeight - footerHeight - 20;
        if(windowTop > 100){
            $(".to_top").fadeIn();
        }else{
            $(".to_top").fadeOut();
        }

        if (windowTop >= val){
            $(".to_top").addClass("bottom").css({bottom:"auto", top: (val + window.innerHeight) - windowTop - 70 + "px"})
            $(".special_menu").css({bottom:(footerHeight+98)+"px"})
        }
        else{
            $(".to_top").removeClass("bottom").css({top:"auto",bottom:""})
            $(".special_menu").css({bottom:""})
        }
    })

    $(".to_top").click(function(){
        $("body,html").animate({scrollTop: 0}, 400);
    });
});

//dev add

Date.prototype.YYYYMMDDHHMM = function () {
    var yyyy = this.getFullYear().toString();
    var MM = pad(this.getMonth() + 1,2);
    var dd = pad(this.getDate(), 2);
    var hh = pad(this.getHours(), 2);
    var mm = pad(this.getMinutes(), 2)

    return yyyy +  MM + dd+  hh + mm
}

function pad(number, length) {
    var str = '' + number;
    while (str.length < length) {
        str = '0' + str;
    }
    return str;
}

var nowDate = new Date();
var today  = nowDate.YYYYMMDDHHMM()

var menuData = {}
function getLanguageList(){
    // $.ajax({
    //     url: "/kr/ko/adm/link/language/othersite.json",
    //     dataType : "JSON",
    //     async : false,
    //     success: function(result){
    //         drawSite(result)
    //     }
    // })
}

function drawSite(item){
    var txt = ''
    for(var i=0;i<item.length;i++){
        txt += '<li'+(item[i].active === 'T' ? ' class="active"' : '') +'>'
        txt += '    <a href="'+item[i].url+'" '+ (item[i].active === 'T' ? '' :'target="_blank"')+' lang="'+item[i].lang+'" ap-click-area="header" ap-click-name="Select Country" ap-click-data="'+item[i].apClickData+'">'+item[i].title+'</a>'
        txt += '</li>'
    }
    $('#language_list').html(txt)

    //dev add
    $("#language_list a").click(function(e){
        $(this).parents(".language").removeClass("active")
        $(".utility").css({zIndex:""})
        $(".gnb_close").css({zIndex:""})
    })
}

//dev add
function getMenuList(){
    // $.ajax({
    //     url: "/kr/ko/adm/menu/gnb.json",
    //     dataType : "json",
    //     async : false,
    //     success: function(result){
    //         menuData = result
    //         drawGnb(result)
    //     },
    // })
}

function drawGnb(item) {
    var txt = ''
    item = item.menu

    txt += '<ul class="gnb-1dep">'
    for (var i = 0; i < item.length; i++) {
        var _url = item[i].url? item[i].url : 'javascript:void(0);'
        var _blank = item[i].url && item[i].target == 'T' ? 'target="_blank"' : ''
        var set1depClass = function() { // 230921 추가
            if (item[i].id === 'snapkkz12') {
                return 'skincare'
            } else {
                return '';
            }
        }
        txt += '<li class="gnb-1dep-item '+set1depClass()+'">'  // 230921 수정
        txt += '    <a href="'+_url+'" '+_blank+' ap-click-area="GNB" ap-click-name="click GNB" ap-click-data="'+item[i].gnbTitle+'">'
        txt += '        <strong class="d1_a">'+item[i].gnbTitle+'</strong>'
        txt += '    </a>'
        if (item[i].children.length > 0) { // 230921 수정
            txt += '<button class="btn_lnb" ap-click-area="MO_Header" ap-click-name="click-MO_Hamberger Menu" ap-click-data="'+item[i].gnbTitle+'">expansion</button>'
        }
        txt += '    <div class="lnb">'

        if (item[i].content.length > 0) {
            txt += '<div class="screen">'
        }
        if (item[i].children.length > 0) { // 230921 수정
            txt += '    <ul class="gnb-2dep '+(item[i].class ? item[i].class : '')+'">'
            for (var j = 0; j < item[i].children.length; j++) {
                txt += '        <li class="gnb-2dep-item">'
                txt += '            <a href="'+(item[i].children[j].url ? item[i].children[j].url : 'javascript:void(0);')+'" '+(item[i].children[j].url && item[i].children[j].target == 'T' ? 'target="_blank"' : '')+' ap-click-area="GNB" ap-click-name="click GNB" ap-click-data="'+item[i].children[j].gnbTitle+'">'
                if (item[i].children[j].content.length > 0) {
                    for (var c = 0; c < item[i].children[j].content.length; c++) {
                        txt += '                <img src="'+item[i].children[j].content[c].img+'" alt="'+item[i].children[j].content[c].alt+'"><p>'+item[i].children[j].content[c].title+'</p>'
                    }
                } else if(item[i].children[j].img.length > 0){
                    txt += '                <img src="'+item[i].children[j].img+'" alt="'+item[i].children[j].alt+'"><p>'+item[i].children[j].gnbTitle+'</p>'
                } else {
                    txt += item[i].children[j].gnbTitle
                }
                txt += '</a>'

                if(item[i].children[j].children.length > 0){
                    txt += '        <ul class="gnb-3dep '+(item[i].children[j].class ? item[i].children[j].class : '')+'">'
                    for (var k = 0; k < item[i].children[j].children.length; k++) {
                        txt += '            <li class="gnb-3dep-item">'
                        txt += '                <a href="'+ (item[i].children[j].children[k].url? item[i].children[j].children[k].url : 'javascript:void(0);')+'" '+(item[i].children[j].children[k].url && item[i].children[j].children[k].target == 'T' ? '_target:_blank' : '')+' ap-click-area="GNB" ap-click-name="click GNB" ap-click-data="'+item[i].children[j].children[k].gnbTitle+'">'
                        txt += '                '+item[i].children[j].children[k].gnbTitle+''
                        txt += '             </a>'
                        txt += '             </li>'
                    }
                    txt += '        </ul>'
                }
                txt += '        </li>'
            }
            txt += '    </ul>'
        }
        if (item[i].content.length > 0) { // 230921 수정
            txt += '    <div class="banner">'
            txt += '        <a href="'+(item[i].content[0].url ? item[i].content[0].url : 'javascript:void(0);')+'" '+(item[i].content[0].url && item[i].content[0].target == 'T' ? 'target="_blank"' : '')+'>'
            txt += '           <div class="img">'
            txt += '               <img src="'+item[i].content[0].img+'" alt="'+item[i].content[0].alt+'">'
            txt += '           </div>'
            txt += '           <div class="title">'
            txt += '               <strong>'+item[i].content[0].title+'</strong>'
            txt += '               <span>'+item[i].content[0].desc+'</span>'
            txt += '             </div>'
            txt += '         </a>'
            txt += '    </div>'
            txt += '</div>'

        }
        txt += '</div>'
        txt += '</li>'
    }
    txt += '</ul>'

    $('#gnb_inner').html(txt)

    for(var i=0; i<$('.gnb-1dep-item').length; i++ ){
        if($('.gnb-1dep-item:eq('+i+') .lnb .banner').length > 0){
            $('.gnb-1dep-item:eq('+i+') .lnb .banner:last').addClass('last')
        }else{
            $('.gnb-1dep-item:eq('+i+') .lnb li:last').addClass('last')
        }
    }

}

function getSpecialMenuList(){
    // $.ajax({
    //     url: "/kr/ko/adm/link/special/specialMenu.json",
    //     dataType : "json",
    //     async : false,
    //     success: function(result){
    //         if(result.useYn == 'T' && result.list.length > 0){
    //             drawSpecialMenu(result)
    //         }
    //     },
    // })
}

function drawSpecialMenu(item){
    var txt = ''
    item = item.list
    if(item.length > 0){
        for(var i=0;i<item.length;i++){
            txt += '<a href="'+(item[i].url ? item[i].url : 'javascript:void(0)')+'" '+(item[i].url && item[i].target == 'T' ? 'target="_blank"' : '')+' ap-click-area="floating menu" ap-click-name="click floating menu" ap-click-data="'+item[i].apClickData+'">'+item[i].title+'</a>'
        }
        $('#special_menu div').html(txt)
        $('#special_menu').show()
    }
}

var siteMap= (function () {
    function drawSiteMap() {
        var txt = ''
        var item = menuData.menu
        for (var i = 0; i < item.length; i++) {
            txt += '<li class="dep_1_item">'
            txt += '    <a href="'+(item[i].url ? item[i].url : 'javascript:void(0);')+'" '+(item[i].target == 'T' ? 'target="_blank"' : '')+'>'
            txt += '        <h3>'+item[i].gnbTitle+'</h3>'
            txt += '    </a>'
            if (item[i].children.length > 0) {
                txt += '<ul class="dep_2">'
                for (var j = 0; j < item[i].children.length; j++) {
                    txt += '<li class="dep_2_item"><a href="'+(item[i].children[j].url ? item[i].children[j].url : 'javascript:void(0);')+'" '+(item[i].children[j].target == 'T' ? 'target="_blank"' : '')+'">'+item[i].children[j].gnbTitle+'</a></li>'

                    if (item[i].children[j].children.length > 0) {
                        txt += '<ul class="dep_3">'
                        for (var k = 0; k < item[i].children[j].children.length; k++) {
                            txt += '<li class="dep_3_item"><a href="'+(item[i].children[j].children[k].url ? item[i].children[j].children[k].url : 'javascript:void(0);')+'" '+(item[i].children[j].children[k].target == 'T' ? 'target="_blank"' : '')+'">'+item[i].children[j].children[k].gnbTitle+'</a></li>'
                        }
                        txt += '</ul>'
                    }
                }
                txt += '</ul>'
            }
            txt += '</li>'
        }
        $('#sitemap').html(txt)
    }

    return {
        draw : function(){
            drawSiteMap()
        }
    }
})();
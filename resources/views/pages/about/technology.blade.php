<?php

$visualFullWidthLayout = 1;

$contents = [
    [


        'title' => 'Exomere Halla™',
        'title_sub' => '한라봉 엑소좀 분리',
        'code' => '특허: 제 10-2023-0121591호',
        'desc' => '유기농으로 재배된 제주 한라봉으로부터 추출한 엑소좀을 유효 성분으로 하여 항산화, 피부 세포재생 및 미백에 효과를 갖는 것을 특징으로 하는 화장품 조성물이다.',
        'image' => asset('assets/img/elements/tech_01.jpg')
    ],
    [
        'title' => 'EXOSOME AG™',
        'title_sub' => '흑마늘, 알로에베라 엑소좀 분리',
        'code' => '특허: 제 10-2534286호',
        'desc' => '유기농으로 재배된 알로에베라, 흑마늘로부터 추출한 엑소좀을 유효 성분으로 하여 피부 주름개선, 피부 보습 및 장벽 강화에 효과를 갖는 것을 특징으로 하는 화장품 조성물이다.',
        'image' => asset('assets/img/elements/tech_02.jpg')
    ],
    [
        'title' => '엑소좀 리프팅 실',
        'title_sub' => '엑소좀을 함유하는 리프팅용 실',
        'code' => '특허: 제 10-2698031호',
        'desc' => '뉴 콘 듀얼 K-리프팅 실은 실루엣 소프트 실의 단점인 리프팅을 강화하기 위해 가시가 추가되어 콘과 가시의 듀얼 리프팅이 가능한 차세대 리프팅용 콘 실로, 엑소좀을 함유하고 있다.',
        'image' => asset('assets/img/elements/tech_03.png')
    ],
    [
        'title' => '비양나무추출물',
        'title_sub' => '제주도 비양나무추출물의 화장료 조성물',
        'code' => '특허: 제 10-1441190호',
        'desc' => '제주도에서 자생하는 비양나무에서 추출한 원료로서,노화방지와 항산화 효과, 항염 효과, 항균 작용 및 미백 효과를 갖는 것을 특징으로 하는 화장료 조성물이다.',

        'image' => asset('assets/img/elements/tech_04.jpg')
    ],
    [
        'title' => '통증완화용 조성물',
        'title_sub' => '천연미세침을 포함하는 통증완화용 조성물',
        'code' => '특허: 제 10-1984260호',
        'desc' => '통증 완화에 도움을 주는 글루코사민, MSM, 일라이트, 노니추출물, 온천수 등이 천연미세침과 혼합되어 효과를 극대화시킨 원 료로서, 혈행을 개선시켜 염증억제에 도움을 주고, 피부 온도 상승과, 붓기 개선, 셀룰라이트감소, 피부 흡수율 상승 등의 효과를 가지고 있다.',
        'image' => asset('assets/img/elements/tech_05.png')
    ],
    [
        'title' => '고체 미세침 필러',
        'title_sub' => '피부 주입식 고체 미세침 형태의 필러',
        'code' => '특허: 제 10-1285831호',
        'desc' => '기존의 주사용 필러와는 다르게 고체 형태의 필러로 세계최초로 개발되었으며, 콜라겐을 형성하는 생분해물질의 일종인 PLLA(Poly-L-Lactic-Acid)재질로 형성되어, 2-3년 이상 장기간 지속 볼륨 증강 작용이 가능하며 깊은 주름 제거와 코끝 올리는 용도로도 사용하는 고체형 필러이다.',
        'image' => asset('assets/img/elements/tech_06.png')
    ],
];


?>
@extends('pages.layouts.subLayout')

@section('title', __('gnb.technology'))

@section('id', 'technology')
@section('visual_title',  __('gnb.technology') )
@section('visual_sub_title', __('gnb.technology_title'))
@section('visual_background', 'https://cdn.pixabay.com/photo/2020/03/29/19/20/theatre-4981936_1280.jpg')

@section('vendor-style')
    <link href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" rel="stylesheet">
@endsection
@section('page-style')
@endsection
@section('content')
    <div class="relative min-h-screen">
        <nav id="parallax__nav"
             class="relative bg-white w-full left-0 z-40 lg:absolute lg:top-32 lg:pl-7 lg:bg-transparent lg:left-0 lg:w-auto">
            <ul class="flex flex-row justify-center text-sm text-center text-slate-500 lg:flex-col lg:text-base">
                <li class="relative p-3 basis-1/4"><a class="" href="/about/core">핵심성분</a>
                </li>
                <li class="relative p-3 basis-1/4"><a class="active" href="/about/technology">특허기술</a>
                </li>
            </ul>
        </nav>

        <div class="py-20 px-4 lg:px-44">
            <div class="flex flex-col gap-y-12">
                {{--tab contents--}}
                <div
                    class="swiper tab-swiper relative pb-2 after:absolute after:bg-slate-500 after:bottom-[8px] after:left-0 after:w-full after:h-[1px]"
                    data-aos="fade">
                    <ul class="swiper-wrapper relative flex flex-row items-end md:text-lg font-medium text-center"
                        id="tab"
                        data-tabs-toggle="#default-styled-tab-content"
                        data-tabs-active-classes="text-head hover:text-head"
                        data-tabs-inactive-classes="text-gray-300 hover:text-gray-600 border-gray-100"
                        role="tablist">
                        @foreach($contents as $content)
                            <li class="swiper-slide w-44 me-2 relative after:absolute after:bg-slate-500 after:-bottom-[4px] after:left-1/2 after:w-[10px] after:h-[10px] after:rounded-full"
                                role="presentation">
                                <button class="inline-block p-4"
                                        id="section{{ $loop->index }}-styled-tab"
                                        data-tabs-target="#styled-section{{ $loop->index }}" type="button" role="tab"
                                        aria-controls="section{{ $loop->index }}"
                                        aria-selected="false"> {{ $content['title'] }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    <div class="swiper-button-wrap opacity_animation">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
                <div id="default-styled-tab-content">
                    @foreach($contents as $content)
                        <div class="hidden" id="styled-section{{ $loop->index }}" role="tabpanel"
                             aria-labelledby="section{{ $loop->index }}-tab">
                            <div
                                class="flex flex-col md:flex-row justify-center items-center gap-y-10 break-keep">
                                <div class="flex justify-center items-center md:basis-1/2">
                                    <picture class="overflow-hidden max-w-sm">
                                        <source srcset="{{ $content['image'] }}">
                                        <img src="{{ $content['image'] }}"
                                             alt="{{ $content['title'] }}"
                                             data-aos="fade-in"
                                             >
                                    </picture>
                                </div>
                                <div class="pt-10 pb-20 px-8 lg:p-0 lg:p-[5%] xl:p-[10%] leading-loose md:basis-1/2"
                                     data-aos="fade-up">
                                    <h2 class="inline-block font-bold text-2xl mb-7">{{ $content['title'] }}</h2>
                                    <p class="leading-loose md:leading-loose text-base md:text-lg text-gray-500 mb-3 ">
                                        {{ $content['code'] }}</p>
                                    <p class="leading-loose md:leading-loose text-base md:text-lg text-gray-500 mb-3 ">
                                        {!! $content['desc'] !!}
                                    </p>
                                    <small class="w-full inline-block text-right text-gray-500">* 원료적 특성에 한함</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @endsection

        @section('page-script')
            <script defer src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
            <script>
                window.addEventListener('DOMContentLoaded', () => {

                    //tab aos init
                    const tab = document.querySelector('#tab');
                    tab.querySelectorAll('[role="tab"]').forEach(function (elem) {

                        elem.addEventListener('click', (event) => {
                            if (event.target.ariaSelected !== 'true') {
                                event.preventDefault();
                                document.querySelectorAll(event.target.dataset.tabsTarget + " [data-aos]").forEach((el) => el.classList.remove('aos-animate'))
                            }
                        })
                    })

                    //tab swiper
                    var tabSwiper = new Swiper(".tab-swiper", {
                        loop: false,
                        freeMode: true,
                        slidesPerView: 4,
                        navigation: {
                            nextEl: ".swiper-button-next",
                            prevEl: ".swiper-button-prev",
                        },
                    });
                });


                //fixed nav
                var header = document.querySelector("header");
                var nav = document.getElementById("parallax__nav");
                var headerHeight = header.offsetHeight;
                var navOffset = nav.getBoundingClientRect().top - headerHeight + nav.offsetHeight;
                var prefix = matchMedia("screen and (min-width: 1024px)").matches ? 'lg:' : '';

                $(window).scroll(function () {
                    if (window.pageYOffset >= navOffset) {
                        nav.classList.remove(prefix + "absolute");
                        nav.classList.add(prefix + "fixed", prefix + "top-[" + headerHeight + "px]",);
                        nav.classList.remove("relative");
                    } else {
                        nav.classList.add(prefix + "absolute");
                        nav.classList.remove(prefix + "fixed", prefix + "top-[" + headerHeight + "px]",);
                        nav.classList.add("relative");
                    }
                });

            </script>

@endsection


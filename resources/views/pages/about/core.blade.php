<?php

$visualFullWidthLayout = 1;

$contents = [
    [
        'title' => ' Exomere Halla™',
        'title_en' => '한라봉 엑소좀',
        'code' => '특허: 제 10-2023-0121591호',
        'desc' => 'Exomere Halla™는 머리카락보다 1,200배 작은 미세 입자를 통해 유효 성분이 피부에 직접 흡수되어 효과를 극대화합니다. 또한 강력한 항산화 성분을 함유하여 피부건강을 유지하는 데 도움을 주고, 멜라닌 생성을 억제하여 피부톤을 고르게 하고 기미와 잡티를 감소시키는 데 기여하며, 피부에 풍부한 영양과 수분을 공급하여 촉촉한 피부를 유지하는 데 도움을 줍니다.',
        'image' => asset('assets/img/elements/about_technology_2.webp')
    ],
    [
        'title' => 'SPICUS™',
        'title_en' => '저분자 콜라겐으로 코팅된 마이크로 니들',
        'code' => '특허: 제 10-2022-0007981호',
        'desc' => 'SPICUS™는 유효성분의 전달 통로가 되어 엑소좀과 유효 성분의 보다 효과적인 흡수를 도와줍니다. 피부 재생에 도움을 줄 수 있으며, 입자의 균일화를 통해 표피 자극을 최소화하여 부작용을 줄일 수 있습니다. 또한, 허브 성분을 배제하여 알러지 유발 가능성을 낮추었으며, 저분자 콜라겐이 코팅되어 있어 피부 치밀도 개선에 기여할 수 있습니다.',
        'image' => asset('assets/img/elements/about_technology_1.webp')
    ],
];

?>
@extends('pages.layouts.subLayout')

@section('title', __('gnb.core'))

@section('id', 'core')
@section('visual_title',  __('gnb.core') )
@section('visual_sub_title', __('gnb.core_title'))
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
                <li class="relative p-3 basis-1/4"><a class="active" href="/about/core">핵심성분</a>
                </li>
                <li class="relative p-3 basis-1/4"><a class="" href="/about/technology">특허기술</a>
                </li>
            </ul>
        </nav>


        <div class="pt-20 px-4 lg:px-44">
            <div class="flex flex-col space-y-12 gap-y-16 mb-20">

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
                                <li class="swiper-slide w-auto me-2 relative after:absolute after:bg-slate-500 after:-bottom-[4px] after:left-1/2 after:w-[10px] after:h-[10px] after:rounded-full"
                                    role="presentation">
                                    <button class="inline-block p-4"
                                            id="section{{ $loop->index }}-styled-tab"
                                            data-tabs-target="#styled-section{{ $loop->index }}" type="button"
                                            role="tab"
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
                            <div class="hidden bg-gray-50" id="styled-section{{ $loop->index }}" role="tabpanel"
                                 aria-labelledby="section{{ $loop->index }}-tab">
                                <div
                                    class="flex flex-col md:flex-row justify-center items-center max-md:space-y-10 break-keep">
                                    <picture class="overflow-hidden md:h-[60vh] md:basis-1/2">
                                        <source srcset="{{ $content['image'] }}">
                                        <img src="{{ $content['image'] }}"
                                             alt="{{ $content['title'] }}"
                                             data-aos="scale"
                                             class="w-full h-full">
                                    </picture>
                                    <div class="relative px-8  leading-loose md:basis-1/2"
                                         data-aos="fade">
                                        <h2 class="inline-block font-bold text-2xl text-head mb-7">{{ $content['title'] }}
                                            <small
                                                class="font-light text-sm block">{{ $content['title_en'] }}</small>
                                        </h2>

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
        </div>

    </div>
@endsection

@section('page-script')
    <script defer src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script>
        window.addEventListener('DOMContentLoaded', () => {

            const tab = document.querySelector('#tab');
            tab.querySelectorAll('[role="tab"]').forEach(function (elem) {

                elem.addEventListener('click', (event) => {
                    if (event.target.ariaSelected !== 'true') {
                        event.preventDefault();
                        document.querySelectorAll(event.target.dataset.tabsTarget + " [data-aos]").forEach((el) => el.classList.remove('aos-animate'))
                    }
                })
            })

            var tabSwiper = new Swiper(".tab-swiper", {
                loop: false,
                freeMode: true,
                slidesPerView: 4,
                centeredSlides: true,
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


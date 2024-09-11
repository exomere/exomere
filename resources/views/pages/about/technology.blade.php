<?php

$contents = [
    [
        'title' => '한라봉 엑소좀 분리',
        'desc' => '<strong class="font-medium text-gray-800">특허 제10-2023-0121591호</strong><br/>EXOMERETM은 제주 한라봉에서 추출한 50~200nm 크기의 엑소좀으로, DNA, RNA, PEPTIDE가 포함되어 있어 노화 및 손상된 피부를 위한 세포 재생과 신호 전달에 도움을 주는 솔루션입니다.',
        'image' => 'https://cdn.pixabay.com/photo/2017/03/08/21/19/file-2127825_1280.png'
    ],
    [
        'title' => '텔로미어 추출',
        'desc' => '<strong class="font-medium text-gray-800">특허 제10-2022-0007981호</strong><br/>스피커스는 청정 바다에서 추출한 해양 생물의 순수 성분을 정제하여, 식물성 콜라겐 생성을 촉진시키는 금화규 추출물과 비피다발효물로 코팅한 특허 성분으로, 스피큘에 코팅된 발효 식물성콜라겐이 피부에 침투해 탄력 있는 피부로 개선시켜줍니다.',
        'image' => 'https://cdn.pixabay.com/photo/2017/03/08/21/19/file-2127825_1280.png'
    ],
    [
        'title' => '텔로미어 추출',
        'desc' => '<strong class="font-medium text-gray-800">특허 제10-2022-0007981호</strong><br/>스피커스는 청정 바다에서 추출한 해양 생물의 순수 성분을 정제하여, 식물성 콜라겐 생성을 촉진시키는 금화규 추출물과 비피다발효물로 코팅한 특허 성분으로, 스피큘에 코팅된 발효 식물성콜라겐이 피부에 침투해 탄력 있는 피부로 개선시켜줍니다.',
        'image' => 'https://cdn.pixabay.com/photo/2017/03/08/21/19/file-2127825_1280.png'
    ],
    [
        'title' => '텔로미어 추출',
        'desc' => '<strong class="font-medium text-gray-800">특허 제10-2022-0007981호</strong><br/>스피커스는 청정 바다에서 추출한 해양 생물의 순수 성분을 정제하여, 식물성 콜라겐 생성을 촉진시키는 금화규 추출물과 비피다발효물로 코팅한 특허 성분으로, 스피큘에 코팅된 발효 식물성콜라겐이 피부에 침투해 탄력 있는 피부로 개선시켜줍니다.',
        'image' => 'https://cdn.pixabay.com/photo/2017/03/08/21/19/file-2127825_1280.png'
    ],
    [
        'title' => '텔로미어 추출',
        'desc' => '<strong class="font-medium text-gray-800">특허 제10-2022-0007981호</strong><br/>스피커스는 청정 바다에서 추출한 해양 생물의 순수 성분을 정제하여, 식물성 콜라겐 생성을 촉진시키는 금화규 추출물과 비피다발효물로 코팅한 특허 성분으로, 스피큘에 코팅된 발효 식물성콜라겐이 피부에 침투해 탄력 있는 피부로 개선시켜줍니다.',
        'image' => 'https://cdn.pixabay.com/photo/2017/03/08/21/19/file-2127825_1280.png'
    ],
    [
        'title' => '텔로미어 추출',
        'desc' => '<strong class="font-medium text-gray-800">특허 제10-2022-0007981호</strong><br/>스피커스는 청정 바다에서 추출한 해양 생물의 순수 성분을 정제하여, 식물성 콜라겐 생성을 촉진시키는 금화규 추출물과 비피다발효물로 코팅한 특허 성분으로, 스피큘에 코팅된 발효 식물성콜라겐이 피부에 침투해 탄력 있는 피부로 개선시켜줍니다.',
        'image' => 'https://cdn.pixabay.com/photo/2017/03/08/21/19/file-2127825_1280.png'
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

    <div class="flex flex-col gap-y-12">
        {{--tab contents--}}
        <div
            class="swiper tab-swiper relative pb-2 after:absolute after:bg-slate-500 after:bottom-[8px] after:left-0 after:w-full after:h-[1px]"
            data-aos="fade">
            <ul class="swiper-wrapper relative flex flex-row items-end md:text-lg font-medium text-center"
                id="tab"
                data-tabs-toggle="#default-styled-tab-content"
                data-tabs-active-classes="text-exomere hover:text-exomere"
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
                        class="flex flex-col md:flex-row justify-center items-center space-y-10 break-keep">
                        <picture class="overflow-hidden md:h-[50vh] md:basis-1/2">
                            <source srcset="{{ $content['image'] }}">
                            <img src="{{ $content['image'] }}"
                                 alt="{{ $content['title'] }}"
                                 data-aos="fade-in"
                                 class="w-full h-full">
                        </picture>
                        <div class="pt-10 pb-20 px-8 lg:p-0 lg:p-[5%] xl:p-[10%] leading-loose md:basis-1/2"
                             data-aos="fade-up">
                            <h2 class="inline-block font-bold text-2xl mb-7">{{ $content['title'] }}</h2>
                            <p class="leading-loose md:leading-loose text-base md:text-lg text-gray-500 mb-3 ">
                                {!! $content['desc'] !!}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
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
                slidesPerView: 'auto',
                centeredSlides: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        });

    </script>

@endsection


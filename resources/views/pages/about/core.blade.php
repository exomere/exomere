<?php

$contents = [
    [
        'title' => '한라봉 엑소좀',
        'title_en' => 'Dekopon-EXO',
        'desc' => '제주 한라봉에서 추출한 <strong class="font-medium text-gray-800">50~ 200mm 크기의 엑소좀</strong>으로, <strong class="font-medium text-gray-800">DNA, RNA, PEPTIDE</strong> 가 포함되어 있어 노화 및 손상된 피부를 위한 세포 재생과 신호 전달에 도움을 주는 솔루션입니다.',
        'image' => asset('assets/img/elements/about_01.png')
    ],
    [
        'title' => '텔로미어',
        'title_en' => 'Telomere',
        'desc' => '<strong class="font-medium text-gray-800">텔로미어</strong>는 염색체의 끝부분에 있는 염색 소립으로 세포의 수명을 결정짓는 역할을 하며, 이것은 즉 <strong class="font-medium text-gray-800">세포시계의 역할을 담당하는 DNA의 조각</strong> 입니다.',
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

@section('page-style')

@endsection
@section('content')

    <div class="flex flex-col space-y-12 gap-y-16 mb-20">
        <div class="relative h-full flex flex-col justify-center overflow-hidden">
            <div
                class="flex flex-col justify-center space-y-10 break-keep pt-10 pb-20 px-8 lg:p-0 lg:p-[5%] xl:p-[10%]
                 bg-[url('{{ asset('assets/img/elements/about_technology_2.webp') }}')] bg-cover bg-center">
                <div class="after:absolute after:inset-0 after:bg-[rgba(0,0,0,0.35)]"></div>
                <h2 class="text-3xl text-white font-normal" data-aos="fade"><span
                        class="decoration-4 decoration-white decoration-wavy text-white underline underline-offset-8">엑소미어</span>란?
                </h2>
                <ul class="max-w-3xl flex flex-col justify-center text-base md:text-xl font-normal space-y-4 gap-y-3 text-white">
                    <li class="leading-10 flex flex-col md:flex-row justify-center items-start gap-x-5"
                        data-aos="fade-up">
                        <p class="text-4xl text-right text-white-500 font-bold opacity-50">01</p>
                        <p class="flex-1">엑소미어는 피부과학의 최신 연구를 바탕으로 자사 특허 성분인 <span class="text-exomere">한라봉 엑소좀</span> 과
                            <span class="text-exomere">스피커스</span>를 통해 피부 재생과 노화 방지의 혁신적 솔루션을 제공합니다.</p>
                    </li>

                    <li class="leading-10 flex flex-col md:flex-row justify-center items-start gap-x-5"
                        data-aos="fade-up"
                        data-aos-delay="100">
                        <p class="text-4xl text-right text-white-500 font-bold opacity-50">02</p>
                        <p class="flex-1">엑소미어 연구팀은 고급 기술과 독창적인 성분을 활용하여 피부 문제의 <span
                                class="text-exomere">근본적인 원인을 해결</span>하는 제품을 개발하고 있습니다. 모든 제품은 철저한 임상 테스트와 품질 관리를 통해
                            고객에게
                            최고의 결과를
                            제공하는 것을 목표로 합니다.</p>
                    </li>

                    <li class="leading-10 flex flex-col md:flex-row justify-center items-start gap-x-5"
                        data-aos="fade-up"
                        data-aos-delay="200">
                        <p class="text-4xl text-right text-white-500 font-bold opacity-50">03</p>
                        <p class="flex-1">엑소미어와 함께, 피부의 근본적인 변화를 경험하세요. 우리의 <span class="text-exomere">과학적 접근</span>과
                            <span
                                class="text-exomere">노하우</span>로, 피부에 새로운 생명을 불어넣고, 지속 가능한 아름다움을 선사하겠습니다.</p>
                    </li>
                </ul>
            </div>
        </div>


        <div class="flex flex-col gap-y-12">
            <div class="flex flex-col justify-center items-center">
                <p class="text-2xl md:text-3xl font-normal mb-3" data-aos="fade">
                    EXO Complex
                </p>
                <p class="text-lg text-gray-500" data-aos="fade" data-aos-delay="100">엑소미어 만의 엑소좀 콤플렉스</p>
            </div>

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
                        <li class="swiper-slide w-40 me-2 relative after:absolute after:bg-slate-500 after:-bottom-[4px] after:left-1/2 after:w-[10px] after:h-[10px] after:rounded-full"
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
                <div class="swiper-button-wrap">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <div id="default-styled-tab-content">
                @foreach($contents as $content)
                    <div class="hidden bg-gray-50" id="styled-section{{ $loop->index }}" role="tabpanel"
                         aria-labelledby="section{{ $loop->index }}-tab">
                        <div
                            class="flex flex-col md:flex-row justify-center items-center space-y-10 break-keep">
                            <picture class="overflow-hidden md:h-[60vh] md:basis-2/3">
                                <source srcset="{{ $content['image'] }}">
                                <img src="{{ $content['image'] }}"
                                     alt="{{ $content['title'] }}"
                                     data-aos="scale"
                                     class="w-full h-full">
                            </picture>
                            <div class="pt-10 pb-20 px-8 lg:p-0 lg:p-[3%] xl:p-[5%] leading-loose md:basis-1/3"
                                 data-aos="fade">
                                <h2 class="inline-block font-bold text-2xl mb-7 lg:mb-10">{{ $content['title_en'] }}
                                    <small
                                        class="font-light text-sm block lg:inline-block lg:ml-3">{{ $content['title'] }}</small>
                                </h2>
                                <p class="leading-loose md:leading-loose text-base md:text-lg text-gray-500 mb-3 ">
                                    {!! $content['desc'] !!}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('page-script')
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


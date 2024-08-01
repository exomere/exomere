@php
    $isMain = true;
@endphp

@extends('pages.layouts.frontLayout')

@section('title', '72시간만에 10년 젊어지기')

@section('page-style')
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet"/>
@endsection

@section('content')
    <section class="hero_section w-full h-full relative overflow-hidden">
        <div class="swiper main-swiper">
            <div class="swiper-wrapper">
                @for($i=0; $i<3; $i++)
                    <div class="swiper-slide">
                        <div
                            class="noto-sans-kr-regular txt-box absolute top-1/2 w-[50%] px-28 transform -translate-x-1/2 -translate-y-[60%] text-left z-10">
                            <p class="text-black/50 mt-6 text-lg translate-y-5 opacity-0 break-keep transition-opacity duration-1000 delay-400">
                                엑소좀과 스피커스가 함유된 미백 크림 {{$i}}
                            </p>
                            <h3 class="noto-sans-kr-bold text-4xl font-normal leading-tight break-keep translate-y-5 opacity-0 transition-opacity duration-1000 delay-200">
                                임플란트 솔루션
                            </h3>
                            <a href="/product" target="_self"
                               class="inline-block mt-12 border border-solid border-black py-2 px-20 text-base translate-y-5 opacity-0 break-keep transition-transform duration-1000">
                                THE MORE
                            </a>
                        </div>
                        <video
                            src="https://www.ap-beauty.com/kr/ko/adm/main/kv/__icsFiles/afieldfile/2024/01/12/MD_Web_Main_10s_4K_v240112_1.mp4"
                            class="slide-video object-cover" autoplay="" muted=""
                            playsinline="" loop=""></video>
                    </div>

                @endfor

            </div>
            <div class="all-box">
                <div class="progress-box">
                    <div class="swiper-pagination"></div>
                    <div class="autoplay-progress">
                        <svg viewBox="0 0 100 10">
                            <line x1="0" y1="0" x2="100" y2="0">
                        </svg>
                    </div>
                </div>
                <div class="arrow-box">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    </section>

    {{--추천제품--}}
    <section class="content_section w-full h-full">

        <article>
            <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">

                <h2 class="font-bold text-3xl text-center mb-20" data-aos="fade-up">
                    추천 제품
                </h2>

                <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3">
                    @for($i=0; $i<6; $i++)
                        <a href="#" class="group" data-aos="zoom-in">
                            <div
                                class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                                <img
                                    src="http://exomere.co.kr/upload/2024061918151944398.png"
                                    alt=""
                                    class="h-full w-full object-cover object-center group-hover:opacity-75">
                            </div>
                            <p class="mt-1 text-lg font-medium text-gray-900">임플란트솔루션(H)</p>
                            <h3 class="mt-1 text-sm text-gray-700">엑소좀 + 스피커스 미백 크림</h3>
                            <p class="mt-4 text-lg font-medium text-gray-900">\66,000</p>
                        </a>
                    @endfor
                </div>

            </div>
        </article>

        {{--기업기술력 영상--}}
        <article class="my-20">
            <video class="w-full aspect-video aspect-w-1"
                   src="http://exomere.co.kr/common/image/exomere.mp4" autoplay muted></video>
        </article>


        {{--특허 원료 소개--}}
        <article class="my-20">
            <div class="w-full relative">
                <div class="swiper section_swiper swiper-container relative">
                    <div class="swiper-wrapper">
                        @for($i=1; $i<=2; $i++)
                            <div class="swiper-slide">
                                <a href="/about/core">
                                    <div
                                        class="flex justify-center items-center overflow-hidden bg-cover bg-center"
                                        style="height: 480px; background-image: url({{ asset("assets/img/elements/about_technology_$i.jpg")}})">
                                        <div
                                            class="txt-box p-28 text-center w-[50%] z-10 backdrop-blur-sm bg-white/30">
                                            <h3 class=" text-white text-3xl font-normal leading-tight break-keep translate-y-5 opacity-0 transition-opacity duration-1000 delay-200">
                                                ( {{$i}} ) 스피커스는
                                            </h3>
                                            <p class="break-words text-white mt-6 text-lg translate-y-5 opacity-0 break-keep transition-opacity duration-1000 delay-400">
                                                청정 바다에서 추출한 해양 생물의 순수 성분을 정제하여,
                                                식물성 콜라겐 생성을 촉진시키는 금화규 추출물과 비피다발효물로
                                                코팅한 특허 성분으로, 스피큘에 코팅된 발효 식물성콜라겐이 피부에
                                                침투해 탄력 있는 피부로 개선시켜줍니다.
                                            </p>
                                            <p class="break-words text-white mt-6 text-lg translate-y-5 opacity-0 break-keep transition-opacity duration-1000 delay-600">
                                                특허 : 제10-2022-0007981호</p>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        @endfor

                    </div>
                    <div class="swiper-button-prev white w-48"></div>
                    <div class="swiper-button-next white w-48"></div>
                </div>
            </div>

        </article>


        <article class="my-20">
            <div class="w-full relative">

                <div class="swiper section_swiper swiper-container relative">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="h-96">
                                <div class="-translate-y-1/2 absolute px-28 top-1/2 transform txt-box z-10">
                                    <h3 class="roboto-bold text-white text-3xl font-normal leading-tight break-keep translate-y-5 opacity-0 transition-opacity duration-1000 delay-200">
                                        ABOUT BRANCH
                                    </h3>
                                    <p class="text-xl text-white mt-6 text-xl translate-y-5 opacity-0 break-keep transition-opacity duration-1000 delay-400">

                                        다양한 체험 프로그램과 <br>
                                        전문적이고 체계적인 상담을 통해<br>
                                        엑소미어의 제품을 체험할 수 있습니다
                                    </p>
                                    <a href="/about/branch" target="_self"
                                       class="inline-block mt-12 border border-solid border-white  py-2 px-20 text-white text-base translate-y-5 opacity-0 break-keep transition-transform duration-1000">
                                        THE MORE
                                    </a>
                                </div>
                                <img src="{{ asset('assets/img/elements/about_branch_1.png') }}"
                                     alt=""
                                     class=" object-cover">
                            </div>

                        </div>


                    </div>
                </div>


            </div>
        </article>
    </section>

@endsection

@section('page-script')
    <script>
        AOS.init({
            duration: 1200,
        })

    </script>

    <script defer src="{{ asset('assets/js/fo/main.js') }}"></script>
@endsection
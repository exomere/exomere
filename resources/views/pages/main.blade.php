@php
    $isMain = true;
@endphp

@extends('pages.layouts.frontLayout')

@section('title', '72시간만에 10년 젊어지기')

@section('page-style')
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet"/>
@endsection

@section('content')

    <div class="relative text-center">
        <div class="flex-col gap-6 h-screen overflow-y-auto relative lg:snap-mandatory lg:snap-y">
            <section class="h-svh shrink-0 lg:snap-center">
                <div class="swiper main-swiper">
                    <div class="swiper-wrapper">
                        @for($i=0; $i<3; $i++)
                            <div class="swiper-slide">
                                <div
                                    class="absolute transform show_content_box z-10 lg:top-1/2 lg:w-[50%] lg:px-28 lg:transform lg:-translate-x-1/2 lg:-translate-y-[60%] lg:text-left ">
                                    <p class="delay-100	blur-20 opacity-0 translate-y-20 text-black/80 mt-6 text-xl break-keep leading-tight">
                                        엑소좀과 스피커스가 함유된 미백 크림 {{$i}}
                                    </p>
                                    <p class="delay-1000 blur-20 opacity-0 translate-y-28 text-3xl lg:text-4xl font-normal leading-tight break-keep mt-5">
                                        임플란트 솔루션
                                    </p>
                                    <a href="/product" target="_self"
                                       class="delay-300 opacity-0 translate-y-20 mt-12 inline-block border border-solid border-black py-3 px-24 text-base break-keep font-montserrat">
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

            {{--best itmes--}}
            <section class="py-24 shrink-0 lg:snap-center  lg:pt-40">
                <div class="text-center">
                    <h2 class="font-montserrat font-semibold text-3xl lg:text-4xl mb-20" data-aos="fade-up">
                        BEST ITEMS
                    </h2>
                    <div class="swiper m-swiper max-container">
                        <div class="swiper-wrapper bg-[#f5f5f5]
                        lg:bg-white
{{--                        lg:grid lg:grid-cols-3 lg:gap-5--}}
                        lg:flex lg:flex-wrap  lg:justify-center
                        ">
                            @for($i=0; $i<6; $i++)
                                <a href="#" class="swiper-slide flex-wrap lg:basis-1/3 padding-x" data-aos="fade-up"
                                   data-aos-delay="{{ $i * 100 }}">
                                    <div
                                        class="show_content_box aspect-h-1 aspect-w-1 w-full overflow-hidden xl:aspect-h-8 xl:aspect-w-7">
                                        <img
                                            src="{{ asset("assets/img/elements/visual_02.webp")}}"
                                            alt=""
                                            class="blur-20 opacity-0 lg:opacity-100 h-full w-full object-cover object-center">
                                    </div>
                                    <div class="show_content_box bg-white padding-x py-5 w-full text-slate max-w-2xl" data-aos="fade-up"
                                         data-aos-delay="{{ $i * 100 }}">
                                        <p class="blur-20 opacity-0 lg:opacity-100 lg:translate-y-0 translate-y-10 mt-1 text-xl font-bold">
                                            임플란트솔루션({{$i}})</p>
                                        <p class="blur-20 opacity-0 lg:opacity-100 translate-y-0 mt-2 text-slate-700 line-clamp-2 info-text">
                                            피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림</p>
                                        <p class="blur-20 opacity-0 lg:opacity-100 translate-y-0 mt-5 text-lg font-montserrat">
                                            66,000</p>
                                    </div>
                                </a>
                            @endfor
                            <div class="swiper-button-prev lg:hidden"></div>
                            <div class="swiper-button-next lg:hidden"></div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="shrink-0 aspect-1 lg:snap-center lg:h-svh lg:w-full overflow-hidden ">
               <div class="flex h-full">
                   <video class="w-full" autoplay muted controls  data-aos="zoom-out">
                       <source src="http://exomere.co.kr/common/image/exomere.mp4" type="video/mp4">
                       Your browser does not support the video tag.
                   </video>
               </div>
            </section>


            <section class="shrink-0 py-24 lg:py-0 lg:snap-center lg:h-svh">

                <div class="swiper material-swiper">
                    <div class="swiper-wrapper">
                        @for($i=1; $i<=2;$i++)
                            <div class="swiper-slide">
                                <a href="#"
                                   class="flex flex-col w-full h-full items-center border border-gray-200 lg:flex-row">
                                    <div
                                        class="min-h-96 w-full h-full lg:w-[50%] bg-center bg-cover h-full lg:w-[50%] w-full"
                                        style="background-image: url('{{ asset("assets/img/elements/about_technology_$i.webp")}}')"
                                    ></div>

                                    <div
                                        class="relative flex flex-col justify-between p-4 pb-12 leading-normal w-full lg:w-[50%] padding">
                                        <div class="lg:max-w-lg lg:leading-10 show_content_box tracking-tight">
                                            <h2 class="font-montserrat leading-tight text-left font-semibold text-3xl lg:text-4xl mb-10">
                                                BASE<br>
                                                MATERIAL
                                            </h2>
                                            <p class="mb-2 text-2xl lg:text-3xl text-left font-bold text-gray-900 dark:text-white font-montserrat
                                            blur-20 opacity-0 translate-y-10">
                                                스피커스{{$i}}</p>
                                            <p class="mb-3 text-left font-normal text-gray-700
                                            blur-20 opacity-0 translate-y-20 line-clamp-4 break-keep">
                                                청정 바다에서 추출한 해양 생물의 순수 성분을 정제하여,
                                                식물성 콜라겐 생성을 촉진시키는 금화규 추출물과 비피다발효물로
                                                코팅한 특허 성분으로, 스피큘에 코팅된 발효 식물성콜라겐이 피부에
                                                침투해 탄력 있는 피부로 개선시켜줍니다.</p>

                                            <p class="blur-20 opacity-0 translate-y-30 mt-5 text-left font-normal text-slate-700 pb-24">
                                                특허 : 제10-2022-0007981호
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endfor
                        <div
                            class="all-box left-0 bottom-0 transform-none padding lg:max-w-lg lg:left-[50%] lg:bottom-[15%]">
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

                </div>


            </section>


            <section class="shrink-0 py-24 lg:py-0 lg:snap-center lg:h-svh lg:pt-56">

                <div class="relative max-container max-lg:aspect-[4/3] lg:aspect-w-1 lg:min-h-[50rem]" >
                    <div class="bg-center bg-cover h-full
                    after:bg-black/50 after:absolute after:h-full after:w-full after:bottom-0 after:left-0"
                         style="background-image: url('{{ asset('assets/img/elements/visual_03.webp') }}')"
                        data-aos="zoom-out"
                    >

                        <div class="absolute padding text-left text-white transform  lg:translate-y-[50%] z-10" >
                            <h3 class="font-montserrat leading-tight text-left font-semibold text-3xl lg:text-4xl mb-10"
                                data-aos="fade-up">
                                ABOUT BRANCH
                            </h3>
                            <p class=" text-white mt-6 text-base lg:text-xl translate-y-5 opacity-0 break-keep transition-opacity duration-1000 delay-400"
                               data-aos="fade-up">
                                다양한 체험 프로그램과 <br>
                                전문적이고 체계적인 상담을 통해<br>
                                엑소미어의 제품을 체험할 수 있습니다
                            </p>
                            <a href="/about/branch"
                               target="_self"
                               class="inline-block mt-12 font-montserrat border border-solid border-white  py-2 px-20 text-white text-base translate-y-5 opacity-0 break-keep transition-transform duration-1000"
                               data-aos="fade-up">
                                THE MORE
                            </a>
                        </div>

                    </div>
                </div>

            </section>
            <section class="shrink-0 lg:snap-center">
                @include('pages.partials.footer')
            </section>
        </div>
    </div>

@endsection

@section('page-script')
    <script>
        AOS.init({
            duration: 1200,
        })

    </script>

    <script defer src="{{ asset('assets/js/fo/main.js') }}"></script>
@endsection
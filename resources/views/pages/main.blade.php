<?php

$isMain = true;
$whiteHeader = true;
?>

@extends('pages.layouts.mainLayout')

@section('title', '72시간만에 10년 젊어지기')

@section('vendor-style')
    <link href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" rel="stylesheet">
@endsection

@section('page-style')
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet"/>
@endsection

@section('content')

    <main class="flex flex-col">
        {{--hero section--}}
        <section class="h-svh">
            <div class="swiper main-swiper">
                <div class="swiper-wrapper">
                    @foreach($mainVideoBanner as $item)
                        <div class="swiper-slide">
                            <div
                                class="absolute transform z-10 lg:top-1/2 lg:w-[50%] lg:px-28 lg:transform lg:-translate-x-1/2 lg:-translate-y-[60%] lg:text-left text-white">
                                <p data-aos="fade-in" data-aos-delay="300"
                                   class="text-white/80 mt-6 text-xl break-keep leading-tight">
                                    {{ $item['sub_title'] }}
                                </p>
                                <p data-aos="fade-up" data-aos-delay="400"
                                   class="text-3xl lg:text-4xl font-normal leading-tight break-keep mt-5">
                                    {{ $item['title'] }}
                                </p>
                                <a data-aos="fade-in" data-aos-delay="300" href="/products" target="_self"
                                   class="mt-12 inline-block border border-solid border-white py-3 px-24 text-base break-keep">
                                    THE MORE
                                </a>
                            </div>

                            <video
                                class="slide-video object-cover"
                                autoPlay
                                loop
                                muted
                            >
                                <source src={{ $item['video_src'] }} type="video/mp4"/>
                            </video>

                        </div>
                    @endforeach
                </div>
                <div class="all-box absolute inline-flex left-1/2 bottom-[10%] w-[90%] h-[50px] p-x-[20px] z-20">
                    <div class="progress-box">
                        <div class="swiper-pagination"></div>
                        <div class="autoplay-progress">
                            <svg viewBox="0 0 100 10">
                                <line x1="0" y1="0" x2="100" y2="0">
                            </svg>
                        </div>
                    </div>
                    <div class="arrow-box text-white">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </section>

        {{--best itmes--}}
        <section class="max-w-5xl lg:max-w-7xl mx-auto px-6 py-24">
            <h2 class="text-center text-3xl lg:text-4xl my-10" data-aos="fade-up">BEST ITEMS</h2>

            <div class="grid grid-cols-2 lg:grid-cols-3 gap-x-2 gap-y-6 lg:gap-x-10 lg:gap-y-3">
                @foreach($bestProducts as $product)
                    <a href="/products/{{ $product['id'] }}" class="swiper-slide group flex flex-col text-center"
                       data-aos="fade-up"
                       data-aos-delay="{{ $loop->index  * 100 }}">
                        <div
                            class="relative w-full aspect-square bg-cover bg-center lg:group-hover:bg-[url({{$product['thumbnail2']}})]">
                            <img src="{{$product['thumbnail']}}" alt="{{$product['product_name']}}"
                                 loading="lazy"
                                 class="h-full w-full object-center lg:h-full lg:w-full lg:group-hover:opacity-0 transition-opacity duration-500">
                        </div>
                        <div class="p-3 pt-5 w-full text-slate">
                            <p class="mb-1 text-lg line-clamp-1 text-gray-900 relative after:bg-slate-700 after:absolute after:h-[1px] after:w-[20px] after:-ml-[10px] after:-bottom-2 after:left-1/2">
                                {{ $product['product_name'] }}</p>
                            <p class="mt-5 text-sm text-gray-700 text-slate-700 line-clamp-2">
                                {{ $product['sub_name'] }}</p>
                            <p class="mt-5 text-base text-gray-600">
                                {{ number_format($product['price']) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        {{--video--}}
        <section class="overflow-hidden padding-y md:p-0">
            <div class="flex h-full">
                <video class="w-full" playsinline="" autoplay="autoplay" loop="loop" muted="muted">
                    <source src="http://exomere.co.kr/common/image/exomere.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </section>

        {{--원료소개--}}
        <section class="h-svh">
            <div class="swiper material-swiper">
                <div class="swiper-wrapper">
                    @foreach($materials as $item)
                        <div class="swiper-slide">
                            <a href="/about/technology"
                               class="flex flex-col w-full h-full items-center bg-white border border-gray-200 lg:flex-row">
                                <div
                                    class="w-full h-full lg:w-[50%] w-full overflow-hidden">
                                    <div data-aos="scale" class="min-h-56 h-full bg-center bg-cover"
                                         style="background-image: url('{{ $item['image_src'] }}')">
                                    </div>
                                </div>

                                <div
                                    class="relative flex flex-col justify-between p-4 pb-12 leading-normal w-full lg:w-[50%] padding">
                                    <div class="lg:max-w-lg lg:leading-10 show_content_box tracking-tight">
                                        <h2 class="leading-tight text-left font-semibold text-3xl lg:text-4xl mb-10">
                                            BASE<br>
                                            MATERIAL
                                        </h2>
                                        <p class="mb-2 text-2xl lg:text-3xl text-left font-semibold text-gray-900">
                                            {{ $item['name'] }}
                                        </p>
                                        <p class="mb-3 md:text-lg md:leading-loose text-left font-normal text-gray-600
                                            line-clamp-4 break-keep">
                                            {{ $item['description'] }}
                                        </p>
                                        <p class="mt-5 text-left font-normal text-slate-700 pb-10">
                                            {{ $item['code'] }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
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


        {{--브랜치--}}
        <section class="h-svh  overflow-hidden">
            <div class="flex justify-center items-center size-full ">
                <div class="relative w-full">
                    <img src="{{asset('assets/img/elements/visual_01.webp')}}" alt="" loading="lazy">
                    <div class="absolute inset-0 size-full bg-black/50"></div>
                    <div
                        class="absolute inset-0 z-10 size-full flex flex-col justify-center text-white pl-10">
                        <h3 class="text-3xl text-white font-semibold leading-tight md:text-4xl break-keep mb-5"
                            data-aos="fade-up">
                            ABOUT BRANCH
                        </h3>
                        <p class="text-sm leading-loose break-keep md:text-xl md:leading-loose"
                           data-aos="fade-up" data-aos-delay="100">
                            다양한 체험 프로그램과
                            <br>
                            전문적이고 체계적인 상담을 통해
                            <br>
                            엑소미어의 제품을 체험할 수 있습니다
                        </p>
                        <p>
                            <a href="/about/branch"
                               target="_self"
                               class="inline-block mt-5 md:mt-7 border border-solid border-white text-white py-2 px-16 break-keep"
                               data-aos="fade" data-aos-delay="200">
                                THE MORE
                            </a>
                        </p>
                    </div>
                </div>

            </div>
        </section>
    </main>
@endsection

@section('page-script')
    <script defer src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script defer src="{{ asset('assets/js/fo/main.js') }}"></script>
@endsection
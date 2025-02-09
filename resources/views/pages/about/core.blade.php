<?php

$visualFullWidthLayout = 1;

$contents = config('contents.core.' . app()->getLocale());

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
                <li class="relative p-3 basis-1/4"><a class="active" href="/about/core">{{ __('gnb.core') }}</a>
                </li>
                <li class="relative p-3 basis-1/4"><a class="" href="/about/technology">{{ __('gnb.technology') }}</a>
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
                                        <source srcset="{{ asset($content['image']) }}">
                                        <img src="{{ asset($content['image']) }}"
                                             alt="{{ $content['title'] }}"
                                             data-aos="scale"
                                             class="w-full h-full">
                                    </picture>
                                    <div class="relative px-8  leading-loose md:basis-1/2"
                                         data-aos="fade">
                                        <h2 class="@if(in_array(app()->getLocale(), ['jp','cn'])) break-all @endif inline-block font-bold text-2xl text-head mb-7">{{ $content['title'] }}
                                            <small
                                                class="font-light text-sm block">{{ $content['title_sub'] }}</small>
                                        </h2>

                                        <p class="leading-loose md:leading-loose text-base md:text-lg text-gray-500 mb-3 ">
                                            {{ $content['code'] }}</p>
                                        <p class="@if(in_array(app()->getLocale(), ['jp','cn'])) break-all @endif leading-loose md:leading-loose text-base md:text-lg text-gray-500 mb-3 ">
                                            {!! $content['description'] !!}
                                        </p>
                                        <small
                                            class="w-full inline-block text-right text-gray-500">* {{ __('messages.core_raw') }}</small>
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


<?php

$visualFullWidthLayout = true;
?>
@extends('pages.layouts.subLayout')

@section('title', __('gnb.about'))

@section('id', 'about')
@section('visual_title',  __('gnb.about') )
@section('visual_sub_title', __('gnb.about_title'))
@section('visual_background', 'https://cdn.pixabay.com/photo/2020/03/29/19/20/theatre-4981936_1280.jpg')

@section('page-style')
    <style>
    </style>
@endsection
@section('content')

    <div class="relative">
        <nav id="parallax__nav" class="relative bg-white w-full left-0 z-40 lg:absolute lg:top-32 lg:pl-7 lg:bg-transparent lg:left-0 lg:w-auto">
            <ul class="flex flex-row justify-center text-sm text-center text-slate-500 lg:flex-col lg:text-base">
                <li class="relative p-3 basis-1/4"><a class="active" href="/about">기업소개</a>
                </li>
                <li class="relative p-3 basis-1/4"><a class="" href="/about/philosophy">경영이념</a>
                </li>
                <li class="relative p-3 basis-1/4"><a class="" href="/about/history">연혁</a>
                </li>
                <li class="relative p-3 basis-1/4"><a class="" href="/about/cibi">CI/BI 소개</a>
                </li>
            </ul>
        </nav>


        <div id="parallax__cont"
             class="overflow-hidden bg-white text-content">
            <section class="pb-32 lg:pb-40">
                <div class="pt-20 px-4 lg:px-44">
                    <div class="relative z-30 text-left tracking-tight flex flex-col xl:flex-row gap-x-4 gap-y-4 justify-between my-10">
                        <h2 class="text-3xl text-head font-semibold leading-tight md:text-4xl break-keep"
                            data-aos="fade">엑소좀 안티에이징 솔루션,<br>엑소미어</h2>
                        <p class="flex-1 w-full md:max-w-4xl xl:max-w-5xl text-sm leading-loose break-keep md:text-xl md:leading-loose"
                           data-aos="fade"
                           data-aos-delay="100">
                            {{ __('messages.about_content_head_1') }}{{ __('messages.about_content_1') }}<br>
                            {{ __('messages.about_content_head_2') }}{{ __('messages.about_content_2') }}
                        </p>
                    </div>
                    <div class="flex flex-col gap-y-1 lg:flex-row lg:gap-x-1">
                        <picture class="lg:basis-2/5 overflow-hidden">
                            <source srcset="{{ asset('assets/img/elements/subvisual_product.jpg') }}">
                            <img src="{{ asset('assets/img/elements/subvisual_product.jpg') }}"
                                 alt=""
                                 class="aspect-square w-full h-full"
                                 data-aos="mix">
                        </picture>
                        <picture class="lg:basis-3/5 overflow-hidden">
                            <source srcset="{{ asset('assets/img/elements/2024021315327960678_hover.png') }}">
                            <img src="{{ asset('assets/img/elements/2024021315327960678_hover.png') }}"
                                 alt=""
                                 class="aspect-square w-full h-full"
                                 data-aos="mix">
                        </picture>
                    </div>
                    <div class="h-96 sm:h-[80svh] mt-10 overflow-hidden">
                        <picture class="size-full">
                            <source srcset="{{ asset('assets/img/elements/visual_01.webp') }}">
                            <img src="{{ asset('assets/img/elements/visual_01.webp') }}"
                                 alt=""
                                 class="aspect-square w-full h-full"
                                 data-aos="mix">
                        </picture>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection

@section('page-script')
    <script>

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


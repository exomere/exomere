<?php

$visualFullWidthLayout = true;

$contents = [
    [
        'src' => "https://cdn.pixabay.com/photo/2024/07/15/06/52/dna-8895875_1280.png"
    ],
    [
        'src' => "https://cdn.pixabay.com/photo/2021/10/11/17/37/handshake-6701408_1280.jpg"
    ],
    [
        'src' => "https://cdn.pixabay.com/photo/2018/12/20/06/53/network-3885328_1280.jpg"
    ],
    [
        'src' => "https://cdn.pixabay.com/photo/2017/02/01/13/53/analysis-2030265_1280.jpg"
    ]
];

?>
@extends('pages.layouts.subLayout')
@section('title', __('gnb.philosophy'))

@section('id', 'philosophy')
@section('visual_title',  __('gnb.philosophy') )
@section('visual_sub_title', __('gnb.philosophy_title'))
@section('visual_background', 'https://cdn.pixabay.com/photo/2020/03/29/19/20/theatre-4981936_1280.jpg')

@section('page-style')

@endsection
@section('content')

    <div class="relative">
        <nav id="parallax__nav"
             class="relative bg-white w-full left-0 z-40 lg:absolute lg:top-32 lg:pl-7 lg:bg-transparent lg:left-0 lg:w-auto">
            <ul class="flex flex-row justify-center text-sm text-center text-slate-500 lg:flex-col lg:text-base lg:backdrop-blur-sm">
                <li class="relative p-3 basis-1/4"><a class="" href="/about">기업소개</a>
                </li>
                <li class="relative p-3 basis-1/4"><a class="active" href="/about/philosophy">경영이념</a>
                </li>
                <li class="relative p-3 basis-1/4"><a class="" href="/about/history">연혁</a>
                </li>
                <li class="relative p-3 basis-1/4"><a class="" href="/about/cibi">CI/BI 소개</a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="flex flex-col pt-20 pb-32 lg:pb-40">
        @foreach($contents as $content)
            <div class="flex flex-col md:flex-row aspect-h-1 sm:min-h-[40svh] lg:min-h-[60svh]">
                <picture class="overflow-hidden basis-1/2">
                    <source srcset="{{$content['src']}}">
                    <img src="{{$content['src']}}" alt=""
                         data-aos="scale"
                         class="w-full h-full">
                </picture>
                <div
                    class="basis-1/2 flex flex-col justify-center pt-10 pb-20 px-8 lg:p-0 lg:px-[5%] xl:px-[10%] @if($loop->even) md:order-first @endif">
                    <div class="min-sm:max-w-lg">
                        <h2 class="text-2xl md:text-3xl lg:text-4xl text-head font-semibold mb-4 md:mb-7 text-left"
                            data-aos="fade-in"
                            data-aos-delay="100">{{ __('messages.philosophy_content_head_'.$loop->index+1) }}</h2>
                        <p class="whitespace-pre-line leading-loose lg:leading-loose lg:text-lg "
                           data-aos="fade-in"
                           data-aos-delay="100">{{ __('messages.philosophy_content_'.$loop->index+1) }}</p>
                    </div>

                </div>
            </div>
        @endforeach
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


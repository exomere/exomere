<?php

?>

@extends('pages.layouts.withoutVisualLayout')
@section('title', __('gnb.products'))

@section('id', 'products')
@section('visual_title',  __('gnb.products') )
@section('visual_sub_title', __('gnb.products_title'))
@section('visual_background', asset("assets/img/elements/subvisual_product.jpg"))

@section('vendor-style')
    <link href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" rel="stylesheet">
@endsection
@section('page-style')
    <style>
        .swiper-wrapper {
            height: max-content !important;
            width: max-content;
        }

        .swiper-button-prev:after,
        .swiper-rtl .swiper-button-next:after {
            content: "" !important;
        }

        .swiper-button-next:after,
        .swiper-rtl .swiper-button-prev:after {
            content: "" !important;
        }

        .product-thumb .swiper-slide.swiper-slide-thumb-active > .slide\:border-indigo-600 {
            --tw-border-opacity: 1;
            border-color: rgb(79 70 229 / var(--tw-border-opacity));
        }

        #toggle-btn,
        #hide-btn {
            width: 95%;
            -webkit-box-shadow: 0 10px 10px 0 rgba(80, 80, 80, .1);
            box-shadow: 0 10px 10px 0 rgba(80, 80, 80, .1);
        }

        #parallax__nav ul li a {
            color: #A6A7A6;
        }

        #parallax__nav ul li:has(a.active){
            background-color: #fff;
        }
        #parallax__nav ul li a.active {
            color: rgb(71 85 105);
            background-color: #fff;
            font-weight: 400;
        }

    </style>

@endsection
<meta name="csrf-token" content="{{ csrf_token() }}"/>
@section('content')

    <section class="py-10 lg:py-24 relative min-h-screen">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16">
                <div>
                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                         class="swiper product-prev mb-3 h-auto max-h-[80svh]">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="relative w-full aspect-square">
                                    <img src="{{ Storage::url('public/data/'.$product['thum_img']) }}"
                                         onerror="this.src='//exomere.co.kr/storage/data/noimg.jpg';"
                                         alt=""
                                         class="size-full object-center">
                                </div>

                            </div>
                            @if(!empty($product['thum_img2']))
                                <div class="swiper-slide">
                                    <div class="relative w-full aspect-square">
                                        <img src="{{ Storage::url('public/data/'.$product['thum_img2']) }}"
                                             onerror="this.src='//exomere.co.kr/storage/data/noimg.jpg';"
                                             alt=""
                                             class="size-full object-center">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="swiper product-thumb max-w-[608px] h-auto mx-auto">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="relative w-full aspect-square">
                                    <img src="{{ Storage::url('public/data/'.$product['thum_img']) }}"
                                         onerror="this.src='//exomere.co.kr/storage/data/noimg.jpg';"
                                         alt=""
                                         class="size-full object-center">
                                </div>
                            </div>
                            @if(!empty($product['thum_img2']))
                                <div class="swiper-slide">
                                    <div class="relative w-full aspect-square">
                                        <img src="{{ Storage::url('public/data/'.$product['thum_img2']) }}"
                                             onerror="this.src='//exomere.co.kr/storage/data/noimg.jpg';"
                                             alt=""
                                             class="size-full object-center">
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="swiper-pagination_prod">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>

                <div
                    class="pro-detail w-full flex flex-col order-last lg:order-none pt-8 ">
                    <p class="font-medium text-lg text-exomere mb-4"><a
                            class="flex flex-inline items-center text-base"
                        >{{ $product['code'] }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="hidden bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                            </svg>
                        </a>
                    </p>
                    <h2 class="mb-2 font-bold text-3xl leading-10 text-gray-900">
                        @if(app()->getLocale() == 'ko')
                            {{ $product['name'] }}
                        @else
                            {{ $product['name_en'] }}
                        @endif
                    </h2>

                    <p class="text-gray-500 text-base font-normal mb-8 ">
                        @if(app()->getLocale() == 'ko')
                            {{ $product['description'] }}
                        @else
                            {{ $product['description_en'] }}
                        @endif
                    </p>
                    @php
                        $locale = app()->getLocale();
                    @endphp
                    <div class="w-full">
                        <input type="hidden" class="distribution_price" name="distribution_price"
                               value="{{ $product['exclusive_price'] }}">

                        <div class="flex flex-col gap-3 mb-8 justify-items-center justify-center items-start">
                            <div class="flex flex-row text-lg leading-9 text-gray-900 sm:border-r border-gray-200">
                                <strong class="w-40">{{ __('common.price') }}</strong>
                                <h6 class="flex"><span
                                        class="">
                                        @if($locale == 'ko')
                                            {{ number_format($product['mem_price']) }}
                                        @elseif($locale == 'jp')
                                            {{ number_format($product['mem_price_y']) }}
                                        @elseif($locale == 'cn')
                                            {{ number_format($product['mem_price_c']) }}
                                        @else
                                            {{ number_format($product['mem_price_d']) }}
                                        @endif
                                        </span>
                                    <span
                                        class="px-1 currency @if(app()->getLocale() == 'en') order-first @endif">{{ __('common.currency') }}</span>
                                </h6>
                            </div>

                            @if(request()->session()->get('member_seq'))
                                @if(request()->session()->get('member_position') != "회원")
                                    <div
                                        class="flex flex-row text-lg leading-9 text-gray-900 sm:border-r border-gray-200">
                                        <strong class="w-40">{{ __('common.distribution_price') }}</strong>

                                        <h6 class="flex "><span
                                                class="">
                                                @if(request()->session()->get('member_position') == "총판")
                                                    @if($locale == 'ko')
                                                        {{ number_format($product['exclusive_price']) }}
                                                    @elseif($locale == 'jp')
                                                        {{ number_format($product['exclusive_price_y']) }}
                                                    @elseif($locale == 'cn')
                                                        {{ number_format($product['exclusive_price_c']) }}
                                                    @else
                                                        {{ number_format($product['exclusive_price_d']) }}
                                                    @endif
                                                @elseif(request()->session()->get('member_position') == "총판1")
                                                    @if($locale == 'ko')
                                                        {{ number_format($product['exclusive_price1']) }}
                                                    @elseif($locale == 'jp')
                                                        {{ number_format($product['exclusive_price_y']) }}
                                                    @elseif($locale == 'cn')
                                                        {{ number_format($product['exclusive_price_c']) }}
                                                    @else
                                                        {{ number_format($product['exclusive_price_d']) }}
                                                    @endif
                                                @elseif(request()->session()->get('member_position') == "회원")
                                                    @if($locale == 'ko')
                                                        {{ number_format($product['mem_price']) }}
                                                    @elseif($locale == 'jp')
                                                        {{ number_format($product['mem_price_y']) }}
                                                    @elseif($locale == 'cn')
                                                        {{ number_format($product['mem_price_c']) }}
                                                    @else
                                                        {{ number_format($product['mem_price_d']) }}
                                                    @endif
                                                @elseif(request()->session()->get('member_position') == "뷰티플래너")
                                                    @if($locale == 'ko')
                                                        {{ number_format($product['planer_price']) }}
                                                    @elseif($locale == 'jp')
                                                        {{ number_format($product['planer_price_y']) }}
                                                    @elseif($locale == 'cn')
                                                        {{ number_format($product['planer_price_c']) }}
                                                    @else
                                                        {{ number_format($product['planer_price_d']) }}
                                                    @endif
                                                @elseif(request()->session()->get('member_position') == "대리점")
                                                    @if($locale == 'ko')
                                                        {{ number_format($product['store_price']) }}
                                                    @elseif($locale == 'jp')
                                                        {{ number_format($product['store_price_y']) }}
                                                    @elseif($locale == 'cn')
                                                        {{ number_format($product['store_price_c']) }}
                                                    @else
                                                        {{ number_format($product['store_price_d']) }}
                                                    @endif
                                                @else
                                                    @if($locale == 'ko')
                                                        {{ number_format($product['exclusive_price']) }}
                                                    @elseif($locale == 'jp')
                                                        {{ number_format($product['exclusive_price_y']) }}
                                                    @elseif($locale == 'cn')
                                                        {{ number_format($product['exclusive_price_c']) }}
                                                    @else
                                                        {{ number_format($product['exclusive_price_d']) }}
                                                    @endif
                                                @endif
                                            </span>
                                            <span
                                                class="px-1 currency @if(app()->getLocale() == 'en') order-first @endif">{{ __('common.currency') }}</span>
                                        </h6>
                                    </div>
                                @endif
                            @endif
                            <div class="flex flex-row text-lg leading-9 text-gray-900 sm:border-r border-gray-200">
                                <strong class="w-40">{{ __('common.vat_excluded') }}</strong>
                                <h6 class="flex"><span
                                        class="">
                                        @if(request()->session()->get('member_position'))
                                            @if(request()->session()->get('member_position') == "총판")

                                                @if($locale == 'ko')
                                                    {{ number_format($product['exclusive_pv']) }}
                                                @elseif($locale == 'jp')
                                                    {{ number_format($product['exclusive_pv_y']) }}
                                                @elseif($locale == 'cn')
                                                    {{ number_format($product['exclusive_pv_c']) }}
                                                @else
                                                    {{ number_format($product['exclusive_pv_d']) }}
                                                @endif
                                            @elseif(request()->session()->get('member_position') == "총판1")
                                                @if($locale == 'ko')
                                                    {{ number_format($product['exclusive_price1']) }}
                                                @elseif($locale == 'jp')
                                                    {{ number_format($product['exclusive_price_y']) }}
                                                @elseif($locale == 'cn')
                                                    {{ number_format($product['exclusive_price_c']) }}
                                                @else
                                                    {{ number_format($product['exclusive_price_d']) }}
                                                @endif
                                            @elseif(request()->session()->get('member_position') == "회원")
                                                @if($locale == 'ko')
                                                    {{ number_format($product['mem_pv']) }}
                                                @elseif($locale == 'jp')
                                                    {{ number_format($product['mem_pv_y']) }}
                                                @elseif($locale == 'cn')
                                                    {{ number_format($product['mem_pv_c']) }}
                                                @else
                                                    {{ number_format($product['mem_pv_d']) }}
                                                @endif
                                            @elseif(request()->session()->get('member_position') == "뷰티플래너")
                                                @if($locale == 'ko')
                                                    {{ number_format($product['planer_pv']) }}
                                                @elseif($locale == 'jp')
                                                    {{ number_format($product['planer_pv_y']) }}
                                                @elseif($locale == 'cn')
                                                    {{ number_format($product['planer_pv_c']) }}
                                                @else
                                                    {{ number_format($product['planer_pv_d']) }}
                                                @endif
                                            @elseif(request()->session()->get('member_position') == "대리점")
                                                @if($locale == 'ko')
                                                    {{ number_format($product['store_pv']) }}
                                                @elseif($locale == 'jp')
                                                    {{ number_format($product['store_pv_y']) }}
                                                @elseif($locale == 'cn')
                                                    {{ number_format($product['store_pv_c']) }}
                                                @else
                                                    {{ number_format($product['store_pv_d']) }}
                                                @endif
                                            @else
                                                @if($locale == 'ko')
                                                    {{ number_format($product['exclusive_pv']) }}
                                                @elseif($locale == 'jp')
                                                    {{ number_format($product['exclusive_pv_y']) }}
                                                @elseif($locale == 'cn')
                                                    {{ number_format($product['exclusive_pv_c']) }}
                                                @else
                                                    {{ number_format($product['exclusive_pv_d']) }}
                                                @endif
                                            @endif
                                        @else
                                            @if($locale == 'ko')
                                                {{ number_format($product['pv']) }}
                                            @elseif($locale == 'jp')
                                                {{ number_format($product['pv_y']) }}
                                            @elseif($locale == 'cn')
                                                {{ number_format($product['pv_c']) }}
                                            @else
                                                {{ number_format($product['pv_d']) }}
                                            @endif
                                        @endif


                                    </span>
                                    <span
                                        class="px-1 currency @if(app()->getLocale() == 'en') order-first @endif">{{ __('common.currency') }}</span>
                                </h6>
                            </div>
                            <div class="flex flex-row text-lg leading-9 text-gray-900 sm:border-r border-gray-200">
                                <strong class="w-40">{{ __('common.quantity') }}</strong>
                                <div class="flex flex-row">
                                    <button
                                        class="minus group py-2 px-3 border border-solid border-gray-300 shadow-sm shadow-transparent transition-all duration-500 hover:shadow-gray-300 hover:bg-gray-50">
                                        <svg
                                            class="stroke-gray-700 transition-all duration-500 group-hover:stroke-black"
                                            width="22" height="22" viewBox="0 0 22 22" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.5 11H5.5" stroke="" stroke-width="1.6"
                                                  stroke-linecap="round"/>
                                            <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2" stroke-width="1.6"
                                                  stroke-linecap="round"/>
                                            <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2" stroke-width="1.6"
                                                  stroke-linecap="round"/>
                                        </svg>
                                    </button>
                                    <input type="text"
                                           id="quantity"
                                           name="quantity"
                                           class="quantity font-semibold text-gray-900 border-y border-solid border-gray-300 text-lg w-12 lg:max-w-[118px] bg-transparent placeholder:text-gray-900 text-center hover:bg-gray-50 focus-within:bg-gray-50 outline-0"
                                           value="1"
                                           maxlength="3"
                                           placeholder="1">
                                    <button
                                        class="plus group py-2 px-3 border border-solid border-gray-300 shadow-sm shadow-transparent transition-all duration-500 hover:shadow-gray-300 hover:bg-gray-50">
                                        <svg
                                            class="stroke-gray-700 transition-all duration-500 group-hover:stroke-black"
                                            width="22" height="22" viewBox="0 0 22 22" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 5.5V16.5M16.5 11H5.5" stroke="" stroke-width="1.6"
                                                  stroke-linecap="round"/>
                                            <path d="M11 5.5V16.5M16.5 11H5.5" stroke="" stroke-opacity="0.2"
                                                  stroke-width="1.6" stroke-linecap="round"/>
                                            <path d="M11 5.5V16.5M16.5 11H5.5" stroke="" stroke-opacity="0.2"
                                                  stroke-width="1.6" stroke-linecap="round"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="flex flex-row text-lg leading-9 text-gray-900 sm:border-r border-gray-200">
                                <strong class="w-40">{{ __('common.total_price') }}</strong>
                                <h6 class="flex font-semibold"><span
                                        class="total-price">
                                        @if(request()->session()->get('member_position'))
                                            @if($locale == 'ko')
                                                {{ number_format($product['exclusive_price']) }}
                                            @elseif($locale == 'jp')
                                                {{ number_format($product['exclusive_price_y']) }}
                                            @elseif($locale == 'cn')
                                                {{ number_format($product['exclusive_price_c']) }}
                                            @else
                                                {{ number_format($product['exclusive_price_d']) }}
                                            @endif
                                        @elseif(request()->session()->get('member_position') == "총판1")
                                            @if($locale == 'ko')
                                                {{ number_format($product['exclusive_price1']) }}
                                            @elseif($locale == 'jp')
                                                {{ number_format($product['exclusive_price_y']) }}
                                            @elseif($locale == 'cn')
                                                {{ number_format($product['exclusive_price_c']) }}
                                            @else
                                                {{ number_format($product['exclusive_price_d']) }}
                                            @endif
                                        @elseif(request()->session()->get('member_position') == "회원")
                                            @if($locale == 'ko')
                                                {{ number_format($product['mem_price']) }}
                                            @elseif($locale == 'jp')
                                                {{ number_format($product['mem_price_y']) }}
                                            @elseif($locale == 'cn')
                                                {{ number_format($product['mem_price_c']) }}
                                            @else
                                                {{ number_format($product['mem_price_d']) }}
                                            @endif
                                        @elseif(request()->session()->get('member_position') == "뷰티플래너")
                                            @if($locale == 'ko')
                                                {{ number_format($product['planer_price']) }}
                                            @elseif($locale == 'jp')
                                                {{ number_format($product['planer_price_y']) }}
                                            @elseif($locale == 'cn')
                                                {{ number_format($product['planer_price_c']) }}
                                            @else
                                                {{ number_format($product['planer_price_d']) }}
                                            @endif
                                        @elseif(request()->session()->get('member_position') == "대리점")
                                            @if($locale == 'ko')
                                                {{ number_format($product['store_price']) }}
                                            @elseif($locale == 'jp')
                                                {{ number_format($product['store_price_y']) }}
                                            @elseif($locale == 'cn')
                                                {{ number_format($product['store_price_c']) }}
                                            @else
                                                {{ number_format($product['store_price_d']) }}
                                            @endif
                                        @else
                                            @if($locale == 'ko')
                                                {{ number_format($product['price']) }}
                                            @elseif($locale == 'jp')
                                                {{ number_format($product['price_y']) }}
                                            @elseif($locale == 'cn')
                                                {{ number_format($product['price_c']) }}
                                            @else
                                                {{ number_format($product['price_d']) }}
                                            @endif
                                        @endif
                                    </span>
                                    <span
                                        class="px-1 currency @if(app()->getLocale() == 'en') order-first @endif">{{ __('common.currency') }}</span>
                                </h6>
                            </div>

                        </div>
                        <div class="flex flex-col lg:flex-row items-center gap-3">
                            <button
                                onclick="add2Cart()"
                                class="rounded-sm group py-4 px-5 border border-solid border-gray-600 bg-white text-gray-600 font-normal text-lg w-full flex items-center justify-center gap-2 shadow-sm shadow-transparent">
                                {{ __('common.add_to_cart') }}
                            </button>
                            <button
                                onclick="buyNow()"
                                class="rounded-sm text-center w-full px-5 py-4 border border-solid border-base-color bg-base-color flex items-center justify-center font-normal text-lg text-white shadow-sm">
                                {{ __('common.buy_now') }}
                            </button>
                        </div>

                    </div>

                </div>

            </div>


            <section class="relative">
                <nav id="parallax__nav" class=" relative bg-transparent w-full max-w-7xl">
                    <ul class="flex flex-row justify-center items-center h-12 bg-[#e9e9e9] mt-4 text-[#A6A7A6] border-t border-solid text-sm text-center tracking-tight">
                        <li class="relative p-3 basis-1/3"><a class="active"
                                                              href="#section1">{{ __('common.details') }}</a>
                        </li>
                        <li class="relative p-3 basis-1/3"><a class="" href="#section2">{{ __('common.review') }}
                                ({{ number_format($reviews->total()) }})</a>
                        </li>
                        <li class="relative p-3 basis-1/3"><a class=""
                                                              href="#section3">{{ __('common.shipping_exchange_refund') }}</a>
                        </li>
                    </ul>
                </nav>

                <div id="parallax__cont">
                    <section id="section1" class="parallax__item">
                        <div class="flex flex-col items-center w-auto mx-auto"
                             id="detail"
                             role="tabpanel"
                             aria-labelledby="detail-tab">

                            <div id="detail__desc" class="overflow-hidden pt-12 md:pt-24" style="height: 800px">
                                @if($locale == 'ko')
                                    {!! $product['content'] ?? ''  !!}
                                @elseif($locale == 'jp')
                                    {!! $product['content_jp'] ?? ''  !!}
                                @elseif($locale == 'cn')
                                    {!! $product['content_cn'] ?? ''  !!}
                                @else
                                    {!! $product['content_us'] ?? '' !!}
                                @endif
                            </div>

                            <button id="toggle-btn"
                                    class="mt-4 h-12 inline-flex justify-center items-center gap-x-1 border border-solid border-base-color text-base-color break-keep text-sm">
                                {{ __('common.expand_detail') }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                     class="bi bi-chevron-down"
                                     fill="currentColor"
                                     stroke="currentColor"
                                     viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                                </svg>
                            </button>
                            <button id="hide-btn"
                                    class="hidden mt-4 h-12 inline-flex justify-center items-center gap-x-1 inline-block border border-solid border-base-color text-base-color break-keep text-sm">
                                {{ __('common.collapse_detail') }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                     stroke="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708z"/>
                                </svg>
                            </button>

                        </div>

                    </section>

                    <section id="section2" class="min-h-96 py-10">
                        <nav id="parallax__nav" class=" relative bg-transparent w-full max-w-7xl">
                            <ul class="flex flex-row justify-center items-center h-12 bg-[#e9e9e9] mt-4 text-[#A6A7A6] border-t border-solid text-sm text-center tracking-tight">
                                <li class="relative p-3 basis-1/3"><a class=""
                                                                      href="#section1">{{ __('common.details') }}</a>
                                </li>
                                <li class="relative p-3 basis-1/3"><a class="active" href="#section2">{{ __('common.review') }}
                                        ({{ number_format($reviews->total()) }})</a>
                                </li>
                                <li class="relative p-3 basis-1/3"><a class=""
                                                                      href="#section3">{{ __('common.shipping_exchange_refund') }}</a>
                                </li>
                            </ul>
                        </nav>

                        <div class="py-4">
                            <p class="text-lg text-head-color font-normal mb-4">{{ __('common.review') }}</p>
                            <div class="flex justify-end mb-4">
                                {{--리뷰등록 버튼--}}
                                @if(auth()->id())
                                    <button data-modal-target="review-modal" data-modal-toggle="review-modal"
                                            class="block border border-solid border-gray-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                            type="button">
                                        {{ __('common.regist_review') }}
                                    </button>
                                @else
                                    <button
                                        onclick="if(confirm('{{ __('messages.require_login') }}')) location.href='{{ route('login') }}'"
                                        class="block border border-solid border-gray-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                        type="button">
                                        {{ __('common.regist_review') }}
                                    </button>
                                @endif
                            </div>
                            <div class="padding">


                                <x-reviews :reviews="$reviews"/>
                            </div>

                        </div>
                    </section>

                    <section id="section3" class="py-10">
                        <nav id="parallax__nav" class=" relative bg-transparent w-full max-w-7xl">
                            <ul class="flex flex-row justify-center items-center h-12 bg-[#e9e9e9] mt-4 text-[#A6A7A6] border-t border-solid text-sm text-center tracking-tight">
                                <li class="relative p-3 basis-1/3"><a class=""
                                                                      href="#section1">{{ __('common.details') }}</a>
                                </li>
                                <li class="relative p-3 basis-1/3"><a class="" href="#section2">{{ __('common.review') }}
                                        ({{ number_format($reviews->total()) }})</a>
                                </li>
                                <li class="relative p-3 basis-1/3"><a class="active"
                                                                      href="#section3">{{ __('common.shipping_exchange_refund') }}</a>
                                </li>
                            </ul>
                        </nav>

                        <div class="py-4">
                            <p class="text-lg text-head-color font-normal mb-4">{{ __('common.shipping_exchange_refund') }}</p>
                            <x-shipping/>
                        </div>
                    </section>
                </div>
            </section>

        </div>


        <!-- review modal -->
        <x-review-modal :product="$product"/>


    </section>

@endsection

@section('page-script')
    <script defer src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            var swiper = new Swiper(".product-thumb", {
                spaceBetween: 10,
                slidesPerView: 6,
                freeMode: true,
                watchSlidesProgress: true,

            });
            var swiper2 = new Swiper(".product-prev", {
                autoplay: true,
                spaceBetween: 5,
                slidesPerView: 1,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                thumbs: {
                    swiper: swiper,
                },

            });

            //상품상세토글
            document.querySelector('#toggle-btn').addEventListener('click', () => {
                document.querySelector('#detail__desc').style.height = 'auto';
                document.querySelector('#toggle-btn').classList.add('hidden');
                document.querySelector('#hide-btn').classList.remove('hidden');
            });
            document.querySelector('#hide-btn').addEventListener('click', () => {
                document.querySelector('#detail__desc').style.height = '800px';
                document.querySelector('#toggle-btn').classList.remove('hidden');
                document.querySelector('#hide-btn').classList.add('hidden');
            });

            /*리뷰페이징 */
            document.addEventListener('click', function (e) {

                if (e.target.matches('#review-pagination a')) {
                    e.preventDefault();

                    const query = e.target.href.match(/page=\d+/)[0];
                    let link = '{{ route('getProductReviews', $product['id']) }}?' + query;

                    fetch(link)
                        .then(response => response.text())
                        .then(html => {
                            document.querySelector('#reviews-container').innerHTML = html;
                        });
                }
            });

            const reviewForm = document.getElementById("review-form");

            reviewForm.addEventListener("submit", async (event) => {
                event.preventDefault(); // 폼 기본 제출 방지

                const responseMessage = document.getElementById("response-message");
                const formData = new FormData(reviewForm);

                const rating = parseInt(formData.get("rating"), 10) || 0; // rating 값 가져오기
                const charlen = formData.get("content").length;

                // 클라이언트 측 검증
                if (rating < 1) {
                    responseMessage.innerHTML = `
                <p class="text-red-500">{{ __('messages.alert_rating') }}</p>
            `;
                    return;
                }

                if (charlen < 10) {
                    responseMessage.innerHTML = `
                <p class="text-red-500">{{ __('messages.alert_content') }}</p>
            `;
                    return;
                }

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                try {
                    const response = await fetch("/reviews", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                            Accept: "application/json",
                        },
                        body: formData,
                    });

                    const data = await response.json();

                    if (response.ok) {
                        // 성공 처리
                        location.reload();
                    } else {
                        // 실패 처리
                        location.reload();
                    }
                } catch (error) {
                    alert('error. ');
                }

            })

        });

        function updateTotalPrice() {
            const quantityInput = document.querySelector('.quantity');
            const pricePerUnit = parseInt(document.querySelector('.distribution_price').value);
            const quantity = parseInt(quantityInput.value);

            if (!isNaN(quantity) && quantity > 0) {
                const totalPrice = quantity * pricePerUnit;

                let formattedNumber = totalPrice.toLocaleString();

                document.querySelector('.total-price').innerText = formattedNumber;
            } else {
                alert("수량은 1 이상이어야 합니다.");
                quantityInput.value = 1;
                document.querySelector('.total-price').innerText = pricePerUnit;
            }
        }

        // 수량 변경 핸들러
        document.querySelector('.plus').addEventListener('click', function () {
            const quantityInput = document.querySelector('.quantity');
            quantityInput.value = parseInt(quantityInput.value) + 1;
            updateTotalPrice();
        });

        document.querySelector('.minus').addEventListener('click', function () {
            const quantityInput = document.querySelector('.quantity');
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
                updateTotalPrice();
            }
        });

        // 텍스트 입력 필드에서 직접 수량을 변경할 때
        document.querySelector('.quantity').addEventListener('input', function () {
            updateTotalPrice();
        });

        function add2Cart() {

            var auth = "{{request()->session()->get('member_id')}}";
            
            if(!auth){
                location.href='/login';
                return false;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "/products/cartSave",
                data: {
                    "pd_seq": {{$product['id']}},
                    "pd_qty": $("#quantity").val(),
                },
                success: function () {
                    alert('{{ __('messages.success_cart') }}');
                    location.href='/products';
                }
            });
        }

        function buyNow() {
            if (confirm('{{ __('messages.confirm_ordersheet') }}')) {

                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '/mypage/ordersheet';

                // Add CSRF token for Laravel
                let csrfToken = '{{ csrf_token() }}';
                let inputCsrf = document.createElement('input');
                inputCsrf.type = 'hidden';
                inputCsrf.name = '_token';
                inputCsrf.value = csrfToken;
                form.appendChild(inputCsrf);

                let inputProductId = document.createElement('input');
                inputProductId.type = 'hidden';
                inputProductId.name = 'pd_id';
                inputProductId.value = {{$product['id']}};
                form.appendChild(inputProductId);

                let inputProductQty = document.createElement('input');
                inputProductQty.type = 'hidden';
                inputProductQty.name = 'pd_qty';
                inputProductQty.value = $("#quantity").val();
                form.appendChild(inputProductQty);

                // Append form to the body and submit it
                document.body.appendChild(form);
                form.submit();
            }

            return false;
        }


    </script>
@endsection


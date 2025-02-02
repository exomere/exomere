<?php

$visualFullWidthLayout = true;

$history = config('contents.history.' . app()->getLocale());
?>

@extends('pages.layouts.subLayout')
@section('title', __('gnb.history'))

@section('id', 'history')
@section('visual_title',  __('gnb.history') )
@section('visual_sub_title', __('gnb.history_title'))
@section('visual_background', 'https://cdn.pixabay.com/photo/2020/03/29/19/20/theatre-4981936_1280.jpg')

@section('page-style')
    <style>
        .history--list li:not(:last-child):before {
            position: absolute;
            top: 30px;
            left: 4px;
            bottom: -12px;
            width: 2px;
            border-radius: 3px;
            background-color: #eee;
            content: "";
        }

        .history--list li::after {
            position: absolute;
            top: 15px;
            left: 0;
            width: 10px;
            height: 10px;
            border-radius: 6px;
            background-color: rgb(207 87 51);
            content: "";
        }
    </style>

@endsection
@section('content')
    <div class="relative">
        <nav id="parallax__nav"
             class="relative bg-white w-full left-0 z-40 lg:absolute lg:top-32 lg:pl-7 lg:bg-transparent lg:left-0 lg:w-auto">
            <ul class="flex flex-row justify-center text-sm text-center text-slate-500 lg:flex-col lg:text-base">
                <li class="relative p-3 basis-1/4"><a class="" href="/about">{{ __('gnb.about') }}</a>
                </li>
                <li class="relative p-3 basis-1/4"><a class="" href="/about/philosophy">{{ __('gnb.philosophy') }}</a>
                </li>
                <li class="relative p-3 basis-1/4"><a class="active" href="/about/history">{{ __('gnb.history') }}</a>
                </li>
                <li class="relative p-3 basis-1/4"><a class="" href="/about/cibi">{{ __('gnb.cibi') }}</a>
                </li>
            </ul>
        </nav>
    </div>

    <?php
    $currentYear = null; ?>
    <ul class="history--list pt-20 px-4 lg:px-44 pb-32 lg:pb-40">
        @foreach ($history as $year => $months)
            @foreach ($months as $month => $events)
                <li class="relative flex flex-col lg:flex-row  pt-0 pr-0 pb-20 pl-8 lg:pl-12" data-aos="fade-up">
                    <div
                        class="flex-shrink-0 w-full w-20 lg:w-24 font-bold my-1.5 text-lg">{{ $currentYear != $year ? $year : '' }}</div>

                    <div class="flex lg:flex-row lg:ml-[36px] w-full">
                        <em class="font-bold w-16 my-1.5 tracking-tight text-right">{{ $month }}</em>
                        <div class="ml-3 lg:ml-7 my-1.5">

                            @foreach ($events as $index => $event)
                                @if ($index < 3)
                                    <p class="mb-4">{{ $event }}</p>
                                @endif
                            @endforeach

                            @if (count($events) > 3)
                                <div class="hidden" id="{{$year.$month}}">
                                    @foreach (array_slice($events,3) as $event)
                                        <p class="mb-4">{{ $event }}</p>
                                    @endforeach
                                </div>

                                <button
                                    class="inline-flex gap-x-1 items-center	bg-gray-200 text-xs px-3 py-1 rounded-full mt-2"
                                    id="toggle-{{$year.$month}}"
                                    data-collapse-toggle="{{$year.$month}}"
                                    aria-expanded="false"
                                >더보기
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                         fill="currentColor"
                                         class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                                    </svg>
                                </button>
                        </div>
                        @endif
                    </div>
                </li>
                    <?php
                    //년도가 바뀔때만 노출
                    $currentYear = $year ?>
            @endforeach
        @endforeach
    </ul>
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


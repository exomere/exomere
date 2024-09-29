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

    <div class="flex flex-col">
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
                        <p class="break-keep leading-loose lg:leading-loose lg:text-lg"
                           data-aos="fade-in"
                           data-aos-delay="100">{!! nl2br(__('messages.philosophy_content_'.$loop->index+1)) !!}</p>
                    </div>

                </div>
            </div>
        @endforeach
    </div>

@endsection

@section('page-script')
@endsection


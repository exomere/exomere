<?php

$items = [
    [
        'title' => "엑소미어 메인 필름",
        'url' => asset("assets/img/elements/main_video.mp4"),
        'thumbnail' => asset("assets/img/elements/about_technology_2.webp"),
        'created_at' => "2024.06.05",
    ],
    [
        'title' => "엑소미어 필름2",
        'url' => "//exomere.co.kr/common/image/exomere.mp4",
        'thumbnail' => asset("assets/img/elements/visual_04.webp"),
        'created_at' => "2024.05.29"
    ],
    [
        'title' => "엑소미어 필름3",
        'url' => "//exomere.co.kr/common/image/exomere.mp4",
        'thumbnail' => asset("assets/img/elements/visual_04.webp"),
        'created_at' => "2024.05.29"
    ],
    [
        'title' => "엑소미어 필름4",
        'url' => "//exomere.co.kr/common/image/exomere.mp4",
        'thumbnail' => asset("assets/img/elements/visual_04.webp"),
        'created_at' => "2024.05.29"
    ],
];

$mainVideo = array_shift($items);
$videos = $items;


$jsonData = json_encode($items, JSON_UNESCAPED_UNICODE);
?>

@extends('pages.layouts.subLayout')
@section('title',   __('gnb.videos'))

@section('id', 'videos')
@section('visual_title',  __('gnb.videos') )
@section('visual_sub_title', __('gnb.videos_title'))
@section('visual_background', asset("assets/img/elements/subvisual_bg3.jpg"))


@section('page-style')

@endsection
@section('content')

    <div>
        <!-- 메인 비디오 -->
        @if($mainVideo)
            <div class="mb-8 relative group cursor-pointer"
                 onclick="playVideo('{{ $mainVideo['url'] }}')"
                 data-aos="fade-in">
                <img src="{{ $mainVideo['thumbnail'] }}" alt="{{ $mainVideo['title'] }}"
                     class="aspect-video transition-opacity duration-300 group-hover:opacity-75">
                <div
                    class="absolute inset-0 flex mt-4 items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <svg class="w-24 h-24 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                            clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg>
                </div>

                <div class="mt-4 group-hover:opacity-75">
                    <h3 class="mb-5 text-lg font-medium text-gray-900 line-clamp-2">
                        {{$mainVideo['title']}}
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">{{$mainVideo['created_at']}}</p>
                </div>
            </div>
        @endif

        <!-- 작은 비디오 그리드 -->
        <div class="grid md:grid-cols-2 gap-x-6 gap-y-10 lg:gap-x-10 lg:gap-y-16">
            @foreach ($videos as $video)
                <div class="relative group cursor-pointer" onclick="playVideo('{{ $video['url'] }}')"
                     data-aos="fade-in"
                     data-aos-delay="{{ $loop->index * 100 }}"
                >
                    <img src="{{ $video['thumbnail'] }}" alt="{{ $video['title'] }}"
                         class="aspect-video transition-opacity duration-300 group-hover:opacity-75">
                    <div
                        class="absolute inset-0 flex mt-4 items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="mt-4 group-hover:opacity-75">
                        <h3 class="mb-5 text-lg font-medium text-gray-900 line-clamp-2">
                            {{$video['title']}}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">{{$video['created_at']}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- 전체화면 비디오 플레이어 -->
    <div id="fullscreenVideo" class="fixed inset-0 bg-black hidden z-50">
        <div class="absolute inset-0">
            <iframe id="videoPlayer" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="absolute top-5 right-5 lg:right-20">
            <button type="button" class="bg-exomere opacity-75 p-3 lg:p-7 rounded-full text-white"
                    onclick="closeVideo()" aria-hidden="false">
                <svg class="close-btn h-7 w-7 z-[101]" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
@endsection

@section('page-script')
    <script>

        function playVideo(url) {
            const player = document.getElementById('videoPlayer');
            const fullscreen = document.getElementById('fullscreenVideo');
            player.src = url;
            fullscreen.classList.remove('hidden');
            document.body.style.overflow = 'hidden';  // 스크롤 방지
        }

        function closeVideo() {
            const player = document.getElementById('videoPlayer');
            const fullscreen = document.getElementById('fullscreenVideo');
            player.src = '';
            fullscreen.classList.add('hidden');
            document.body.style.overflow = '';  // 스크롤 복원
        }
    </script>
@endsection


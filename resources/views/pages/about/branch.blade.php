<?php

$contents = [
    [
        'title' => '본사',
        'address' => '서울 송파구 법원로11길 11 (문정동, 문정현대지식산업센터1-1) A동 204호',
        'src' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3165.958500426007!2d127.1161443628678!3d37.485305671943145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca622c1588ee7%3A0xf2b3afd90b75baef!2z66y47KCVIOyngOyLneyCsOyXheyEvO2EsCBB64-Z!5e0!3m2!1sko!2skr!4v1725010469682!5m2!1sko!2skr',
        'x' => '36.81551',
        'y' => '127.11011',
    ],
];

?>
@extends('pages.layouts.subLayout')

@section('title', __('gnb.branch'))

@section('id', 'branch')
@section('visual_title',  __('gnb.branch') )
@section('visual_sub_title', __('gnb.branch_title'))
@section('visual_background', 'https://cdn.pixabay.com/photo/2020/03/29/19/20/theatre-4981936_1280.jpg')

@section('page-style')

@endsection
@section('content')

    <div class="grid md:grid-cols-5 gap-4  border-solid border border-slate-100
    divide-x divide-solid divide-slate-100"
         data-aos="fade">

        <!-- Google Map -->
        <div class="col-span-3 p-4 min-h-[70svh] max-h-[80svh]">

            <div id="map" class="h-full">
                <iframe id="frameMap"
                        src="//www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3165.958500426007!2d127.1161443628678!3d37.485305671943145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca622c1588ee7%3A0xf2b3afd90b75baef!2z66y47KCVIOyngOyLneyCsOyXheyEvO2EsCBB64-Z!5e0!3m2!1sko!2skr!4v1725010469682!5m2!1sko!2skr"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        </div>


        <!-- Address List -->
        <div class="col-span-2 max-h-[80svh] h-full overflow-y-scroll p-4">
            <form action="">
                <div class="hidden">
                    <div class="grid grid-cols-3 gap-3">
                        <select class="input">
                            <option value="">전체</option>
                        </select>
                        <select class="input">
                            <option value="">시/도</option>
                        </select>
                        <select class="input">
                            <option value="">시/군/구</option>
                        </select>
                    </div>
                    <input type="text" class="input" placeholder="이름 또는 주소 입력">
                    <button type="button" class="border-0 input text-exomere border-exomere border-solid"
                            onclick="alert('준비중입니다.')">검색하기
                    </button>
                </div>
                <div class="overflow-y-auto flex flex-col divide-y divide-solid divide-slate-100">
                    @foreach($contents as $content)
                        <div class="py-5 cursor-pointer">
                            <a class="hover:underline"
                               {{--                           onclick="updateMap({{ $content['x'] }}, {{ $content['y'] }})">--}}
                               onclick="updateMap('{{ $content['src'] }}')">
                                <p class="md:text-lg"><strong>{{ $content['title'] }}</strong></p>
                                {{ $content['address'] }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </form>

        </div>


    </div>
@endsection

@section('page-script')
    <script>
        let map_frame = document.querySelector("#frameMap");

        function updateMap(map_src) {
            map_frame.src = map_src;
        }
    </script>

@endsection


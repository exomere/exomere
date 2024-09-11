<?php

$items = [
    [
        'id' => 1,
        'subject' => '엑소미어 바디케어 리뉴얼 자료',
        'created_id' => 'Admin',
        'created_at' => \Illuminate\Support\Carbon::create(2024, 7, 9, 12, 00, 00)->toDateString(),
        'contents' => '  <div><p style="text-align: center;display:inline-flex; column-gap: 16px;"><img src="//placehold.co/300x400"><img src="//placehold.co/300x400"><img src="//placehold.co/300x400"></p><p style="text-align: center"><br></p><p style="text-align: center"><strong>바디케어 리뉴얼 이미지 입니다.</strong></p><p style="text-align: center"><br></p><p style="text-align: center">(관련자료는 첨부파일을 확인해 주세요)</p><p><br></p></div>',
        'views_count' => 100,
        'attach_type' => 'pdf',
        'attachments' => [
            'bodycream.pdf',
            'bodyscrub.pdf',
            'bodywash.pdf',
        ],
    ],
    [
        'id' => 2,
        'subject' => '엑소미어 헤어케어 리뉴얼 이미지',
        'created_id' => 'Admin',
        'created_at' => \Illuminate\Support\Carbon::create(2024, 8, 10, 12, 00, 00),
        'contents' => '  <div><p style="text-align: center;display:inline-flex; column-gap: 16px;"><img src="//placehold.co/400x300"><img src="//placehold.co/400x300"></p><p style="text-align: center"><br></p><p style="text-align: center"><strong>헤어케어 리뉴얼 이미지 입니다.</strong></p><p style="text-align: center"><br></p><p style="text-align: center">(관련자료는 첨부파일을 확인해 주세요)</p><p><br></p></div>',
        'views_count' => 0,
        'attach_type' => 'image',
        'attachments' => [
            'hairsampoo.png',
            'hairsampoo2.png',
        ],
    ],
    [
        'id' => 2,
        'subject' => '엑소미어 동영상',
        'created_id' => 'Admin',
        'created_at' => \Illuminate\Support\Carbon::create(2024, 8, 10, 12, 00, 00),
        'contents' => '  <div><p style="text-align: center;display:inline-flex; column-gap: 16px;"><img src="//placehold.co/900x500"></p><p style="text-align: center"><br></p><p style="text-align: center"><strong>동영상을 리뉴얼 했습니다 .</strong></p><p style="text-align: center"><br></p><p style="text-align: center">(관련자료는 첨부파일을 확인해 주세요)</p><p><br></p></div>',
        'views_count' => 0,
        'attach_type' => 'video',
        'attachments' => [
            'hairsampoo.mp4',
        ],
    ],
];

$jsonData = json_encode($items, JSON_UNESCAPED_UNICODE);
?>
@extends('pages.layouts.subLayout')
@section('title', __('gnb.reference'))

@section('id', 'reference')
@section('visual_title',  __('gnb.reference') )
@section('visual_sub_title', __('gnb.reference_title'))
@section('visual_background', '//cdn.pixabay.com/photo/2016/11/29/06/56/abstract-1867937_1280.jpg')

@section('page-style')
    <style>

    </style>
@endsection
@section('content')

    <div id="accordion-flush"
         data-accordion="collapse"
         data-active-classes="text-exomere font-medium"
         data-inactive-classes=""
         data-aos="fade-up"
    >
        @foreach($items as $item)
            <h2 id="accordion-flush-heading-{{ $loop->index }}"
                class="border-b border-solid border-slate-200">
                <button type="button"
                        class="flex items-center justify-between w-full p-5 "
                        data-accordion-target="#accordion-flush-body-{{ $loop->index }}"
                        aria-expanded="false"
                        aria-controls="accordion-flush-body-{{ $loop->index }}">
                    <span>{{ $item['subject'] }}</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                </button>
            </h2>
            <div id="accordion-flush-body-{{ $loop->index }}" class="hidden"
                 aria-labelledby="accordion-flush-heading-{{ $loop->index }}">
                <div class="py-5 border-b border-gray-200">
                    <div class="overflow-y-auto">
                        {!! $item['contents'] !!}
                    </div>

                    <div class="flex">
                        <p class="lg:w-56 border border-l-0 border-slate-200 border-solid padding text-center text-gray-500 ">
                            첨부파일</p>

                        <div
                            class="flex-1 flex items-center border border-solid border-slate-200 border-x-0 ">
                            @if(count($item['attachments']))
                                <ul class="ps-5 text-gray-500 leading-loose ">

                                    @foreach( $item['attachments'] as $attach)
                                        <li class="relative __icon __{{$item['attach_type']}}">
                                            <a
                                                href="javascript:alert('{{ __('common.in_ready') }}')"
                                                class="text-blue-600 hover:underline">{{ $attach }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                    </div>

                </div>
            </div>
        @endforeach
    </div>

@endsection

@section('page-script')
    <script>

    </script>
@endsection


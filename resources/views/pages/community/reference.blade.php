<?php

$items = [
    [
        'id' => 1,
        'subject' => '엑소미어 바디케어 리뉴얼 자료',
        'created_id' => 'Admin',
        'created_at' => \Illuminate\Support\Carbon::create(2024, 7, 9, 12, 00, 00)->toDateString(),
        'contents' => '  <div><p style="text-align: center;display:inline-flex; column-gap: 16px;"><img src="https://via.placeholder.com/300x400"><img src="https://via.placeholder.com/300x400"><img src="https://via.placeholder.com/300x400"></p><p style="text-align: center"><br></p><p style="text-align: center"><strong>바디케어 리뉴얼 이미지 입니다.</strong></p><p style="text-align: center"><br></p><p style="text-align: center">(관련자료는 첨부파일을 확인해 주세요)</p><p><br></p></div>',
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
        'contents' => '  <div><p style="text-align: center;display:inline-flex; column-gap: 16px;"><img src="https://via.placeholder.com/400x300"><img src="https://via.placeholder.com/400x300"></p><p style="text-align: center"><br></p><p style="text-align: center"><strong>헤어케어 리뉴얼 이미지 입니다.</strong></p><p style="text-align: center"><br></p><p style="text-align: center">(관련자료는 첨부파일을 확인해 주세요)</p><p><br></p></div>',
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
        'contents' => '  <div><p style="text-align: center;display:inline-flex; column-gap: 16px;"><img src="https://via.placeholder.com/900x600"></p><p style="text-align: center"><br></p><p style="text-align: center"><strong>동영상을 리뉴얼 했습니다 .</strong></p><p style="text-align: center"><br></p><p style="text-align: center">(관련자료는 첨부파일을 확인해 주세요)</p><p><br></p></div>',
        'views_count' => 0,
        'attach_type' => 'video',
        'attachments' => [
            'hairsampoo.mp4',
        ],
    ],
];

$jsonData = json_encode($items, JSON_UNESCAPED_UNICODE);
?>
@extends('pages.layouts.frontSubLayout')
@section('title', __('gnb.reference_title'))
@section('page-style')
    <style>

    </style>
@endsection
@section('content')

    <main class="relative">
        <section class="h-96 lg:h-[50svh]">
            <!-- Subvisual Wrapper -->
            <div class="relative pt-[80px] lg:pt-[160px] w-full h-full flex flex-col items-center justify-center
                    bg-cover bg-no-repeat bg-center"
                 style="background-image: url({{asset('assets/img/elements/subtitle_bg.webp')}})"
            >
                <!-- Subvisual Text -->
                <div class="text-center font-roboto tracking-tight z-10 text-gray-900">
                    <p class="text-4xl font-medium uppercase" data-aos="fade-down">
                        {{ __('gnb.reference') }}
                    </p>
                    <p class="font-medium" data-aos="fade-down" data-aos-delay="200">{{ __('gnb.reference_title') }}</p>
                </div>
            </div>
        </section>

        <section class="min-sm:max-container min-h-screen padding-y">
            <div class="bg-white">
                <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                    <div id="accordion-flush"
                         data-accordion="collapse"
                         data-active-classes="text-white bg-exomere font-medium"
                         data-inactive-classes="">
                        @foreach($items as $item)
                            <h2 id="accordion-flush-heading-{{ $loop->index }}"
                                class="border-b border-solid border-slate-200"
                                data-aos="fade-up"
                                data-aos-delay="{{ $loop->index * 100}}"
                            >
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
                </div>

            </div>
        </section>
    </main>

@endsection

@section('page-script')
    <script>

    </script>
@endsection


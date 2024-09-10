<?php

$history = [
    '2023년' => [
        '11월' => [
            '엑소미어 창립',
            'EXOMERE 상표 출원'
        ]
    ],
    '2024년' => [
        '1월' => [
            '1월 총판점장 심화교육'
        ],
        '2월' => [
            '엑소미어 일본도쿄코스메위크 참가',
            '엑소미어 미국지사 계약체결'
        ],
        '3월' => [
            '한라봉엑소좀 식약처 성분등록',
            '3월 총판점장 심화교육 및 출범식(1박 2일)/250 명 참석'
        ],
        '4월' => [
            '11일 제1기 스킨임플란트 전문가과정 아카데미',
            '17일 제1기 스킨임플란트 전문가과정 아카데미',
            '24일 제1기 스킨임플란트 전문가과정 아카데미'
        ],
        '5월' => [
            '5월 총판 심화교육',
            '엑소미어 일본 도쿄뷰티월드 참가',
            '일본지사 프리 오픈 세미나',
            '28일 제2기 스킨임플란트 전문가과정 아카데미'
        ],
        '6월' => [
            '엑소미어 한라봉엑소좀 특허등록 (제10-2677780호)',
            '엑소미어 7품목 미국FDA등록 완료'
        ],
        '7월' => [

            '2일 제3기 스킨임플란트 전문가과정 아카데미',
            '9일 제3기 스킨임플란트 전문가과정 아카데미',
            '16일 제3기 스킨임플란트 전문가과정 아카데미',
            '엑소미어 7품목 일본후생성허가 등록완료',
            '엑소미어 라스베가스 코스모프로프 박람회 참가',
            '2024 코스모프로프 어워즈 파이널리스트 선정',
            '엑소미어 미국 라스베가스 제품설명회',
        ]
    ]
];

$history = array_reverse($history);

?>

@extends('pages.layouts.subLayout')
@section('title', __('gnb.history'))

@section('id', 'history')
@section('visual_title',  __('gnb.history') )
@section('visual_sub_title', __('gnb.history_title'))
@section('visual_background', 'https://cdn.pixabay.com/photo/2020/03/29/19/20/theatre-4981936_1280.jpg')

@section('page-style')
    <style>
        #history li:not(:last-child):before {
            position: absolute;
            top: 30px;
            left: 4px;
            bottom: -12px;
            width: 2px;
            border-radius: 3px;
            background-color: #eee;
            content: "";
        }

        #history li::after {
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
    <?php
    $currentYear = null; ?>
    <ul class="mt-10">
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
@endsection


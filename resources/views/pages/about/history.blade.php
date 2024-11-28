<?php

$visualFullWidthLayout = true;

$locale = app()->getLocale();

if ($locale == 'ko') {
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
                '엑소미어 7품목 미국FDA등록 완료',
                '4일 제2기 스킨임플란트 전문가과정 아카데미',
                '11일 제2기 스킨임플란트 전문가과정 아카데미',
            ],
            '7월' => [

                '2일 제3기 스킨임플란트 전문가과정 아카데미',
                '9일 제3기 스킨임플란트 전문가과정 아카데미',
                '16일 제3기 스킨임플란트 전문가과정 아카데미',
                '엑소미어 7품목 일본후생성허가 등록완료',
                '엑소미어 라스베가스 코스모프로프 박람회 참가',
                '2024 코스모프로프 어워즈 파이널리스트 선정',
                '엑소미어 미국 라스베가스 제품설명회',
            ],

            '8월' => ['엑소미어 일본 법인지사 설립 (도쿄 신주쿠)'],
            '9월' => ['엑소미어 일본 스킨임플란트 뷰티아카데미 1회 개최'],
        ]
    ];
} elseif ($locale == 'cn') {
    $history = [
        '2023' => [
            '11' => [
                'EXOMERE成立',
                'EXOMERE商标申请'
            ]
        ],
        '2024' => [
            '01' => [
                '1月高级经理培训'
            ],
            '02' => [
                '参加EXOMERE东京美容周（日本）',
                '签署EXOMERE美国分公司合同'
            ],
            '03' => [
                'Hallabong Exosome作为成分在MFDS注册',
                '3月高级经理培训及启动活动（2天，250名参与者）'
            ],
            '04' => [
                '11日：第一届皮肤植入专家课程',
                '17日：第一届皮肤植入专家课程',
                '24日：第一届皮肤植入专家课程'
            ],
            '05' => [
                '5月高级经理培训',
                '参加EXOMERE东京美容世界（日本）',
                '日本分公司开业前研讨会',
                '28日：第二届皮肤植入专家课程'
            ],
            '06' => [
                'EXOMERE Hallabong Exosome专利注册（第10-2677780号）',
                '7个EXOMERE产品完成FDA注册',
                '4日：第二届皮肤植入专家课程',
                '11日：第二届皮肤植入专家课程'
            ],
            '07' => [
                '2日：第三届皮肤植入专家课程',
                '9日：第三届皮肤植入专家课程',
                '16日：第三届皮肤植入专家课程',
                '7个EXOMERE产品完成日本厚生劳动省批准',
                '参加拉斯维加斯Cosmoprof博览会',
                '2024 Cosmoprof大奖决赛入围',
                '在美国拉斯维加斯展示EXOMERE产品'
            ],
            '08' => ['成立EXOMERE日本公司（东京，新宿）'],
            '10' => ['在日本举行第一次EXOMERE皮肤植入美容学院']
        ]
    ];
} elseif ($locale == 'jp') {
    $history = [
        '2023' => [
            '11' => [
                'EXOMERE創立',
                'EXOMERE商標出願'
            ]
        ],
        '2024' => [
            '01' => [
                '1月の一般マネージャー向け高度なトレーニング'
            ],
            '02' => [
                'EXOMERE東京コスメティックウィーク（日本）への参加',
                'EXOMERE米国支社契約締結'
            ],
            '03' => [
                'Hallabong ExosomeがMFDSに成分登録',
                '3月の一般マネージャー向け高度なトレーニングとローンチイベント（2日間、250名参加）'
            ],
            '04' => [
                '11日：第1回皮膚インプラント専門家コースアカデミー',
                '17日：第1回皮膚インプラント専門家コースアカデミー',
                '24日：第1回皮膚インプラント専門家コースアカデミー'
            ],
            '05' => [
                '5月の一般マネージャー向け高度なトレーニング',
                'EXOMERE東京ビューティーワールド（日本）への参加',
                '日本支社のプレオープンセミナー',
                '28日：第2回皮膚インプラント専門家コースアカデミー'
            ],
            '06' => [
                'EXOMERE Hallabong Exosomeの特許登録（第10-2677780号）',
                '7つのEXOMERE製品のFDA登録完了',
                '4日：第2回皮膚インプラント専門家コースアカデミー',
                '11日：第2回皮膚インプラント専門家コースアカデミー'
            ],
            '07' => [
                '2日：第3回皮膚インプラント専門家コースアカデミー',
                '9日：第3回皮膚インプラント専門家コースアカデミー',
                '16日：第3回皮膚インプラント専門家コースアカデミー',
                '7つのEXOMERE製品の日本厚生労働省承認完了',
                'Cosmoprofラスベガスエキスポへの参加',
                '2024 Cosmoprof Awardsのファイナリスト',
                'アメリカ・ラスベガスでEXOMERE製品のプレゼンテーション'
            ],
            '08' => ['EXOMERE日本法人設立（東京、新宿）'],
            '10' => ['日本で初めてEXOMERE皮膚インプラントビューティーアカデミー開催']
        ]
    ];
} else {
    $history = [
        '2023' => [
            '11' => [
                'Founding of EXOMERE',
                'Trademark application for EXOMERE'
            ]
        ],
        '2024' => [
            '01' => [
                'Advanced training for general managers in January'
            ],
            '02' => [
                'Participation in EXOMERE Tokyo Cosmetic Week in Japan',
                'Contract signing for EXOMERE’s U.S. branch'
            ],
            '03' => [
                'Registration of Hallabong Exosome as an ingredient with the MFDS',
                'March advanced training and launch event for general managers (2 days, 250 participants)'
            ],
            '04' => [
                '11th: 1st Skin Implant Specialist Course Academy',
                '17th: 1st Skin Implant Specialist Course Academy',
                '24th: 1st Skin Implant Specialist Course Academy'
            ],
            '05' => [
                'Advanced training for general managers in May',
                'Participation in EXOMERE Tokyo Beauty World in Japan',
                'Pre-opening seminar for the Japan branch',
                '28th: 2nd Skin Implant Specialist Course Academy'
            ],
            '06' => [
                'Patent registration for EXOMERE Hallabong Exosome (No. 10-2677780)',
                'Completion of FDA registration for 7 EXOMERE products',
                '4th: 2nd Skin Implant Specialist Course Academy',
                '11th: 2nd Skin Implant Specialist Course Academy'
            ],
            '07' => [
                '2nd: 3rd Skin Implant Specialist Course Academy',
                '9th: 3rd Skin Implant Specialist Course Academy',
                '16th: 3rd Skin Implant Specialist Course Academy',
                'Completion of Japanese Ministry of Health approval for 7 EXOMERE products',
                'Participation in Cosmoprof Las Vegas Expo',
                'Finalist for the 2024 Cosmoprof Awards',
                'EXOMERE product presentation in Las Vegas, USA',
            ],
            '08' => ['Establishment of EXOMERE Japan Corporation (Tokyo, Shinjuku)'],
            '10' => ['First EXOMERE Skin Implant Beauty Academy held in Japan'],
        ]
    ];
}

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


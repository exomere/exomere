<?php

$items = [
    [
        'title' => "2024년 제2회 한류인플루언서 대상 어워즈 주최",
        'thumbnail' => "//exomere.co.kr/common/image/media_01.png",
        'contents' => "2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상<br><br>
         d어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워<br>
         즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년<br><br> 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 <br>한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대<br>상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최",
        'created_at' => "2024.06.05",
        'category' => 'company'
    ],
    [
        'title' => "2024년 코엑스 뷰티 박람회 참여",
        'thumbnail' => "//exomere.co.kr/common/image/media_02.png",
        'contents' => "2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최",
        'created_at' => "2024.05.29",
        'category' => 'rnd'
    ],
    [
        'title' => "2024년 일본 도쿄뷰티월드 세미나 개최",
        'thumbnail' => "//exomere.co.kr/common/image/media_03.png",
        'contents' => "2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최",
        'created_at' => "2024.05.13",
        'category' => 'social',
    ],
    [
        'title' => "2024년 일본 도쿄뷰티월드 박람회 참여",
        'thumbnail' => "//exomere.co.kr/common/image/media_04.png",
        'contents' => "2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최2024년 제2회 한류인플루언서 대상 어워즈 주최",
        'created_at' => "2024.05.13",
        'category' => 'social',

    ]
];


$news = collect($items)->whereNotNull('category'); //전체
$categorizeItems = $news->groupBy('category');//카테고리화

// 병합
$items = collect([
    'view_all' => $news
])->merge($categorizeItems);

$selectedCategory = request()->query('category') ?? null;

// todo
$categories = [
    "view_all",
    'company',
    'rnd',
    'social',
];

$jsonData = json_encode($news, JSON_UNESCAPED_UNICODE);
?>

@extends('pages.layouts.subLayout')
@section('title', __('gnb.news'))

@section('id', 'news')
@section('visual_title',  __('gnb.news') )
@section('visual_sub_title', '')
@section('visual_background', asset("assets/img/elements/subvisual_bg3.jpg"))

@section('page-style')
@endsection
@section('content')

    <!-- tabs -->
    <ul class="flex flex-wrap justify-center padding-y -mb-px text-base lg:text-lg font-medium text-center tracking-tight gap-4"
        id="tab"
        role="tablist"
        data-tabs-active-classes="text-exomere border border-solid rounded-full"
        data-tabs-inactive-classes="false"
        data-tabs-toggle="#tab-content"
    >
        @foreach($categories as $category)
            <li role="presentation">
                <button class="inline-block p-2 lg:p-4 "
                        id="{{$category}}-tab"
                        type="button"
                        role="tab"
                        data-tabs-target="#{{$category}}"
                        aria-controls="{{$category}}"
                        aria-selected="{{$category == $selectedCategory ? 'true' : 'false'}}"
                >{{ __('gnb.'.$category) }}
                </button>
            </li>
        @endforeach
    </ul>

    <div id="tab-content">
        @foreach($items as $category => $data)
            <div class="hidden"
                 id="{{$category}}"
                 role="tabpanel"
                 aria-labelledby="{{$category}}-tab"
                 data-aos="fade-right"
            >
                <div
                    class="grid md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-10 lg:gap-x-10 lg:gap-y-16">
                    @foreach($data as $item)
                        <div class="group relative">
                            <span
                                class="absolute top-1 left-1 badge {{ $item['category'] }}">
                                {{ __('gnb.' . $item['category']) }}
                            </span>
                            <div
                                class="aspect-h-1 aspect-w-1 w-full bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                                <img src="{{$item['thumbnail']}}"
                                     alt="{{$item['title']}}"
                                     class="h-full w-full  object-center lg:h-full lg:w-full">

                            </div>
                            <div class="mt-4">
                                <h3 class="mb-5 text-lg text-gray-900 line-clamp-2">
                                    <a href="#!" onclick="openContentModal('{{$loop->index}}')">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{$item['title']}}
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-600">{{$item['created_at']}}</p>
                            </div>
                        </div>
                    @endforeach


                </div>
                <!-- View More -->
                <div class="hidden text-center" data-aos="fade-up">
                    <a href="javascript:alert('{{ __('common.in_ready') }}')"
                       class="inline-block mt-12 border border-solid border-black py-3 px-24 text-base break-keep">
                        더 보기
                    </a>
                </div>
            </div>
        @endforeach

    </div>

    <div class="hidden" id="contents-modal" tabindex="-1" aria-hidden="true">
        <div class="fixed size-full inset-0 z-[201] overflow-y-auto bg-white">
            <div class="fixed top-5 right-5 lg:right-20">
                <button type="button" class="bg-exomere opacity-75 p-3 lg:p-7 rounded-full text-white"
                        onclick="closeModal('contents-modal')" aria-hidden="false">
                    <svg class="close-btn h-7 w-7 z-[101]" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div
                class="flex flex-col max-w-3xl min-h-screen mx-auto padding">
                <article class="min-h-svh overflow-y-auto">
                    <span id="modal-badge" class="badge"></span>
                    <h1 id="modal-title" class="text-2xl lg:text-4xl font-medium text-gray-900 mt-2 mb-6"></h1>

                    <div id="modal-date" class="text-gray-600 mb-2 "></div>

                    <img id="modal-img" src="" class="padding-y">

                    <div class="text-md">
                        <p id="modal-contents" class="break-keep leading-loose text-gray-900 mb-4"></p>
                    </div>
                </article>
            </div>
        </div>
    </div>

@endsection

@section('page-script')
    <script>
        const categories = {
            'company': '{{ __('gnb.company') }}',
            'rnd': '{{ __('gnb.rnd') }}',
            'social': '{{ __('gnb.social') }}',
        };
    </script>
    <script>
        const tab = document.querySelector('#tab');
        tab.querySelectorAll('[role="tab"]').forEach(function (elem) {
            elem.addEventListener('click', (event) => {
                if (event.target.ariaSelected !== 'true') {
                    event.preventDefault();
                    document.querySelector(event.target.dataset.tabsTarget).classList.remove('aos-animate');
                }
            })
        })
    </script>

    <script>

        const data = @json($jsonData);
        const news = JSON.parse(data);

        var openContentModal = function (index) {
            const modal = document.getElementById('contents-modal');
            modal.querySelector('#modal-badge').innerHTML = categories[news[index].category];
            modal.querySelector('#modal-img').src = news[index].thumbnail;
            modal.querySelector('#modal-date').innerHTML = news[index].created_at;
            modal.querySelector('#modal-title').innerHTML = news[index].title;
            modal.querySelector('#modal-contents').innerHTML = news[index].contents;

            openModal('contents-modal');
        }

    </script>
@endsection


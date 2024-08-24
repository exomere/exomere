<?php

$products = [
    [
        'product_name' => '리프팅샷 수딩젤 100g',
        'price' => 66000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'brand' => 'exomere',
        'category' => 'creams',
    ],
    [
        'product_name' => '퍼펙트 스칼프 임플란트 세럼',
        'price' => 39000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'category' => 'serums_essences'
    ],
    [
        'product_name' => 'EXO-AG 리셀솔루션4SET',
        'price' => 220000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'category' => 'serums_essences'

    ],
    [
        'product_name' => '퍼펙트 스칼프 토너',
        'price' => 39000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'category' => 'toners_mists',
    ],
    [
        'product_name' => '임플라힐 P.O 크림',
        'price' => 37000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'brand' => 'imlaheal',
        'category' => null,
    ],
    [
        'product_name' => '에델바이스 스노우크림',
        'price' => 40000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
    ],
    [
        'product_name' => '티트리 버블 클렌져',
        'price' => 28000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'brand' => 'return10',
        'category' => null,
    ],
    [
        'product_name' => 'AC미라클 힐러',
        'price' => 35000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'brand' => 'time72',
        'category' => null,
    ],
    [
        'product_name' => '미라클 스폰질라(M)',
        'price' => 22000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'brand' => 'time72',
        'category' => null,
    ],
    [
        'product_name' => '세라마이드 리셀크림',
        'price' => 99000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'brand' => 'exomere',
        'category' => 'creams',
    ],
    [
        'product_name' => '에델바이스스노우크림',
        'price' => 50000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'brand' => 'exomere',
        'category' => 'creams',
    ],
    [
        'product_name' => '아로마 힐링미스트 50ml',
        'price' => 25000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'brand' => 'exomere',
        'category' => 'toners_mists',
    ],
    [
        'product_name' => '아로마 힐링미스트 150ml',
        'price' => 55000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'brand' => 'exomere',
        'category' => 'toners_mists',
    ],
    [
        'product_name' => '글루타치온 멜라샷 솔루션',
        'price' => 99000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'brand' => 'exomere',
        'category' => 'creams',
    ],
    [
        'product_name' => '리커버리밤 플러스',
        'price' => 52000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'brand' => 'exomere',
        'category' => 'cushions',
    ],
    [
        'product_name' => '리커버리밤 플러스(리필)',
        'price' => 40000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
    ],
    [
        'product_name' => '임플란트솔루션(H)',
        'price' => 66000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'brand' => 'exomere',
        'category' => 'creams',
    ],
    [
        'product_name' => '로즈가든마스크팩',
        'price' => 45000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'brand' => 'return10',
        'category' => 'sheet_masks'
    ]
];

$products = collect($products)->whereNotNull('category'); //전체
$categorizeItems = $products->groupBy('category');//카테고리화

// 병합
$items = collect([
    'view_all' => $products
])->merge($categorizeItems);


$selectedCategory = request()->query('category') ?? null;

// todo
$categories = [
    "view_all",
    "toners_mists",
    "serums_essences",
    "creams",
    "sheet_masks",
    "cushions",
];

?>

@extends('pages.layouts.frontSubLayout')
@section('title', __('gnb.products_title'))
@section('page-style')


@endsection
@section('content')

    <main class="relative">

        <section class="h-96 lg:h-[80svh]">
            <!-- Subvisual Wrapper -->
            <div class="relative pt-[80px] lg:pt-[160px] w-full h-full flex flex-col items-center justify-center
                    bg-cover bg-no-repeat bg-bottom"
                 style="background-image: url('{{ asset("assets/img/elements/subvisual_product.jpg") }}')"
            ></div>
        </section>

        <section class="min-sm:max-container min-h-screen padding-y">
            <div class="bg-white">
                <!-- Subvisual Text -->
                <div class="text-center font-monospace tracking-tight z-10 text-gray-900">
                    <p class="text-4xl font-medium uppercase drop-shadow-lg" data-aos="fade-down">
                        {{ __('gnb.products') }}
                    </p>
                    <p class="font-medium font-roboto" data-aos="fade-down"
                       data-aos-delay="200">{{ __('gnb.products_title') }}</p>
                </div>

                <!-- tabs -->
                <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                    <ul class="flex flex-wrap justify-center items-center padding-y -mb-px text-base lg:text-lg font-medium text-center tracking-tight"
                        id="tab"
                        role="tablist"
                        data-tabs-active-classes="text-exomere"
                        data-tabs-inactive-classes="false"
                        data-tabs-toggle="#tab-content"
                    >
                        @foreach($categories as $category)
                            <li role="presentation"
                                class="relative px-4
                                @if(!$loop->last)
                                    after:absolute after:top-1/2 after:right-0 after:w-[1px] after:h-[12px] after:mt-[-6px] after:bg-[#e9e9e9]
                                @endif
                                ">
                                <button class="inline-block "
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

                    <!-- tab contents -->
                    <div id="tab-content">
                        @foreach($items as $category => $data)
                            <div class="hidden"
                                 id="{{$category}}"
                                 role="tabpanel"
                                 aria-labelledby="{{$category}}-tab"
                                 data-aos="fade-right">
                                <div
                                    class="mt-6 space-y-12 lg:grid lg:grid-cols-3 lg:gap-x-6 lg:gap-y-10 lg:space-y-0">
                                    @foreach($data as $item)
                                        <div class="group relative mx-auto">
                                            <div
                                                class="relative w-full aspect-square bg-cover bg-center group-hover:bg-[url({{$item['thumbnail2']}})]">
                                                <img src="{{$item['thumbnail']}}" alt="{{$item['product_name']}}"
                                                     class="h-full w-full object-center lg:h-full lg:w-full group-hover:opacity-0 transition-opacity duration-500">
                                            </div>
                                            <div class="mt-4 flex flex-col justify-between items-start">
                                                <h3 class="mb-5 text-lg text-gray-900">
                                                    <a href="/product/?">
                                                            <span aria-hidden="true"
                                                                  class="absolute inset-0"></span>
                                                        {{$item['product_name']}}
                                                    </a>
                                                </h3>
                                                <p class="mt-1 text-sm text-gray-600">{{number_format($item['price'])}}</p>
                                            </div>
                                        </div>
                                    @endforeach
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
@endsection


@php
    $isMain = true;
    $whiteHeader = true;

$products = [
    [
        'product_name' => '리프팅샷 수딩젤 100g',
        'price' => 66000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'brand' => 'exomere',
        'category' => 'creams',
        'is_best' => true,
        'product_desc' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
    ],
    [
        'product_name' => '퍼펙트 스칼프 임플란트 세럼',
        'price' => 39000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'category' => 'serums_essences',
        'is_best' => true,
        'product_desc' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
    ],
    [
        'product_name' => 'EXO-AG 리셀솔루션4SET',
        'price' => 220000,
        'thumbnail' => asset('assets/img/elements/2024021315327960678.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'category' => 'serums_essences',
        'is_best' => true,
        'product_desc' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
    ],
    [
        'product_name' => '퍼펙트 스칼프 토너',
        'price' => 39000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'category' => 'toners_mists',
        'is_best' => true,
        'product_desc' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
    ],
    [
        'product_name' => '임플라힐 P.O 크림',
        'price' => 37000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'brand' => 'imlaheal',
        'category' => null,
        'is_best' => true,
        'product_desc' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
    ],
    [
        'product_name' => '에델바이스 스노우크림',
        'price' => 40000,
        'thumbnail' => asset('assets/img/elements/2024061918143212433-removebg.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover_removebg.png'),
        'is_best' => true,
        'product_desc' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
    ],
];

$bestProducts = collect($products)->where('is_best', true);

@endphp

@extends('pages.layouts.mainLayout')

@section('title', '72시간만에 10년 젊어지기')

@section('vendor-style')
    <link href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" rel="stylesheet">
@endsection

@section('page-style')
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet"/>
@endsection

@section('content')

    <main class="flex flex-col">
        {{--hero section--}}
        <section class="h-svh">
            <div class="swiper main-swiper">
                <div class="swiper-wrapper">
                    @for($i=0; $i<1; $i++)
                        <div class="swiper-slide">
                            <div
                                class="absolute transform z-10 lg:top-1/2 lg:w-[50%] lg:px-28 lg:transform lg:-translate-x-1/2 lg:-translate-y-[60%] lg:text-left text-white">
                                <p data-aos="fade-in" data-aos-delay="300"
                                   class="text-white/80 mt-6 text-xl break-keep leading-tight">
                                    엑소좀과 스피커스가 함유된 미백 크림 {{$i}}
                                </p>
                                <p data-aos="fade-up" data-aos-delay="400"
                                   class="text-3xl lg:text-4xl font-normal leading-tight break-keep mt-5">
                                    임플란트 솔루션
                                </p>
                                <a data-aos="fade-in" data-aos-delay="300" href="/products" target="_self"
                                   class="mt-12 inline-block border border-solid border-white py-3 px-24 text-base break-keep">
                                    THE MORE
                                </a>
                            </div>
                            <video
                                src="{{ asset('assets/img/elements/main_video.mp4') }}"
                                class="slide-video object-cover" autoplay="" muted=""
                                playsinline="" loop=""></video>
                        </div>
                    @endfor
                </div>
                <div class="all-box absolute inline-flex left-1/2 bottom-[10%] w-[90%] h-[50px] p-x-[20px] z-20">
                    <div class="progress-box">
                        <div class="swiper-pagination"></div>
                        <div class="autoplay-progress">
                            <svg viewBox="0 0 100 10">
                                <line x1="0" y1="0" x2="100" y2="0">
                            </svg>
                        </div>
                    </div>
                    <div class="arrow-box">
                        <div class="swiper-button-prev white"></div>
                        <div class="swiper-button-next white"></div>
                    </div>
                </div>
            </div>
        </section>

        {{--best itmes--}}
        <section class="max-w-5xl lg:max-w-7xl mx-auto px-6 py-24">
            <h2 class="text-center text-3xl lg:text-4xl my-10" data-aos="fade-up">BEST ITEMS</h2>

            <div class="grid grid-cols-2 lg:grid-cols-3 gap-x-2 gap-y-6 lg:gap-x-10 lg:gap-y-3">
                @foreach($bestProducts as $product)
                    <a href="#" class="swiper-slide group flex flex-col text-center"
                       data-aos="fade-up"
                       data-aos-delay="{{ $loop->index  * 100 }}">
                        <div
                            class="relative w-full aspect-square bg-cover bg-center lg:group-hover:bg-[url({{$product['thumbnail2']}})]">
                            <img src="{{$product['thumbnail']}}" alt="{{$product['product_name']}}"
                                 class="h-full w-full object-center lg:h-full lg:w-full lg:group-hover:opacity-0 transition-opacity duration-500">
                        </div>
                        <div class="p-3 pt-5 w-full text-slate">
                            <p class="mb-1 text-lg line-clamp-1 text-gray-900 relative after:bg-slate-700 after:absolute after:h-[1px] after:w-[20px] after:-ml-[10px] after:-bottom-2 after:left-1/2">
                                {{ $product['product_name'] }}</p>
                            <p class="mt-5 text-sm text-gray-700 text-slate-700 line-clamp-2">
                                {{ $product['product_desc'] }}</p>
                            <p class="mt-5 text-base text-gray-600">
                                {{ number_format($product['price']) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        {{--video--}}
        <section class="overflow-hidden padding-y md:p-0">
            <div class="flex h-full">
                <video class="w-full" playsinline="" autoplay="autoplay" loop="loop" muted="muted">
                    <source src="http://exomere.co.kr/common/image/exomere.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </section>

        {{--원료소개--}}
        <section class="h-svh">
            <div class="swiper material-swiper">
                <div class="swiper-wrapper">
                    @for($i=1; $i<=2;$i++)
                        <div class="swiper-slide">
                            <a href="/about/technology"
                               class="flex flex-col w-full h-full items-center bg-white border border-gray-200 lg:flex-row">
                                <div
                                    class="w-full h-full lg:w-[50%] w-full overflow-hidden">
                                    <div data-aos="scale" class="min-h-56 h-full bg-center bg-cover"
                                         style="background-image: url('{{ asset("assets/img/elements/about_technology_$i.webp")}}')">
                                    </div>
                                </div>

                                <div
                                    class="relative flex flex-col justify-between p-4 pb-12 leading-normal w-full lg:w-[50%] padding">
                                    <div class="lg:max-w-lg lg:leading-10 show_content_box tracking-tight">
                                        <h2 class="leading-tight text-left font-semibold text-3xl lg:text-4xl mb-10">
                                            BASE<br>
                                            MATERIAL
                                        </h2>
                                        <p class="mb-2 text-2xl lg:text-3xl text-left font-semibold text-gray-900
                                           ">@if($i==1)
                                                EXOMERE™
                                            @else
                                                스피커스
                                            @endif
                                        </p>
                                        <p class="mb-3 md:text-lg md:leading-loose text-left font-normal text-gray-600
                                            line-clamp-4 break-keep">
                                            @if($i==1)
                                                제주 한라봉에서 추출한 50~ 200mm 크기의 엑소좀으로, DNA, RNA, PEPTIDE가 포함되어 있어 노화 및
                                                손상된 피부를 위한 세포 재생과 신호 전달에 도움을 주는 솔루션입니다.
                                            @else
                                                청정 바다에서 추출한 해양 생물의 순수 성분을 정제하여,
                                                식물성 콜라겐 생성을 촉진시키는 금화규 추출물과 비피다발효물로
                                                코팅한 특허 성분으로, 스피큘에 코팅된 발효 식물성콜라겐이 피부에
                                                침투해 탄력 있는 피부로 개선시켜줍니다.
                                            @endif
                                        </p>
                                        <p class="mt-5 text-left font-normal text-slate-700 pb-10">
                                            특허 : 제10-2022-0007981호
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endfor
                    <div
                        class="all-box left-0 bottom-0 transform-none padding lg:max-w-lg lg:left-[50%] lg:bottom-[15%]">
                        <div class="progress-box">
                            <div class="swiper-pagination"></div>
                            <div class="autoplay-progress">
                                <svg viewBox="0 0 100 10">
                                    <line x1="0" y1="0" x2="100" y2="0">
                                </svg>
                            </div>
                        </div>
                        <div class="arrow-box">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        {{--브랜치--}}
        <section class="pt-40">
            <div class="bg-gradient-to-r from-[#e4e4df]">
                <div class="max-w-6xl mx-auto h-[65svh] md:flex md:flex-row relative">
                    <div class="h-full w-full bg-bottom bg-[url({{ asset('assets/img/elements/about-branch-removebg.png') }})] bg-contain md:bg-center bg-no-repeat md:basis-1/2"></div>
                    <div class="inset-0 absolute font-normal text-center md:static md:basis-1/2 md:text-left md:flex md:flex-col md:justify-center">
                        <div class="w-full h-full flex flex-col justify-start items-center text-center pt-20 md:justify-center md:items-start md:p-0 md:max-w-lg">
                            <h3 class="leading-tight font-semibold text-3xl lg:text-4xl mb-10 text-head"
                                data-aos="fade-up">
                                ABOUT BRANCH
                            </h3>
                            <p class="break-keep leading-loose md:leading-loose md:text-lg md:text-left" data-aos="fade-up" data-aos-delay="100">
                                다양한 체험 프로그램과 전문적이고 체계적인 상담을 통해
                                <br class="md:hidden">
                                엑소미어의 제품을 체험할 수 있습니다
                            </p>
                            <p>
                                <a href="/about/branch"
                                   target="_self"
                                   class="inline-block mt-5 md:mt-7 border border-solid border-base-color bg-base-color text-white py-2 px-16 break-keep"
                                   data-aos="fade" data-aos-delay="200">
                                    THE MORE
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection

@section('page-script')
    <script defer src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script defer src="{{ asset('assets/js/fo/main.js') }}"></script>
@endsection
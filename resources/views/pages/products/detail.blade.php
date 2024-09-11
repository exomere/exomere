<?php

$activeHeader = true;
$product = [
    'product_name' => '로즈가든마스크팩',
    'price' => 45000,
    'thumbnail' => asset('assets/img/elements/2024061918143212433.png'),
    'thumbnail2' => asset('assets/img/elements/product_hover.jpg'),
    'brand' => 'return10',
    'category' => 'sheet_masks',
    'desc' => '<img src="//exomere.co.kr/upload/2024021315320116226.png" alt="">',
    'sub_name' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
];

?>

@extends('pages.layouts.withoutVisualLayout')
@section('title', __('gnb.products'))

@section('id', 'products')
@section('visual_title',  __('gnb.products') )
@section('visual_sub_title', __('gnb.products_title'))
@section('visual_background', asset("assets/img/elements/subvisual_product.jpg"))

@section('vendor-style')
    <link href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" rel="stylesheet">
@endsection
@section('page-style')
    <style>
        .swiper-wrapper {
            height: max-content !important;
            width: max-content;
        }

        .swiper-button-prev:after,
        .swiper-rtl .swiper-button-next:after {
            content: "" !important;
        }

        .swiper-button-next:after,
        .swiper-rtl .swiper-button-prev:after {
            content: "" !important;
        }

        .product-thumb .swiper-slide.swiper-slide-thumb-active > .slide\:border-indigo-600 {
            --tw-border-opacity: 1;
            border-color: rgb(79 70 229 / var(--tw-border-opacity));
        }
    </style>

@endsection
@section('content')

    <section class="py-10 lg:py-24 relative min-h-screen">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16">
                <div>
                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                         class="swiper product-prev mb-6 h-auto max-h-[80svh]">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ $product['thumbnail'] }}"
                                     alt="" class="mx-auto object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ $product['thumbnail2'] }}"
                                     alt="" class="mx-auto object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ $product['thumbnail'] }}"
                                     alt="" class="mx-auto object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ $product['thumbnail2'] }}"
                                     alt="" class="mx-auto object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ $product['thumbnail'] }}"
                                     alt="" class="mx-auto object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ $product['thumbnail2'] }}"
                                     alt="" class="mx-auto object-cover">
                            </div>
                        </div>
                    </div>
                    <div class="swiper product-thumb max-w-[608px] h-auto mx-auto">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ $product['thumbnail'] }}"
                                     class=" cursor-pointer border-2 border-gray-50 transition-all duration-500 hover:border-indigo-600 slide:border-indigo-600 object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ $product['thumbnail2'] }}"
                                     class=" cursor-pointer border-2 border-gray-50 transition-all duration-500 hover:border-indigo-600 slide:border-indigo-600 object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ $product['thumbnail'] }}"
                                     class=" cursor-pointer border-2 border-gray-50 transition-all duration-500 hover:border-indigo-600 slide:border-indigo-600 object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ $product['thumbnail2'] }}"
                                     class=" cursor-pointer border-2 border-gray-50 transition-all duration-500 hover:border-indigo-600 slide:border-indigo-600 object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ $product['thumbnail'] }}"
                                     class=" cursor-pointer border-2 border-gray-50 transition-all duration-500 hover:border-indigo-600 slide:border-indigo-600 object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ $product['thumbnail2'] }}"
                                     class=" cursor-pointer border-2 border-gray-50 transition-all duration-500 hover:border-indigo-600 slide:border-indigo-600 object-cover">
                            </div>

                        </div>
                        <div class="swiper-pagination_prod">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>

                <div
                    class="pro-detail w-full flex flex-col justify-center order-last lg:order-none max-lg:max-w-[608px] max-lg:mx-auto">
                    <p class="font-medium text-lg text-indigo-600 mb-4">{{ __('gnb.'. $product['brand']) }}</p>
                    <h2 class="mb-2 font-manrope font-bold text-3xl leading-10 text-gray-900">{{ $product['product_name'] }}
                    </h2>

                    <p class="text-gray-500 text-base font-normal mb-8 ">
                        {{ $product['sub_name'] }}
                    </p>
                    <div class="block w-full">
                        <div class="text">
                            <div class="grid grid-cols-2 gap-3 mb-8 justify-items-center items-center">
                                <div class="flex items-center justify-center w-full">
                                    <button
                                        class="group py-4 px-6 border border-gray-400 shadow-sm shadow-transparent transition-all duration-500 hover:shadow-gray-300 hover:bg-gray-50">
                                        <svg
                                            class="stroke-gray-700 transition-all duration-500 group-hover:stroke-black"
                                            width="22" height="22" viewBox="0 0 22 22" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.5 11H5.5" stroke="" stroke-width="1.6"
                                                  stroke-linecap="round"/>
                                            <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2" stroke-width="1.6"
                                                  stroke-linecap="round"/>
                                            <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2" stroke-width="1.6"
                                                  stroke-linecap="round"/>
                                        </svg>
                                    </button>
                                    <input type="text"
                                           class="font-semibold text-gray-900 text-lg py-[13px] px-6 w-full lg:max-w-[118px] border-gray-400 bg-transparent placeholder:text-gray-900 text-center hover:bg-gray-50 focus-within:bg-gray-50 outline-0"
                                           placeholder="1">
                                    <button
                                        class="group py-4 px-6 border border-gray-400 shadow-sm shadow-transparent transition-all duration-500 hover:shadow-gray-300 hover:bg-gray-50">
                                        <svg
                                            class="stroke-gray-700 transition-all duration-500 group-hover:stroke-black"
                                            width="22" height="22" viewBox="0 0 22 22" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 5.5V16.5M16.5 11H5.5" stroke="" stroke-width="1.6"
                                                  stroke-linecap="round"/>
                                            <path d="M11 5.5V16.5M16.5 11H5.5" stroke="" stroke-opacity="0.2"
                                                  stroke-width="1.6" stroke-linecap="round"/>
                                            <path d="M11 5.5V16.5M16.5 11H5.5" stroke="" stroke-opacity="0.2"
                                                  stroke-width="1.6" stroke-linecap="round"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="">
                                    <h6
                                        class="font-manrope font-semibold text-2xl leading-9 text-gray-900 sm:border-r border-gray-200">
                                        {{ number_format($product['price']) }}원</h6>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <button
                                    class="group py-4 px-5 bg-indigo-50 text-indigo-600 font-semibold text-lg w-full flex items-center justify-center gap-2 shadow-sm shadow-transparent transition-all duration-500 hover:bg-indigo-100 hover:shadow-indigo-200">
                                    장바구니
                                </button>
                                <button
                                    class="text-center w-full px-5 py-4  bg-indigo-600 flex items-center justify-center font-semibold text-lg text-white shadow-sm transition-all duration-500 hover:bg-indigo-700 hover:shadow-indigo-400">
                                    구매하기
                                </button>
                            </div>

                        </div>
                    </div>

                </div>

            </div>


            <ul class="flex flex-row justify-center mt-20 bg-[#e9e9e9] text-[#A6A7A6] border-t border-solid text-sm text-center tracking-tight gap-4"
                id="tab"
                role="tablist"
                data-tabs-active-classes="text-slate-600 font-normal bg-white"
                data-tabs-inactive-classes="text-[#A6A7A6]"
                data-tabs-toggle="#tab-content"
            >
                <li role="presentation" class="basis-1/2">
                    <button class="w-full p-4 "
                            id="detail-tab"
                            type="button"
                            role="tab"
                            data-tabs-target="#detail"
                            aria-controls="detail"
                            aria-selected="true"
                    >상세정보
                    </button>
                </li>
                <li role="presentation" class="basis-1/2">
                    <button class="w-full p-4"
                            id="info-tab"
                            type="button"
                            role="tab"
                            data-tabs-target="#info"
                            aria-controls="info"
                            aria-selected="false"
                    >배송/교환/환불
                    </button>
                </li>
            </ul>

            <div id="tab-content">
                <div class="flex flex-col items-center w-auto mx-auto"
                     id="detail"
                     role="tabpanel"
                     aria-labelledby="detail-tab">

                    <div id="detail__desc" class="overflow-hidden pt-12 md:pt-24" style="height: 800px">
                        {!! $product['desc'] !!}
                    </div>

                    <button id="toggle-btn"
                            class="mt-4 mt-12 inline-block border border-solid border-base-color py-3 px-24 text-base-color break-keep text-sm">
                        상품 정보 더보기
                    </button>
                    <button id="hide-btn"
                            class="hidden mt-4 mt-12 inline-block border border-solid border-base-color py-3 px-24 text-base-color break-keep text-sm">
                        상품 정보 접기
                    </button>
                </div>

                <div class="hidden"
                     id="info"
                     role="tabpanel"
                     aria-labelledby="info-tab"
                >
                    <div
                        class="flex flex-col divide-y divide-solid divide-slate-300 gap-y-5 padding whitespace-pre-line text-sm">
                        <div>
                            <p class="text-lg text-head-color font-normal">주문취소</p>

                            <strong>1. 주문취소 가능시점</strong>

                            회원은 상품 주문 및 결제 완료 후 주문을 취소할 수 있습니다.

                            단, 주문취소는 결제완료 상태일 때만 가능합니다. 배송준비중, 배송중에는 상품 수령 후 반품 절차를 따라야합니다.

                        </div>

                        <div>
                            <p class="text-lg text-head-color font-normal">배송안내</p>

                            <strong>1. 배송업체</strong>

                            CJ 대한통운

                            <strong>2. 배송비</strong>

                            ① 주문 상품 기준 50,000원 이상 구매 시 무료배송

                            ② 주문 상품 기준 50,000원 미만 주문 시 3,000원 배송비 부과 (도서산간 지역 추가비용 없음)

                            ※ 기본 배송비는 변경될 수 있으며 변경될 경우 회사는 상품 대금 결제 시 이를 안내해 드립니다.

                            <strong>3. 배송기간</strong>

                            ① 주문하신 상품이 오후 4시 이전 결제 완료된 경우 당일 발송되며, 오후 4시 이후 결제 완료된 경우 영업일 기준 익일에 발송됩니다.
                            단, 회사의 상품 발송 후 2~3일 정도의 배송 기간이 소요되며 택배사의 물류 사정에 따라 지연될 수 있습니다.

                            ② 월 말이나 월초, 연휴 기간의 주문이거나 배송지가 도서, 오지, 산간 지역일 경우 2~3일 정도 배송이 지연될 수 있습니다.

                            ③ 토, 일요일 주문 건은 월요일에 발송 처리되오니 주문 시 참고 부탁드립니다.

                            ④ 상품 중 스프레이류, 방향제, 염모제는 항공 운송 상 안전 상의 이유로 항공 운송 거부 품목에 해당되며, 제주 및 도서 지역은 배편을 이용하여 배송되며, 배송
                            기간이
                            추가될 수 있습니다.

                            ⑤ 군부대 및 민간인 출입이 제한되는 지역은 택배 수령이 불가한 경우가 있으니 주문 시 참조해 주십시오.

                        </div>


                        <div>
                            <p class="text-lg text-head-color font-normal">반품 안내</p>


                            <strong>1. 반품 기준</strong>

                            ① 미개봉, 미사용 상태(QR 스티커가 뜯어지지 않은 상태)의 손상 및 변질이 없는 상품만 반품이 가능하며 사용하신 상품은 반품이 일체 허용되지 않습니다.

                            ② 키트, 프로모션, 패키지 상품을 반품하는 경우, 또는 사은품이 함께 지급되는 상품을 반품하는 경우, 주문한 상품 외에 함께 제공된 증정 상품 및 사은품 등을
                            포함하여
                            배송 받은 모든 내용물을 반환하여야 합니다.

                            <strong>2. 반품 시 제한 사항</strong>

                            ① 구매자의 책임있는 사유로 상품등이 멸실 또는 훼손된 경우

                            ② 단순 변심의 사유로 상품 인도일로 부터 14일이 경과한 경우

                            ③ 상품 인수 시 포함되어 있던 사은품, 추가 제공 물품등이 누락되거나 파손, 사용된 경우

                            ④ 구매자의 사용 또는 일부 소비에 의하여 제품의 가치가 감소한 경우

                            ⑤ 포장을 개봉 하였거나 포장이 훼손되어 상품 가치가 현저히 상실된 경우

                            ⑥ 시간이 경과되어 재판매가 곤란할 정도로 상품의 가치가 상실된 경우

                            <strong>3. 반품 요청 가능 기간</strong>

                            ① 구매자 단순 변심은 상품 수령 후 14일 이내 (반품 배송비 구매자 부담)

                            ② 상품 내용이 표시/광고와 다르거나 상품하자의 경우 상품 수령 후 3개월 이내 혹은 그 사실을 안 날 또는 알 수 있었던 날로부터 30일 이내 (반품 배송비 회사
                            부담)

                            <strong>4. 반품 배송비</strong>

                            반품회수배송비 3,000원, 최초배송비 3,000원

                            (무료 배송의 경우 결제금액에 최초 배송비 포함으로 인하여 반품배송비 6,000원으로 표기)

                            <strong>5. 반품 절차</strong>

                            ① 환불 예상 금액 등 반품 예상 정보 확인 후 반품 접수 완료

                            ② CJ 대한 통운에서 상품 회수

                            ③ 반품된 상품의 상태를 확인한 이후 3영업일 이내에 환불 처리(카드 결제의 경우 카드사의 사정에 따라 처리시간이 추가로 소요됨)

                            ※ 상품 입고 후 2~3일 정도 검수 및 확인 작업시간이 소요될 수 있습니다.
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@section('page-script')
    <script defer src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            var swiper = new Swiper(".product-thumb", {
                spaceBetween: 10,
                slidesPerView: 6,
                freeMode: true,
                watchSlidesProgress: true,

            });
            var swiper2 = new Swiper(".product-prev", {
                autoplay: true,
                spaceBetween: 5,
                slidesPerView: 1,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                thumbs: {
                    swiper: swiper,
                },

            });

            //상품상세토글
            document.querySelector('#toggle-btn').addEventListener('click', () => {
                document.querySelector('#detail__desc').style.height = 'auto';
                document.querySelector('#toggle-btn').classList.add('hidden');
                document.querySelector('#hide-btn').classList.remove('hidden');
            });
            document.querySelector('#hide-btn').addEventListener('click', () => {
                document.querySelector('#detail__desc').style.height = '800px';
                document.querySelector('#toggle-btn').classList.remove('hidden');
                document.querySelector('#hide-btn').classList.add('hidden');
            })

        });

    </script>
@endsection


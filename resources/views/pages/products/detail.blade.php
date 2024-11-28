<?php

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

        #toggle-btn,
        #hide-btn {
            width: 95%;
            -webkit-box-shadow: 0 10px 10px 0 rgba(80, 80, 80, .1);
            box-shadow: 0 10px 10px 0 rgba(80, 80, 80, .1);
        }
    </style>

@endsection
<meta name="csrf-token" content="{{ csrf_token() }}"/>
@section('content')
    <section class="py-10 lg:py-24 relative min-h-screen">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16">
                <div>
                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                         class="swiper product-prev mb-3 h-auto max-h-[80svh]">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ Storage::url('public/data/'.$product['thum_img']) }}"
                                     alt="" class="mx-auto object-cover">
                            </div>
                            @if(!empty($product['thum_img2']))
                                <div class="swiper-slide">
                                    <img src="{{ Storage::url('public/data/'.$product['thum_img2']) }}"
                                         alt="" class="mx-auto object-cover">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="swiper product-thumb max-w-[608px] h-auto mx-auto">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ Storage::url('public/data/'.$product['thum_img']) }}"
                                     class=" cursor-pointer border-2 border-gray-50 transition-all duration-500 hover:border-indigo-600 slide:border-indigo-600 object-cover">
                            </div>
                            @if(!empty($product['thum_img2']))
                                <div class="swiper-slide">
                                    <img src="{{ Storage::url('public/data/'.$product['thum_img2']) }}"
                                         class=" cursor-pointer border-2 border-gray-50 transition-all duration-500 hover:border-indigo-600 slide:border-indigo-600 object-cover">
                                </div>
                            @endif
                        </div>
                        <div class="swiper-pagination_prod">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>

                <div
                    class="pro-detail w-full flex flex-col order-last lg:order-none pt-8 ">
                    <p class="font-medium text-lg text-exomere mb-4"><a
                            class="flex flex-inline items-center text-base"
                        >{{ $product['code'] }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="hidden bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                            </svg>
                        </a>
                    </p>
                    <h2 class="mb-2 font-bold text-3xl leading-10 text-gray-900">
                        @if(app()->getLocale() == 'ko')
                            {{ $product['name'] }}
                        @else
                            {{ $product['name_en'] }}
                        @endif
                    </h2>

                    <p class="text-gray-500 text-base font-normal mb-8 ">
                        @if(app()->getLocale() == 'ko')
                            {{ $product['description'] }}
                        @else
                            {{ $product['description_en'] }}
                        @endif
                    </p>
                    <div class="w-full">
                        <input type="hidden" class="distribution_price" name="distribution_price"
                               value="{{ $product['exclusive_price'] }}">

                        <div class="flex flex-col gap-3 mb-8 justify-items-center justify-center items-start">
                            <div class="flex flex-row text-lg leading-9 text-gray-900 sm:border-r border-gray-200">
                                <strong class="w-40">{{ __('common.price') }}</strong>
                                <h6 class="flex"><span
                                        class="">{{ number_format($product['price']) }}</span>
                                    <span
                                        class="px-1 currency @if(app()->getLocale() == 'en') order-first @endif">{{ __('common.currency') }}</span>
                                </h6>
                            </div>

                            @if(request()->session()->get('member_seq'))
                                <div class="flex flex-row text-lg leading-9 text-gray-900 sm:border-r border-gray-200">
                                    <strong class="w-40">{{ __('common.distribution_price') }}</strong>
                                    <h6 class="flex "><span
                                            class="">
                                                @if(request()->session()->get('member_position') == "총판")
                                                {{ number_format($product['exclusive_price']) }}
                                            @elseif(request()->session()->get('member_position') == "회원")
                                                {{ number_format($product['mem_price']) }}
                                            @elseif(request()->session()->get('member_position') == "뷰티플래너")
                                                {{ number_format($product['planer_price']) }}
                                            @elseif(request()->session()->get('member_position') == "대리점")
                                                {{ number_format($product['store_price']) }}
                                            @else
                                                {{ number_format($product['exclusive_price']) }}
                                            @endif
                                        </span>
                                        <span
                                            class="px-1 currency @if(app()->getLocale() == 'en') order-first @endif">{{ __('common.currency') }}</span>
                                    </h6>
                                </div>
                            @endif
                            <div class="flex flex-row text-lg leading-9 text-gray-900 sm:border-r border-gray-200">
                                <strong class="w-40">{{ __('common.vat_excluded') }}</strong>
                                <h6 class="flex"><span
                                        class="">
                                        @if(request()->session()->get('member_position'))
                                            @if(request()->session()->get('member_position') == "총판")
                                                {{ number_format($product['exclusive_pv']) }}
                                            @elseif(request()->session()->get('member_position') == "회원")
                                                {{ number_format($product['mem_pv']) }}
                                            @elseif(request()->session()->get('member_position') == "뷰티플래너")
                                                {{ number_format($product['planer_pv']) }}
                                            @elseif(request()->session()->get('member_position') == "대리점")
                                                {{ number_format($product['store_pv']) }}
                                            @else
                                                {{ number_format($product['exclusive_pv']) }}
                                            @endif
                                        @else
                                            {{ number_format( $product['pv'] ) }}
                                        @endif
                                        
                                    
                                    </span>
                                    <span
                                        class="px-1 currency @if(app()->getLocale() == 'en') order-first @endif">{{ __('common.currency') }}</span>
                                </h6>
                            </div>
                            <div class="flex flex-row text-lg leading-9 text-gray-900 sm:border-r border-gray-200">
                                <strong class="w-40">{{ __('common.quantity') }}</strong>
                                <div class="flex flex-row">
                                    <button
                                        class="minus group py-2 px-3 border border-solid border-gray-300 shadow-sm shadow-transparent transition-all duration-500 hover:shadow-gray-300 hover:bg-gray-50">
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
                                           id="quantity"
                                           name="quantity"
                                           class="quantity font-semibold text-gray-900 border-y border-solid border-gray-300 text-lg w-12 lg:max-w-[118px] bg-transparent placeholder:text-gray-900 text-center hover:bg-gray-50 focus-within:bg-gray-50 outline-0"
                                           value="1"
                                           maxlength="3"
                                           placeholder="1">
                                    <button
                                        class="plus group py-2 px-3 border border-solid border-gray-300 shadow-sm shadow-transparent transition-all duration-500 hover:shadow-gray-300 hover:bg-gray-50">
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
                            </div>
                            <div class="flex flex-row text-lg leading-9 text-gray-900 sm:border-r border-gray-200">
                                <strong class="w-40">{{ __('common.total_price') }}</strong>
                                <h6 class="flex font-semibold"><span
                                        class="total-price">
                                    
                                        @if(request()->session()->get('member_position'))
                                            @if(request()->session()->get('member_position') == "총판")
                                                {{ number_format($product['exclusive_price']) }}
                                            @elseif(request()->session()->get('member_position') == "회원")
                                                {{ number_format($product['mem_price']) }}
                                            @elseif(request()->session()->get('member_position') == "뷰티플래너")
                                                {{ number_format($product['planer_price']) }}
                                            @elseif(request()->session()->get('member_position') == "대리점")
                                                {{ number_format($product['store_price']) }}
                                            @else
                                                {{ number_format($product['exclusive_price']) }}
                                            @endif

                                        @else
                                            {{ number_format( $product['price'] ) }}
                                        @endif
                                    </span>
                                    <span
                                        class="px-1 currency @if(app()->getLocale() == 'en') order-first @endif">{{ __('common.currency') }}</span>
                                </h6>
                            </div>

                        </div>
                        <div class="flex flex-col lg:flex-row items-center gap-3">
                            {{-- <button
                                onclick="add2Cart()"
                                class="rounded-sm group py-4 px-5 border border-solid border-gray-600 bg-white text-gray-600 font-normal text-lg w-full flex items-center justify-center gap-2 shadow-sm shadow-transparent">
                                {{ __('common.add_to_cart') }}
                            </button> --}}
                            <button
                                onclick="buyNow()"
                                class="rounded-sm text-center w-full px-5 py-4 border border-solid border-base-color bg-base-color flex items-center justify-center font-normal text-lg text-white shadow-sm">
                                {{ __('common.buy_now') }}
                            </button>
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
                    >{{ __('common.details') }}
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
                    >{{ __('common.shipping_exchange_refund') }}
                    </button>
                </li>
            </ul>

            <div id="tab-content">
                <div class="flex flex-col items-center w-auto mx-auto"
                     id="detail"
                     role="tabpanel"
                     aria-labelledby="detail-tab">

                    <div id="detail__desc" class="overflow-hidden pt-12 md:pt-24" style="height: 800px">
                        {!! $product['content'] !!}
                    </div>

                    <button id="toggle-btn"
                            class="mt-4 h-12 inline-flex justify-center items-center gap-x-1 border border-solid border-base-color text-base-color break-keep text-sm">
                        {{ __('common.expand_detail') }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                             class="bi bi-chevron-down"
                             fill="currentColor"
                             stroke="currentColor"
                             viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </button>
                    <button id="hide-btn"
                            class="hidden mt-4 h-12 inline-flex justify-center items-center gap-x-1 inline-block border border-solid border-base-color text-base-color break-keep text-sm">
                        {{ __('common.collapse_detail') }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                             stroke="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708z"/>
                        </svg>
                    </button>
                </div>

                <div class="hidden"
                     id="info"
                     role="tabpanel"
                     aria-labelledby="info-tab"
                >
                    <div
                        class="flex flex-col divide-y divide-solid divide-slate-300 gap-y-5 padding whitespace-pre-line text-sm">
                        @if(app()->getLocale() == 'ko')
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

                                ④ 상품 중 스프레이류, 방향제, 염모제는 항공 운송 상 안전 상의 이유로 항공 운송 거부 품목에 해당되며, 제주 및 도서 지역은 배편을 이용하여 배송되며,
                                배송
                                기간이
                                추가될 수 있습니다.

                                ⑤ 군부대 및 민간인 출입이 제한되는 지역은 택배 수령이 불가한 경우가 있으니 주문 시 참조해 주십시오.

                            </div>


                            <div>
                                <p class="text-lg text-head-color font-normal">반품 안내</p>


                                <strong>1. 반품 기준</strong>

                                ① 미개봉, 미사용 상태(QR 스티커가 뜯어지지 않은 상태)의 손상 및 변질이 없는 상품만 반품이 가능하며 사용하신 상품은 반품이 일체 허용되지 않습니다.

                                ② 키트, 프로모션, 패키지 상품을 반품하는 경우, 또는 사은품이 함께 지급되는 상품을 반품하는 경우, 주문한 상품 외에 함께 제공된 증정 상품 및 사은품
                                등을
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

                                ② 상품 내용이 표시/광고와 다르거나 상품하자의 경우 상품 수령 후 3개월 이내 혹은 그 사실을 안 날 또는 알 수 있었던 날로부터 30일 이내 (반품 배송비
                                회사
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

                    @else
                        <div>
                            <p class="text-lg text-head-color font-normal">Order Cancellation</p>

                            <strong>1. When Order Cancellation is Possible</strong>

                            Members can cancel their orders after completing the order and payment process.

                            However, order cancellations are only possible while the order is in the "payment completed"
                            status. If the order is in the "preparing for shipment" or "in transit" status, you must
                            follow the return process after receiving the product.

                        </div>

                        <div>
                            <p class="text-lg text-head-color font-normal">Shipping Information</p>

                            <strong>1. Delivery Company</strong>

                            CJ Logistics

                            <strong>2. Shipping Fees</strong>

                            ① Free shipping for purchases of 50,000 KRW or more.

                            ② A shipping fee of 3,000 KRW applies for purchases under 50,000 KRW. (No additional fees
                            for remote or island areas)

                            ※ Basic shipping fees may be subject to change, and changes will be notified at the time of
                            payment for the product.

                            <strong>3. Delivery Period</strong>

                            ① Orders completed by 4 PM will be shipped on the same day. Orders completed after 4 PM will
                            be shipped the next business day. Delivery takes about 2-3 days after shipment but may be
                            delayed due to logistics conditions of the courier.

                            ② Orders placed at the end of the month, the beginning of the month, during holidays, or for
                            delivery to remote or island areas may experience a 2-3 day delay.

                            ③ Orders placed on Saturdays or Sundays will be processed for shipment on Monday.

                            ④ Products such as sprays, air fresheners, and hair dyes are restricted from air transport
                            due to safety concerns and will be shipped via sea transport to Jeju and island areas, which
                            may result in additional delivery time.

                            ⑤ Deliveries to military bases or areas restricted to civilians may not be possible, so
                            please consider this when placing orders.

                        </div>

                        <div>
                            <p class="text-lg text-head-color font-normal">Return Policy</p>

                            <strong>1. Return Criteria</strong>

                            ① Only unopened and unused products (with QR stickers intact) that are not damaged or
                            deteriorated can be returned. Used products are not eligible for return.

                            ② When returning kits, promotional, or package products, or products with complimentary
                            gifts, all contents received, including gift items, must also be returned.

                            <strong>2. Restrictions on Returns</strong>

                            ① If the product is lost or damaged due to the buyer's responsibility.

                            ② If more than 14 days have passed since delivery for reasons of buyer’s simple change of
                            mind.

                            ③ If any included promotional or additional items are missing, damaged, or used.

                            ④ If the product's value is reduced due to use or partial consumption by the buyer.

                            ⑤ If the packaging is opened or damaged, significantly reducing the product’s value.

                            ⑥ If the product's value has significantly depreciated over time, making resale difficult.

                            <strong>3. Return Request Period</strong>

                            ① Simple change of mind: Within 14 days after receiving the product (return shipping fee to
                            be borne by the buyer).

                            ② Product discrepancy or defect: Within 3 months of receiving the product, or within 30 days
                            from the date the issue was discovered (return shipping fee to be borne by the company).

                            <strong>4. Return Shipping Fee</strong>

                            Return pickup fee: 3,000 KRW, initial shipping fee: 3,000 KRW.

                            (For free shipping, the return shipping fee will be 6,000 KRW, as the initial shipping fee
                            is included in the payment amount.)

                            <strong>5. Return Procedure</strong>

                            ① Confirm expected refund amount and other details before completing the return request.

                            ② CJ Logistics will collect the product.

                            ③ After confirming the condition of the returned product, a refund will be processed within
                            3 business days (for card payments, additional time may be required due to card company
                            procedures).

                            ※ It may take 2-3 days for inspection and confirmation after the product is received.
                        </div>

                    @endif
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

        function updateTotalPrice() {
            const quantityInput = document.querySelector('.quantity');
            const pricePerUnit = parseInt(document.querySelector('.distribution_price').value);
            const quantity = parseInt(quantityInput.value);

            if (!isNaN(quantity) && quantity > 0) {
                const totalPrice = quantity * pricePerUnit;

                let formattedNumber = totalPrice.toLocaleString();

                document.querySelector('.total-price').innerText = formattedNumber;
            } else {
                alert("수량은 1 이상이어야 합니다.");
                quantityInput.value = 1;
                document.querySelector('.total-price').innerText = pricePerUnit;
            }
        }

        // 수량 변경 핸들러
        document.querySelector('.plus').addEventListener('click', function () {
            const quantityInput = document.querySelector('.quantity');
            quantityInput.value = parseInt(quantityInput.value) + 1;
            updateTotalPrice();
        });

        document.querySelector('.minus').addEventListener('click', function () {
            const quantityInput = document.querySelector('.quantity');
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
                updateTotalPrice();
            }
        });

        // 텍스트 입력 필드에서 직접 수량을 변경할 때
        document.querySelector('.quantity').addEventListener('input', function () {
            updateTotalPrice();
        });

        function add2Cart() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "/products/cartSave",
                data: {
                    "pd_seq": {{$product['id']}},
                    "pd_qty": $("#quantity").val(),
                },
                success: function () {
                    alert('{{ __('messages.success_cart') }}');
                }
            });
        }

        function buyNow() {
            if (confirm('{{ __('messages.confirm_ordersheet') }}')) {

                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '/mypage/ordersheet';

                // Add CSRF token for Laravel
                let csrfToken = '{{ csrf_token() }}';
                let inputCsrf = document.createElement('input');
                inputCsrf.type = 'hidden';
                inputCsrf.name = '_token';
                inputCsrf.value = csrfToken;
                form.appendChild(inputCsrf);

                let inputProductId = document.createElement('input');
                inputProductId.type = 'hidden';
                inputProductId.name = 'pd_id';
                inputProductId.value = {{$product['id']}};
                form.appendChild(inputProductId);

                let inputProductQty = document.createElement('input');
                inputProductQty.type = 'hidden';
                inputProductQty.name = 'pd_qty';
                inputProductQty.value = $("#quantity").val();
                form.appendChild(inputProductQty);

                // Append form to the body and submit it
                document.body.appendChild(form);
                form.submit();
            }

            return false;
        }

    </script>
@endsection


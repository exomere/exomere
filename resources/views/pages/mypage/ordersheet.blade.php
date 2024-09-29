<?php

$activeHeader = true;

dump($_POST);
?>

@extends('pages.layouts.withoutVisualLayout')
@section('title', __('gnb.cart'))

@section('id', 'cart')

@section('vendor-style')
@endsection
@section('page-style')

@endsection
@section('content')

    <section class="py-10 lg:py-24 relative min-h-screen">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <form action="/mypage/checkout" method="POST">
                @csrf
                <div class="grid grid-cols-12 min-h-screen border border-solid border-gray-300 rounded-sm">
                    <div class="col-span-12 lg:col-span-8 p-4">
                        <h6 class="text-3xl font-semibold text-head">Shopping Cart</h6>
                        <hr class="text-gray-300 my-4">

                        <!-- 전체 선택 -->
                        <div class="flex items-center mb-4">
                            <input type="checkbox" id="checked_all" class="mr-4 w-5 h-5 accent-exomere">
                            <label for="checked_all">
                                전체선택
                            </label>
                        </div>

                        <!-- 상품 리스트 -->
                        <div class="space-y-8">
                            <!-- 상품 -->
                            @foreach($carts as $cart)
                                <div class="row flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input type="hidden" class="distribution_price" name="distribution_price[{{ $cart['id'] }}][]"
                                               value="{{ $cart['distribution_price'] }}">
                                        <input type="hidden" class="pv" name="pv[{{ $cart['id'] }}][]" value="{{ $cart['pv'] }}">


                                        <div class="flex">
                                            <input type="checkbox"
                                                   value="{{ $cart['id'] }}"
                                                   name="id[{{ $cart['id'] }}][]"
                                                   id="cart_{{ $cart['id'] }}"
                                                   class="mr-4 w-4 h-4 accent-exomere">
                                        </div>

                                        <img src="{{ $cart['thumbnail'] }}" alt="상품 이미지"
                                             class="w-16 h-16 object-cover mr-4">
                                        <div>
                                            <p class="font-semibold">{{ $cart['product_name'] }}</p>

                                            <div class="flex flex-row">
                                                <button
                                                    class="minus group border border-solid border-gray-300 shadow-sm shadow-transparent transition-all duration-500 hover:shadow-gray-300 hover:bg-gray-50">
                                                    <svg
                                                        class="stroke-gray-700 transition-all duration-500 group-hover:stroke-black"
                                                        width="22" height="22" viewBox="0 0 22 22" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M16.5 11H5.5" stroke="" stroke-width="1.6"
                                                              stroke-linecap="round"/>
                                                        <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2"
                                                              stroke-width="1.6"
                                                              stroke-linecap="round"/>
                                                        <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2"
                                                              stroke-width="1.6"
                                                              stroke-linecap="round"/>
                                                    </svg>
                                                </button>
                                                <input type="text"
                                                       name="quantity[{{ $cart['id'] }}][]"
                                                       class="quantity font-semibold text-gray-900 border-y border-solid border-gray-300 w-12 lg:max-w-[118px] bg-transparent placeholder:text-gray-900 text-center hover:bg-gray-50 focus-within:bg-gray-50 outline-0"
                                                       value="{{ $cart['quantity'] }}"
                                                       maxlength="3"
                                                       placeholder="1">
                                                <button
                                                    class="plus group border border-solid border-gray-300 shadow-sm shadow-transparent transition-all duration-500 hover:shadow-gray-300 hover:bg-gray-50">
                                                    <svg
                                                        class="stroke-gray-700 transition-all duration-500 group-hover:stroke-black"
                                                        width="22" height="22" viewBox="0 0 22 22" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11 5.5V16.5M16.5 11H5.5" stroke="" stroke-width="1.6"
                                                              stroke-linecap="round"/>
                                                        <path d="M11 5.5V16.5M16.5 11H5.5" stroke=""
                                                              stroke-opacity="0.2"
                                                              stroke-width="1.6" stroke-linecap="round"/>
                                                        <path d="M11 5.5V16.5M16.5 11H5.5" stroke=""
                                                              stroke-opacity="0.2"
                                                              stroke-width="1.6" stroke-linecap="round"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <h6 class="flex font-semibold"><span
                                                class="total-price">{{ number_format($cart['distribution_price'] * $cart['quantity']) }}</span>
                                            <span
                                                class="px-1 currency @if(app()->getLocale() == 'en') order-first @endif">{{ __('common.currency') }}</span>
                                        </h6>
                                        <h6 class="flex text-gray-500"><span
                                                class="total-pv">{{ number_format($cart['pv'] * $cart['quantity']) }}</span>
                                            <span
                                                class="px-1 currency">PV</span>
                                        </h6>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- 주문 합계 -->
                    <div class="col-span-12 lg:col-span-4 p-4 bg-gray-100">
                        <h6 class="text-3xl font-semibold text-head">Order Summary</h6>
                        <hr class="text-gray-300 my-4">

                        <div class="flex flex-col gap-y-8">
                            <div class="pt-4">
                                <p class="text-head font-semibold text-lg mb-2">주문 합계</p>
                                <div class="flex justify-between mb-2">
                                    <span>주문금액</span>
                                    <span id="final-total-price">0</span><span>원</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>PV</span>
                                    <span id="final-total-pv">0</span><span> PV</span>
                                </div>
                            </div>

                            <!-- 결제 예정 금액 -->
                            <div class="pt-4">
                                <p class="text-head font-semibold text-lg mb-2">결제 예정 금액</p>
                                <div class="flex justify-between mb-2">
                                    <span>상품수</span>
                                    <span>0개</span>
                                </div>
                                <div class="flex justify-between mb-2">
                                    <span>주문금액</span>
                                    <span>0원</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>배송비</span>
                                    <span>0원</span>
                                </div>
                            </div>

                            <!-- 총 금액 -->
                            <div class="pt-4">
                                <p class="text-head font-semibold text-lg mb-2">총금액</p>
                                <div class="flex justify-between">
                                    <span>결제총액</span>
                                    <span>0원</span>
                                </div>
                            </div>

                            <!-- 버튼 -->
                            <div class="flex flex-col lg:flex-row items-center gap-3">
                                <button
                                    type="submit"
                                    class="rounded-sm text-center w-full px-5 py-4 border border-solid border-base-color bg-base-color flex items-center justify-center font-normal text-lg text-white shadow-sm">
                                    {{ __('common.checkout') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection

@section('page-script')
    <script>

    </script>
@endsection


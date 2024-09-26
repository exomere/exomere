<?php

$carts = [
    [
        'id' => 1,
        'product_name' => '로즈가든마스크팩로즈가든마스크팩로즈가든마스크팩',
        'price' => 45000,
        'distribution_price' => 22500,
        'vat_excluded' => 20455,
        'total_price' => 22500,
        'pv' => 20455 * 2,
        'thumbnail' => asset('assets/img/elements/2024061918143212433.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover.jpg'),
        'brand' => 'return10',
        'category' => 'sheet_masks',
        'desc' => '<img src="//exomere.co.kr/upload/2024021315320116226.png" alt="">',
        'sub_name' => '피부 깊은 보습과 영양감을 채워 기초부터 건강한 피부로 가꾸어주고 흔들리지 않는 탄탄한 피부로 가꾸어주는 탄력 보습 크림',
        'quantity' => 1,
    ],
    [
        'id' => 2,
        'product_name' => '퍼펙트 스칼프 임플란트 세럼',
        'price' => 39000,
        'distribution_price' => 19500,
        'vat_excluded' => 17727,
        'total_price' => 19500,
        'pv' => 17727 * 2,
        'thumbnail' => asset('assets/img/elements/2024061918143212433.png'),
        'thumbnail2' => asset('assets/img/elements/product_hover.jpg'),
        'brand' => 'return10',
        'category' => 'sheet_masks',
        'desc' => '<img src="//exomere.co.kr/upload/2024021315320116226.png" alt="">',
        'sub_name' => '마이크로바이옴과 미세침으로 당신의 모발을 더욱 탄탄하게',
        'quantity' => 2,
    ],
];
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
        <div class="mx-auto max-w-7xl sm:px-6">
            <form action="/mypage/ordersheet" method="POST" name="cartForm" onsubmit="return formCheck()">
                @csrf
                <div class="grid grid-cols-12 min-h-screen sm:border sm:border-solid sm:border-gray-300 rounded-sm">
                    <div class="col-span-12 lg:col-span-8 p-4">
                        <h6 class="text-3xl font-semibold text-head">Shopping Cart</h6>
                        <hr class="text-gray-300 my-4">

                        <!-- 전체 선택 -->
                        <div class="flex items-center mb-4">
                            <input type="checkbox" id="checked_all" class="mr-4 w-5 h-5 accent-exomere">
                            <label for="checked_all">
                                {{ __('common.select_all') }}
                            </label>
                        </div>

                        <!-- 상품 리스트 -->
                        <div class="space-y-8">
                            <!-- 상품 -->
                            @foreach($carts as $cart)
                                <div class="row flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input type="hidden" class="distribution_price"
                                               name="distribution_price[{{ $cart['id'] }}][]"
                                               value="{{ $cart['distribution_price'] }}">
                                        <input type="hidden" class="pv" name="pv[{{ $cart['id'] }}][]"
                                               value="{{ $cart['pv'] }}">


                                        <div class="flex">
                                            <input type="checkbox"
                                                   name="item[{{ $cart['id'] }}][]"
                                                   value="{{ $cart['id'] }}"
                                                   id="cart_{{ $cart['id'] }}"
                                                   class="mr-2 w-4 h-4 accent-exomere">
                                        </div>

                                        <img src="{{ $cart['thumbnail'] }}" alt="상품 이미지"
                                             class="w-16 h-16 object-cover mr-4">
                                        <div>
                                            <p class="font-semibold">{{ $cart['product_name'] }}</p>

                                            <div class="flex flex-row">
                                                <button type="button"
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
                                                <button type="button"
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
                                <p class="text-head font-semibold text-lg mb-2">{{ __('common.order_summary') }}</p>
                                <div class="flex justify-between mb-2">
                                    <span>{{ __('common.order_amount') }}</span>
                                    <h6 class="flex"><span id="final-total-price">0</span>
                                        <span
                                            class="px-1 currency @if(app()->getLocale() == 'en') order-first @endif">{{ __('common.currency') }}</span>
                                    </h6>
                                </div>
                                <div class="flex justify-between">
                                    <span>PV</span>
                                    <h6 class="flex"><span id="final-total-pv">0</span>
                                        <span class="px-1">PV</span>
                                    </h6>
                                </div>
                            </div>

                            <!-- 결제 예정 금액 -->
                            <div class="pt-4">
                                <p class="text-head font-semibold text-lg mb-2">{{ __('common.payment_expected') }}</p>
                                <div class="flex justify-between mb-2">
                                    <span>{{ __('common.product_count') }}</span>
                                    <h6 class="flex"><span id="final-total-quantity">0</span>
                                        <span
                                            class="px-1">{{ __('common.ea') }}</span>
                                    </h6>
                                </div>
                                <div class="flex justify-between">
                                    <span>{{ __('common.shipping_fee') }}</span>
                                    <h6 class="flex"><span id="final-total-shipment">0</span>
                                        <span
                                            class="px-1 currency @if(app()->getLocale() == 'en') order-first @endif">{{ __('common.currency') }}</span>
                                    </h6>
                                </div>
                            </div>

                            <!-- 총 금액 -->
                            <div class="pt-4">
                                <p class="text-head font-semibold text-lg mb-2">{{ __('common.total_amount') }}</p>
                                <div class="flex justify-between">
                                    <span>{{ __('common.payment_total') }}</span>
                                    <h6 class="flex"><span id="final-grand-total-price">0</span>
                                        <span
                                            class="px-1 currency @if(app()->getLocale() == 'en') order-first @endif">{{ __('common.currency') }}</span>
                                    </h6>
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
        function formCheck() {
            let selectedItemsLength = document.querySelectorAll('[name^="item["]:checked').length;

            if (!selectedItemsLength) {
                alert("{{ __('messages.select_item') }}");
            }

            return selectedItemsLength > 0;
        }


        // todo  장바구니 저장
        function saveCart() {
            setTimeout(function () {
                alert('수량이 변경되었습니다.')
            }, 500);
        }

        function updateTotalPrice(row) {
            const quantityInput = row.querySelector('.quantity');
            const pricePerUnit = parseInt(row.querySelector('.distribution_price').value);
            const pvPerUnit = parseInt(row.querySelector('.pv').value);
            const quantity = parseInt(quantityInput.value);

            if (!isNaN(quantity) && quantity > 0) {
                const totalPrice = quantity * pricePerUnit;
                const totalPV = quantity * pvPerUnit;

                row.querySelector('.total-price').innerText = totalPrice.toLocaleString();
                row.querySelector('.total-pv').innerText = totalPV.toLocaleString();
            } else {
                alert("수량은 1 이상이어야 합니다.");
                quantityInput.value = 1;

                row.querySelector('.total-price').innerText = pricePerUnit.toLocaleString();
                row.querySelector('.total-pv').innerText = pvPerUnit.toLocaleString();
            }

            saveCart();
            calculateTotal();
        }

        // 수량 변경 핸들러
        document.querySelectorAll('.plus').forEach(function (el) {
            el.addEventListener('click', function () {

                const row = el.closest('.row');
                const quantityInput = row.querySelector('.quantity');
                quantityInput.value = parseInt(quantityInput.value) + 1;
                updateTotalPrice(row);
            });
        });

        document.querySelectorAll('.minus').forEach(function (el) {
            el.addEventListener('click', function () {

                const row = el.closest('.row');
                const quantityInput = row.querySelector('.quantity');
                if (parseInt(quantityInput.value) > 1) {
                    quantityInput.value = parseInt(quantityInput.value) - 1;
                    updateTotalPrice(row);
                }
            });
        })

        // 텍스트 입력 필드에서 직접 수량을 변경할 때
        document.querySelectorAll('.quantity').forEach(function (el) {
            el.addEventListener('input', function () {
                const row = el.closest('.row');
                updateTotalPrice(row);
            });
        })

        // 전체 선택
        document.querySelector('#checked_all').addEventListener('click', function (el) {
            document.querySelectorAll('[name^="item["]').forEach(function (e) {
                e.checked = el.target.checked;
            })

            calculateTotal();
        })

        // 체크박스 클릭 시 이벤트 핸들러
        document.querySelectorAll('[name^="item["]').forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                calculateTotal();
            });
        });


        // 배송비 설정 (4000원)
        const shippingFee = 4000;

        // 체크박스 클릭 시 결제 금액 계산하는 함수
        function calculateTotal() {
            let totalPrice = 0;
            let totalPv = 0;
            let totalQuantity = 0;
            let grandTotalPrice = 0;

            // 체크된 아이템을 모두 탐색
            document.querySelectorAll('.row input[type="checkbox"]:checked').forEach(function (checkbox) {
                // 체크된 상품의 가격, PV 및 수량 추출
                const parentRow = checkbox.closest('.row');
                const price = parseInt(parentRow.querySelector('.distribution_price').value);
                const pv = parseInt(parentRow.querySelector('.pv').value);
                const quantity = parseInt(parentRow.querySelector('.quantity').value);

                // 총 금액과 PV 계산
                totalPrice += price * quantity;
                totalPv += pv * quantity;
                totalQuantity += quantity;
            });

            // 배송비 더하기 (상품이 하나라도 선택되면)
            if (totalPrice > 0) {
                grandTotalPrice = totalPrice + shippingFee;
            }

            // 결제 총액 및 PV 업데이트
            document.getElementById('final-total-price').innerText = totalPrice.toLocaleString();
            document.getElementById('final-total-pv').innerText = totalPv.toLocaleString();
            document.getElementById('final-total-quantity').innerText = totalQuantity.toLocaleString();
            document.getElementById('final-total-shipment').innerText = shippingFee.toLocaleString();
            document.getElementById('final-grand-total-price').innerText = grandTotalPrice.toLocaleString();
        }


    </script>
@endsection


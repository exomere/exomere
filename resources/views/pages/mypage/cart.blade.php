@extends('pages.layouts.withoutVisualLayout')
@section('title', __('gnb.cart'))

@section('id', 'cart')

@section('vendor-style')
@endsection
@section('page-style')

@endsection
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <section class="py-10 lg:py-24 relative min-h-screen">
        <div class="mx-auto max-w-7xl sm:px-6">
            <form action="/mypage/ordersheet" method="POST" name="cartForm" onsubmit="return formCheck()">
                @csrf
                <input type='hidden' name='type' value='cart'>
                <div class="grid grid-cols-12 min-h-screen sm:border sm:border-solid sm:border-gray-300 rounded-sm">
                    <div class="col-span-12 lg:col-span-8 p-4">
                        <h6 class="text-3xl font-semibold text-head">Shopping Cart</h6>
                        <hr class="text-gray-300 my-4">

                        @if(count($carts))
                            <div class="flex justify-between mb-4">
                                <!-- 전체 선택 -->
                                <div>
                                    <input type="checkbox" id="checked_all" class=" accent-exomere">
                                    <label for="checked_all">
                                        {{ __('common.select_all') }}
                                    </label>
                                </div>


                                {{--선택 삭제--}}
                                <a href="javascript:deleteSelected()">
                                    <div class="flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6 18 18 6M6 6l12 12"/>
                                        </svg>
                                        {{ __('common.select_delete') }}
                                    </div>
                                </a>
                            </div>
                        @else
                            <div
                                class="p-10 text-center text-xl text-gray-600 font-normal">
                                {{ __('messages.no_products') }}
                            </div>
                        @endif

                        <!-- 상품 리스트 -->
                        <div class="space-y-4">
                            <!-- 상품 -->
                            @foreach($carts as $cart)

                                <div class="row p-1 pb-4">

                                    <div class="flex justify-end">
                                        {{-- 단건삭제--}}
                                        <button type="button" onclick="deleteCart({{ $cart['id'] }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                            </svg>


                                        </button>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <input type="checkbox"
                                                   name="item[{{ $cart['id'] }}][]"
                                                   value="{{ $cart['id'] }}"
                                                   id="cart_{{ $cart['id'] }}"
                                                   class="chk mr-2 w-4 h-4 accent-exomere">

                                            <input type="hidden" class="distribution_price"
                                                   name="distribution_price[{{ $cart['id'] }}][]"
                                                   value="{{ $cart['distribution_price'] }}">
                                            <input type="hidden" class="pv" name="pv[{{ $cart['id'] }}][]"
                                                   value="{{ $cart['pv'] }}">


                                            <img src="{{ $cart['thumbnail'] }}"
                                                 alt="{{ $cart['product_name'] }}"
                                                 onerror="this.src='//exomere.co.kr/storage/data/noimg.jpg';"
                                                 class="w-16 h-16 object-cover mr-4"
                                            >

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
                                                            <path d="M11 5.5V16.5M16.5 11H5.5" stroke=""
                                                                  stroke-width="1.6"
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
                                            <h6 class="flex font-semibold justify-end"><span
                                                    class="total-price">{{ number_format($cart['distribution_price'] * $cart['quantity']) }}</span>
                                                <span
                                                    class="px-1 currency @if(app()->getLocale() == 'en') order-first @endif">{{ __('common.currency') }}</span>
                                            </h6>
                                            <h6 class="flex justify-end"><span
                                                    class="total-pv">{{ number_format($cart['pv'] * $cart['quantity']) }}</span>
                                                <span
                                                    class="px-1 currency">PV</span>
                                            </h6>
                                        </div>

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
        // 선택 상품 체크
        function formCheck() {
            let selectedItems = getSelectedItems();

            if (!selectedItems || !selectedItems.length) {
                alert("{{ __('messages.select_item') }}");
                return false;
            }

            return true;
        }

        // 선택된 장바구니 아이템 가져오기
        function getSelectedItems() {
            return document.querySelectorAll('input[name^="item"]:checked');
        }


        // 단건삭제: 특정 장바구니 항목 삭제
        function deleteCart(id) {
            if (confirm("{{ __('messages.delete_sure') }}")) {
                fetch(`/products/cart/delete/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => {
                        if (response.ok) {
                            document.getElementById(`cart_${id}`).closest('.row').remove();

                            // 선택 합계 업데이트
                            calculateTotal();

                            alert('{{ __('messages.delete_cart') }}');
                        } else {
                            alert('{{ __('messages.unexpected_error_alert') }}');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('{{ __('messages.unexpected_error_alert') }}');
                    });
            }
        }

        // 선택삭제: 체크된 항목 모두 삭제
        function deleteSelected() {
            const selectedCheckboxes = getSelectedItems();
            if (selectedCheckboxes.length === 0) {
                alert("{{ __('messages.select_item') }}");
                return;
            }

            if (confirm("{{ __('messages.delete_sure') }}")) {
                const idsToDelete = Array.from(selectedCheckboxes).map(checkbox => checkbox.value);

                fetch('/products/cart/delete-selected', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ids: idsToDelete})
                })
                    .then(response => {
                        if (response.ok) {
                            idsToDelete.forEach(id => {
                                document.getElementById(`cart_${id}`).closest('.row').remove();
                            });

                            // 선택 합계 업데이트
                            calculateTotal();

                            alert('{{ __('messages.delete_cart') }}');
                        } else {
                            alert('{{ __('messages.unexpected_error_alert') }}');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('{{ __('messages.unexpected_error_alert') }}');
                    });
            }

        }


        // todo  장바구니 저장
        function saveCart(row) {
            const id = row.querySelector('.chk').value;
            const quantityInput = row.querySelector('.quantity');
            const quantity = parseInt(quantityInput.value);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "/products/cartSave",
                data: {
                    "pd_seq": id,
                    "pd_qty": quantity,
                },
                success: function () {
                    alert('{{ __('messages.change_quantity') }}')
                }
            });
        }

        // 장바구니 업데이트
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
                alert("{{ __('messages.least_quantity') }}");
                quantityInput.value = 1;

                row.querySelector('.total-price').innerText = pricePerUnit.toLocaleString();
                row.querySelector('.total-pv').innerText = pvPerUnit.toLocaleString();
            }

            calculateTotal();

            // db update
            clearTimeout(debounceTimer);
            var debounceTimer = setTimeout(() => {
                saveCart(row);
            }, 300);

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
            el.addEventListener('blur', function () {
                const row = el.closest('.row');

                updateTotalPrice(row);
            });
        })

        // 전체 선택
        document.querySelector('#checked_all') && document.querySelector('#checked_all').addEventListener('click', function (el) {
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
        let shippingFee = 4000;

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


            if (totalPrice >= 200000) {
                shippingFee = 0;
            } else {
                shippingFee = 4000;
            }

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


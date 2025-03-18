<?php

$activeHeader = true;
?>

@extends('pages.layouts.withoutVisualLayout')
@section('title', __('gnb.ordersheet'))

@section('id', 'ordersheet')

@section('vendor-style')
@endsection
@section('page-style')

@endsection
@section('content')

    <section class="py-10 lg:py-24 relative min-h-screen">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <form id='paymentForm' action="/mypage/doPayment" method="POST">
                @csrf
                <div class="grid grid-cols-12 min-h-screen rounded-sm">
                    <div class="col-span-12 lg:col-span-8 p-4">
                        <h6 class="text-3xl font-semibold text-head">{{ __('common.checkout_fill') }}</h6>
                        <hr class="text-gray-300 my-4">

                        <!-- 배송지 -->
                        <div class="flex flex-col  gap-y-10">
                            <div>
                                <h2 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug !mb-2 text-primary">
                                    {{ __('common.checkout_addr') }}</h2>
                                <div class="flex flex-col gap-y-5">
                                    <div>
                                        <div class="w-full max-w-sm min-w-[200px]">
                                            <label class="block mb-1 text-sm text-slate-600">
                                                {{ __('common.checkout_recipient') }}
                                            </label>
                                            <input
                                                id="user_name" name="user_name"
                                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                maxlength="10"
                                                placeholder="{{ __('messages.checkout_recipient_holder') }}"
                                                value="{{$ex_member->name ?? null}}"
                                            />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="w-full max-w-sm min-w-[200px]">
                                            <label class="block mb-1 text-sm text-slate-600">
                                                {{ __('common.checkout_phone') }}
                                            </label>
                                            <input
                                                id="user_phone" name="user_phone"
                                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                maxlength="11"
                                                placeholder="{{ __('messages.checkout_phone_holder') }}"
                                                value="{{$ex_member->phone ?? null}}"
                                            />
                                        </div>
                                    </div>

                                    <div class="w-full max-w-sm min-w-[200px]">
                                        <label class="block mb-1 text-sm text-slate-600">
                                            {{ __('common.checkout_address') }}
                                        </label>
                                        <div class="relative">
                                            <input
                                                id="zipcode" name="zipcode"
                                                class="w-full mb-1 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                placeholder="{{ __('messages.checkout_addr_search_holder') }}"
                                                readonly
                                                value="{{$ex_member->zip_code ?? null}}"
                                            />

                                            <button
                                                class="absolute top-1 right-1 flex items-center rounded bg-slate-800 py-1 px-2.5 border border-transparent text-center text-sm text-white transition-all shadow-sm hover:shadow focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                type="button"
                                                onclick="getPostCode();"
                                            >
                                                {{ __('common.checkout_addr_search') }}
                                            </button>
                                            <input type="text" id="address" name="address"
                                                   class="w-full mb-1 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                   placeholder="{{ __('messages.address') }}"
                                                   value="{{$ex_member->address ?? null}}"
                                            >
                                            <input type="text" id="address_detail" name="address_detail"
                                                   class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                   placeholder="{{ __('messages.address_detail') }}"
                                                   value="{{$ex_member->address_detail ?? null}}"
                                            >
                                            <textarea id="address_remark" name="address_remark"
                                                   class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                   placeholder="{{ __('common.checkout_product_remark') }}"
                                            ></textarea>
                                        </div>
                                    </div>


                                </div>
                            </div>


                            <div>
                                <!-- 주문상품 -->
                                <h2 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug !mb-2 text-primary">
                                    {{ __('common.checkout_items') }}</h2>

                                <div class="mb-4">
                                    <div class="space-y-8">
                                        <!-- 상품 -->
                                        @foreach ($items as $item)
                                            <div class="row flex items-center justify-between">
                                                <div class="flex items-center">
                                                    <img src="{{ $item['pd_img'] }}"
                                                         alt="image"
                                                         class="w-16 h-16 object-cover mr-4"
                                                         onerror="this.src='//exomere.co.kr/storage/data/noimg.jpg';"
                                                    >
                                                    <div>
                                                        {{--상품명--}}
                                                        <p class="font-semibold">{{$item['pd_name']}}</p>

                                                        {{--금액--}}
                                                        <h6 class="flex"><span
                                                                class="total-price">{{number_format($item['pd_price'])}}</span>
                                                            <span
                                                                class="px-1 currency @if(app()->getLocale() == 'en') order-first @endif">{{ __('common.currency') }}</span>
                                                            (<span
                                                                class="total-pv">{{number_format($item['pd_pv'])}}</span>
                                                            <span
                                                                class="hidden px-1 currency">PV</span>
                                                            )
                                                        </h6>
                                                        {{--수량--}}
                                                        <div class="flex flex-row text-sm">
                                                            <input type='hidden' name='pd_qty[]'
                                                                   value="{{$item['pd_qty']}}">
                                                            <input type='hidden' name='pd_id[]'
                                                                   value="{{$item['pd_id']}}">
                                                            {{ __('common.quantity') }}: {{$item['pd_qty']}}
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                            <div>
                                {{--포인트사용--}}
                                <h2 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug !mb-2 text-primary">
                                    {{ __('common.method_point') }}</h2>
                                <div class="flex items-center mb-4">
                                    <div class="w-full max-w-sm min-w-[200px]">

                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700">{{ __('common.point_use') }}</label>

                                            <div class="relative">
                                                {{--사용할 포인트--}}
                                                <input type="number"
                                                       class="text-right w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-10 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                       id="use_point"
                                                       name=""
                                                />

                                                {{--사용 리셋--}}
                                                <button type="button"
                                                        id="resetPointButton"
                                                        class="text-gray-400 text-sm absolute end-2.5 bottom-2.5 font-medium text-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"
                                                         class="size-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <p class="my-1 text-right text-sm text-gray-400">{{ __('common.available_point') }} :
                                                <span class="font-semibold">{{number_format($ex_member->remain_points ?? 0)}}</span>
                                            </p>
                                        </div>

                                    </div>

                                </div>
                            </div>


                            <div>
                                {{--결제수단--}}
                                <h2 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug !mb-2 text-primary">
                                    {{ __('common.checkout_method') }}</h2>
                                <div class="flex items-center mb-4">
                                    <div class="flex gap-10">
                                        <div class="inline-flex items-center">
                                            <label class="relative flex items-center cursor-pointer"
                                                   for="radio_account">
                                                <input name="payment_type" type="radio"
                                                       class="checkPaymentType peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-slate-300 checked:border-slate-400 transition-all"
                                                       id="radio_account" value='account' checked="">
                                                <span
                                                    class="absolute bg-slate-800 w-3 h-3 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                                            </label>
                                            <span class="ml-2 text-slate-600 cursor-pointer text-sm">
                                                 {{ __('common.method_account') }}
                                            </span>
                                        </div>
                                        <div class="inline-flex items-center">
                                            <label class="relative flex items-center cursor-pointer" for="radio_card">
                                                <input name="payment_type" type="radio"
                                                       class="checkPaymentType peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-slate-300 checked:border-slate-400 transition-all"
                                                       id="radio_card" value='card'>
                                                <span
                                                    class="absolute bg-slate-800 w-3 h-3 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                                            </label>
                                            <label class="ml-2 text-slate-600 cursor-pointer text-sm"
                                                   for="radio_card">{{ __('common.method_card') }}</label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div id='payment_account_form'>
                                {{--결제수단--}}
                                <h2 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug !mb-2 text-primary">
                                    {{ __('common.checkout_account') }}
                                </h2>
                                <div class="flex items-center mb-4">
                                    <div class="w-full max-w-sm min-w-[240px]">
                                        <label class="block mb-1 text-sm text-slate-600">
                                        </label>
                                        <div class="relative">
                                            <input
                                                class="w-full mb-1 bg-transparent placeholder:text-slate-440 text-slate-740 text-sm border border-slate-240 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                placeholder="KB국민 989801-00-072129 ㈜엑소미어"
                                                readonly
                                                value="입금계좌 : 국민 989801-00-072129 ㈜엑소미어"
                                            />
                                            <input type="text" name="account_name" id="account_name"
                                                   class="w-full mb-1 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                   placeholder="{{ __('messages.checkout_account_name_holder') }}"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id='payment_card_form' style='display:none;'>
                                {{--결제수단--}}
                                <h2 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug !mb-2 text-primary">
                                    {{ __('common.checkout_card') }}
                                </h2>
                                <div class="flex items-center mb-4">
                                    <div class="w-full max-w-sm min-w-[240px]">
                                        <div class="flex flex-col gap-2">
                                            <div class="flex flex-col">
                                                <label class="required"
                                                       for="payment_card">{{ __('common.checkout_card_select') }}</label>
                                                <select
                                                    class="mb-1 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow "
                                                    id="payment_card" name='card_company'>
                                                    <option value="">== Select ==</option>
                                                    @foreach ($card_compnay as $key => $val)
                                                        <option value="{{$key}}">{{$val}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div>
                                                <label class="required"
                                                       for="card_name">{{ __('common.checkout_card_owner') }}</label>
                                                <input type="text"
                                                       class="w-full mb-1 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                       placeholder="{{ __('messages.checkout_card_name_holder') }}"
                                                       name="card_name"
                                                       id="card_name"
                                                >
                                            </div>

                                            <div>
                                                <label class="required"
                                                       for="card_number">{{ __('common.checkout_card_number') }}</label>
                                                <input type="text"
                                                       class="w-full mb-1 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                       placeholder="{{ __('messages.checkout_card_number_holder') }}"
                                                       name="card_number"
                                                       id="card_number"
                                                >
                                            </div>
                                            <div>
                                                <label class="required"
                                                       for="card_password">{{ __('common.checkout_card_pw') }}</label>
                                                <input type="text"
                                                       class="w-full mb-1 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                       placeholder="{{ __('messages.checkout_card_pw_holder') }}"
                                                       maxlength="2"
                                                       name="card_password"
                                                       id="card_password"
                                                >
                                            </div>
                                            <div>
                                                <label class="required"
                                                       for="card_password">{{ __('common.checkout_card_birth') }}</label>
                                                <input type="text"
                                                       class="w-full mb-1 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                       placeholder="{{ __('messages.checkout_card_birth_holder') }}"
                                                       maxlength="12"
                                                       name="user_brith"
                                                       id="user_brith"
                                                >
                                            </div>
                                            <div class="grid grid-cols-2 gap-1">
                                                <div class="flex flex-col">
                                                    <label class="required"
                                                           for="card_installment">{{ __('common.checkout_card_months') }}</label>
                                                    <select
                                                        class="mb-1 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                        name="card_installment" id="card_installment">
                                                        <option value="0">{{__('common.checkout_card_months_1')}}</option>
                                                        @for ($i = 2; $i < 13; $i++)
                                                                <option
                                                                    value="{{$i}}">{{$i}} {{__('common.months')}}</option>
                                                            
                                                        @endfor
                                                    </select>
                                                </div>

                                                <div class="flex flex-col">
                                                    <label class="required"
                                                           for="card_year"> {{ __('common.checkout_card_expiration') }} </label>
                                                    <div class="flex gap-1">
                                                        <select
                                                            class="basis-1/2 mb-1 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                            name="card_year" id="card_year">
                                                            <option value="">{{__('common.year')}}</option>
                                                            @for ($i = date("y"); $i < (date("y")+15); $i++)
                                                                <option value="{{$i}}">{{$i}}</option>
                                                            @endfor
                                                        </select>
                                                        <select
                                                            class="basis-1/2 mb-1 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                            name="card_month">
                                                            <option value="">{{__('common.months')}}</option>
                                                            @for ($i = 1; $i < 13; $i++)
                                                                <option value="{{$i}}">{{$i}}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-1">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 주문 합계 -->
                    <div class="col-span-12 lg:col-span-4 p-4 bg-gray-100">
                        <h6 class="text-3xl font-semibold text-head">{{ __('common.checkout_detail') }}</h6>
                        <hr class="text-gray-300 my-4">

                        <div class="flex flex-col gap-y-8">
                            <!-- 총 금액 -->
                            <div>
                                <h2 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug !mb-2 text-primary">
                                    {{ __('common.checkout_total_amount') }}</h2>
                                <div class="flex justify-between">
                                    <span>{{ __('common.checkout_product_price') }}</span>
                                    <span class="flex">
                                        <span>{{number_format($total_price)}}</span>
                                        <span
                                            class="px-1 currency @if(app()->getLocale() == 'en') order-first @endif">{{ __('common.currency') }}</span>
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span>{{ __('common.shipping_fee') }}</span>
                                    <span class="flex">
                                        <span>{{number_format($delivery_price)}}</span>
                                        <span
                                            class="px-1 currency @if(app()->getLocale() == 'en') order-first @endif">{{ __('common.currency') }}</span>
                                    </span>
                                </div>
                            </div>

                            <!-- 버튼 -->
                            <div class="">
                                <div class="text-center text-sm text-gray-600 mb-3">
                                    {{ __('messages.confirm_checkout') }}
                                </div>
                                <button
                                    type="button"
                                    class="submitBtn rounded-sm text-center w-full px-5 py-4 border border-solid border-base-color bg-base-color flex items-center justify-center font-normal text-lg text-white shadow-sm">

                                    <span class="flex">
                                        <input type='hidden' name='total_price'
                                               value="{{$total_price + $delivery_price}}">
                                        <span>{{number_format($total_price + $delivery_price)}}</span>
                                        <span
                                            class="px-1 currency @if(app()->getLocale() == 'en') order-first @endif">{{ __('common.currency') }}</span>
                                    </span>

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
    <script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
    <script>

        $(".submitBtn").on("click", function () {
            var check_value = $('input:radio[name="payment_type"]:checked').val();


            try {
                if (check_value === 'card') {
                    const cardFields = [
                        {id: "#payment_card"},
                        {id: "#card_name"},
                        {id: "#card_number"},
                        {id: "#card_password"},
                        {id: "#user_brith"},
                        {id: "#card_installment"},
                        {id: "#card_year"}
                    ];

                    for (const field of cardFields) {
                        const input = $(field.id).val();
                        if (!input) {
                            alert('{{ __('messages.checkout_error_alert') }}');
                            $(field.id).focus();
                            return false;
                        }
                    }
                } else {
                    const accountField = {id: "#account_name"};
                    const input = $(accountField.id).val();
                    if (!input) {
                        alert('{{ __('messages.checkout_error_alert') }}');
                        $(accountField.id).focus();
                        return false;
                    }
                }

                
                $("#paymentForm").submit();
                $(".submitBtn").attr("disabled", true);
            } catch (error) {
                alert("{{ __('messages.unexpected_error_alert') }}");
                return false;
            }
         
        });

        function getPostCode() {
            new daum.Postcode({
                oncomplete: function (data) {
                    // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                    // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                    var fullAddr = ''; // 최종 주소 변수
                    var extraAddr = ''; // 조합형 주소 변수

                    // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                    if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                        fullAddr = data.roadAddress;

                    } else { // 사용자가 지번 주소를 선택했을 경우(J)
                        fullAddr = data.jibunAddress;
                    }

                    // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
                    if (data.userSelectedType === 'R') {
                        //법정동명이 있을 경우 추가한다.
                        if (data.bname !== '') {
                            extraAddr += data.bname;
                        }
                        // 건물명이 있을 경우 추가한다.
                        if (data.buildingName !== '') {
                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                        fullAddr += (extraAddr !== '' ? ' (' + extraAddr + ')' : '');
                    }

                    var postArr = new Array();
                    postArr.push(data.zonecode);
                    postArr.push(fullAddr);

                    setPostCode(postArr);
                }
            }).open();
        }

        function setPostCode(postArr) {
            const zip_code = postArr[0];
            const full_addr = postArr[1];

            $("#zipcode").val(zip_code);
            $("#address").val(full_addr);
            $("#address_detail").val('');
            $("#address_detail").focus();
        }

        $(".checkPaymentType").on("click", function () {
            var check_value = $('input:radio[name="payment_type"]:checked').val();
            if (check_value == 'card') {
                $("#payment_card_form").css('display', 'block');
                $("#payment_account_form").css('display', 'none');
            } else {
                $("#payment_card_form").css('display', 'none');
                $("#payment_account_form").css('display', 'block');
            }
        });

        //포인트 리셋
        $('#resetPointButton').on('click', function() {
            $('#use_point').val(0);
        });

    </script>
@endsection


<?php

$activeHeader = true;
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
                <div class="grid grid-cols-12 min-h-screen rounded-sm">
                    <div class="col-span-12 lg:col-span-8 p-4">
                        <h6 class="text-3xl font-semibold text-head">주문서 작성</h6>
                        <hr class="text-gray-300 my-4">

                        <!-- 배송지 -->
                        <div class="flex flex-col  gap-y-10">
                            <div>
                                <h2 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug !mb-2 text-primary">
                                    배송지</h2>
                                <div class="flex flex-col gap-y-5">
                                    <div>
                                        <div class="w-full max-w-sm min-w-[200px]">
                                            <label class="block mb-1 text-sm text-slate-600">
                                                받는 이
                                            </label>
                                            <input
                                                id=""
                                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                maxlength="10"
                                                placeholder="수령자 명"
                                            />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="w-full max-w-sm min-w-[200px]">
                                            <label class="block mb-1 text-sm text-slate-600">
                                                휴대폰 번호
                                            </label>
                                            <input
                                                id="phone"
                                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                placeholder="e.g., 123-456-7890"
                                                pattern="^d{3}-\d{4}-\d{4}$"
                                                maxlength="11"
                                            />
                                        </div>
                                    </div>

                                    <div class="w-full max-w-sm min-w-[200px]">
                                        <label class="block mb-1 text-sm text-slate-600">
                                            주소
                                        </label>
                                        <div class="relative">
                                            <input
                                                id="zipcode" name="zipcode"
                                                class="w-full  mb-1 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                placeholder="주소검색을 이용해 주세요"
                                                readonly
                                            />
                                            <button
                                                class="absolute top-1 right-1 flex items-center rounded bg-slate-800 py-1 px-2.5 border border-transparent text-center text-sm text-white transition-all shadow-sm hover:shadow focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                type="button"
                                                onclick="getPostCode();"
                                            >
                                                주소검색
                                            </button>
                                            <input type="text" id="address" name="address"
                                                   class="w-full  mb-1 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                   placeholder="{{ __('messages.address') }}">
                                            <input type="text" id="address_detail" name="address_detail"
                                                   class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                   placeholder="{{ __('messages.address_detail') }}">
                                        </div>
                                    </div>


                                </div>
                            </div>


                            <div>
                                <!-- 주문상품 -->
                                <h2 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug !mb-2 text-primary">
                                    주문상품</h2>

                                <div class="mb-4">
                                    <div class="space-y-8">
                                        <!-- 상품 -->
                                        <div class="row flex items-center justify-between">
                                            <div class="flex items-center">
                                                <img src="{{ asset('assets/img/elements/2024061918143212433.png') }}"
                                                     alt="상품 이미지"
                                                     class="w-16 h-16 object-cover mr-4">
                                                <div>
                                                    <p class="font-semibold">퍼펙트 스칼프 임플란트 세럼</p>

                                                    <div class="flex flex-row">
                                                        수량: 1
                                                    </div>
                                                    <h6 class="flex"><span
                                                            class="total-price">19,500</span> <span
                                                            class="px-1 currency @if(app()->getLocale() == 'en') order-first @endif">{{ __('common.currency') }}</span>
                                                        / <span
                                                            class="total-pv">35,454</span>
                                                        <span
                                                            class="px-1 currency">PV</span>

                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div>
                                {{--결제수단--}}
                                <h2 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug !mb-2 text-primary">
                                    결제수단</h2>
                                <div class="flex items-center mb-4">
                                    <div class="flex gap-10">
                                        <div class="inline-flex items-center">
                                            <label class="relative flex items-center cursor-pointer" for="계좌이체">
                                                <input name="framework" type="radio"
                                                       class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-slate-300 checked:border-slate-400 transition-all"
                                                       id="계좌이체">
                                                <span
                                                    class="absolute bg-slate-800 w-3 h-3 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                                            </label>
                                            <label class="ml-2 text-slate-600 cursor-pointer text-sm"
                                                   for="계좌이체">계좌이체</label>
                                        </div>

                                        <div class="inline-flex items-center">
                                            <label class="relative flex items-center cursor-pointer" for="신용카드">
                                                <input name="framework" type="radio"
                                                       class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-slate-300 checked:border-slate-400 transition-all"
                                                       id="신용카드" checked="">
                                                <span
                                                    class="absolute bg-slate-800 w-3 h-3 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                                            </label>
                                            <label class="ml-2 text-slate-600 cursor-pointer text-sm"
                                                   for="신용카드">신용카드</label>
                                        </div>

                                        <div class="inline-flex items-center">
                                            <label class="relative flex items-center cursor-pointer" for="휴대폰결제">
                                                <input name="framework" type="radio"
                                                       class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-slate-300 checked:border-slate-400 transition-all"
                                                       id="휴대폰결제" checked="">
                                                <span
                                                    class="absolute bg-slate-800 w-3 h-3 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                                            </label>
                                            <label class="ml-2 text-slate-600 cursor-pointer text-sm"
                                                   for="휴대폰결제">휴대폰결제</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- 주문 합계 -->
                    <div class="col-span-12 lg:col-span-4 p-4 bg-gray-100">
                        <h6 class="text-3xl font-semibold text-head">결제 상세</h6>
                        <hr class="text-gray-300 my-4">

                        <div class="flex flex-col gap-y-8">
                            <!-- 총 금액 -->
                            <div>
                                <h2 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug !mb-2 text-primary">
                                    총금액</h2>
                                <div class="flex justify-between">
                                    <span>상품금액</span>
                                    <span>0 원</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>배송비</span>
                                    <span>0 원</span>
                                </div>

                            </div>

                            <!-- 버튼 -->
                            <div class="">
                                <div class="text-center text-sm text-gray-600 mb-3">
                                    약관 및 주문 내용을 확인하였으며, 정보 제공 등에 동의합니다.
                                </div>
                                <button
                                    type="submit"
                                    class="rounded-sm text-center w-full px-5 py-4 border border-solid border-base-color bg-base-color flex items-center justify-center font-normal text-lg text-white shadow-sm">
                                    0 원
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
    <script src="//spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
    <script>

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

                    // 우편번호와 주소보를 해당 필드에 넣는다.
                    //document.getElementById("sample6_postcode1").value = data.postcode1;
                    //document.getElementById("sample6_postcode2").value = data.postcode2;
                    //document.getElementById("sample6_address").value = fullAddr;

                    // 커서를 상세주소 필드로 이동한다.
                    //document.getElementById("sample6_address2").focus();

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

        document.getElementById('phone').addEventListener('input', function (e) {
            e.target.value = e.target.value.replace(/[^+\d\s-]/g, '');
        });
    </script>
@endsection


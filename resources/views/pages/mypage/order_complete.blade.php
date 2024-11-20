<?php

$activeHeader = true;
?>

@extends('pages.layouts.withoutVisualLayout')
@section('title', __('gnb.order_complete'))

@section('id', 'order_complete')

@section('vendor-style')
@endsection
@section('page-style')

@endsection
@section('content')
    <section class="py-10 lg:py-24 relative min-h-screen">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="bg-gray-100 p-6 rounded-lg shadow-md w-full max-w-md mx-auto ">
                <h2 class="text-3xl font-bold text-center mb-4">{{ __('gnb.order_complete') }}</h2>
                @if($payment_type == 'card')
                    <p class="text-lg text-center text-gray-600 mb-4">카드결제가 완료 되었습니다</p>

                    <div class="bg-white p-4 rounded-lg mb-4 shadow">
                        <h3 class="font-semibold text-lg mb-2">카드 결제</h3>
                        <div class="text-gray-700">
                            <p class="mb-1">카드 승인번호: {{$return_card_info['approval_num']}}</p>
                            <p class="font-bold text-blue-600 text-lg">결제금액 : {{ number_format($total_amount) }}원</p>
                        </div>
                    </div>

                @elseif ($payment_type == 'account')
                    <p class="text-lg text-center text-gray-600 mb-4">아래 계좌정보로 입금해 주시면
                        <br>결제 완료처리가 됩니다</p>

                    <div class="bg-white p-4 rounded-lg mb-4 shadow">
                        <h3 class="font-semibold text-lg mb-2">입금계좌 안내</h3>
                        <div class="text-gray-700">
                            <p class="mb-1">은행명: KB국민</p>
                            <p class="mb-1">계좌번호: 989801-00-072129</p>
                            <p class="mb-1">예금주: ㈜엑소미어</p>
                            <p class="font-bold text-blue-600 text-lg">{{ number_format($total_amount) }}원</p>
                        </div>
                    </div>
                @endif
              
                <div class="bg-white p-4 rounded-lg mb-4 shadow">
                    <h3 class="font-semibold text-lg mb-2">주문번호</h3>
                    <p class="text-gray-700">{{ $input_data['order_code'] }}</p>
                </div>

                <div class="bg-white p-4 rounded-lg mb-4 shadow">
                    <h3 class="font-semibold text-lg mb-2">배송지</h3>
                    <div class="text-gray-700">
                        <p>{{ $input_data['member_name'] }}</p>
                        <p>{{ $phone }}</p>
                        <p>{{ $input_data['address'] }} {{ $input_data['address_detail'] }}</p>
                        <p>({{ $input_data['zipcode'] }})</p>
                    </div>
                </div>

                {{-- <div class="bg-white p-4 rounded-lg mb-4 shadow">
                    <h3 class="font-semibold text-lg mb-2">배송 방법</h3>
                    <p class="text-gray-700">택배</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="font-semibold text-lg mb-2">배송 메모</h3>
                    <p class="text-gray-700">배송 전에 미리 연락 바랍니다.</p>
                </div> --}}

                <a href='/'
                    class="mt-6 w-full px-10 h-12 text-center text-exomere border border-solid border-exomere text-base font-semibold leading-6 hover:bg-exomere hover:text-white shadow transition-all duration-700">
                    홈으로
                </a>
            </div>

        </div>
    </section>

@endsection

@section('page-script')
@endsection

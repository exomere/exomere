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
                    <p class="text-lg text-center text-gray-600 mb-4">{{ __('messages.completed_card_payment') }}</p>

                    <div class="bg-white p-4 rounded-lg mb-4 shadow">
                        <h3 class="font-semibold text-lg mb-2">{{ __('common.checkout_card') }}</h3>
                        <div class="text-gray-700">
                            <p class="mb-1">{{ __('common.card_approval_number') }}
                                <span class="font-bold">{{$return_card_info['approval_num']}}</span></p>
                            <p class="flex gap-x-1 mb-1 text-blue-600 text-lg">
                                <span>{{ __('common.checkout_total_amount') }}</span>
                                <span class="flex font-bold">
                                    <span>{{ number_format($total_amount) }}</span>
                                    <span class="px-1 currency @if(app()->getLocale() == 'en') order-first @endif">{{ __('common.currency') }}</span>
                                </span>
                            </p>
                        </div>
                    </div>

                @elseif ($payment_type == 'account')
                    <p class="text-lg text-center text-gray-600 mb-4">{!! __('messages.completed_account_payment') !!}</p>

                    <div class="bg-white p-4 rounded-lg mb-4 shadow">
                        <h3 class="font-semibold text-lg mb-2">{{ __('common.account_info') }}</h3>
                        <div class="text-gray-700">
                            <p class="mb-1">{{ __('common.bank') }} <span class="font-bold">KB국민</span></p>
                            <p class="mb-1">{{ __('common.account_no') }} <span class="font-bold">989801-00-072129</span></p>
                            <p class="mb-1">{{ __('common.account_name') }} <span class="font-bold">㈜엑소미어</span></p>
                            <p class="font-bold text-blue-600 text-lg">
                                 <span class="flex">
                                    <span>{{ number_format($total_amount) }}</span>
                                    <span
                                        class="px-1 currency @if(app()->getLocale() == 'en') order-first @endif">{{ __('common.currency') }}</span>
                                </span>
                            </p>
                        </div>
                    </div>
                @endif

                {{--포인트--}}
                <div class="bg-white p-4 rounded-lg mb-4 shadow">
                    <h3 class="font-semibold text-lg mb-2">{{ __('common.method_point') }}</h3>
                    <p class="text-gray-700">0</p>
                </div>

                <div class="bg-white p-4 rounded-lg mb-4 shadow">
                    <h3 class="font-semibold text-lg mb-2">{{ __('common.order_number') }}</h3>
                    <p class="text-gray-700">{{ $input_data['order_code'] }}</p>
                </div>

                <div class="bg-white p-4 rounded-lg mb-4 shadow">
                    <h3 class="font-semibold text-lg mb-2">{{ __('common.checkout_address') }}</h3>
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

                <button
                    class="mt-6 w-full px-10 h-12 text-center text-exomere border border-solid border-exomere text-base font-semibold leading-6 hover:bg-exomere hover:text-white shadow transition-all duration-700"
                    onclick="location.href='/'"
                >
                    {{ __('common.to_home') }}
                </button>
            </div>

        </div>
    </section>

@endsection

@section('page-script')
@endsection

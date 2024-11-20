<?php

$activeHeader = true;
?>

@extends('pages.layouts.withoutVisualLayout')
@section('title', __('gnb.order_fail'))

@section('id', 'order_fail')

@section('vendor-style')
@endsection
@section('page-style')

@endsection
@section('content')
    <section class="py-10 lg:py-24 relative min-h-screen">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="bg-gray-100 p-6 rounded-lg shadow-md w-full max-w-md mx-auto ">
                <h2 class="text-3xl font-bold text-center mb-4">{{ __('gnb.order_fail') }}</h2>

                    <p class="text-lg text-center text-gray-600 mb-4">카드결제를 실패 했습니다.</p>

                    <div class="bg-white p-4 rounded-lg mb-4 shadow">
                        <h3 class="font-semibold text-lg mb-2">카드 결제</h3>
                        <div class="text-gray-700">
                            <p class="mb-1">실패 사유: {{$msg}}</p>
                        </div>
                    </div>
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

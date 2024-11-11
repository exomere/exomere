@extends('layouts/blankLayout')

@section('title', '서버 점검 중입니다')

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-misc.css')}}">
@endsection

@section('content')
    <!-- Error -->
    <div class="container-xxl container-p-y">
        <div class="misc-wrapper">
            <div class="mb-2">
                <svg fill="#CF5733" width="200px" height="200px" viewBox="0 0 9 9" version="1.1" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><title>error-solid</title><path class="clr-i-solid clr-i-solid-path-1" d="M4.5 1.5a3 3 0 1 0 3 3 3 3 0 0 0 -3 -3M4.127 3a0.373 0.373 0 0 1 0.75 0v1.723a0.373 0.373 0 1 1 -0.75 0Zm0.373 3.375a0.43 0.43 0 1 1 0.43 -0.43 0.43 0.43 0 0 1 -0.43 0.43"/><path x="0" y="0" width="36" height="36" fill-opacity="0" d="M0 0h9v9H0z"/></svg>
            </div>
            <h2 class="mb-2 mx-2">현재 서버 점검 중입니다.</h2>
            <h4 class="mb-4 mx-2">The requested page is under maintenance.</h4>
            <p class="mb-4 mx-2">보다 나은 서비스를 제공해 드리기 위하여 서비스 점검을 실시합니다.
                <br>고객 여러분의 많은 양해 부탁드립니다.</p>
        </div>
    </div>
    <!-- /Error -->
@endsection

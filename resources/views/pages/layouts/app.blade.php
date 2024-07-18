<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>엑소미어 | @yield('title', env('APP_NAME'))</title>
    <link href="{{ asset('assets/css/common/styles.css') }}" rel="stylesheet" />
    @stack('styles')
</head>
<body>
<div id="wrap" class="main normal">
@include('pages.partials.header')

@yield('content')

@include('pages.partials.footer')

    <script src="{{ asset('../assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('../assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script defer src="{{ asset('assets/js/fo/common.js') }}"></script>
    @stack('scripts')
</div>
</body>
</html>

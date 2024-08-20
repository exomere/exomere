@php
    $isMain = $isMain ?? false;
@endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=5, minimum-scale=1, viewport-fit=cover">

    <title>{{ config('meta.title') }} | @yield('title')</title>
    <meta name="description" content="{{ config('meta.description') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>::: 엑소미어 :::</title>
    <meta name="title" content="{{ config('meta.title') }}">
    <meta name="description" content="{{ config('meta.description') }}">
    <meta name="keywords" content="{{ config('meta.keywords') }}">
    <meta name="url" content="{{ config('meta.url') }}">

    <meta name="description" content="{{ config('meta.description') }}">
    <meta name="format-detection" content="telephone=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="keywords" content="{{ config('meta.keywords') }}">

    <meta property="og:site_name" content="{{ config('meta.title') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ config('meta.url') }}">
    <meta property="og:title" content="{{ config('meta.title') }}">
    <meta property="og:image" content="{{ asset('assets/img/favicon/og.png') }}">
    <meta property="og:description" content="{{ config('meta.description') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Canonical SEO -->
    <link rel="canonical" href="{{ config('meta.url') }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}"/>
    <link rel="shortcut icon" sizes="192x192" href="{{ asset('assets/img/favicon/android.png') }}">
    <link rel="apple-touch-icon" sizes="128x128" href="{{ asset('assets/img/favicon/ios.png') }}">

    <!-- Include Styles -->
    <style type="text/tailwindcss">

        @layer components {
            .max-container {
                max-width: 1200px;
                margin: 0 auto;
            }

            .max-inner {
                max-width: 80%;
                margin: 0 auto;
            }

            .input {
                @apply sm:flex-1 max-sm:w-full text-base leading-normal text-slate-gray pl-5 max-sm:p-5 outline-none sm:border-none border max-sm:border-slate-gray max-sm:rounded-full;
            }
        }

        @layer utilities {
            .padding {
                @apply sm:px-8 px-4 sm:py-12 py-6;
            }

            .padding-x {
                @apply sm:px-8 px-4;
            }

            .padding-y {
                @apply sm:py-12 py-6;
            }

            .padding-l {
                @apply sm:pl-8 pl-4;
            }

            .padding-r {
                @apply sm:pr-8 pr-4;
            }

            .padding-t {
                @apply sm:pt-6 pt-3;
            }

            .padding-b {
                @apply sm:pb-6 pb-3;
            }

            .underline-animation {
                @apply relative after:bg-black after:absolute after:h-[1px] after:w-0 after:bottom-0 after:left-0 hover:after:w-full after:transition-all after:duration-300
            }

            /*.title-text {*/
            /*    @apply font-poppins font-semibold text-2xl;*/
            /*}*/
            /*.info-text {*/
            /*    @apply font-montserrat text-slate-gray text-base;*/
            /*}*/
        }

    </style>
    @include('pages.sections.styles')

</head>

<body class="relative w-full h-full bg-white {{ $isMain ? 'main_page' : '' }}">

<!-- Layout Content -->
@yield('layoutContent')

<!-- Include Scripts -->
@include('pages.sections.scripts')
</body>

</html>

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
                max-width: 120rem;
                margin: 0 auto;
            }
        }

        @layer utilities {
            .badge {
                @apply inline-block w-20 bg-gray-800 text-white text-xs font-medium text-center me-2 py-1 border border-solid border-gray-800;
            }

            .input {
                @apply w-full focus:outline-none py-2 px-4 mb-2 border border-solid border-slate-200 rounded-lg;
            }

            .required {
                @apply text-sm after:inline-block after:ml-[4px] after:text-[#E65F3E] after:content-['*'];
            }

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
                @apply relative after:bg-slate-700 after:absolute after:h-[1px] after:w-0 after:bottom-0 after:left-0 hover:after:w-full after:transition-all after:duration-300
            }
        }

    </style>
    @include('pages.sections.styles')

</head>

<body>

<!-- Layout Content -->
@yield('layoutContent')

<!-- Include Scripts -->
@include('pages.sections.scripts')
</body>

</html>

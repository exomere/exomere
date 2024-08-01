<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      class="h-full">
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
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
    <link rel="shortcut icon" sizes="192x192" href="{{ asset('assets/img/favicon/android.png') }}">
    <link rel="apple-touch-icon" sizes="128x128" href="{{ asset('assets/img/favicon/ios.png') }}">

    <!-- Include Styles -->
    @include('pages.sections.styles')

</head>

<body class="h-full">
    <!-- Layout Content -->
    @yield('layoutContent')

    <!-- Include Scripts -->
    @include('pages.sections.scripts')
</body>

</html>

@extends('pages.layouts.app')

@section('layoutContent')

    @include('pages.partials.header')

    <main class="relative w-full h-full pt-24" id="@yield('id')">
        @yield('content')
    </main>

    @include('pages.partials.footer')

@endsection

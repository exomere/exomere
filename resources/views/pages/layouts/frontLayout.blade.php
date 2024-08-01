@php
    $isMain = $isMain ?? false;
@endphp

@extends('pages.layouts.app')

@section('layoutContent')

    <div class="w-full bg-white	 {{ $isMain ? 'main' : '' }}">

        @include('pages.partials.header')

        <main class="w-full">
            @yield('content')
        </main>

        @include('pages.partials.footer')

    </div>

@endsection

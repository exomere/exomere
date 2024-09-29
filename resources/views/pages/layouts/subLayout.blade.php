<?php
$visualFullWidthLayout = $visualFullWidthLayout ?? false;

$whiteHeader = true;

?>
@extends('pages.layouts.app')

@section('layoutContent')

    @include('pages.partials.header')

    <main class="relative w-full h-full" id="@yield('id')">

        <section class="max-lg:h-[50vh] h-[50vh]">
            <!-- Sub visual Wrapper -->
            <div class="relative pt-[80px] lg:pt-[160px] w-full h-full flex flex-col items-center justify-center
                    bg-cover bg-no-repeat bg-center bg-[url('@yield('visual_background')')]">
                <div class="absolute inset-0 size-full bg-black/50"></div>

                <!-- Sub visual Text -->
                <div
                    class="leading-tight text-center {{ isset($whiteHeader) ? 'text-white' : '' }} ">
                    <p class="text-4xl text-white font-semibold  mb-3"
                       data-aos="fade"
                    >@yield('visual_title')</p>

                    <p class="text-xl text-white"
                       data-aos="fade"
                       data-aos-delay="200"
                    >@yield('visual_sub_title')</p>
                </div>
            </div>
        </section>

        @if($visualFullWidthLayout)
            @yield('content')
        @else
            <section class="max-container h-full min-h-screen bg-white">
                <!-- Contents -->
                <div class="max-w-5xl lg:max-w-7xl mx-auto px-2 py-24">
                    @yield('content')
                </div>
            </section>
        @endif


    </main>

    @include('pages.partials.footer')

@endsection

@extends('pages.layouts.app')

@section('layoutContent')

    @include('pages.partials.header')

    <main class="relative w-full h-full" id="@yield('id')">

        <section class="h-[78svh]">
            <!-- Sub visual Wrapper -->
            <div class="relative pt-[80px] lg:pt-[160px] w-full h-full flex flex-col items-center justify-center
                    bg-cover bg-no-repeat bg-center bg-[url('@yield('visual_background')')]">
            </div>
        </section>

        <section class="max-container h-full min-h-screen bg-white">
            <div class="mt-14 mb-24 md:mt-24 text-center">
                <!-- Sub visual Text -->
                <div
                    class="text-center font-roboto tracking-tight z-1 text-gray-900 {{ isset($whiteHeader) ? 'text-white' : '' }} ">
                    <p class="text-4xl font-medium mb-3" data-aos="fade">
                        @yield('visual_title')
                    </p>
                    <p class="text-2xl font-medium text-gray-500"
                       data-aos="fade"
                       data-aos-delay="200">@yield('visual_sub_title')</p>
                </div>
            </div>

            <!-- Contents -->
            <div class="max-w-5xl lg:max-w-6xl mx-auto px-6 pb-24">
                @yield('content')
            </div>
        </section>

    </main>

    @include('pages.partials.footer')

@endsection

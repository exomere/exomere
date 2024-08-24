@extends('pages.layouts.frontSubLayout')
@section('title', __('gnb.philosophy'))
@section('page-style')

@endsection
@section('content')

    <main class="relative" id="philosophy">
        <section class="h-96 lg:h-[50svh]">
            <!-- Subvisual Wrapper -->
            <div class="relative pt-[80px] lg:pt-[160px] w-full h-full flex flex-col items-center justify-center
                    bg-cover bg-no-repeat bg-center"
                 style="background-image: url('{{ asset("assets/img/elements/visual_02.webp") }}')"
            >
                <!-- Subvisual Text -->
                <div class="padding-x text-center font-roboto tracking-tight z-10 text-gray-900">
                    <p class="text-4xl font-medium uppercase" data-aos="fade-down">
                        {{ __('gnb.philosophy') }}
                    </p>
                    <p class="font-medium" data-aos="fade-down"
                       data-aos-delay="200">{{ __('gnb.philosophy_title') }}</p>
                </div>
            </div>
        </section>
        <section class="min-sm:max-container min-h-screen padding-y">
            <div class="bg-white">
                <div class="mx-auto  px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                    <div class="my-7">
                        <p class="text-3xl font-normal"
                           data-aos="fade-up"
                           data-aos-delay="100">
                            {{ __('messages.philosophy_heading') }}
                        </p>
                        <p class="text-3xl font-normal"
                           data-aos="fade-up"
                           data-aos-delay="200">
                            {{ __('messages.philosophy_heading_sub') }}
                        </p>
                    </div>

                    <div class="flex flex-col gap-y-10 md:gap-0">

                        <div class="flex flex-col md:flex-row">
                            <picture class="overflow-hidden basis-1/2">
{{--                                <source srcset="{{ asset('assets/img/elements/visual_01.webp') }}"--}}
{{--                                        media="(max-width: 768px)">--}}
{{--                                <img src="{{ asset('assets/img/elements/visual_01.webp') }}" alt="" data-aos="scale">--}}
                                <source srcset="https://cdn.pixabay.com/photo/2024/07/15/06/52/dna-8895875_1280.png"
                                        media="(max-width: 768px)">
                                <img src="https://cdn.pixabay.com/photo/2024/07/15/06/52/dna-8895875_1280.png" alt="" data-aos="scale">
                            </picture>
                            <div class="basis-1/2 flex flex-col justify-center padding leading-loose break-keep">
                                <h2 class="text-2xl font-semibold mb-7 text-left" data-aos="fade-up"
                                    data-aos-delay="100">{{ __('messages.philosophy_content_head_1') }}</h2>
                                <p data-aos="fade-in"
                                   data-aos-delay="100">{!! nl2br(__('messages.philosophy_content_1')) !!}</p>
                            </div>
                        </div>


                        <div class="flex flex-col md:flex-row">

                            <picture class="overflow-hidden basis-1/2">
{{--                                <source srcset="{{ asset('assets/img/elements/visual_02.webp') }}"--}}
{{--                                        media="(max-width: 768px)">--}}
{{--                                <img src="{{ asset('assets/img/elements/visual_02.webp') }}" alt="" data-aos="scale">  --}}
                                <source srcset="https://cdn.pixabay.com/photo/2021/10/11/17/37/handshake-6701408_1280.jpg"
                                        media="(max-width: 768px)">
                                <img src="https://cdn.pixabay.com/photo/2021/10/11/17/37/handshake-6701408_1280.jpg" alt="" data-aos="scale">
                            </picture>

                            <div
                                class="basis-1/2 flex flex-col justify-center padding leading-loose break-keep md:order-first">
                                <h2 class="text-2xl font-semibold mb-7 text-left"
                                    data-aos="fade-up">{{ __('messages.philosophy_content_head_2') }}</h2>
                                <p data-aos="fade-in"
                                   data-aos-delay="100">{!! nl2br(__('messages.philosophy_content_2')) !!}</p>
                            </div>

                        </div>

                        <div class="flex flex-col md:flex-row">
                            <picture class="overflow-hidden basis-1/2">
{{--                                <source srcset="{{ asset('assets/img/elements/visual_03.webp') }}"--}}
{{--                                        media="(max-width: 768px)">--}}
{{--                                <img src="{{ asset('assets/img/elements/visual_03.webp') }}" alt="" data-aos="scale">--}}
                                <source srcset="https://cdn.pixabay.com/photo/2018/12/20/06/53/network-3885328_1280.jpg"
                                        media="(max-width: 768px)">
                                <img src="https://cdn.pixabay.com/photo/2018/12/20/06/53/network-3885328_1280.jpg" alt="" data-aos="scale">
                            </picture>
                            <div class="basis-1/2 flex flex-col justify-center padding leading-loose break-keep">
                                <h2 class="text-2xl font-semibold mb-7 text-left"
                                    data-aos="fade-up">{{ __('messages.philosophy_content_head_3') }}</h2>
                                <p data-aos="fade-in"
                                   data-aos-delay="100">{!! nl2br(__('messages.philosophy_content_3')) !!}</p>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row">

                            <picture class="overflow-hidden basis-1/2">
{{--                                <source srcset="{{ asset('assets/img/elements/visual_04.webp') }}" media="(max-width: 768px)">--}}
{{--                                <img src="{{ asset('assets/img/elements/visual_04.webp') }}" alt="" data-aos="scale">--}}
                                <source srcset="https://cdn.pixabay.com/photo/2017/02/01/13/53/analysis-2030265_1280.jpg" media="(max-width: 768px)">
                                <img src="https://cdn.pixabay.com/photo/2017/02/01/13/53/analysis-2030265_1280.jpg" alt="" data-aos="scale">

                            </picture>
                            <div
                                class="basis-1/2 flex flex-col justify-center padding leading-loose md:order-first break-keep">
                                <h2 class="text-2xl font-semibold mb-7 text-left"
                                    data-aos="fade-up">{{ __('messages.philosophy_content_head_4') }}</h2>
                                <p data-aos="fade-in"
                                   data-aos-delay="100">{!! nl2br(__('messages.philosophy_content_4')) !!}</p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </section>
    </main>

@endsection

@section('page-script')
@endsection


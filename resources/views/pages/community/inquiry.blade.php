@extends('pages.layouts.frontSubLayout')
@section('title', __('gnb.brand_title'))
@section('page-style')

@endsection
@section('content')

    <main class="relative">

        <section class="h-96">
            <!-- Subvisual Wrapper -->
            <div class="relative pt-[80px] lg:pt-[160px] w-full h-full flex flex-col items-center justify-center
                    bg-cover bg-no-repeat bg-center"
                 style="background-image: url({{asset('assets/img/elements/subtitle_bg.webp')}})"
            ></div>
        </section>

        <section class="max-container padding-y">
            <div class="bg-white">
                <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                    <div class="grid lg:grid-cols-1 grid-cols-1 gap-x-24">
                        <div class="flex items-center lg:mb-0 mb-10">
                            <div class="">
                                <h4 class="text-slate-600 text-base font-medium leading-6 mb-4 lg:text-left text-center"
                                    data-aos="fade-down"
                                >{{ __('gnb.inquiry_title') }}</h4>
                                <h2 class="text-gray-900 font-manrope text-4xl font-semibold leading-10 mb-9 lg:text-left text-center"
                                    data-aos="fade-down" data-aos-delay="200">{{ __('gnb.inquiry') }}</h2>
                                <form action="" data-aos="fade-up">
                                    <input type="text"
                                           class="w-full h-14 shadow-sm text-gray-600 placeholder-text-400 text-lg font-normal leading-7  border border-gray-200 focus:outline-none py-2 px-4 mb-8"
                                           placeholder="{{__('messages.company_name')}}">
                                    <input type="text"
                                           class="w-full h-14 shadow-sm text-gray-600 placeholder-text-400 text-lg font-normal leading-7  border border-gray-200 focus:outline-none py-2 px-4 mb-8"
                                           placeholder="{{__('messages.name')}}">
                                    <select
                                        class="w-full h-14 shadow-sm text-gray-400 placeholder-text-400 text-lg font-normal leading-7  border border-gray-200 focus:outline-none py-2 px-4 mb-8">
                                        <option value="">{{__('messages.nation')}}</option>
                                        <option value="">1</option>
                                        <option value="">1</option>
                                        <option value="">1</option>
                                        <option value="">1</option>
                                    </select>
                                    <input type="email"
                                           class="w-full h-14 shadow-sm text-gray-600 placeholder-text-400 text-lg font-normal leading-7  border border-gray-200 focus:outline-none py-2 px-4 mb-8"
                                           placeholder="{{__('messages.email')}}">
                                    <textarea name="" id="text"
                                              class="w-full h-48 shadow-sm resize-none text-gray-600 placeholder-text-400 text-lg font-normal leading-7 border border-gray-200 focus:outline-none px-4 py-4 mb-8"
                                              placeholder="{{__('messages.contents')}}"></textarea>
                                    <button
                                        class="px-10 h-12 text-center text-exomere border border-solid rounded-full border-exomere text-base font-semibold leading-6 hover:bg-exomere hover:text-white shadow transition-all duration-700">
                                        {{__('messages.submit')}}
                                    </button>
                                </form>
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


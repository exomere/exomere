@extends('pages.layouts.subLayout')
@section('title', __('gnb.cibi'))

@section('id', 'cibi')
@section('visual_title',  __('gnb.cibi') )
@section('visual_sub_title', __('gnb.cibi_title'))
@section('visual_background', 'https://cdn.pixabay.com/photo/2020/03/29/19/20/theatre-4981936_1280.jpg')

@section('page-style')
@endsection
@section('content')

    <div class="flex flex-col space-y-12 gap-y-12 items-center justify-center md:text-lg">
        <div class="w-full">
            <h2 class="text-2xl font-semibold mb-7 text-left" data-aos="fade-up">Signature
                System</h2>
            <div class="grid lg:grid-cols-2 gap-4">
                <div
                    class="bg-white padding border border-solid border-slate-200 flex flex-col items-center"
                    data-aos="fade-up"
                    data-aos-delay="300">
                    <div class="flex flex-col h-32 items-center justify-center">
                        <img src="{{asset('img/logo.svg')}}" alt=""
                             class=" h-full object-cover ">
                    </div>
                </div>

                <div
                    class="bg-white padding border border-solid border-slate-200 flex flex-col items-center"
                    data-aos="fade-up"
                    data-aos-delay="400">
                    <div class="flex flex-col w-56 h-32 items-center justify-center">
                        <img src="{{asset('img/logo_horizontal.png')}}" alt=""
                             class="w-full object-cover ">
                    </div>
                </div>
            </div>
            <div class="text-center my-7">
                <p class="break-keep tracking-tight leading-loose"
                   data-aos="fade-up"
                   data-aos-delay="300">
                    {!! nl2br(__('messages.cibi_content')) !!}
                </p>
                <button type="button"
                        class="inline-flex items-center gap-x-1 mt-3 px-10 h-12 text-sm border border-solid border-slate-200 rounded-full"
                        data-aos="fade-up"
                        data-aos-delay="300"
                        onclick="alert('{{__('common.in_ready')}}')"
                >{{ __('common.download') }}
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         width="14" height="14" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="1"
                              d="M12 13V4M7 14H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2m-1-5-4 5-4-5m9 8h.01"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="w-full">
            <h2 class="text-2xl font-semibold mb-7 text-left" data-aos="fade-up">Color System</h2>
            <div class="flex flex-col">
                <div class="w-full h-20 mb-7 bg-exomere" data-aos="fade-up"></div>
                <ul class="leading-loose" data-aos="fade-up">
                    <li><span class="inline-block min-w-32 font-bold ">PANTONE</span> 2026C</li>
                    <li><span class="inline-block min-w-32 font-bold ">CMYK</span> C18 M78 Y83 K0
                    </li>
                    <li><span class="inline-block min-w-32 font-bold ">RGB</span> R207 G87 B51</li>
                </ul>

            </div>
        </div>
        <div class="w-full">
            <div class="flex flex-wrap justify-between items-center gap-x-1">
                <div>
                    <h2 class="text-lg font-semibold mb-1"
                        data-aos="fade-up">명도에 따른 색상 활용</h2>
                    <div class="color__system brightness mb-7"
                         data-aos="fade-up"
                         data-aos-delay="100">
                        <img src="{{asset('assets/img/elements/color_system_brightness.png')}}"
                             alt="">
                    </div>

                    <h2 class="text-lg font-semibold mb-1"
                        data-aos="fade-up">채도에 따른 색상 활용</h2>
                    <div class="color__system saturation mb-7"
                         data-aos="fade-up"
                         data-aos-delay="100">
                        <img src="{{asset('assets/img/elements/color_system_saturation.png')}}"
                             alt="">
                    </div>
                </div>
                <div>
                    <h2 class="text-lg font-semibold mb-1"
                        data-aos="fade-up">흑백 배경 색상 활용</h2>
                    <div class="color__system black mb-7"
                         data-aos="fade-up"
                         data-aos-delay="100">
                        <img src="{{asset('assets/img/elements/color_system_black.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
@endsection


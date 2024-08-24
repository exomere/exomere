@extends('pages.layouts.frontSubLayout')
@section('title', __('gnb.inquiry_title'))
@section('page-style')

@endsection
@section('content')

    <main class="relative">
        <section class="h-96 lg:h-[50svh]">
            <!-- Subvisual Wrapper -->
            <div class="relative pt-[80px] lg:pt-[160px] w-full h-full flex flex-col items-center justify-center
                    bg-cover bg-no-repeat bg-center"
                 style="background-image: url({{asset('assets/img/elements/subtitle_bg.webp')}})"
            >
                <!-- Subvisual Text -->
                <div class="text-center font-roboto tracking-tight z-10 text-gray-900">
                    <p class="text-4xl font-medium uppercase" data-aos="fade-down">
                        {{ __('gnb.inquiry') }}
                    </p>
                    <p class="font-medium" data-aos="fade-down" data-aos-delay="200">{{ __('gnb.inquiry_title') }}</p>
                </div>
            </div>
        </section>

        <section class="min-sm:max-container min-h-screen padding-y">
            <div class="bg-white">
                <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                    <div
                        class="grid lg:grid-cols-3 grid-cols-1 gap-x-16 xl:gap-x-24 gap-y-14 max-w-lg md:max-w-3xl lg:max-w-full mx-auto">
                        <div class="flex flex-col gap-y-8">
                            <div
                                class="border border-gray-200 bg-white">
                                <h5 class="inline-flex items-center text-xl font-semibold leading-8 mb-3 text-exomere"
                                    data-aos="fade-up">
                                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                         width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                              d="M4 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h1v2a1 1 0 0 0 1.707.707L9.414 13H15a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4Z"
                                              clip-rule="evenodd"/>
                                        <path fill-rule="evenodd"
                                              d="M8.023 17.215c.033-.03.066-.062.098-.094L10.243 15H15a3 3 0 0 0 3-3V8h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1v2a1 1 0 0 1-1.707.707L14.586 18H9a1 1 0 0 1-.977-.785Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    Message
                                </h5>
                                <p class="text-gray-500 font-normal leading-loose"
                                   data-aos="fade-up"
                                   data-aos-delay="300"
                                >
                                    엑소미어와 관련된 내용을 문의해 주세요<br>
                                    최대한 빠른 시간내에 담당자가 연락 드리도록 하겠습니다
                                </p>
                            </div>

                            <div
                                class="border border-gray-200 bg-white">
                                <h5 class="inline-flex items-center text-xl font-semibold leading-8 mb-3 text-exomere"
                                    data-aos="fade-up"
                                    data-aos-delay="400">
                                    <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                         width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M7.978 4a2.553 2.553 0 0 0-1.926.877C4.233 6.7 3.699 8.751 4.153 10.814c.44 1.995 1.778 3.893 3.456 5.572 1.68 1.679 3.577 3.018 5.57 3.459 2.062.456 4.115-.073 5.94-1.885a2.556 2.556 0 0 0 .001-3.861l-1.21-1.21a2.689 2.689 0 0 0-3.802 0l-.617.618a.806.806 0 0 1-1.14 0l-1.854-1.855a.807.807 0 0 1 0-1.14l.618-.62a2.692 2.692 0 0 0 0-3.803l-1.21-1.211A2.555 2.555 0 0 0 7.978 4Z"/>
                                    </svg>
                                    Support
                                </h5>
                                <p class="text-gray-500 font-normal leading-loose"
                                   data-aos="fade-up"
                                   data-aos-delay="500">
                                    Tel. {{ __('common.tel') }}<br>
                                    Fax. {{ __('common.fax') }}<br>
                                    Email. {{ __('common.email') }}
                                </p>
                            </div>


                        </div>
                        <div class="col-span-2">
                            <form action="">
                                <div data-aos="fade-up" data-aos-delay="100">
                                    <label class="required">
                                        {{__('messages.company_name')}}
                                    </label>
                                    <input type="text"
                                           class="input"
                                           required
                                           placeholder="{{__('messages.company_name')}}">
                                </div>
                                <div data-aos="fade-up" data-aos-delay="200">
                                    <label class="required">{{__('messages.name')}}</label>
                                    <input type="text"
                                           class="input"
                                           required
                                           placeholder="{{__('messages.name')}}">
                                </div>
                                <div data-aos="fade-up" data-aos-delay="300">
                                    <label class="required">{{__('messages.nation')}}</label>
                                    <select
                                        class="input text-gray-400"
                                        required>
                                        <option value="">{{__('messages.nation')}}</option>
                                    </select>
                                </div>
                                <div data-aos="fade-up" data-aos-delay="400">
                                    <label class="required">{{__('messages.email')}}</label>
                                    <input type="email"
                                           class="input"
                                           required
                                           placeholder="{{__('messages.email')}}">
                                </div>
                                <div data-aos="fade-up" data-aos-delay="500">
                                    <label class="required">{{__('messages.contents')}}</label>
                                    <textarea name="" id="text"
                                              rows="5"
                                              class="input"
                                              required
                                              placeholder="{{__('messages.contents')}}"></textarea>
                                </div>
                                <div data-aos="fade-up" data-aos-delay="100">
                                    <button
                                        class="px-10 h-12 text-center text-exomere border border-solid rounded-full border-exomere text-base font-semibold leading-6 hover:bg-exomere hover:text-white shadow transition-all duration-700">
                                        {{__('messages.submit')}}
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </section>
    </main>

@endsection

@section('page-script')

@endsection


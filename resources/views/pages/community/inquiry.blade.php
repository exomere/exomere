@extends('pages.layouts.subLayout')
@section('title', __('gnb.inquiry'))

@section('id', 'inquiry')
@section('visual_title',  __('gnb.inquiry') )
@section('visual_sub_title', '')
@section('visual_background', 'https://cdn.pixabay.com/photo/2016/11/29/06/56/abstract-1867937_1280.jpg')

@section('page-style')

@endsection
@section('content')
    <div
        class="grid grid-cols-1 lg:grid-cols-3 gap-x-16 xl:gap-x-24 gap-y-14">
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
        <div class="col-span-2" data-aos="fade-up" data-aos-delay="300">
            <form id="inquiryForm" method='post' action="{{ route('fo.inquiry.store') }}" enctype="multipart/form-data">
                @csrf
                <div>
                    <label class="required">
                        {{__('messages.company_name')}}
                    </label>
                    <input type="text"
                           name="company_name"
                           class="input"
                           required
                           placeholder="{{__('messages.company_name')}}">
                </div>
                <div>
                    <label class="required">{{__('messages.nation')}}</label>
                    <select
                        class="input text-gray-400"
                        name="nation"
                        required>
                        <option value="">{{__('messages.nation')}}</option>
                        @foreach(config('meta.nation') as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="required">{{__('messages.email')}}</label>
                    <input type="email"
                           name="email"
                           class="input"
                           required
                           placeholder="{{__('messages.email')}}">
                </div>
                <div>
                    <label class="required">{{__('messages.contents')}}</label>
                    <textarea name="content" id="text"
                              rows="10"
                              class="input"
                              required
                              placeholder="{{__('messages.contents')}}"></textarea>
                </div>
                <div>
                    <button
                        type="submit"
                        class="px-10 h-12 text-center text-exomere border border-solid rounded-full border-exomere text-base font-semibold leading-6 hover:bg-exomere hover:text-white shadow transition-all duration-700">
                        {{__('messages.submit')}}
                    </button>
                </div>
            </form>
        </div>

    </div>

    <!-- Display success message if available -->
    @if (session('success'))

        <div id="toast-default"
             class="fixed bottom-5 right-5 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow"
             role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-blue-500 bg-blue-100 rounded-lg">
                <svg class="w-5 h-5 text-blue-600 rotate-45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m9 17 8 2L9 1 1 19l8-2Zm0 0V9"/>
                </svg>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session('success') }}</div>
            <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8"
                    data-dismiss-target="#toast-default" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif

@endsection

@section('page-script')

@endsection


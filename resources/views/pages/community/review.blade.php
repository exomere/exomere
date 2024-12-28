<?php

?>
@extends('pages.layouts.subLayout')
@section('title', __('gnb.review'))

@section('id', 'review')
@section('visual_title',  __('gnb.review') )
@section('visual_sub_title', '')
@section('visual_background', 'https://cdn.pixabay.com/photo/2016/11/29/06/56/abstract-1867937_1280.jpg')

@section('page-style')

@endsection
@section('content')

    <table class="w-full border-t-2 border-solid border-gray-900"
           data-aos="fade-up">
        <colgroup>
            <col class="max-sm:hidden w-16"> {{--번호--}}
            <col class="w-32"> {{--상품--}}
            <col class="max-sm:hidden w-24"> {{--카테고리--}}
            <col> {{--제목--}}
            <col class="max-sm:hidden w-16"> {{--작성자--}}
            <col class="max-sm:hidden w-16"> {{--추천--}}
            <col class="w-16"> {{--평점--}}
        </colgroup>
        <thead>
        <tr class="h-20 font-normal border-b border-solid border-slate-200">
            <th class="max-sm:hidden align-middle text-center">{{ __('common.number') }}</th>
            <th class="align-middle text-center">{{ __('common.product_info') }}</th>
            <th class="max-sm:hidden align-middle text-center">{{ __('common.category') }}</th>
            <th class="align-middle text-center">{{ __('common.title') }}</th>
            <th class="max-sm:hidden align-middle text-center">{{ __('common.author') }}</th>
            <th class="max-sm:hidden align-middle text-center">{{ __('common.recommend') }}</th>
            <th class="align-middle text-center">{{ __('common.rating') }}</th>
        </tr>
        </thead>
        <tbody class="text-sm">
        @foreach($items as $item)
            <tr class="h-20 font-normal border-b border-solid border-slate-200 cursor-pointer"
                onclick="location.href = '{{ route('reviewDetail', $item->id) }}'">
                <td class="max-sm:hidden align-middle text-center p-1">{{ $item->id }}</td>
                <td class="align-middle text-center p-1">
                    @if(app()->getLocale() == 'ko')
                        {{ $item->item->name }}
                    @else
                        {{ $item->item->name_en }}
                    @endif
                </td>
                <td class="max-sm:hidden align-middle text-center p-1">
                    {{ $item->item->code }}
                </td>
                <td class="align-middle align-middle p-1">
                    {{ $item->title }}
                </td>
                <td class="max-sm:hidden align-middle text-center p-1">
                    {{ $item->author_name }}
                </td>
                {{--추천--}}
                <td class="max-sm:hidden align-middle text-center p-1">
                    {{ $item->likes_count }}
                </td>
                {{-- 평점 --}}
                <td class="align-middle text-center p-1">
                    <div class="flex items-center">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $item->rating)
                                <!-- 채워진 별 -->
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                            @else
                                <!-- 빈 별 -->
                                <svg class="w-4 h-4 text-gray-300" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                            @endif
                        @endfor
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{--paging--}}
    <div class="my-10">
        {{ $items->links() }}
    </div>

    {{--search--}}
    <div class="my-10">
        <form action="{{ route('reviews') }}" method="get">
            <div class="flex items-center space-x-2 max-w-sm min-w-[200px] border border-solid border-gray-300">
                <!-- Input Field -->
                <input type="text" placeholder="{{ __('messages.enter_keyword') }}"
                       name="search_keyword"
                       value="{{ request()->get('search_keyword')}}"
                       class="w-full px-2 border-none outline-none text-base placeholder-gray-400 text-gray-700">
                <!-- Search Button -->
                <button type="submit" class="px-4 py-2 bg-base-color text-sm text-white">
                    <!-- Search Icon -->
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
        </form>

    </div>

@endsection

@section('page-script')
@endsection


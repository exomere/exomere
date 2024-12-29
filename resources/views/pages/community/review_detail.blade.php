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
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <div class="w-full">
        <div class="size-full overflow-y-auto bg-white">
            <div class="flex flex-col min-h-screen mx-auto">

                <article class="min-h-svh overflow-y-auto">
                    <div class="max-w-2xl mx-auto p-4 bg-white">

                        <!-- Product info -->
{{--                        <div class="bg-gray-50 px-4 py-2 rounded-lg mb-8 relative">--}}
                        <div class="border border-solid border-gray-300 px-4 py-1 rounded-lg mb-8 relative">
                            <a href="/products/{{ $review->item->id }}">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                <div class="flex flex-wrap items-center">

                                    <img src="{{ Storage::url('public/data/'.$review->item->thum_img) }}" alt="Product Image"
                                         class="rounded-lg w-24 h-24 object-cover"
                                         onerror="this.src='//exomere.co.kr/storage/data/noimg.jpg';"/>

                                    <div class="flex-1 p-4">
                                        <div class="text-gray-600">
                                            {{ $review->item->code }}
                                        </div>
                                        <div class="text-gray-600">
                                            @if(app()->getLocale() == 'ko')
                                                {{ $review->item->name }}
                                            @else
                                                {{ $review->item->name_en }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        {{--리뷰 컨텐츠--}}
                        <x-review-item :review="$review"/>

                        {{--이전/다음글--}}
                        <div class="flex flex-row justify-between mt-10">
                            <div>
                                @if($previousReview)
                                    <a href="{{ route('reviewDetail', $previousReview->id) }}"
                                       class="flex flex-row -ms-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15.75 19.5 8.25 12l7.5-7.5"/>
                                        </svg>
                                        {{ __('common.previous_review') }}
                                    </a>

                                @endif
                            </div>
                            <div>
                                @if($nextReview)
                                    <a href="{{ route('reviewDetail', $nextReview->id) }}"
                                       class="flex flex-row -me-1">
                                        {{ __('common.next_review') }}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                                        </svg>

                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{--목록으로--}}
                    <div class="text-center">
                        <a href="{{ route('reviews') }}"
                           class="inline-block mt-12 border border-solid border-black py-3 px-24 text-base break-keep">
                            {{ __('common.to_list') }}
                        </a>
                    </div>

                </article>

            </div>

        </div>
    </div>

@endsection

@section('page-script')
    <script>

    </script>
@endsection


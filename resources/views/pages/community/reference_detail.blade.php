<?php

?>
@extends('pages.layouts.subLayout')
@section('title', __('gnb.reference'))

@section('id', 'reference')
@section('visual_title',  __('gnb.reference') )
@section('visual_sub_title', '')
@section('visual_background', 'https://cdn.pixabay.com/photo/2016/11/29/06/56/abstract-1867937_1280.jpg')

@section('page-style')

@endsection
@section('content')

    <div class="w-full border-t-2 border-solid border-gray-900">
        <div class="size-full overflow-y-auto bg-white">
            <div
                class="flex flex-col min-h-screen mx-auto">

                <article class="min-h-svh overflow-y-auto border-b border-solid border-slate-200">
                    <div
                        class="flex flex-col sm:flex-row justify-between px-3 py-8 border-b border-solid border-slate-200">
                        <h1 class="text-xl font-medium text-gray-900">{{ $item['title' ]}}</h1>

                        <div class="text-gray-500 sm:text-right">
                            {{ substr($item['created_at'], 0,10) }}
                        </div>
                    </div>

                    <div class="text-md p-5">
                        <p
                            class="break-keep leading-loose text-gray-900 mb-4">
                            {!! $item['contents'] !!}
                        </p>
                    </div>
                </article>
                <div class="flex">
                    <p class="lg:w-56 border border-l-0 border-slate-200 border-solid padding text-center text-gray-500 ">
                        첨부파일</p>
                    <div
                        class="flex-1 flex items-center border border-solid border-slate-200 border-x-0">
                        @if(count($item['attachments']))
                            <ul class="ps-5 text-gray-500 leading-loose ">

                                @foreach( $item['attachments'] as $attach)
                                    <li class="relative __icon __{{$item['attach_type']}}">
                                        <a
                                            href="{{ asset($attach) }}"
                                            download="{{ basename($attach) }}"
                                            class="text-blue-600 hover:underline">{{ basename($attach) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                </div>

                <div class="text-center">
                    <a href="javascript:history.back()"
                       class="inline-block mt-12 border border-solid border-black py-3 px-24 text-base break-keep">
                        목록으로
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-script')

@endsection


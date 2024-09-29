<?php

?>
@extends('pages.layouts.subLayout')
@section('title', __('gnb.notice'))

@section('id', 'notice')
@section('visual_title',  __('gnb.notice') )
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
                    <div class="flex flex-row justify-between px-3 py-8 border-b border-solid border-slate-200">
                        <h1 class="text-xl font-medium text-gray-900">{{ $item['title' ]}}</h1>

                        <div class="text-gray-500">{{ $item['created_at'] }}</div>
                    </div>

                    <div class="text-md p-5">
                        <p
                            class="break-keep leading-loose text-gray-900 mb-4">
                            {!! $item['content'] !!}
                        </p>
                    </div>
                </article>
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


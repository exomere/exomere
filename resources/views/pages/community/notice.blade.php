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

    <table class="w-full border-t-2 border-solid border-gray-900"
           data-aos="fade-up">
        <colgroup>
            <col class="w-16">
            <col>
            <col class="w-24">
        </colgroup>
        @foreach($items as $item)
            <tr class="h-20 font-normal border-b border-solid border-slate-200">
                <td class="align-middle	text-center">{{ $item['id'] }}</td>
                <td class="align-middle relative">
                    <a href="{{ route('community.noticeDetail', ['notice_id' => $item['id']]) }}"
                       class="cursor-pointer hover:underline">
                        {{ $item['subject'] }}
                    </a>
                </td>
                <td class="align-middle	 text-center">
                    {{ $item['created_at'] }}
                </td>
            </tr>
        @endforeach
    </table>



    {{--paging--}}
    <nav aria-label="Page navigation example" class="hidden my-10">
        <ul class="flex items-center justify-center -space-x-px h-8 text-sm">
            <li>
                <a href="#"
                   class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                    <span class="sr-only">Previous</span>
                    <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                </a>
            </li>
            <li>
                <a href="#"
                   class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">1</a>
            </li>
            <li>
                <a href="#"
                   class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">2</a>
            </li>
            <li>
                <a href="#" aria-current="page"
                   class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700">3</a>
            </li>
            <li>
                <a href="#"
                   class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">4</a>
            </li>
            <li>
                <a href="#"
                   class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">5</a>
            </li>
            <li>
                <a href="#"
                   class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                    <span class="sr-only">Next</span>
                    <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                </a>
            </li>
        </ul>
    </nav>

@endsection

@section('page-script')
@endsection


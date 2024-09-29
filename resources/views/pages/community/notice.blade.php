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
                <td class="align-middle	text-center">{{ $item->id }}</td>
                <td class="align-middle relative">
                    <a href="{{ route('community.noticeDetail', ['notice_id' => $item->id]) }}"
                       class="cursor-pointer hover:underline">
                        {{ $item->title }}
                    </a>
                </td>
                <td class="align-middle	 text-center">
                    {{ substr($item->created_at, 0,10) }}
                </td>
            </tr>
        @endforeach
    </table>



    {{--paging--}}
    <div class="my-10">
        {{ $items->links() }}
    </div>

@endsection

@section('page-script')
@endsection


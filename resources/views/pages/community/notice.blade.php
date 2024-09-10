<?php

$items = [
//번호, 제목, 작성자, 작성일, 조회수, 내용
    [
        'id' => 1,
        'subject' => '엑소미어 라스베가스 워크샵 개최',
        'created_id' => 'Admin',
        'created_at' => \Illuminate\Support\Carbon::create(2024, 7, 9, 12, 00, 00)->toDateString(),
        'contents' => '<div class="contents p-2 p-lg-3"><p></p><div style="text-align: center;"><span style="font-size: 24px;"><span style="background-color: rgb(204, 153, 0); color: rgb(255, 255, 255);"><br></span></span></div><div style="text-align: center;"><span style="font-size: 24px;"><span style="background-color: rgb(204, 153, 0); color: rgb(255, 255, 255);"><br></span></span></div><div style="text-align: center;"><span style="font-size: 24px;"><span style="background-color: rgb(204, 153, 0); color: rgb(255, 255, 255);"><br></span></span></div><div style="text-align: center;"><span style="font-size: 24px;"><span style="background-color: rgb(204, 153, 0); color: rgb(255, 255, 255);"><br></span></span></div><div style="text-align: center;"><span style="font-size: 24px;"><span style="background-color: rgb(204, 153, 0); color: rgb(255, 255, 255);">라스베가스<span style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);"> </span></span>에서 <span style="color: rgb(255, 0, 0);">엑소미어 워크샵</span>을 개최합니다!</span></div><div style="text-align: center;"><span style="font-size: 24px;"><br></span></div><div style="text-align: center;">많은 관신 부탁드립니다.</div><div style="text-align: center;"><br></div><div style="text-align: center;"><br></div><div style="text-align: center;"><br></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><b><br></b></span></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><b><br></b></span></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><b><span style="font-size: 24px;">시간: 2024. 07. 24. 수요일</span></b></span></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><b><span style="font-size: 24px;">      8:00 PM~11:00 PM</span></b></span></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><br></span></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><br></span></div><div style="text-align: center;"><b style="color: rgb(255, 0, 0);"><span style="font-size: 18px;">장소: 5725 S Valley View Blvd Suite 7 Las Vegas, NV, 89118</span></b></div><div style="text-align: center;"><b style="color: rgb(255, 0, 0);"><span style="font-size: 18px;"><br></span></b></div><div style="text-align: center;"><b style="color: rgb(255, 0, 0);"><span style="font-size: 18px;"><br></span></b></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><br></span></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><br></span></div><div style="text-align: center;"><a href="https://www.google.com/maps/place/5725+S+Valley+View+Blvd+Suite+7,+Las+Vegas,+NV+89118+%EB%AF%B8%EA%B5%AD/data=!4m2!3m1!1s0x80c8c78439f8d841:0x5471c5c12f2d53ec?sa=X&amp;ved=1t:242&amp;ictx=111" target="_self"><img src="https://www.google.com/maps/vt/data=oNPo3qO-Wngn7r-MKDYFf21xRwUUGolqjxRzu4ZekZRG_Kbpzpi8kyfZJC_pUzZ66WVRf618zscGJXvXhnrB-eB6T09RKVKgHa83c32g3-mxxafE3J-ApcX6L7QPElkqlPpWgg3YbmpTSpGx0V7ySoFBxNnObew7eNSI8RTOPpciHTXHtL6CGIBzP00YxihlD1HHBe6cEjkDYZmExsIpOehyUV_I8qHF4qI"></a></div><p></p><!--img src="https://via.placeholder.com/1920x2000/eee.png/777" alt="Content Image" /--></div>',
        'views_count' => 100,
    ],
    [
        'id' => 2,
        'subject' => '엑소미어 라스베가스 워크샵 개최2',
        'created_id' => 'Admin',
        'created_at' => \Illuminate\Support\Carbon::create(2024, 8, 23, 12, 00, 00)->toDateString(),
        'contents' => '공지 테스트 ',
        'views_count' => 0,
    ],
];

$jsonData = json_encode($items, JSON_UNESCAPED_UNICODE);
?>
@extends('pages.layouts.subLayout')
@section('title', __('gnb.notice'))

@section('id', 'notice')
@section('visual_title',  __('gnb.notice') )
@section('visual_sub_title', __('gnb.notice_title'))
@section('visual_background', 'https://cdn.pixabay.com/photo/2016/11/29/06/56/abstract-1867937_1280.jpg')

@section('page-style')

@endsection
@section('content')

    <div class="relative overflow-x-auto ">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500" data-aos="fade-up">
            <colgroup>
                <col class="w-20 max-sm:hidden">
                <col class="max-w-lg">
                <col class="w-20 max-sm:hidden">
                <col class="w-32">
                <col class="w-20 max-sm:hidden">
            </colgroup>
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-4 max-sm:hidden">
                    {{ __('messages.no') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('messages.subject') }}
                </th>
                <th scope="col" class="px-6 py-3 max-sm:hidden">
                    {{ __('messages.created_id') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('messages.created_at') }}
                </th>
                <th scope="col" class="px-6 py-3 max-sm:hidden">
                    {{ __('messages.views_count') }}
                </th>
            </tr>
            </thead>
            <tbody>

            @foreach($items as $item)
                <!-- Modal toggle -->
                <tr class="bg-white hover:bg-gray-50"
                    onclick="openContentModal('{{$loop->index}}')">
                    <td class="px-6 py-4 max-sm:hidden">{{ $item['id'] }}</td>
                    <td class="px-6 py-4">{{ $item['subject'] }}</td>
                    <td class="px-6 py-4 max-sm:hidden">{{ $item['created_id'] }}</td>
                    <td class="px-6 py-4">{{ mb_strcut($item['created_at'],0, 10) }}</td>
                    <td class="px-6 py-4 max-sm:hidden">{{ $item['views_count'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>


        <!-- modal -->
        <div class="hidden" id="contents-modal" tabindex="-1" aria-hidden="true">
            <div
                class="bg-white fixed h-full left-0 min-h-svh top-0 w-full z-[201] overflow-y-auto padding">
                <div class="fixed right-5 lg:right-20">
                    <button type="button"
                            class="bg-exomere opacity-75 p-3 lg:p-7 rounded-full text-white"
                            onclick="closeModal('contents-modal')" aria-hidden="false">
                        <svg class="close-btn h-7 w-7 z-[101]" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div
                    class="min-sm:max-container min-h-screen padding-y mx-auto lg:padding-x lg:px-4 py-8 flex flex-col">
                    <div class="padding">
                        <article class="bg-white min-h-svh overflow-y-auto">
                            <h1 id="modal-title"
                                class="text-2xl lg:text-4xl font-medium text-gray-900 mb-6"></h1>

                            <div id="modal-date" class="text-gray-600 mb-2 "></div>

                            <div class="text-md">
                                <p id="modal-contents"
                                   class="break-keep leading-loose text-gray-900 mb-4"></p>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--paging--}}
    <nav aria-label="Page navigation example" class="my-10">
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
    <script>

        const data = @json($jsonData);
        const items = JSON.parse(data);

        var openContentModal = function (index) {
            const modal = document.getElementById('contents-modal');
            modal.querySelector('#modal-date').innerHTML = items[index].created_at;
            modal.querySelector('#modal-title').innerHTML = items[index].subject;
            modal.querySelector('#modal-contents').innerHTML = items[index].contents;

            openModal('contents-modal');
        }

    </script>
@endsection


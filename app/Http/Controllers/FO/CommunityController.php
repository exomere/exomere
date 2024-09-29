<?php

namespace App\Http\Controllers\FO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function notice()
    {
        $items = [
            [
                'id' => 1,
                'subject' => '엑소미어 라스베가스 워크샵 개최',
                'created_id' => 'Admin',
                'created_at' => \Illuminate\Support\Carbon::create(2024, 7, 9, 12, 00, 00)->toDateString(),
                'contents' => '<div class="contents p-2 p-lg-3"><p></p><div style="text-align: center;"><span style="font-size: 24px;"><span style="background-color: rgb(204, 153, 0); color: rgb(255, 255, 255);"><br></span></span></div><div style="text-align: center;"><span style="font-size: 24px;"><span style="background-color: rgb(204, 153, 0); color: rgb(255, 255, 255);"><br></span></span></div><div style="text-align: center;"><span style="font-size: 24px;"><span style="background-color: rgb(204, 153, 0); color: rgb(255, 255, 255);"><br></span></span></div><div style="text-align: center;"><span style="font-size: 24px;"><span style="background-color: rgb(204, 153, 0); color: rgb(255, 255, 255);"><br></span></span></div><div style="text-align: center;"><span style="font-size: 24px;"><span style="background-color: rgb(204, 153, 0); color: rgb(255, 255, 255);">라스베가스<span style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);"> </span></span>에서 <span style="color: rgb(255, 0, 0);">엑소미어 워크샵</span>을 개최합니다!</span></div><div style="text-align: center;"><span style="font-size: 24px;"><br></span></div><div style="text-align: center;">많은 관신 부탁드립니다.</div><div style="text-align: center;"><br></div><div style="text-align: center;"><br></div><div style="text-align: center;"><br></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><b><br></b></span></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><b><br></b></span></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><b><span style="font-size: 24px;">시간: 2024. 07. 24. 수요일</span></b></span></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><b><span style="font-size: 24px;">      8:00 PM~11:00 PM</span></b></span></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><br></span></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><br></span></div><div style="text-align: center;"><b style="color: rgb(255, 0, 0);"><span style="font-size: 18px;">장소: 5725 S Valley View Blvd Suite 7 Las Vegas, NV, 89118</span></b></div><div style="text-align: center;"><b style="color: rgb(255, 0, 0);"><span style="font-size: 18px;"><br></span></b></div><div style="text-align: center;"><b style="color: rgb(255, 0, 0);"><span style="font-size: 18px;"><br></span></b></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><br></span></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><br></span></div><div style="text-align: center;"><a href="https://www.google.com/maps/place/5725+S+Valley+View+Blvd+Suite+7,+Las+Vegas,+NV+89118+%EB%AF%B8%EA%B5%AD/data=!4m2!3m1!1s0x80c8c78439f8d841:0x5471c5c12f2d53ec?sa=X&amp;ved=1t:242&amp;ictx=111" target="_self"><img src="https://www.google.com/maps/vt/data=oNPo3qO-Wngn7r-MKDYFf21xRwUUGolqjxRzu4ZekZRG_Kbpzpi8kyfZJC_pUzZ66WVRf618zscGJXvXhnrB-eB6T09RKVKgHa83c32g3-mxxafE3J-ApcX6L7QPElkqlPpWgg3YbmpTSpGx0V7ySoFBxNnObew7eNSI8RTOPpciHTXHtL6CGIBzP00YxihlD1HHBe6cEjkDYZmExsIpOehyUV_I8qHF4qI"></a></div><p></p><!--img src="//placehold.co/1920x2000/eee.png/777" alt="Content Image" /--></div>',
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


        return view('pages.community.notice', compact('items'));
    }

    public function noticeDetail($notice_id)
    {
        $items = [
            [
                'id' => 1,
                'subject' => '엑소미어 라스베가스 워크샵 개최',
                'created_id' => 'Admin',
                'created_at' => \Illuminate\Support\Carbon::create(2024, 7, 9, 12, 00, 00)->toDateString(),
                'contents' => '<div class="contents p-2 p-lg-3"><p></p><div style="text-align: center;"><span style="font-size: 24px;"><span style="background-color: rgb(204, 153, 0); color: rgb(255, 255, 255);"><br></span></span></div><div style="text-align: center;"><span style="font-size: 24px;"><span style="background-color: rgb(204, 153, 0); color: rgb(255, 255, 255);"><br></span></span></div><div style="text-align: center;"><span style="font-size: 24px;"><span style="background-color: rgb(204, 153, 0); color: rgb(255, 255, 255);"><br></span></span></div><div style="text-align: center;"><span style="font-size: 24px;"><span style="background-color: rgb(204, 153, 0); color: rgb(255, 255, 255);"><br></span></span></div><div style="text-align: center;"><span style="font-size: 24px;"><span style="background-color: rgb(204, 153, 0); color: rgb(255, 255, 255);">라스베가스<span style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);"> </span></span>에서 <span style="color: rgb(255, 0, 0);">엑소미어 워크샵</span>을 개최합니다!</span></div><div style="text-align: center;"><span style="font-size: 24px;"><br></span></div><div style="text-align: center;">많은 관신 부탁드립니다.</div><div style="text-align: center;"><br></div><div style="text-align: center;"><br></div><div style="text-align: center;"><br></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><b><br></b></span></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><b><br></b></span></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><b><span style="font-size: 24px;">시간: 2024. 07. 24. 수요일</span></b></span></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><b><span style="font-size: 24px;">      8:00 PM~11:00 PM</span></b></span></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><br></span></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><br></span></div><div style="text-align: center;"><b style="color: rgb(255, 0, 0);"><span style="font-size: 18px;">장소: 5725 S Valley View Blvd Suite 7 Las Vegas, NV, 89118</span></b></div><div style="text-align: center;"><b style="color: rgb(255, 0, 0);"><span style="font-size: 18px;"><br></span></b></div><div style="text-align: center;"><b style="color: rgb(255, 0, 0);"><span style="font-size: 18px;"><br></span></b></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><br></span></div><div style="text-align: center;"><span style="color: rgb(255, 0, 0);"><br></span></div><div style="text-align: center;"><a href="https://www.google.com/maps/place/5725+S+Valley+View+Blvd+Suite+7,+Las+Vegas,+NV+89118+%EB%AF%B8%EA%B5%AD/data=!4m2!3m1!1s0x80c8c78439f8d841:0x5471c5c12f2d53ec?sa=X&amp;ved=1t:242&amp;ictx=111" target="_self"><img src="https://www.google.com/maps/vt/data=oNPo3qO-Wngn7r-MKDYFf21xRwUUGolqjxRzu4ZekZRG_Kbpzpi8kyfZJC_pUzZ66WVRf618zscGJXvXhnrB-eB6T09RKVKgHa83c32g3-mxxafE3J-ApcX6L7QPElkqlPpWgg3YbmpTSpGx0V7ySoFBxNnObew7eNSI8RTOPpciHTXHtL6CGIBzP00YxihlD1HHBe6cEjkDYZmExsIpOehyUV_I8qHF4qI"></a></div><p></p><!--img src="//placehold.co/1920x2000/eee.png/777" alt="Content Image" /--></div>',
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


        $item = collect($items)->where('id', $notice_id)->first();

        if (!$item) {
            abort(404);
        }

        return view(
            'pages.community.notice_detail',
            [
                'item' => $item
            ]
        );
    }

    public function reference()
    {
        $items = [
            [
                'id' => 1,
                'subject' => '엑소미어 바디케어 리뉴얼 자료',
                'created_id' => 'Admin',
                'created_at' => \Illuminate\Support\Carbon::create(2024, 7, 9, 12, 00, 00)->toDateString(),
                'contents' => '  <div><p style="text-align: center;display:inline-flex; column-gap: 16px;"><img src="//placehold.co/300x400"><img src="//placehold.co/300x400"><img src="//placehold.co/300x400"></p><p style="text-align: center"><br></p><p style="text-align: center"><strong>바디케어 리뉴얼 이미지 입니다.</strong></p><p style="text-align: center"><br></p><p style="text-align: center">(관련자료는 첨부파일을 확인해 주세요)</p><p><br></p></div>',
                'views_count' => 100,
                'attach_type' => 'pdf',
                'attachments' => [
                    'bodycream.pdf',
                    'bodyscrub.pdf',
                    'bodywash.pdf',
                ],
            ],
            [
                'id' => 2,
                'subject' => '엑소미어 헤어케어 리뉴얼 이미지',
                'created_id' => 'Admin',
                'created_at' => \Illuminate\Support\Carbon::create(2024, 8, 10, 12, 00, 00)->toDateString(),
                'contents' => '  <div><p style="text-align: center;display:inline-flex; column-gap: 16px;"><img src="//placehold.co/400x300"><img src="//placehold.co/400x300"></p><p style="text-align: center"><br></p><p style="text-align: center"><strong>헤어케어 리뉴얼 이미지 입니다.</strong></p><p style="text-align: center"><br></p><p style="text-align: center">(관련자료는 첨부파일을 확인해 주세요)</p><p><br></p></div>',
                'views_count' => 0,
                'attach_type' => 'image',
                'attachments' => [
                    'hairsampoo.png',
                    'hairsampoo2.png',
                ],
            ],
            [
                'id' => 3,
                'subject' => '엑소미어 동영상',
                'created_id' => 'Admin',
                'created_at' => \Illuminate\Support\Carbon::create(2024, 8, 10, 12, 00, 00)->toDateString(),
                'contents' => '  <div><p style="text-align: center;display:inline-flex; column-gap: 16px;"><img src="//placehold.co/900x500"></p><p style="text-align: center"><br></p><p style="text-align: center"><strong>동영상을 리뉴얼 했습니다 .</strong></p><p style="text-align: center"><br></p><p style="text-align: center">(관련자료는 첨부파일을 확인해 주세요)</p><p><br></p></div>',
                'views_count' => 0,
                'attach_type' => 'video',
                'attachments' => [
                    'hairsampoo.mp4',
                ],
            ],
        ];

        return view('pages.community.reference', compact('items'));
    }

    public function referenceDetail($reference_id)
    {
        $items = [
            [
                'id' => 1,
                'subject' => '엑소미어 바디케어 리뉴얼 자료',
                'created_id' => 'Admin',
                'created_at' => \Illuminate\Support\Carbon::create(2024, 7, 9, 12, 00, 00)->toDateString(),
                'contents' => '  <div><p style="text-align: center;display:inline-flex; column-gap: 16px;"><img src="//placehold.co/300x400"><img src="//placehold.co/300x400"><img src="//placehold.co/300x400"></p><p style="text-align: center"><br></p><p style="text-align: center"><strong>바디케어 리뉴얼 이미지 입니다.</strong></p><p style="text-align: center"><br></p><p style="text-align: center">(관련자료는 첨부파일을 확인해 주세요)</p><p><br></p></div>',
                'views_count' => 100,
                'attach_type' => 'pdf',
                'attachments' => [
                    'bodycream.pdf',
                    'bodyscrub.pdf',
                    'bodywash.pdf',
                ],
            ],
            [
                'id' => 2,
                'subject' => '엑소미어 헤어케어 리뉴얼 이미지',
                'created_id' => 'Admin',
                'created_at' => \Illuminate\Support\Carbon::create(2024, 8, 10, 12, 00, 00)->toDateString(),
                'contents' => '  <div><p style="text-align: center;display:inline-flex; column-gap: 16px;"><img src="//placehold.co/400x300"><img src="//placehold.co/400x300"></p><p style="text-align: center"><br></p><p style="text-align: center"><strong>헤어케어 리뉴얼 이미지 입니다.</strong></p><p style="text-align: center"><br></p><p style="text-align: center">(관련자료는 첨부파일을 확인해 주세요)</p><p><br></p></div>',
                'views_count' => 0,
                'attach_type' => 'image',
                'attachments' => [
                    'hairsampoo.png',
                    'hairsampoo2.png',
                ],
            ],
            [
                'id' => 3,
                'subject' => '엑소미어 동영상',
                'created_id' => 'Admin',
                'created_at' => \Illuminate\Support\Carbon::create(2024, 8, 10, 12, 00, 00)->toDateString(),
                'contents' => '  <div><p style="text-align: center;display:inline-flex; column-gap: 16px;"><img src="//placehold.co/900x500"></p><p style="text-align: center"><br></p><p style="text-align: center"><strong>동영상을 리뉴얼 했습니다 .</strong></p><p style="text-align: center"><br></p><p style="text-align: center">(관련자료는 첨부파일을 확인해 주세요)</p><p><br></p></div>',
                'views_count' => 0,
                'attach_type' => 'video',
                'attachments' => [
                    'hairsampoo.mp4',
                ],
            ],
        ];

        $item = collect($items)->where('id', $reference_id)->first();

        if (!$item) {
            abort(404);
        }

        return view(
            'pages.community.reference_detail',
            [
                'item' => $item
            ]
        );
    }


    public function inquiry()
    {
        return view('pages.community.inquiry');
    }
}
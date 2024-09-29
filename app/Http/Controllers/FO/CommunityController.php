<?php

namespace App\Http\Controllers\FO;

use App\Models\ExInquire;
use App\Models\ExNotice;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;

class CommunityController extends BaseController
{

    public function notice(Request $request)
    {
        $page = $request->get('page') ?? $this->page;
        $limit = $request->get('limit') ?? $this->limit;

        $items = ExNotice::orderBy('id', 'desc')
            ->paginate($limit, ['*'], 'page', $page);

        return view('pages.community.notice', compact('items'));
    }

    public function noticeDetail($notice_id)
    {
        $item = ExNotice::findOrFail($notice_id);

        return view(
            'pages.community.notice_detail',
            compact('item')
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

    public function inquiryStore(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'company_name' => 'required|string|max:100',
            'nation' => 'required|string:max:3',
            'email' => 'required|string|max:100',
        ]);

        $user = auth()->user();

        // 데이터 저장
        ExInquire::create([
            'title' => '홈페이지 1:1 문의가 접수되었습니다',
            'content' => $request->input('content'),
            'company_name' => $request->input('company_name'),
            'nation' => $request->input('nation'),
            'email' => $request->input('email'),
            'author_name' => $user ? $user->name : 'Unknown',
            'author_seq' => $user ? $user->id : 0
        ]);

        return redirect()->route('fo.inquiry.list')->with('success', '문의를 등록했습니다.');
    }
}
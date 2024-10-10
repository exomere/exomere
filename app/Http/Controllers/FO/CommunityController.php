<?php

namespace App\Http\Controllers\FO;

use App\Models\ExInquire;
use App\Models\ExNotice;
use App\Models\ExReference;
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

    public function reference(Request $request)
    {
        $page = $request->get('page') ?? $this->page;
        $limit = $request->get('limit') ?? $this->limit;

        $items = ExReference::orderBy('id', 'desc')
            ->paginate($limit, ['*'], 'page', $page);

        return view('pages.community.reference', compact('items'));
    }

    public function referenceDetail($reference_id)
    {
        $item = ExReference::findOrFail($reference_id);

        return view(
            'pages.community.reference_detail',
            compact('item')
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
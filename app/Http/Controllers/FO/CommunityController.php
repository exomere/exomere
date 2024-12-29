<?php

namespace App\Http\Controllers\FO;

use App\Models\ExInquire;
use App\Models\ExItem;
use App\Models\ExNotice;
use App\Models\ExReference;
use App\Models\ExReview;
use App\Models\ExReviewLike;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        $items = ExReference::where('is_active', 'Y')->orderBy('id', 'desc')
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

    public function reviews(Request $request)
    {
        $page = $request->get('page') ?? $this->page;
        $limit = $request->get('limit') ?? $this->limit;
        $search_keyword = $request->get('search_keyword') ?? null;

        //검색
        $items = ExReview::with('item')
            ->withCount('likes')
            ->when($search_keyword, function ($q) use ($search_keyword) {
                $q->where('title', 'like', '%' . $search_keyword . '%')
                    ->orWhere('content', 'like', '%' . $search_keyword . '%');
            })
            ->orderByDesc('id')
            ->orderByDesc('rating')
            ->paginate($limit, ['*'], 'page', $page);

        foreach ($items as &$item) {
            $item->author_name = Str::mask($item->author_name, '*', 1);
        }

        return view('pages.community.review', compact('items'));
    }

    public function reviewDetail(ExReview $review)
    {
        $review->load(['item', 'comments'])
            ->loadCount('likes');

        $review->author_name = Str::mask($review->author_name, '*', 1);

        // 로그인상태면 이미 좋아요 누른 리뷰인지 체크
        $review->liked = false;
        if (auth()->id()) {
            $review->liked = $review->likedByUser(auth()->id());
        }

        $previousReview = $review->previous();
        $nextReview = $review->next();

        return view('pages.community.review_detail', compact('review', 'previousReview', 'nextReview'));
    }


    /**
     * 리뷰 좋아요 토글
     * @param int $review_id
     * @return bool[]
     */
    public function setLikeReview(int $review_id)
    {
        // 이미 좋아요를 눌렀는지 확인
        $likeItem = ExReviewLike::where('author_seq', auth()->id())
            ->where('review_seq', $review_id)
            ->first();

        $liked = true;
        if ($likeItem) {
            // 좋아요를 이미 눌렀다면 삭제
            $likeItem->delete();
            $liked = false;
        } else {
            // 좋아요가 없으면 생성
            ExReviewLike::create([
                'author_seq' => auth()->id(),
                'review_seq' => $review_id,
            ]);
        }

        return ['liked' => $liked];
    }


    public function reviewsStore(Request $request)
    {
        $request->validate([
            'product_seq' => 'required|exists:ex_items,id',
            'title' => 'required|max:100',
            'content' => 'required|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        ExReview::create([
            'author_seq' => auth()->id(),
            'author_name' => auth()->user()->name,
            'product_seq' => $request->product_seq,
            'title' => strip_tags($request->get('title')),
            'content' => strip_tags($request->get('content')),
            'rating' => $request->get('rating'),
        ]);

        return response()->json(['message' => '리뷰가 등록되었습니다!'], 201);
    }
}
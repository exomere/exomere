<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Exomere;
use App\Models\ExReview;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class ErpReviewController extends Exomere
{
    public function list (Request $request)
    {
        $limitPage = $this->getPageLimit();
        $page = $request->get('page') ?? 1;

        $query = ExReview::where('nation',$request->session()->get('member_nation'))->with('item')
            ->withCount('likes');

        // 검색어가 있을 경우 쿼리에 필터 추가
        if ($request->has('search_text') && $request->get('search_text') !== '') {
            $search_text = $request->get('search_text');
            $query->where(function ($q) use ($search_text) {
                $q->where('title', 'like', '%' . $search_text . '%')
                    ->orWhere('content', 'like', '%' . $search_text . '%');
            });
        }

        $lists = $query->orderBy('id', 'desc')->paginate($limitPage);

        if (!is_null($request->get('search_text'))) {
            $search_text = $request->get('search_text');
        }

        $data = [
            "search_text" => $search_text ?? '',
            "lists" =>  $lists ?? [],
            "row_num" => $this->getPageRowNumber($lists->count(), $page, $limitPage) ?? null,
        ];

        return view('pages.erp.board.review.list')->with($data);
    }
    public function detail (int $id)
    {
        $item = ExReview::with(['item', 'comments'])
            ->withCount('likes')
            ->findOrFail($id);

        // 로그인상태면 이미 좋아요 누른 리뷰인지 체크
        if (auth()->id()) {
            $item->liked = $item->likedByUser(auth()->id());
        } else {
            $item->liked = null;
        }

        return view('pages.erp.board.review.detail', compact('item'));
    }

    public function comment (Request $request, int $id): RedirectResponse
    {

        $request->validate([
            'content' => 'required|string',
        ]);

        $review = ExReview::findOrFail($id);

        $review->comments()->create([
            'content' => $request->content,
            'author_name' => auth()->user()->name,
            'author_seq' => auth()->id(),
        ]);

        return redirect()->route('erp-board.review.detail', $id)->with('success', '답변이 성공적으로 등록되었습니다.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Exomere;
use App\Models\ExNotice;
use App\Models\ExInquire;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class ErpBoardController extends Exomere
{
    /**
     * Display a listing of the notices.
     *
     * @param Request $request
     * @return View
     */
    public function noticeList (Request $request)
    {
        $limitPage = $this->getPageLimit();
        $page = $request->get('page', 1);

        $notices = ExNotice::orderBy('id', 'desc')->paginate($limitPage);

        $datas = [
            "notices" => $notices,
            "row_num" => $this->getPageRowNumber($notices->total(), $page, $limitPage)
        ];

        return view('pages.erp.board.notice.list')->with($datas);
    }

     /**
     * Show the form for creating a new notice.
     *
     * @return View
     */
    public function noticeCreate()
    {
        return view('pages.erp.board.notice.create');
    }

    /**
     * Store a newly created notice in the database.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function noticeStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $user = auth()->user();

        ExNotice::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'author_name' => $user ? $user->name : 'Unknown',
            'author_seq' => $user ? $user->id : 0
        ]);

        return redirect()->route('erp-board.notice.list')->with('success', 'Notice created successfully.');
    }

    /**
     * Show the form for editing the specified notice.
     *
     * @param $id
     * @return View
     */
    public function noticeDetail($id)
    {
        $notice = ExNotice::findOrFail($id);
        return view('pages.erp.board.notice.detail', compact('notice')); // Ensure the view exists
    }

    /**
     * Show the form for editing the specified notice.
     *
     * @param $id
     * @return View
     */
    public function noticeEdit($id)
    {
        $notice = ExNotice::findOrFail($id);
        return view('pages.erp.board.notice.edit', compact('notice')); // Ensure the view exists
    }

    /**
     * Update the specified notice in the database.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function noticeUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $notice = ExNotice::findOrFail($id);
        $notice->update([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);

        return redirect()->route('erp-board.notice.list')->with('success', 'Notice updated successfully.');
    }

    /**
     * Remove the specified notice from the database.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function noticeDestroy($id)
    {
        $notice = ExNotice::findOrFail($id);
        $notice->delete();
        return redirect()->route('erp-board.notice.list')->with('success', 'Notice deleted successfully.');
    }


    /**
     * Display a listing of the notices.
     *
     * @param Request $request
     * @return View
     */
    public function inquiryList(Request $request)
    {
        $limitPage = $this->getPageLimit();
        $page = $request->get('page', 1);

        $inquires = ExInquire::orderBy('id', 'desc')->paginate($limitPage);

        $datas = [
            "inquires" => $inquires,
            "row_num" => $this->getPageRowNumber($inquires->total(), $page, $limitPage)
        ];

        return view('pages.inquiry.list')->with($datas);
    }

    /**
     * Show the form for creating a new notice.
     *
     * @return View
     */
    public function inquiryCreate()
    {
        return view('pages.inquiry.create');
    }

    /**
     * Store a newly created notice in the database.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function inquiryStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $user = auth()->user();

        ExInquire::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'author_name' => $user ? $user->name : 'Unknown',
            'author_seq' => $user ? $user->id : 0
        ]);

        return redirect()->route('inquiry.list')->with('success', 'Inquiry created successfully.');
    }

    /**
     * Show the form for editing the specified notice.
     *
     * @param $id
     * @return View
     */
    public function inquiryDetail($id)
    {
        $inquiry = ExInquire::with('comments')->findOrFail($id);

        return view('pages.inquiry.detail', compact('inquiry')); // Ensure the view exists
    }

    /**
     * Show the form for editing the specified notice.
     *
     * @param $id
     * @return View
     */
    public function inquiryEdit($id)
    {
        $inquiry = ExInquire::findOrFail($id);
        return view('pages.inquiry.edit', compact('inquiry')); // Ensure the view exists
    }

    /**
     * Update the specified notice in the database.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function inquiryUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $inquiry = ExInquire::findOrFail($id);
        $inquiry->update([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);

        return redirect()->route('inquiry.list')->with('success', 'Inquiry updated successfully.');
    }

    /**
     * Remove the specified notice from the database.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function inquiryDestroy($id)
    {
        $notice = ExInquire::findOrFail($id);
        $notice->delete();
        return redirect()->route('inquiry.list')->with('success', 'Inquiry deleted successfully.');
    }

    public function inquiryStoreComment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $inquiry = ExInquire::findOrFail($id);

        $inquiry->comments()->create([
            'content' => $request->content,
            'author_name' => auth()->user()->name,
            'author_seq' => auth()->id(),
        ]);

        $inquiry->update([
            'status' => "completed"
        ]);

        return redirect()->route('inquiry.detail', $id)->with('success', '답변이 성공적으로 등록되었습니다.');
    }
}

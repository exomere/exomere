<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Exomere;
use App\Models\ExInquire;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InquiryController extends Exomere
{
    /**
     * Display a listing of the notices.
     *
     * @param Request $request
     * @return View
     */
    public function list(Request $request)
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
    public function create()
    {
        return view('pages.inquiry.create');
    }

    /**
     * Store a newly created notice in the database.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
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
    public function detail($id)
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
    public function edit($id)
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
    public function update(Request $request, $id)
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
    public function destroy($id)
    {
        $notice = ExInquire::findOrFail($id);
        $notice->delete();
        return redirect()->route('inquiry.list')->with('success', 'Inquiry deleted successfully.');
    }

    public function storeComment(Request $request, $id)
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

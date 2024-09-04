<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Exomere;
use App\Models\ExNotice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NoticeController extends Exomere
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

        $notices = ExNotice::orderBy('id', 'desc')->paginate($limitPage);

        $datas = [
            "notices" => $notices,
            "row_num" => $this->getPageRowNumber($notices->total(), $page, $limitPage)
        ];

        return view('pages.notice.list')->with($datas);
    }

    /**
     * Show the form for creating a new notice.
     *
     * @return View
     */
    public function create()
    {
        return view('pages.notice.create');
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

        ExNotice::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'author_name' => $user ? $user->name : 'Unknown',
            'author_seq' => $user ? $user->id : 0
        ]);

        return redirect()->route('notice.list')->with('success', 'Notice created successfully.');
    }

    /**
     * Show the form for editing the specified notice.
     *
     * @param $id
     * @return View
     */
    public function detail($id)
    {
        $notice = ExNotice::findOrFail($id);
        return view('pages.notice.detail', compact('notice')); // Ensure the view exists
    }

    /**
     * Show the form for editing the specified notice.
     *
     * @param $id
     * @return View
     */
    public function edit($id)
    {
        $notice = ExNotice::findOrFail($id);
        return view('pages.notice.edit', compact('notice')); // Ensure the view exists
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

        $notice = ExNotice::findOrFail($id);
        $notice->update([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);

        return redirect()->route('notice.list')->with('success', 'Notice updated successfully.');
    }

    /**
     * Remove the specified notice from the database.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $notice = ExNotice::findOrFail($id);
        $notice->delete();
        return redirect()->route('notice.list')->with('success', 'Notice deleted successfully.');
    }
}

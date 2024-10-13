<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Exomere;
use App\Models\ExNotice;
use App\Models\ExInquire;
use App\Models\ExVideo;
use App\Models\ExReference;
use App\Models\ExNews;
use App\Models\ExBanner;

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

        return view('pages.erp.board.inquiry.list')->with($datas);
    }

    /**
     * Show the form for creating a new notice.
     *
     * @return View
     */
    public function inquiryCreate()
    {
        return view('pages.erp.board.inquiry.create');
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

        return view('pages.erp.board.inquiry.detail', compact('inquiry')); // Ensure the view exists
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
        return view('pages.erp.board.inquiry.edit', compact('inquiry')); // Ensure the view exists
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

    /**
     * Display a listing of the newss.
     *
     * @param Request $request
     * @return View
     */
    public function newsList (Request $request)
    {

        
        $limitPage = $this->getPageLimit();
        $page = $request->get('page', 1);

        $newss = ExNews::orderBy('id', 'desc')->paginate($limitPage);

        $datas = [
            "newss" => $newss,
            "row_num" => $this->getPageRowNumber($newss->total(), $page, $limitPage)
        ];

        return view('pages.erp.board.news.list')->with($datas);
    }

     /**
     * Show the form for creating a new news.
     *
     * @return View
     */
    public function newsCreate()
    {
        return view('pages.erp.board.news.create');
    }

    /**
     * Store a newly created news in the database.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function newsStore(Request $request)
    {

      
        $request->validate([
            'title' => 'required|string|max:255',
            'contents' => 'required',
        ]);

        $user = auth()->user();

        $save_data = [
            'title' => $request->input('title'),
            'contents' => $request->input('contents'),
            'category' => $request->input('category'),
            'author_name' => $user ? $user->name : 'Unknown',
            'is_active' => $request->input('is_active') ?? 'N',
        ];

        if ($request->hasFile('thumbnail')) {
            $fileName = time() . '_' . str_replace(" ","",$request->file('thumbnail')->getClientOriginalName());
            $request->file('thumbnail')->storeAs('public/data/board', $fileName);
            $save_data['thumbnail'] =  "storage/data/board/".$fileName;
        }
        
        ExNews::create($save_data);

        return redirect()->route('erp-board.news.list')->with('success', 'news created successfully.');
    }

    /**
     * Show the form for editing the specified news.
     *
     * @param $id
     * @return View
     */
    public function newsDetail($id)
    {
        $news = ExNews::findOrFail($id);
        return view('pages.erp.board.news.detail', compact('news')); // Ensure the view exists
    }

    /**
     * Show the form for editing the specified news.
     *
     * @param $id
     * @return View
     */
    public function newsEdit($id)
    {
        $news = ExNews::findOrFail($id);
        return view('pages.erp.board.news.edit', compact('news')); // Ensure the view exists
    }

    /**
     * Update the specified news in the database.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function newsUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'contents' => 'required',
        ]);

        $news = ExNews::findOrFail($id);
       
        $save_data = [
            'title' => $request->input('title'),
            'contents' => $request->input('contents'),
            'category' => $request->input('category'),
            'is_active' => $request->input('is_active') ?? 'N',
        ];

        if ($request->hasFile('thumbnail')) {
            $fileName = time() . '_' . str_replace(" ","",$request->file('thumbnail')->getClientOriginalName());
            $request->file('thumbnail')->storeAs('public/data/board', $fileName);
            $save_data['thumbnail'] = "storage/data/board/".$fileName;
        }

        $news->update($save_data);


        return redirect()->route('erp-board.news.list')->with('success', 'news updated successfully.');
    }

    /**
     * Remove the specified news from the database.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function newsDestroy($id)
    {
        $news = ExNews::findOrFail($id);
        $news->delete();
        return redirect()->route('erp-board.news.list')->with('success', 'news deleted successfully.');
    }
/**
     * Display a listing of the videos.
     *
     * @param Request $request
     * @return View
     */
    public function videoList (Request $request)
    {
        $limitPage = $this->getPageLimit();
        $page = $request->get('page', 1);

        $videos = ExVideo::orderBy('id', 'desc')->paginate($limitPage);

        $datas = [
            "videos" => $videos,
            "row_num" => $this->getPageRowNumber($videos->total(), $page, $limitPage)
        ];

        return view('pages.erp.board.video.list')->with($datas);
    }

     /**
     * Show the form for creating a new video.
     *
     * @return View
     */
    public function videoCreate()
    {
        return view('pages.erp.board.video.create');
    }

    /**
     * Store a newly created video in the database.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function videoStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        $save_data = [
            'title' => $request->input('title'),
            'author_name' => $user ? $user->name : 'Unknown',
            'is_active' => $request->input('is_active') ?? 'N',
        ];

        if ($request->hasFile('thumbnail')) {
            $fileName = time() . '_' . str_replace(" ","",$request->file('thumbnail')->getClientOriginalName());
            $request->file('thumbnail')->storeAs('public/data/board', $fileName);
            $save_data['thumbnail'] = "storage/data/board/".$fileName;
        }

        if ($request->hasFile('video')) {
            $fileName = time() . '_' . str_replace(" ","",$request->file('video')->getClientOriginalName());
            $request->file('video')->storeAs('public/data/board/video', $fileName);
            $save_data['video'] = "storage/data/board/video".$fileName;
        }
        
        ExVideo::create($save_data);

        return redirect()->route('erp-board.video.list')->with('success', 'video created successfully.');
    }

    /**
     * Show the form for editing the specified video.
     *
     * @param $id
     * @return View
     */
    public function videoDetail($id)
    {
        $video = ExVideo::findOrFail($id);
        return view('pages.erp.board.video.detail', compact('video')); // Ensure the view exists
    }

    /**
     * Show the form for editing the specified video.
     *
     * @param $id
     * @return View
     */
    public function videoEdit($id)
    {
        $video = ExVideo::findOrFail($id);
        return view('pages.erp.board.video.edit', compact('video')); // Ensure the view exists
    }

    /**
     * Update the specified video in the database.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function videoUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $video = ExVideo::findOrFail($id);

        $save_data = [
            'title' => $request->input('title'),
            'is_active' => $request->input('is_active') ?? 'N',
        ];

        if ($request->hasFile('thumbnail')) {
            $fileName = time() . '_' . str_replace(" ","",$request->file('thumbnail')->getClientOriginalName());
            $request->file('thumbnail')->storeAs('public/data/board', $fileName);
            $save_data['thumbnail'] = "storage/data/board/".$fileName;
        }

        if ($request->hasFile('video')) {
            $fileName = time() . '_' . str_replace(" ","",$request->file('video')->getClientOriginalName());
            $request->file('video')->storeAs('public/data/board/video', $fileName);
            $save_data['video'] = "storage/data/board/video/".$fileName;
        }
  
        $video->update($save_data);

        return redirect()->route('erp-board.video.list')->with('success', 'video updated successfully.');
    }

    /**
     * Remove the specified video from the database.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function videoDestroy($id)
    {
        $video = ExVideo::findOrFail($id);
        $video->delete();
        return redirect()->route('erp-board.video.list')->with('success', 'video deleted successfully.');
    }

/**
     * Display a listing of the references.
     *
     * @param Request $request
     * @return View
     */
    public function referenceList (Request $request)
    {
        $limitPage = $this->getPageLimit();
        $page = $request->get('page', 1);

        $references = ExReference::orderBy('id', 'desc')->paginate($limitPage);

        $datas = [
            "references" => $references,
            "row_num" => $this->getPageRowNumber($references->total(), $page, $limitPage)
        ];

        return view('pages.erp.board.reference.list')->with($datas);
    }

     /**
     * Show the form for creating a new reference.
     *
     * @return View
     */
    public function referenceCreate()
    {
        return view('pages.erp.board.reference.create');
    }

    /**
     * Store a newly created reference in the database.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function referenceStore(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'contents' => 'required',
        ]);


        $user = auth()->user();
        $save_data = [
            'title' => $request->input('title'),
            'contents' => $request->input('contents'),
            "attach_type" => "image",
            'author_name' => $user ? $user->name : 'Unknown',
            'is_active' => $request->input('is_active') ?? 'N',
        ];
        
        if ($request->hasFile('file1')) {
            $fileName = date("ymd_his")."_".str_replace(" ","",$request->file('file1')->getClientOriginalName());
            $request->file('file1')->storeAs('public/data/board/upload', $fileName);
            $save_data['attachments'][] = "storage/data/board/upload/".$fileName;
        }
        if ($request->hasFile('file2')) {
            $fileName = date("ymd_his")."_".str_replace(" ","",$request->file('file2')->getClientOriginalName());
            $request->file('file2')->storeAs('public/data/board/upload', $fileName);
            $save_data['attachments'][] = "storage/data/board/upload/".$fileName;
        }
        if ($request->hasFile('file3')) {
            $fileName = date("ymd_his")."_".str_replace(" ","",$request->file('file3')->getClientOriginalName());
            $request->file('file3')->storeAs('public/data/board/upload', $fileName);
            $save_data['attachments'][] = "storage/data/board/upload/".$fileName;
        }
        if ($request->hasFile('file4')) {
            $fileName = date("ymd_his")."_".str_replace(" ","",$request->file('file4')->getClientOriginalName());
            $request->file('file4')->storeAs('public/data/board/upload', $fileName);
            $save_data['attachments'][] = "storage/data/board/upload/".$fileName;
        }
        if ($request->hasFile('file5')) {
            $fileName = date("ymd_his")."_".str_replace(" ","",$request->file('file5')->getClientOriginalName());
            $request->file('file5')->storeAs('public/data/board/upload', $fileName);
            $save_data['attachments'][] = "storage/data/board/upload/".$fileName;
        }
        ExReference::create($save_data);

        return redirect()->route('erp-board.reference.list')->with('success', 'reference created successfully.');
    }

    /**
     * Show the form for editing the specified reference.
     *
     * @param $id
     * @return View
     */
    public function referenceDetail($id)
    {
        $reference = ExReference::findOrFail($id);
        return view('pages.erp.board.reference.detail', compact('reference')); // Ensure the view exists
    }

    /**
     * Show the form for editing the specified reference.
     *
     * @param $id
     * @return View
     */
    public function referenceEdit($id)
    {
        $reference = ExReference::findOrFail($id);
        return view('pages.erp.board.reference.edit', compact('reference')); // Ensure the view exists
    }

    /**
     * Update the specified reference in the database.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function referenceUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'contents' => 'required',
        ]);

        $reference = ExReference::findOrFail($id);

        $save_data = [
            'title' => $request->input('title'),
            'contents' => $request->input('contents'),
            "attach_type" => "image",
            'is_active' => $request->input('is_active') ?? 'N',
        ];
        
        if ($request->hasFile('file1')) {
            $fileName = date("ymd_his")."_".str_replace(" ","",$request->file('file1')->getClientOriginalName());
            $request->file('file1')->storeAs('public/data/board/upload', $fileName);
            $save_data['attachments'][] = "storage/data/board/upload/".$fileName;
        }
        if ($request->hasFile('file2')) {
            $fileName = date("ymd_his")."_".str_replace(" ","",$request->file('file2')->getClientOriginalName());
            $request->file('file2')->storeAs('public/data/board/upload', $fileName);
            $save_data['attachments'][] = "storage/data/board/upload/".$fileName;
        }
        if ($request->hasFile('file3')) {
            $fileName = date("ymd_his")."_".str_replace(" ","",$request->file('file3')->getClientOriginalName());
            $request->file('file3')->storeAs('public/data/board/upload', $fileName);
            $save_data['attachments'][] = "storage/data/board/upload/".$fileName;
        }
        if ($request->hasFile('file4')) {
            $fileName = date("ymd_his")."_".str_replace(" ","",$request->file('file4')->getClientOriginalName());
            $request->file('file4')->storeAs('public/data/board/upload', $fileName);
            $save_data['attachments'][] = "storage/data/board/upload/".$fileName;
        }
        if ($request->hasFile('file5')) {
            $fileName = date("ymd_his")."_".str_replace(" ","",$request->file('file5')->getClientOriginalName());
            $request->file('file5')->storeAs('public/data/board/upload', $fileName);
            $save_data['attachments'][] = "storage/data/board/upload/".$fileName;
        }

        $reference->update($save_data);

        return redirect()->route('erp-board.reference.list')->with('success', 'reference updated successfully.');
    }

    /**
     * Remove the specified reference from the database.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function referenceDestroy($id)
    {
        $reference = ExReference::findOrFail($id);
        $reference->delete();
        return redirect()->route('erp-board.reference.list')->with('success', 'reference deleted successfully.');
    }



    /**
     * Display a listing of the banners.
     *
     * @param Request $request
     * @return View
     */
    public function bannerList (Request $request)
    {

        
        $limitPage = $this->getPageLimit();
        $page = $request->get('page', 1);

        $banners = ExBanner::orderBy('id', 'desc')->paginate($limitPage);

        $datas = [
            "banners" => $banners,
            "row_num" => $this->getPageRowNumber($banners->total(), $page, $limitPage)
        ];

        return view('pages.erp.board.banner.list')->with($datas);
    }

     /**
     * Show the form for creating a new banner.
     *
     * @return View
     */
    public function bannerCreate()
    {
        return view('pages.erp.board.banner.create');
    }

    /**
     * Store a newly created banner in the database.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function bannerStore(Request $request)
    {

      
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'link' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        $save_data = [
            'title' => $request->input('title'),
            'sub_title' => $request->input('sub_title'),
            'type' => $request->input('type'),
            'link' => $request->input('link'),
            'is_active' => $request->input('is_active') ?? 'N',
            'author_name' => $user ? $user->name : 'Unknown',
        ];

        if ($request->hasFile('thumbnail')) {
            $fileName = time() . '_' . str_replace(" ","",$request->file('thumbnail')->getClientOriginalName());
            $request->file('thumbnail')->storeAs('public/data/board', $fileName);
            $save_data['thumbnail'] = "storage/data/board/".$fileName;
        }
        
        ExBanner::create($save_data);

        return redirect()->route('erp-board.banner.list')->with('success', 'banner created successfully.');
    }

    /**
     * Show the form for editing the specified banner.
     *
     * @param $id
     * @return View
     */
    public function bannerDetail($id)
    {
        $banner = ExBanner::findOrFail($id);
        return view('pages.erp.board.banner.detail', compact('banner')); // Ensure the view exists
    }

    /**
     * Show the form for editing the specified banner.
     *
     * @param $id
     * @return View
     */
    public function bannerEdit($id)
    {
        $banner = ExBanner::findOrFail($id);
        return view('pages.erp.board.banner.edit', compact('banner')); // Ensure the view exists
    }

    /**
     * Update the specified banner in the database.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function bannerUpdate(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'link' => 'required|string|max:255',
        ]);

        $banner = ExBanner::findOrFail($id);

        $save_data = [
            'title' => $request->input('title'),
            'sub_title' => $request->input('sub_title'),
            'type' => $request->input('type'),
            'link' => $request->input('link'),
            'is_active' => $request->input('is_active') ?? 'N',
        ];

        if ($request->hasFile('thumbnail')) {
            $fileName = time() . '_' . str_replace(" ","",$request->file('thumbnail')->getClientOriginalName());
            $request->file('thumbnail')->storeAs('public/data/board', $fileName);
            $save_data['thumbnail'] = "storage/data/board/".$fileName;
        }

        $banner->update($save_data);


        return redirect()->route('erp-board.banner.list')->with('success', 'banner updated successfully.');
    }

    /**
     * Remove the specified banner from the database.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function bannerDestroy($id)
    {
        $banner = ExBanner::findOrFail($id);
        $banner->delete();
        return redirect()->route('erp-board.banner.list')->with('success', 'banner deleted successfully.');
    }
}

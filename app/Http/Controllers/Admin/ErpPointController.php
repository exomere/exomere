<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Exomere;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ExMember;

class ErpPointController extends Exomere
{
    /**
     * Display a listing of the notices.
     *
     * @param Request $request
     * @return View
     */
    public function list (Request $request)
    {
        $limitPage = $this->getPageLimit();
        $page = $request->get('page') ?? 1;

        $ex_members = ExMember::where('member_level','<',10)->orderBy('id', 'desc')->paginate($limitPage);

        if (!is_null($request->get('search_text'))) {
            $search_text = $request->get('search_text');
        }

        $data = [
            "search_text" => $search_text ?? '',
            "ex_members" =>  $ex_members ?? [],
            "row_num" => $this->getPageRowNumber($ex_members->count(), $page, $limitPage) ?? null,
        ];

        return view('pages.erp.point.list')->with($data);
    }
}

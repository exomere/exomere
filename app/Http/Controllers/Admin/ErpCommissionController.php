<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Exomere;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ErpCommissionController extends Exomere
{
    /**
     * Display a listing of the notices.
     *
     * @param Request $request
     * @return View
     */
    public function termClosing (Request $request)
    {
        return view('pages.erp.commission.termClosing')->with([]);
    }


    /**
     * Display a listing of the notices.
     *
     * @param Request $request
     * @return View
     */
    public function monthlyClosing (Request $request)
    {
        return view('pages.erp.commission.monthlyClosing')->with([]);
    }
}

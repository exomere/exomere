<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Exomere;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ErpWithdrawalController extends Exomere
{
    /**
     * Display a listing of the notices.
     *
     * @param Request $request
     * @return View
     */
    public function list (Request $request)
    {
        return view('pages.erp.withdrawal.list')->with([]);
    }
}

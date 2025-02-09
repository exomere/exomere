<?php

namespace App\Http\Controllers\FO;


use App\Models\ExCenter;
use Illuminate\Http\Request;

class AboutController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function branch(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $items = ExCenter::active()
            ->whereNotNull('address')
            ->get();

        return view('pages.about.branch', compact('items'));
    }

}

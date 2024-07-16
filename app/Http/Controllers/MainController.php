<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Exomere;
use Illuminate\Support\Facades\Auth;

class MainController extends Exomere
{

    public function index()
    {
        return view('pages.main');
    }

}

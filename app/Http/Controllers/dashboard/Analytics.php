<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Analytics extends Controller
{
  public function index()
  {
    dd(request()->server());
    return view('content.dashboard.dashboards-analytics');
  }
}

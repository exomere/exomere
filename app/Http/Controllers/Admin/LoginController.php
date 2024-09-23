<?php

namespace App\Http\Controllers\Admin;

use App\Models\ExMember;
use App\Http\Controllers\Exomere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Exomere
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $pwd = $request->password ?? null;
        $id = $request->id ?? null;

        $userInfo = ExMember::where('member_id', $id)->where("member_pw", DB::raw("UPPER(SHA1(UNHEX(SHA1('".env('LOGIN_KEY'). $pwd . "'))))"))->first();

        if ($userInfo) {
            $request->session()->regenerate();
            $request->session()->put('member_seq', $userInfo->id ?? '');
            $request->session()->put('member_id', $userInfo->member_id ?? '');
            $request->session()->put('member_name', $userInfo->name ?? '');
            $request->session()->put('member_type', $userInfo->member_type ?? '');
            $request->session()->put('member_code', $userInfo->code ?? '');
            $request->session()->put('member_level', $userInfo->member_level ?? '');

            auth()->login($userInfo);

            return redirect('/management/dashboard');
            
        } else {
            return redirect('/login');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

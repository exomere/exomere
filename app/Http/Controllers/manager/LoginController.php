<?php

namespace App\Http\Controllers\Manager;

use App\Models\Member;
use App\Http\Controllers\Exomere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $userInfo = Member::where('id', $id)->whereRaw("pw = UPPER(SHA1(UNHEX(SHA1('".env('LOGIN_KEY'). $pwd . "'))))")->first();
        
        if (!empty($userInfo->seq)) {
            $request->session()->regenerate();
            $request->session()->put('member_id', $userInfo->id ?? '');
            $request->session()->put('member_seq', $userInfo->seq ?? '');
            $request->session()->put('member_name', $userInfo->name ?? '');
            $request->session()->put('member_type', $userInfo->type ?? '');
            $request->session()->put('member_code', $userInfo->code ?? '');

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

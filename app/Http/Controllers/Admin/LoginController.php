<?php

namespace App\Http\Controllers\Admin;

use App\Models\ExMember;
use App\Http\Controllers\Exomere;
use App\Models\ExDistribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
class LoginController extends Exomere
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {        
       
        $back_url = url()->previous();
        $datas = [
            'back_url' =>$back_url ?? "/",
        ];
        return view('auth.login')->with($datas);
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
            $request->session()->put('member_position', $userInfo->member_position ?? '');
            $request->session()->put('member_type', $userInfo->member_type ?? '');
            $request->session()->put('member_code', $userInfo->code ?? '');
            $request->session()->put('member_level', $userInfo->member_level ?? '');
            $request->session()->put('site_code', $userInfo->site_code ?? 'exomere');
            $request->session()->put('member_nation', $userInfo->nation ?? 'KR');
        
            $distribute = ExDistribute::where('director_seq',$userInfo->id)->first();

            if($userInfo->site_code != 'exomere'){
                $user_distribute = ExDistribute::where('code',$userInfo->site_code)->first();
                $request->session()->put('director_name', $user_distribute->director_name ?? '정성헌');
                $request->session()->put('director_company', $user_distribute->name ?? '(주)엑소미어');
                $request->session()->put('director_business_num', $user_distribute->business_num ?? '');
                $request->session()->put('director_phone', $user_distribute->director_phone ?? '02-1577-1586');
                $request->session()->put('director_address', $user_distribute->address ?? '서울 송파구 법원로11길 11 (문정동, 문정현대지식산업센터1-1) ');
                $request->session()->put('director_address_detail', $user_distribute->address_detail ?? 'A동 204호');
                $request->session()->put('director_code', $user_distribute->pg_code ?? '29151');
            }

            if(isset($distribute)){
                if($distribute->code != 'exomere'){
                    $request->session()->put('member_type','director');    
                    $request->session()->put('site_code', $distribute->code);
                }
            }

            $localearray = [
                'KR' => 'ko',
                'JP' => 'jp',
                'USA' => 'en',
                'CN' => 'cn',
            ];

            $nation = $localearray[$userInfo->nation] ?? 'ko';

            Session::put('locale', $nation);
            App::setLocale($nation);

            auth()->login($userInfo);
            // if($request->back_url){
            //     return redirect($request->back_url);
            // }else{
                return redirect('/products');
            // }
            
            
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

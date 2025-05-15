<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRegisterRequest;
use App\Models\ExDistribute;
use App\Models\ExMember;
use App\Models\ExCenter;

use Illuminate\Http\Request;

class JoinController extends Controller
{
    public function signup(Request $request)
    {
        $recommendId = null;
        $recommendName = null;
        $recommendSeq = null;
        $distrCode = null;
        $nation = 'KR';

        $distr_data = ExDistribute::where('code',$request->code)->first();

        if(isset($distr_data->id)){
            $recommendId = $distr_data->director_id;
            $recommendName = $distr_data->director_name;
            $recommendSeq = $distr_data->director_seq;
            $nation = $distr_data->nation ?? 'KR';
            $distrCode = $distr_data->code;
        }


        $centers = ExCenter::where('is_active','Y')->get();
        $centerArray = [];
        $cnt = 0;

        foreach($centers as $center){
          $centerArray[$cnt]['seq'] = $center->id;
          $centerArray[$cnt]['name'] = $center->name;
          $cnt++;
        }

        return view('auth.signup', compact('recommendId', 'recommendName', 'recommendSeq','distrCode','centerArray','nation'));
    }

    public function checkId(Request $request)
    {
        $memberID = $request->query('member_id');
        $exists = ExMember::findByMemberId($memberID);

        return response()->json(['available' => !$exists]);
    }

    public function checkRecommendId(Request $request)
    {
        $recommendId = $request->query('recommend_id');
        $exMember = ExMember::findByMemberId($recommendId);

        if ($exMember) {
            return response()->json([
                'exists' => true,
                'recommendSeq' => $exMember->id,
                'recommendName' => $exMember->name,
            ]);
        }

        return response()->json(['exists' => false]);
    }

    public function register(MemberRegisterRequest $request)
    {
        
        $exMember = $this->createMember($request->validated(),$request->distr_code,$request->nation);

        if ($exMember) {
            return redirect()->route('login')->with('success', __('messages.register_success'));
        }

        return redirect()->back()->withErrors(['error' => __('messages.register_fail')]);
    }

    protected function createMember($data,$code,$nation)
    {
       
        $recomMember = ExMember::find($data['recommend_seq']);
        $distribute = ExDistribute::where('code',$code)->first();

        return ExMember::create([
            'member_id' => $data['member_id'],
            'member_pw' => strtoupper(sha1(hex2bin(sha1(env('LOGIN_KEY') . $data['password'])))),
            'name' => $data['name'],
            'phone' => $data['phone'],
            'tel' => $data['phone'],
            "distribute_seq" => $distribute->id ?? null,
            "recommend_id" => $recomMember->member_id ?? null,
            "recommend_name" => $recomMember->name ?? null,
            "member_type" => "user",
            "member_position" => "회원",
            'local_store' => $data['local_store'] ?? '26',
            'recommend_seq' => $data['recommend_seq'],
            'zip_code' => $data['zipcode'],
            'address' => $data['address'],
            'address_detail' => $data['address_detail'],
            'nation' => $nation,
            'email' => $data['email'],
            'site_code' => $code,
            'code' => $code,
            'is_delete' => 'N',
        ]);
    }
}

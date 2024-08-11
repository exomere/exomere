<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRegisterRequest;
use App\Models\ExMember;
use Illuminate\Http\Request;

class JoinController extends Controller
{
    public function signup($recommendId = null)
    {
        $recommendName = null;
        $recommendSeq = null;

        if ($recommendId) {
            $recruiter = ExMember::findByMemberId($recommendId);
            if ($recruiter) {
                $recommendName = $recruiter->name;
                $recommendSeq = $recruiter->id;
            }
        }

        return view('auth.signup', compact('recommendId', 'recommendName', 'recommendSeq'));
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
        $exMember = $this->createMember($request->validated());

        if ($exMember) {
            return redirect()->route('login')->with('success', __('messages.register_success'));
        }

        return redirect()->back()->withErrors(['error' => __('messages.register_fail')]);
    }

    protected function createMember(array $data)
    {
        return ExMember::create([
            'member_id' => $data['member_id'],
            'member_pw' => strtoupper(sha1(hex2bin(sha1(env('LOGIN_KEY') . $data['password'])))),
            'name' => $data['name'],
            'phone' => $data['phone'],
            'local_store' => $data['local_store'],
            'recommend_seq' => $data['recommend_seq'],
            'zip_code' => $data['zipcode'],
            'address' => $data['address'],
            'address_detail' => $data['address_detail'],
            'nation' => $data['nation'],
            'email' => $data['email'],
        ]);
    }
}

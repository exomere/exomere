<?php

namespace App\Http\Controllers\Admin;

use App\Constants\CommonConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateMemberAccountInformationRequest;
use App\Http\Requests\UpdateMemberBasicInformationRequest;
use App\Http\Requests\UpdateMemberPasswordRequest;
use App\Models\ExAccountInfo;
use App\Models\ExMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function info()
    {
        $user = auth()->user();
        $member = ExMember::findByMemberSeq($user->id);
        $recruiter = ExMember::findByMemberSeq($user->recommend_seq);
        $account = ExAccountInfo::findByMemberSeq($user->id);
        $bankList = CommonConstants::BANK_LIST;

        return view('pages.member.info', compact('member', 'recruiter', 'account', 'bankList'));
    }
    public function updateBasicInformation(UpdateMemberBasicInformationRequest $request)
    {
        $user = auth()->user();
        $user->update($request->only('phone', 'email'));

        $exMember = ExMember::find($user->id);

        if ($exMember) {
            $exMember->update($request->only('phone', 'email'));
        }

        return redirect()->back()->with('success', '기본정보가 업데이트되었습니다.');
    }

    public function updateAccountInformation(UpdateMemberAccountInformationRequest $request)
    {
        $userId = auth()->id();
        $data = $request->only('bank_code', 'account_number', 'account_name');

        $accountInfo = ExAccountInfo::where('member_seq', $userId)->first();

        if ($accountInfo) {
            $accountInfo->update($data);
        } else {
            ExAccountInfo::create(array_merge($data, ['member_seq' => $userId]));
        }

        return redirect()->back()->with('success', '계좌정보가 업데이트되었습니다.');
    }

    public function updatePassword(UpdateMemberPasswordRequest $request)
    {
        $user = auth()->user();

        $encryptedCurrentPassword = encryptPassword($request->current_password);

        if ($encryptedCurrentPassword !== $user->member_pw) {
            return redirect()->back()->withErrors(['current_password' => '현재 비밀번호가 맞지 않습니다.']);
        }

        $encryptedNewPassword = encryptPassword($request->new_password);

        $user->update(['member_pw' => $encryptedNewPassword]);

        return redirect()->back()->with('success', '비밀번호가 성공적으로 변경되었습니다.');
    }

    public function searchMember(Request $request)
    {
        $members = ExMember::where($request->type,'like','%'.$request->text.'%')->get();

        $output_data = [];
        $cnt = 0;

        foreach($members as $member){
            $output_data[$cnt]["seq"] = $member->id;
            $output_data[$cnt]["member_id"] = $member->member_id;
            $output_data[$cnt]["name"] = $member->name;
            $output_data[$cnt]["member_position"] = $member->member_position;
            $output_data[$cnt]["remain_points"] = $member->remain_points;
            $output_data[$cnt]["created_at"] = date("Y-m-d",strtotime($member->created_at));
            $cnt++;
        }   
        
        return json_encode($output_data,JSON_UNESCAPED_UNICODE);
    }
}

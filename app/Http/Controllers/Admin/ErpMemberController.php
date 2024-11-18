<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Exomere;
use App\Models\ExCenter;
use App\Models\ExMemberModificationLog;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ExMember;
use App\Constants\CommonConstants;
use App\Http\Controllers\API\OnPlatController;
class ErpMemberController extends Exomere
{
    CONST MEMBER_INFO_FIELD = [
        "member_id" => "회원 아이디",
        "name" => "회원명",
        "member_pw" => "비밀번호",
        "member_type" => "회원형태",
        "member_position" => "직급",
        "resident_number" => "주민등록번호",
        "tel" => "연락처",
        "phone" => "비밀번호",
        "email" => "이메일",
        "local_store" => "지역점",
        "zip_code" => "우편번호",
        "address" => "기본주소",
        "address_detail" => "상세주소",
        "bank" => "은행",
        "account_number" => "계좌번호",
        "account_holder" => "예금주",
        "recommend_id" => "모집인 id",
        "recommend_name" => "모집인 명",
        "is_delete" => "상태",
        "remark" => "비고",
    ];

    /**
     *
     * @param Request $request
     * @return View
     */
    public function list (Request $request)
    {

        $limitPage = $this->getPageLimit();
        $page = $request->get('page') ?? 1;

        $query = ExMember::where('member_level', '<', 10);

        if ($request->session()->get('member_level') != 99) {
            $query->whereIn("member_position", ["최우수총판", "우수총판", "총판", "회원"]);
        }

        // 검색어가 있을 경우 쿼리에 필터 추가
        if ($request->has('search_text') && $request->get('search_text') !== '') {
            $search_text = $request->get('search_text');
            $query->where(function ($q) use ($search_text) {
                $q->where('name', 'like', '%' . $search_text . '%')
                    ->orWhere('member_id', 'like', '%' . $search_text . '%')
                    ->orWhere('tel', 'like', '%' . $search_text . '%')
                    ->orWhere('phone', 'like', '%' . $search_text . '%')
                    ->orWhere('email', 'like', '%' . $search_text . '%');
            });
        }

        $ex_members = $query->where('is_delete','N')->orderBy('id', 'desc')->paginate($limitPage);

        $data = [
            "search_text" => $search_text ?? '',
            "ex_members" =>  $ex_members ?? [],
            "row_num" => $this->getPageRowNumber($ex_members->total(), $page, $limitPage) ?? null,
        ];

        return view('pages.erp.member.list')->with($data);
    }

    public function create(Request $request){

        if (isset($request->seq)) {
            $member = ExMember::find($request->seq);
            $recommend_info = $member->recommend_id . " | " . $member->recommend_name;
            $email_info = explode("@", $member->email);
            $resident_number_info = explode("-", $member->resident_number);
        }

        $centers = ExCenter::where('is_active','Y')->get();
        $centerArray = [];
        $cnt = 0;

        foreach($centers as $center){
          $centerArray[$cnt]['seq'] = $center->id;
          $centerArray[$cnt]['name'] = $center->name;
          $cnt++;
        }

        $data = [
            "bank_list" => CommonConstants::BANK_LIST,
            "member_seq" => $request->seq ?? null,
            "member" => $member ?? [],
            "center_array" => $centerArray,
            "email_info" => $email_info ?? null,
            "recommend_info" => $recommend_info ?? null,
            "resident_number_info" => $resident_number_info ?? null,
        ];

        return view('pages.erp.member.register')->with($data);
    }

    public function save(Request $request)
    {   
        
        $member_seq = $request->member_seq ?? null;
        // dd($request->input());
        $input_data = [
            "member_id" => $request->member_id,
            "name" => $request->name,
            "member_type" => "user",
            "member_level" => 1,
            "is_delete" => $request->is_delete ?? 'N',
            "remark" => $request->remark,
            "member_position" => $request->member_position,
            "tel" => $request->tel,
            "phone" => $request->phone,
            "resident_number" => $request->resident_number."-".$request->resident_number2,
            "email" => $request->email."@".$request->email2,
            "local_store" => $request->local_store,
            "recommend_seq" => $request->recommend_seq,
            "recommend_id" => explode(" | ", $request->recommend_info)[0],
            "recommend_name" => explode(" | ", $request->recommend_info)[1],
            "zip_code" => $request->zipcode,
            "address" => $request->address,
            "address_detail" => $request->address_detail,
            "nation" => $request->nation,
            "bank" => $request->bank,
            "account_number" => $request->account_number,
            "account_holder" => $request->account_holder,
            "is_delete" => $request->is_delete,
            "created_at" => $request->member_reg_date ?? date("Y-m-d H:i:s"),
        ];

        if(isset($request->member_pw)){
            $input_data["member_pw"] = $this->encryptPassword($request->member_pw);
        }

        $existingMember = ExMember::find($member_seq);
        if ($existingMember) {
            foreach ($input_data as $field => $new_value) {
                $old_value = $existingMember->$field;
                if ($old_value != $new_value) {
                    ExMemberModificationLog::create([
                        'member_seq' => $member_seq,
                        'field' => $field,
                        'old_value' => $old_value,
                        'new_value' => $new_value,
                        'modify_member_seq' => $request->session()->get('member_seq')
                    ]);
                }
            }
        }

        ExMember::UpdateOrCreate(
            [
                'id' => $member_seq,
            ],
            $input_data
        );
        
        return redirect()->route('erp-member.list');
    }

    public function del(Request $request)
    {
        ExMember::find($request->seq)->update(['is_delete' => 'Y']);
        return redirect()->route('erp-member.list');
    }

    public function getModifyList (Request $request)
    {
        $data = [];

        $seq = $request->seq;

        $data["member_info"] = ExMember::findByMemberSeq($seq)->toArray();
        $data["modify_info"] = ExMemberModificationLog::leftjoin('ex_members as b', 'ex_member_modification_logs.modify_member_seq', '=', 'b.id')
            ->where('member_seq', $seq)
            ->whereNotIn('field', ['recommend_seq'])
            ->orderBy('ex_member_modification_logs.created_at', 'desc')
            ->get(['ex_member_modification_logs.created_at', 'field', 'old_value', 'new_value', 'modify_member_seq', 'b.member_id'])->toArray();

        foreach ($data["modify_info"] as $key => $info) {
            if ($data["modify_info"][$key]["field"] == "member_pw") {
                $data["modify_info"][$key]["new_value"] = $data["modify_info"][$key]["old_value"] = "";
            }
            $data["modify_info"][$key]["field_name"] = self::MEMBER_INFO_FIELD[$data["modify_info"][$key]["field"]];
        }

        return response()->json($data);
    }
}

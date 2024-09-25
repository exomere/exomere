<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Exomere;
use App\Models\ExCenter;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ExMember;
use App\Constants\CommonConstants;
class ErpMemberController extends Exomere
{

    /**
     *
     * @param Request $request
     * @return View
     */
    public function list (Request $request)
    {

        $limitPage = $this->getPageLimit();
        $page = $request->get('page') ?? 1;

        $ex_members = ExMember::where('member_level','<',10)->orderBy('id', 'desc')->paginate($limitPage);

        if (!is_null($request->get('search_text'))) {
            $search_text = $request->get('search_text');
        }

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
        ];

        if(isset($request->member_pw)){
            $input_data["member_pw"] = $this->encryptPassword($request->member_pw);
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
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Exomere;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ExMember;
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
        }

        $data = [
            "member_seq" => $request->seq ?? null,
            "member" => $member ?? [],
        ];

        return view('pages.erp.member.register')->with($data);
    }

    public function save(Request $request)
    {
        $member_seq = $request->member_seq ?? null;

        $input_data = [
            "member_id" => $request->member_id,
            "name" => $request->name,
            "member_type" => "user",
            "member_level" => 1,
            "is_delete" => $request->is_delete ?? 'N',
            "remark" => $request->remark,
        ];

        if(isset($request->member_pw)){
            $input_data["member_pw"] = encryptPassword($request->member_pw);
        }

        ExMember::UpdateOrCreate(
            [
                'id' => $member_seq,
            ],
            $input_data
        );
        
        return redirect()->route('erp-member.list');
    }
}

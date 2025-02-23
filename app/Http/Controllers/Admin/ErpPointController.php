<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Exomere;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ExMember;
use App\Models\ExPointLog;

class ErpPointController extends Exomere
{

    CONST POINT_KIND = [
        "provision" => "지급",
        "sell" => "구매",
        "use" => "사용",
    ];
    /**
     * Display a listing of the notices.
     *
     * @param Request $request
     * @return View
     */
    public function list (Request $request)
    {
        $limitPage = $this->getPageLimit();
        $page = $request->get('page') ?? 1;
        
        $site_code = $request->session()->get('site_code') ?? "exomere";

        $query = ExMember::where('member_level', '<', 10)->where("site_code",$site_code)->where('nation',$request->session()->get('member_nation'));

        // 검색어가 있을 경우 쿼리에 필터 추가
        if ($request->has('search_text') && $request->get('search_text') !== '') {
            $search_text = $request->get('search_text');
            $query->where(function ($q) use ($search_text) {
                $q->where('name', 'like', '%' . $search_text . '%')
                    ->orWhere('member_id', 'like', '%' . $search_text . '%')
                    ->orWhere('tel', 'like', '%' . $search_text . '%')
                    ->orWhere('phone', 'like', '%' . $search_text . '%');
            });
        }

        $ex_members = $query->where('is_delete','N')->orderBy('id', 'desc')->paginate($limitPage);

        if (!is_null($request->get('search_text'))) {
            $search_text = $request->get('search_text');
        }

        $data = [
            "search_text" => $search_text ?? '',
            "ex_members" =>  $ex_members ?? [],
            "row_num" => $this->getPageRowNumber($ex_members->count(), $page, $limitPage) ?? null,
        ];

        return view('pages.erp.point.list')->with($data);
    }

    //포인트 지급
    public function provision(Request $request){
        $seq = $request->member_seq;

        $exMember = ExMember::find($seq);
        
        if($request->point_kind == 'provision'){
            $remain_points = ($exMember->remain_points + $request->provision_point);
            $payment_points = ($exMember->payment_points + $request->provision_point);
        }else{
            $remain_points = ($exMember->remain_points - $request->provision_point);
            $payment_points = ($exMember->payment_points - $request->provision_point);
        }
        
        $exMember->update([
            "remain_points" => $remain_points,
            "payment_points" => $payment_points,
        ]);

        ExPointLog::create([
            "kind" => $request->point_kind,
            "date" => date("Y-m-d H:i:s"),
            "member_seq" => $request->member_seq,
            "point" => $request->provision_point,
            "remark" => $request->remark,
            "reg_name" => $request->session()->get('member_name'),
        ]);
    }

    public function getPointList(Request $request){
        $seq = $request->seq;

        $exMember = ExMember::find($seq);
        $points = ExPointLog::where("member_seq",$seq);
        
        $output_data = [
            "member_id" => $exMember->member_id,
            "member_name" => $exMember->name,
            "remain_points" => $exMember->remain_points,
            "payment_points" => $exMember->payment_points,
            "total_count" => $points->count(),
        ];

        $cnt=0;

        foreach($points->get() as $point){
            $output_data['pointInfo'][$cnt]['kind'] = self::POINT_KIND[$point->kind];
            $output_data['pointInfo'][$cnt]['date'] = $point->date;
            $output_data['pointInfo'][$cnt]['reg_name'] = $point->reg_name;
            $output_data['pointInfo'][$cnt]['remark'] = $point->remark ?? ' - ';
            $output_data['pointInfo'][$cnt]['point'] = $point->point;
            $cnt++;
        }

        return json_encode($output_data);
    }
    
}

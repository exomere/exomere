<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Exomere;
use Illuminate\Http\Request;
use App\Models\ExOrder;
use App\Models\ExMember;
use App\Models\ExCenter;
use App\Models\ExMemberStatements;
use App\Models\ExStatements;

use Illuminate\View\View;

class ErpCommissionController extends Exomere
{
    /**
     * Display a listing of the notices.
     *
     * @param Request $request
     * @return View
     */
    public function termClosing (Request $request)
    {
        return view('pages.erp.commission.termClosing')->with([]);
    }


    /**
     * Display a listing of the notices.
     *
     * @param Request $request
     * @return View
     */
    public function monthlyClosing (Request $request)
    {
        return view('pages.erp.commission.monthlyClosing')->with([]);
    }

    /**
     *
     * @param Request $request
     * @return void
     */
    public function termCalculation (Request $request)
    {
        return view('pages.erp.commission.monthlyClosing')->with([]);
    }

    /**
     *
     * @param Request $request
     * @return void
     */
    public function monthlyCalculation (Request $request)
    {
        $settlement_month = $request->settlement_month;
        $deadline_date = $request->deadline_date;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $calcu_code = str_replace("-","",$settlement_month);
        
        /**   TEST AREA  START */
        
        /**   TEST AREA  START */

        $order_data = ExOrder::whereBetween('order_date', [$start_date, $end_date]);
        
        $total_amount = 0;
        $total_pv = 0;
        $total_payment = 0; 
        $actual_amount = 0; //실지급액은 3.3% ( * 0.033) 빼고 준것
        $mem_cnt = 0;
        $member_input_data = [];
        foreach($order_data->get() as $order){

            if($order->order_type == 'repurchase'){ // 주문구분이 재구매 주분인지 확인

                /* TODO 주문정보 테이블 컬럼추가로 인한 수정 생각해야함 */
                // $exMember = ExMember::findByMemberSeq( $order->member_seq );
                // $r_seq = $exMember->recommend_seq;
                
                $exMember = ExMember::findByMemberId( $order->member_id );
                $r_seq = ExMember::findByMemberId($exMember->recommend_id ?? 'oley')->id ?? null;
                
                $c_recruitment_amount = ($member_input_data[$r_seq]['recruitment_amount'] ?? 0) + ($order->total_pv * 0.09);
                $c_total_amount = ($member_input_data[$r_seq]['total_amount'] ?? 0) + $order->total_amount;
                $c_pv =  ($member_input_data[$r_seq]['pv'] ?? 0) + $order->total_pv;
                $c_payment_points = ($member_input_data[$r_seq]['recruitment_amount'] ?? 0) + ($order->total_pv * 0.01);

                $c_total_payment = $c_recruitment_amount + $c_payment_points;
                $c_income_tax = $c_total_payment * 0.03;
                $c_residence_tax = $c_total_payment * 0.003;
                $c_total_deduction = $c_income_tax + $c_residence_tax;
                $c_actual_amount = $c_total_payment - $c_total_deduction;

                /* TODO 주문정보 테이블 컬럼추가로 인한 수정 생각해야함 */
                // $member_input_data[$order->recommend_seq] = [
                //     "member_seq" => $order->recommend_seq,
                //     "member_id" => $order->recommend_id ?? 'oley',
                //     "member_name" => $order->recommend_name ?? 'oley',

                $member_input_data[$r_seq] = [
                    "member_seq" => $r_seq,
                    "member_id" => $exMember->recommend_id ?? 'oley',
                    "member_name" => $exMember->recommend_name ?? 'oley',
                    "pv" => $c_pv,
                    "total_amount" => $c_total_amount,
                    "recruitment_amount" => $c_recruitment_amount , //직접모집관리금
                    "payment_points" => $c_payment_points, // 포인트지급합계

                    // "incentives" => $c_incentives, //우수총판 인센티브
                    // "bouns" => $c_incentives, //우수총판 보너스
                    // "contribution_amount" => $c_contribution_amount, //우수총판기여금
                    // "contribution_amount2" => $c_contribution_amount2, //최우수총판기여금
                    // "promote_prive" => $c_promote_prive, //장려금

                    "total_payment" => $c_total_payment, // 지급합계 
                    "income_tax" => $c_income_tax, //소득세
                    "residence_tax" => $c_residence_tax, // 주민세
                    "total_deduction" => $c_total_deduction, // 공제합계
                    "actual_amount" => $c_actual_amount, //실지급액
                    
                ];
            
                $mem_cnt++;
            }

            $total_amount += $order->total_amount;
            $total_pv += $order->total_pv;
        }

        /* 한번 더 누를 시 삭제*/
        ExStatements::where("type","month")->where("code",$calcu_code)->delete();
        ExMemberStatements::where("type","month")->where("code",$calcu_code)->delete();

        ExStatements::create([
            "type" => "month",
            "code" => $calcu_code,
            "total_amount" => $total_amount,
            "total_pv" => $total_pv,
            "total_payment" => $total_payment, //합계금액
            "actual_amount" => $actual_amount, //실지급액
            "deadline_date" => $deadline_date,
            "s_date" => $start_date,
            "e_date" => $end_date
        ]);

        foreach( $member_input_data as $data){
            $data['code'] = $calcu_code;
            $data['type'] = "month";
            ExMemberStatements::create($data);
        }
        
        /* 지역점비 지원금 계산 */
        $this->monthlyCalculationCenter($calcu_code,$start_date, $end_date);

        /* 총판 수당 계산 */
        $this->monthlyCalculationRecommend($calcu_code,$start_date, $end_date);

        return redirect()->route('erp-allowance.monthly-closing');
    }

    /**
     * 총판수당 계산
     * @param Request $request
     * @return void
     */
    private function monthlyCalculationRecommend($calcu_code,$s_date, $e_date){

    }
    
    /**
     * 지역점비 지원금
     * @param Request $request
     * @return void
     */
    private function monthlyCalculationCenter($calcu_code,$s_date, $e_date){

        $center_data = ExCenter::all();

        foreach($center_data as $center){

            $center_total = ExOrder::whereBetween('order_date', [$s_date, $e_date])->where("center_seq",$center->id)->sum('total_pv') * 0.04;
            
            $total_payment = $center_total ;
            $income_tax  = $center_total * 0.03;
            $residence_tax  = $center_total * 0.003;
            $total_deduction  = $income_tax + $residence_tax;
            $actual_amount  = $total_payment - $total_deduction;

            $order = ExMemberStatements::where("member_seq",$center->director_seq)->where('code',$calcu_code);

            if(isset($order->id)){
                $order->update([
                    "center_amount" => $center_total * 0.04,
                    "total_payment" => $total_payment, 
                    "income_tax" => ($order->income_tax + $income_tax), 
                    "residence_tax" => ($order->residence_tax + $residence_tax), 
                    "total_deduction" => ($order->total_deduction + $total_deduction), 
                    "actual_amount" => ($order->actual_amount + $actual_amount), 
                ]);
            }else{
                ExMemberStatements::create([
                    "member_seq" => $center->director_seq,
                    "member_id" => $center->director_name,
                    "member_name" => $center->director_id,
                    "code" => $calcu_code,
                    "type" => "month",
                    "center_amount" => $center_total,
                    "total_payment" => $total_payment, 
                    "income_tax" => $income_tax, 
                    "residence_tax" => $residence_tax, 
                    "total_deduction" => $total_deduction, 
                    "actual_amount" => $actual_amount, 
                ]);
            }
        }
    }

    
}

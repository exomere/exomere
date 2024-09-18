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
    public function monthlyClosingDetail (Request $request)
    {
        $limitPage = 30;
        $page = $request->get('page', 1);

        $statements = ExMemberStatements::where("code",$request->code)->where("type",$request->type)->where("pv",">",0)->orderBy('id', 'desc')->paginate($limitPage);

        $datas = [
            "statements" => $statements,
            "row_num" => $this->getPageRowNumber($statements->total(), $page, $limitPage)
        ];

        return view('pages.erp.commission.monthlyClosingDetail')->with($datas);
    }

    /**
     * Display a listing of the notices.
     *
     * @param Request $request
     * @return View
     */
    public function monthlyClosing (Request $request)
    {
        $limitPage = $this->getPageLimit();
        $page = $request->get('page', 1);

        $statements = ExStatements::orderBy('id', 'desc')->paginate($limitPage);

        $datas = [
            "statements" => $statements,
            "row_num" => $this->getPageRowNumber($statements->total(), $page, $limitPage)
        ];

        return view('pages.erp.commission.monthlyClosing')->with($datas);
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

        @set_time_limit(0);  

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
                $c_payment_points = ($member_input_data[$r_seq]['payment_points'] ?? 0) + ($order->total_pv * 0.01);

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

        foreach( $member_input_data as $data){
            $data['code'] = $calcu_code;
            $data['type'] = "month";
            ExMemberStatements::create($data);
        }
        
        /* 지역점비 지원금 계산 */
        $this->monthlyCalculationCenter($calcu_code,$start_date, $end_date);

        /* 총판 수당 계산 */
        $this->monthlyCalculationRecommend($calcu_code,$start_date, $end_date, $total_pv);

        /* 장려금 계산 */
        $this->promoteCalculation($calcu_code,$start_date, $end_date, $total_pv);

        $st_total_payment = ExMemberStatements::where("type","month")->where("code",$calcu_code)->SUM("total_payment");
        $st_actual_amount = ExMemberStatements::where("type","month")->where("code",$calcu_code)->SUM("actual_amount");
        
        ExStatements::create([
            "type" => "month",
            "code" => $calcu_code,
            "total_amount" => $total_amount,
            "total_pv" => $total_pv,
            "total_payment" => $st_total_payment, //합계금액
            "actual_amount" => $st_actual_amount, //실지급액
            "deadline_date" => $deadline_date,
            "s_date" => $start_date,
            "e_date" => $end_date,
            "reg_name" => $request->session()->get('member_id')
        ]);

        return redirect()->route('erp-allowance.monthly-closing');
    }

    /**
     * 장려금 계산
     * @param Request $request
     * @return void
     */
    private function promoteCalculation($calcu_code,$s_date, $e_date,$total_pv){

        $ex_members1 = ExMember::where("member_position","총판")->get();
        $ex_members2 = ExMember::whereIn("member_position",["우수총판","최우수총판"])->get();
        
        $score = [];
        $total_amount = [];
        $pv = [];
        $score = [];
        foreach($ex_members1 as $member){
            $member_amount = ExOrder::where("member_seq",$member->id)->whereBetween('order_date', [$s_date, $e_date])->sum("total_amount");
            
            if($member_amount >= 275000){ //총판 판매액이 27만5천원 이상일 경우,

                $score[$member->id] = 0;

                if($member_amount >= 25300000){
                    $score[$member->id] += 2;
                }else if($member_amount >= 13200000){
                    $score[$member->id] += 1;
                }
                
                $recommendOrders = ExOrder::where("recommend_seq",$member->id)->whereBetween('order_date', [$s_date, $e_date])->where("total_amount",">",0);

                foreach($recommendOrders->get() as $orders){
                    if($orders->total_amount >= 25300000){
                        $score[$member->id] += 2;
                    }else if($member_amount >= 13200000){
                        $score[$member->id] += 1;
                    }
                }

                $total_amount[$member->id] = ($total_amount[$member->id] ?? 0) + $orders->total_amount;
                $pv[$member->id] = ($pv[$member->id] ?? 0) + $orders->total_pv;
            }
        }

        foreach($ex_members2 as $member){
            $member_amount = ExOrder::where("member_seq",$member->id)->whereBetween('order_date', [$s_date, $e_date])->sum("total_amount");
            
            if($member_amount >= 660000){ //총판 판매액이 27만5천원 이상일 경우,

                if($member->member_position == "우수총판"){
                    $score[$member->id] = 3;
                }else{
                    $score[$member->id] = 5;
                }

                if($member_amount >= 25300000){
                    $score[$member->id] += 2;
                }else if($member_amount >= 13200000){
                    $score[$member->id] += 1;
                }
                
                $recommendOrders = ExOrder::where("recommend_seq",$member->id)->whereBetween('order_date', [$s_date, $e_date])->where("total_amount",">",0);

                foreach($recommendOrders->get() as $orders){
                    if($orders->total_amount >= 25300000){
                        $score[$member->id] += 2;
                    }else if($member_amount >= 13200000){
                        $score[$member->id] += 1;
                    }
                }

                $total_amount[$member->id] = ($total_amount[$member->id] ?? 0) + $orders->total_amount;
                $pv[$member->id] = ($pv[$member->id] ?? 0) + $orders->total_pv;
            }
        }

        $total_score = 0;
        foreach($score as $key => $val){
            $total_score += $val;
        }

        $promote_price = ROUND(( $total_pv * 0.08 ) / $total_score) ;

        foreach($score as $key => $val){
            if($val > 0){
                $c_promote_price = $promote_price * $val;

                $order = ExMemberStatements::where("member_seq",$key)->where('code',$calcu_code);

                $total_payment = $c_promote_price * 0.09; 
                $payment_points = $c_promote_price * 0.01; 
                $income_tax = $c_promote_price * 0.03; 
                $residence_tax = $c_promote_price * 0.003; 
                $total_deduction = $income_tax + $residence_tax;
                $actual_amount = $total_payment - $total_deduction;
                

                if(isset($order->id)){
                    $order->update([
                        "total_amount" => $total_amount[$key],
                        "pv" => $pv[$key],
                        "promote_prive" => $c_promote_price,
                        "promote_score" => $val,
                        "total_payment" =>  ($order->total_payment +$total_payment), 
                        "payment_points" =>  ($order->payment_points + $payment_points),
                        "income_tax" => ($order->income_tax + $income_tax), 
                        "residence_tax" => ($order->residence_tax + $residence_tax), 
                        "total_deduction" => ($order->total_deduction + $total_deduction), 
                        "actual_amount" => ($order->actual_amount + $actual_amount), 
                    ]);
                }else{

                    $exMember = ExMember::findByMemberSeq( $key );

                    ExMemberStatements::create([
                        "total_amount" => $total_amount[$key],
                        "pv" => $pv[$key],
                        "member_seq" => $exMember->id,
                        "member_id" => $exMember->member_id,
                        "member_name" => $exMember->name,
                        "code" => $calcu_code,
                        "type" => "month",
                        "promote_prive" => $c_promote_price,
                        "promote_score" => $val,
                        "total_payment" => $total_payment, 
                        "payment_points" => $payment_points,
                        "income_tax" => $income_tax, 
                        "residence_tax" => $residence_tax, 
                        "total_deduction" => $total_deduction, 
                        "actual_amount" => $actual_amount, 
                    ]);
                }
            }
        }

    }


    /**
     * 총판수당 계산
     * @param Request $request
     * @return void
     */
    private function monthlyCalculationRecommend($calcu_code,$s_date, $e_date,$total_pv){

        $ex_members = ExMember::whereIn("member_position",["우수총판","최우수총판"]);
        $ex_members2 = ExMember::where("member_position","최우수총판");
        

        $contribution_amount = ($total_pv * 0.03) / ( $ex_members->count()); //우수총판 기여금
        $contribution_amount2 = ($total_pv * 0.02) / ($ex_members2->count() ?? 0); //최우수총판 기여금

        // "contribution_amount" => $c_contribution_amount, //우수총판기여금
        // "contribution_amount2" => $c_contribution_amount2, //최우수총판기여금
        foreach($ex_members->get() as $member){
            $order = ExOrder::where("recommend_seq",$member->id)->whereBetween('order_date', [$s_date, $e_date]);
            
            $total_payment = $contribution_amount * 0.09; 
            $payment_points = $contribution_amount * 0.01; 
            $income_tax = $contribution_amount * 0.03; 
            $residence_tax = $contribution_amount * 0.003; 
            $total_deduction = $income_tax + $residence_tax;
            $actual_amount = $total_payment - $total_deduction;

            if($member->member_position == "최우수총판"){
                $c_contribution_amount2 = $contribution_amount2;
                $total_payment = $total_payment + ($contribution_amount2 * 0.09); 
                $payment_points = $payment_points + ($contribution_amount2 * 0.01); 
                $income_tax = $income_tax + ($contribution_amount2 * 0.03); 
                $residence_tax = $residence_tax + ($contribution_amount2 * 0.003); 
                $total_deduction = $income_tax + $residence_tax;
                $actual_amount = $total_payment - $total_deduction;
            }else{
                $c_contribution_amount2 = 0;
            }

            if(isset($order->id)){
                $order->update([
                    "contribution_amount" => $contribution_amount,
                    "contribution_amount2" => $c_contribution_amount2,
                    "total_payment" => ($order->total_payment +$total_payment), 
                    "payment_points" => ($order->payment_points +$payment_points),
                    "income_tax" => ($order->income_tax + $income_tax), 
                    "residence_tax" => ($order->residence_tax + $residence_tax), 
                    "total_deduction" => ($order->total_deduction + $total_deduction), 
                    "actual_amount" => ($order->actual_amount + $actual_amount), 
                ]);
            }else{

                $exMember = ExMember::findByMemberSeq( $member->id );

                ExMemberStatements::create([
                    "member_seq" => $exMember->id,
                    "member_id" => $exMember->member_id,
                    "member_name" => $exMember->name,
                    "code" => $calcu_code,
                    "type" => "month",
                    "contribution_amount" => $contribution_amount,
                    "contribution_amount2" => $c_contribution_amount2,
                    "total_payment" => $total_payment, 
                    "payment_points" => $payment_points,
                    "income_tax" => $income_tax, 
                    "residence_tax" => $residence_tax, 
                    "total_deduction" => $total_deduction, 
                    "actual_amount" => $actual_amount, 
                ]);
            }
        }

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
                    "center_amount" => $center_total,
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

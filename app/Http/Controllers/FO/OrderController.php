<?php

namespace App\Http\Controllers\FO;

use App\Http\Controllers\API\OnPlatController;
use App\Http\Controllers\Exomere;
use App\Models\ExCardPayment;
use App\Models\ExCenter;
use App\Models\ExItem;
use App\Models\ExMember;
use App\Models\ExOrder;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class OrderController extends Exomere
{

    public function ordersheet(Request $request)
    {
        $ex_member = ExMember::find($request->session()->get("member_seq"));
        $item_info = ExItem::find($request->pd_id);
        
        if($ex_member->member_position == "회원"){
            $pd_price = $item_info->mem_price;
            $pd_pv = $item_info->mem_pv;
        }else if($ex_member->member_position == "총판"){
            $pd_price = $item_info->exclusive_price;
            $pd_pv = $item_info->exclusive_pv;
        }else if($ex_member->member_position == "뷰티플래너"){
            $pd_price = $item_info->planer_price;
            $pd_pv = $item_info->planer_pv;
        }else if($ex_member->member_position == "대리점"){
            $pd_price = $item_info->store_price;
            $pd_pv = $item_info->store_pv;
        }else{
            $pd_price = $item_info->exclusive_price;
            $pd_pv = $item_info->exclusive_pv;
        }

        $datas = [
            "item_info" => $item_info,
            "ex_member" => $ex_member,
            "pd_qty" => $request->pd_qty,
            "pd_id" => $request->pd_id,
            "pd_price" => $pd_price,
            "pd_pv" => $pd_pv,
            "card_compnay" => self::_PAYMENT_CARD_COMPANY,
        ];

        return view('pages.mypage.ordersheet')->with($datas);
    }

    public function doPayment(Request $request){


        $item_seq = $request->pd_id ?? '124';

        $ex_member = ExMember::find($request->session()->get("member_seq"));
        $item_info = ExItem::find($item_seq);

        if($ex_member->member_position == "회원"){
            $pd_price = $item_info->mem_price;
            $pd_pv = $item_info->mem_pv;
        }else if($ex_member->member_position == "총판"){
            $pd_price = $item_info->exclusive_price;
            $pd_pv = $item_info->exclusive_pv;
        }else if($ex_member->member_position == "뷰티플래너"){
            $pd_price = $item_info->planer_price;
            $pd_pv = $item_info->planer_pv;
        }else if($ex_member->member_position == "대리점"){
            $pd_price = $item_info->store_price;
            $pd_pv = $item_info->store_pv;
        }else{
            $pd_price = $item_info->exclusive_price;
            $pd_pv = $item_info->exclusive_pv;
        }

        $item_array = [];
        $card_info = [];
        $account_info = [];
        $point_payment = 0;
        $card_payment = 0;
        $account_payment = 0;

        $phone = str_replace('-','',$request->user_phone);
        
        $total_pv = 0;
        $total_amount = 0;
        if(isset($request->pd_qty)){
            $item_array[0]['pd_seq'] = $item_seq;
            $item_array[0]['pd_qty'] = $request->pd_qty;
            $item_array[0]['pd_price'] = $pd_price;
            $item_array[0]['pd_name'] = $item_info->name;
            $item_array[0]['pd_pv'] = $pd_pv;
            $total_amount +=  (1*($pd_price) * (1*$request->pd_qty));
            $total_pv += (1*($pd_pv) * (1*$request->pd_qty));
        }

        if(isset($request->account_number)){
            for ($i = 0; $i < count($request->account_number); $i++) {
                $account_info[0]['account_number'] = "KB국민 계좌번호 989801-00-072129 ㈜엑소미어";
                $account_info[0]['account_head'] = $request->account_name;
                $account_info[0]['account_date'] = $request->account_date;
                $account_info[0]['account_payment_price'] = $request->account_payment_price;
            }
        }

        if($request->payment_type == 'card'){
            /* 카드결제 */
            $onplatAPI = new OnPlatController();
            
           
            $card_month = $request->card_month;
            if(10 > $request->card_month){
                $card_month = "0".$request->card_month;
            }

            $card_payment_info = [
                'productName' => $item_info->name,
                'customerName' => $request->user_name,
                'customerPhone' => $phone,
                'totalAmount' => $total_amount,
                'cardNum' => $request->card_number,
                'cardInst' => $request->card_installment,
                'expiryDate' => $request->card_year.$card_month,
                'password2' => $request->card_password,
                'userInfo' => $request->user_brith,
            ];
            

            $res = $onplatAPI->userOrderPayment($card_payment_info);

            dd($res);

            $return_card_info = [
                "member_seq" => $ex_member->id,
                "store_id" => $res['storeId'],
                "receipt_id" => $res['receiptId'],
                "receipt_num" => $res['receiptNum'],
                "trad_date" => $res['tradDate'],
                "trad_num" => $res['tradNum'],
                "approval_num" => $res['approvalNum'],
                "card_name" => $res['cardName'],
                "card_num" => $res['cardNum'],
                "card_inst" => $res['cardInst'],
                "charge_state" => $res['chargeState'],
                "resp_msg" => $res['respMsg'],
                "return_url" => $res['returnUrl'],
                "return_val" => $res['returnVal'],
                "reg_date" => date('Y-m-d H:i:s'),
            ];
            ExCardPayment::create($return_card_info);
         
            if(isset($request->card_company)){
                for ($i = 0; $i < count($request->card_company); $i++) {
                    $card_info[0]['card_company'] = $request->card_company;
                    $card_info[0]['card_name'] = $request->card_name;
                    $card_info[0]['card_number'] = $request->card_number;
                    $card_info[0]['card_payment_price'] = $request->card_payment_price;
                    $card_info[0]['card_month_plan'] = $request->card_month_plan;
                    $card_info[0]['card_year_month'] = $request->card_year_month;
                    $card_info[0]['card_approval_number'] = $request->card_approval_number;
                    $card_info[0]['card_approval_name'] = $request->card_approval_name;
                    $card_info[0]['card_approval_date'] = $request->card_approval_date;
                    $card_info[0]['card_password'] = $request->card_password;
                }
            }
            /* 카드결제 */
        }else{
            $account_info[0]['account_number'] = "KB국민 계좌번호 989801-00-072129 ㈜엑소미어";
            $account_info[0]['account_head'] = $request->account_name;
            $account_info[0]['account_date'] = date("Y-m-d");
            $account_info[0]['account_payment_price'] = $total_amount;
            $account_payment = $total_amount;
        }

        $ex_center = ExCenter::find( $ex_member->local_store );

        $order_code = "ex-".date("YmdHis").rand(100,999);

        $input_data = [
            "order_code" => $order_code,
            "member_seq" => $ex_member->id ?? null,
            "member_id" => $ex_member->member_id ,
            "member_name" => $ex_member->name, 
            "recommend_seq" => $ex_member->recommend_seq ?? null,
            "recommend_id" => $ex_member->recommend_id ?? null,
            "recommend_name" => $ex_member->recommend_name ?? null,
            "order_type" => $request->order_type ?? 'new',
            "center_seq" => $ex_center->id ?? null,
            "center_name" => $ex_center->name ?? null,
            "receipt_method" => "delivery",

            // "delivery_name" => $request->delivery_name ?? null,
            // "delivery_phone" => $request->delivery_phone ?? null,

            "zipcode" => $request->zipcode ?? null,
            "address" => $request->address ?? null,
            "address_detail" => $request->address_detail ?? null,
            "total_amount" => $total_amount ?? 0,
            "total_pv" => $total_pv ?? 0,
            "remaining_amount" => 0,

            "payment_amount" => $total_amount ?? null,
            "point_payment" => $point_payment,
            "card_payment" => $card_payment,
            "account_payment" => $account_payment,

            "item_info" => json_encode($item_array) ?? [],
            "card_info" => json_encode($card_info) ?? [],
            "account_info" => json_encode($account_info) ?? [],
            "order_date" => date("Y-m-d H:i:s"),
            "reg_name" => "F/O 본인결제",
        ];

        // ExOrder::create($input_data);

        $complete_data = [
            "input_data" => $input_data,
            "payment_type" => $request->payment_type,
            "return_card_info" => $return_card_info ?? [],
            "total_amount" => $total_amount,
            "phone" => $request->user_phone,
        ];

        return view('pages.mypage.order_complete')->with($complete_data);
    }

    public function orderComplete(Request $request){

        $datas = [
            'payment_type' => 'account'
        ];

        return view('pages.mypage.order_complete')->with($datas);
    }
}
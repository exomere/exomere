<?php

namespace App\Http\Controllers\FO;

use App\Http\Controllers\API\OnPlatController;
use App\Http\Controllers\Exomere;
use App\Models\ExCardPayment;
use App\Models\ExCenter;
use App\Models\ExItem;
use App\Models\ExMember;
use App\Models\ExPointLog;

use App\Models\ExOrder;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class OrderController extends Exomere
{

    public function ordersheet(Request $request)
    {
        $ex_member = ExMember::find($request->session()->get("member_seq"));
        // dd($request->input());
        $cnt = 0;
        $item_info = [];
        $total_price = 0;
        $total_pv = 0;
        if($request->type == 'cart'){
            
            foreach($request->item as $item => $key){
                
                $ex_item = ExItem::find($item);
                
                if($ex_member->member_position == "회원"){
                    $pd_price = $ex_item->mem_price ?? 0;
                    $pd_pv = $ex_item->mem_pv ?? 0;
                }else if($ex_member->member_position == "총판"){
                    $pd_price = $ex_item->exclusive_price ?? 0;
                    $pd_pv = $ex_item->exclusive_pv ?? 0;
                }else if($ex_member->member_position == "총판1"){
                    $pd_price = $ex_item->exclusive_price1 ?? 0;
                    $pd_pv = $ex_item->exclusive_pv1 ?? 0;
                }else if($ex_member->member_position == "뷰티플래너"){
                    $pd_price = $ex_item->planer_price ?? 0;
                    $pd_pv = $ex_item->planer_pv ?? 0;
                }else if($ex_member->member_position == "대리점"){
                    $pd_price = $ex_item->store_price ?? 0;
                    $pd_pv = $ex_item->store_pv ?? 0;
                }else{
                    $pd_price = $ex_item->exclusive_price ?? 0;
                    $pd_pv = $ex_item->exclusive_pv ?? 0;
                }
    
        
                $item_info[$cnt]["pd_name"] = $ex_item->name;
                $item_info[$cnt]["pd_qty"] = $request->quantity[$item][0];
                $item_info[$cnt]["pd_id"] = $ex_item->id;
                $item_info[$cnt]["pd_img"] = Storage::url('public/data/'.$ex_item->thum_img);
                $item_info[$cnt]["pd_price"] = $pd_price;
                $item_info[$cnt]["pd_pv"] = $pd_pv;
                
                $total_price += $item_info[$cnt]["pd_qty"] * $item_info[$cnt]["pd_price"];
                $total_pv += $item_info[$cnt]["pd_qty"] * $item_info[$cnt]["pd_pv"];

                $cnt++;
            }
        }else{
            $ex_item = ExItem::find($request->pd_id);

            if($ex_member->member_position == "회원"){
                $pd_price = $ex_item->mem_price ?? 0;
                $pd_pv = $ex_item->mem_pv ?? 0;
            }else if($ex_member->member_position == "총판"){
                $pd_price = $ex_item->exclusive_price ?? 0;
                $pd_pv = $ex_item->exclusive_pv ?? 0;
            }else if($ex_member->member_position == "총판1"){
                $pd_price = $ex_item->exclusive_price1 ?? 0;
                $pd_pv = $ex_item->exclusive_pv1 ?? 0;
            }else if($ex_member->member_position == "뷰티플래너"){
                $pd_price = $ex_item->planer_price ?? 0;
                $pd_pv = $ex_item->planer_pv ?? 0;
            }else if($ex_member->member_position == "대리점"){
                $pd_price = $ex_item->store_price ?? 0;
                $pd_pv = $ex_item->store_pv ?? 0;
            }else{
                $pd_price = $ex_item->exclusive_price ?? 0;
                $pd_pv = $ex_item->exclusive_pv ?? 0;
            }
    
            $item_info[0]["pd_name"] = $ex_item->name;
            $item_info[0]["pd_qty"] = $request->pd_qty;
            $item_info[0]["pd_id"] = $request->pd_id;
            $item_info[0]["pd_img"] = Storage::url('public/data/'.$ex_item->thum_img);
            $item_info[0]["pd_price"] = $pd_price;
            $item_info[0]["pd_pv"] = $pd_pv;

            $total_price += $item_info[0]["pd_qty"] * $item_info[0]["pd_price"];
            $total_pv += $item_info[0]["pd_qty"] * $item_info[0]["pd_pv"];
        }
       
        $datas = [
            "ex_member" => $ex_member,
            "items" => $item_info,
            "card_compnay" => self::_PAYMENT_CARD_COMPANY,
            "total_price" => $total_price,
            "delivery_price" => ($total_price >= 300000) ? 0 : 4000,
            "total_pv" => $total_pv,
        ];

        return view('pages.mypage.ordersheet')->with($datas);
    }

    public function doPayment(Request $request){
        
        $ex_member = ExMember::find($request->session()->get("member_seq"));
        
        $item_array = [];
        $card_info = [];
        $account_info = [];
        $point_payment = $request->use_point;
        $card_payment = 0;
        $account_payment = 0;

        $phone = str_replace('-','',$request->user_phone);
        
        $total_pv = 0;
        $total_amount = 0;

        for ($i = 0; $i < count($request->pd_id); $i++) {

            $item_info = ExItem::find($request->pd_id[$i]);

            $item_array[$i]['pd_seq'] = $item_info->id;
            $item_array[$i]['pd_qty'] = $request->pd_qty[$i];

            if($ex_member->member_position == "회원"){
                $pd_price = $item_info->mem_price;
                $pd_pv = $item_info->mem_pv;
            }else if($ex_member->member_position == "총판"){
                $pd_price = $item_info->exclusive_price;
                $pd_pv = $item_info->exclusive_pv;
            }else if($ex_member->member_position == "총판1"){
                $pd_price = $item_info->exclusive_price1;
                $pd_pv = $item_info->exclusive_pv1;
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

            $item_array[$i]['pd_price'] = $pd_price;
            $item_array[$i]['pd_name'] = $item_info->name;
            $item_array[$i]['pd_pv'] = $pd_pv;
            $total_amount +=  (1*($pd_price) * (1*$request->pd_qty[$i]));
            $total_pv += (1*($pd_pv) * (1*$request->pd_qty[$i]));
        }

        if(isset($request->account_number)){
            for ($i = 0; $i < count($request->account_number); $i++) {
                $account_info[0]['account_number'] = "KB국민 계좌번호 989801-00-072129 ㈜엑소미어";
                $account_info[0]['account_head'] = $request->account_name;
                $account_info[0]['account_date'] = $request->account_date;
                $account_info[0]['account_payment_price'] = $request->total_price;
            }
        }
        $card_info_in_array = [];
        if($request->payment_type == 'card'){
            $is_approval = 'Y';
            /* 카드결제 */
            $onplatAPI = new OnPlatController();
            
            $card_month = $request->card_month;
            if(10 > $request->card_month){
                $card_month = "0".$request->card_month;
            }

            $product_name = $item_array[0]['pd_name']."외 ".(count($request->pd_id) - 1);

            $card_payment_info = [
                'productName' => $product_name,
                'customerName' => $request->card_name,
                'customerPhone' => $phone,
                'totalAmount' => $request->total_price,
                'cardNum' => str_replace('-','',$request->card_number),
                'cardInst' => $request->card_installment,
                'expiryDate' => $request->card_year.$card_month,
                'password2' => $request->card_password,
                'userInfo' => $request->user_brith,
            ];

            $res = $onplatAPI->userOrderPayment($card_payment_info);

            if(isset($res['storeId'])){
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
                
                $card_info = ExCardPayment::create($return_card_info);
                
                if($res['chargeState'] == "승인거절"){
                    $fail_data = [
                        "msg" => $res['respMsg'],
                    ];
                    return view('pages.mypage.order_fail')->with($fail_data);
                }
            }else{
                $fail_data = [
                    "msg" => "입력 카드정보가 정확하지 않습니다.",
                ];
                return view('pages.mypage.order_fail')->with($fail_data);
            }
            
            if(isset($request->card_name)){
                $card_info_in_array[0]['card_company'] = $request->card_company ?? null;
                $card_info_in_array[0]['card_name'] = $request->card_name ?? null;
                $card_info_in_array[0]['card_number'] = $request->card_number ?? null;
                $card_info_in_array[0]['card_payment_price'] = $request->card_payment_price ?? null;
                $card_info_in_array[0]['card_month_plan'] = $request->card_month_plan ?? null;
                $card_info_in_array[0]['card_year_month'] = $request->card_year_month ?? null;
                $card_info_in_array[0]['card_approval_number'] = $request->card_approval_number ?? null;
                $card_info_in_array[0]['card_approval_name'] = $request->card_approval_name ?? null;
                $card_info_in_array[0]['card_approval_date'] = $request->card_approval_date ?? null;
                $card_info_in_array[0]['card_password'] = $request->card_password ?? null;
            }
            /* 카드결제 */
        }else{
            $account_info[0]['account_number'] = "KB국민 계좌번호 989801-00-072129 ㈜엑소미어";
            $account_info[0]['account_head'] = $request->account_name;
            $account_info[0]['account_date'] = date("Y-m-d");
            $account_info[0]['account_payment_price'] = $request->total_price;
            $account_payment = $request->total_price;
        }

        $ex_center = ExCenter::find( $ex_member->local_store );

        $order_code = "ex-".date("YmdHis").rand(100,999);

        $info_total_price = $request->total_price ?? 0;
        
        $delivery_fee = 4000;
        if($request->receipt_method == 'scene'){
            $delivery_fee = 0;
        }

        if($request->total_price < 300000){
            $info_total_price = $request->total_price - $delivery_fee + $point_payment;
        }else{
            $info_total_price = $request->total_price + $point_payment ?? 0;
        }

        $order_type = 'new';
        if(request()->session()->get('member_position') == "총판"){
            $order_type = 'repurchase';
        }else if(request()->session()->get('member_position') == "총판1"){
            $order_type = 'repurchase';
        }

        $input_data = [
            "order_code" => $order_code,
            "member_seq" => $ex_member->id ?? null,
            "member_id" => $ex_member->member_id ,
            "member_name" => $ex_member->name, 
            "recommend_seq" => $ex_member->recommend_seq ?? null,
            "recommend_id" => $ex_member->recommend_id ?? null,
            "recommend_name" => $ex_member->recommend_name ?? null,
            "order_type" => $order_type,
            "center_seq" => $ex_center->id ?? null,
            "center_name" => $ex_center->name ?? null,
            "receipt_method" => "delivery",
            "delivery_name" => $request->user_name ?? '-',
            "delivery_phone" => $request->user_phone ?? '-',
            "zipcode" => $request->zipcode ?? '-',
            "address" => $request->address ?? '-',
            "address_detail" => $request->address_detail ?? '-',
            "remark" => $request->address_remark ?? '',
            "total_amount" => $info_total_price ?? 0,
            "total_pv" => $total_pv ?? 0,
            "remaining_amount" => 0,
            "payment_amount" => $request->total_price ?? 0,
            "point_payment" => $point_payment ?? 0,
            "card_payment" => $card_payment ?? 0,
            "account_payment" => $account_payment ?? 0,
            "is_approval" => $is_approval ?? 'N',
            "item_info" => json_encode($item_array) ?? [],
            "card_info" => json_encode($card_info_in_array) ?? [],
            "account_info" => json_encode($account_info) ?? [],
            "order_date" => date("Y-m-d H:i:s"),
            "reg_name" => "F/O 본인결제",
        ];
        // dd($input_data);
        $create_order = ExOrder::create($input_data);

        if($point_payment > 0){
            
            $remain_points = ($ex_member->remain_points - $point_payment);
            $payment_points = ($ex_member->payment_points - $point_payment);
            
            
            $ex_member->update([
                "remain_points" => $remain_points,
                "payment_points" => $payment_points,
            ]);
    
            ExPointLog::create([
                "kind" => "extinction",
                "date" => date("Y-m-d H:i:s"),
                "member_seq" => $ex_member->id,
                "point" => $point_payment,
                "remark" => $create_order->id."번에 주문에 사용 F/O",
            ]);
        }

        if(isset($card_info->id)){
            ExCardPayment::find($card_info->id)->update([
                "order_id" => $create_order->id,
            ]);
        }
        
        $complete_data = [
            "input_data" => $input_data,
            "payment_type" => $request->payment_type,
            "return_card_info" => $return_card_info ?? [],
            "total_amount" => $request->total_price,
            "point_payment" => $point_payment,
            "phone" => $request->user_phone,
        ];
        // dd($complete_data);
        return redirect()->route('user.order_complete',$complete_data);
        // return view('pages.mypage.order_complete')->with($complete_data);
    }

    public function orderComplete(Request $request){
        
        
        $datas = [
            "input_data" => $request->input_data,
            "payment_type" => $request->payment_type,
            "return_card_info" => $request->return_card_info ?? [],
            "total_amount" => $request->total_amount,
            "point_payment" => $request->point_payment,
            "phone" => $request->phone,
        ];
        
        return view('pages.mypage.order_complete')->with($datas);
        // return view('pages.mypage.order_complete')->with($datas);
    }
}
<?php

namespace App\Http\Controllers\FO;

use App\Http\Controllers\Exomere;
use App\Models\ExItem;
use App\Models\ExMember;
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
            "pd_price" => $pd_price,
            "pd_pv" => $pd_pv,
            "card_compnay" => self::_PAYMENT_CARD_COMPANY,
        ];

        return view('pages.mypage.ordersheet')->with($datas);
    }

    public function doPayment(Request $request){
        dd($request->input());
    }

    public function orderComplete(Request $request){

        $datas = [
            'payment_type' => 'account'
        ];

        return view('pages.mypage.order_complete')->with($datas);
    }
}
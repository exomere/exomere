<?php

namespace App\Http\Controllers\Admin;

use App\Models\ExOrder;
use App\Models\ExItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Exomere;
use Illuminate\Support\Facades\Storage;

class OrderController extends Exomere
{

    CONST ORDER_CATEGORY = [
      'skin' => '스킨케어',
      'health' => '헬스케어',
      'etc' => '기타',
    ];

    CONST ORDER_KIND = [
      'N' => '없음',
      'signature' => '대표상품',
    ];

    public function orderList(Request $request)
    {

    
        $orders = new ExOrder;
        $limitPage = $this->getPageLimit();
        $page = $request->get('page') ?? 1;

        if (!is_null($request->get('search_text'))) {
            $search_text = $request->get('search_text');
            $orders->where('name','LIKE',"%{$request->get('search_text')}%");
        }
      
        $orders->limit($limitPage)->orderBy('id', 'desc');


        $data = [
          "search_text" => $search_text ?? '',
          "orders" =>  $orders ?? [],
          "order_category" => self::ORDER_CATEGORY,
          "row_num" => $this->getPageRowNumber($orders->count(), $page, $limitPage) ?? null,
          "paga_nation" => $this->pagaNation($orders, $limitPage),

        ];

        return view('pages.order.list')->with($data);
    }

    public function orderRegister(Request $request)
    {
  
        if (isset($request->seq)) {
            $Order = ExOrder::find($request->seq);
          }

          $items = ExItem::where('is_active','Y')->get();
          $itemArray = [];
          $cnt = 0;
          foreach($items as $item){
            $itemArray[$cnt]['seq'] = $item->id;
            $itemArray[$cnt]['name'] = $item->name;
            $itemArray[$cnt]['price'] = $item->price;
            $itemArray[$cnt]['pv'] = $item->pv;
            $cnt++;
          }

          $data = [
            "order_seq" => $request->seq ?? null,
            "order_category" => self::ORDER_CATEGORY,
            "order_kind" => self::ORDER_KIND,
            "order" => $Order ?? [],
            "card_compnay" => self::_PAYMENT_CARD_COMPANY,
            "item_array" => $itemArray ?? [],
          ];

          return view('pages.order.register')->with($data);
    }

    public function orderSave(Request $request)
    {

      $order_seq = $request->Order_seq ?? null;

      $item_info = [];
      $card_info = [];
      $account_info = [];

      for($i=0;$i<count($request->pd_qty);$i++){
        // $item_info[$i]['pd_seq'] = $request->pd_seq[$i];
        $item_info[$i]['pd_qty'] = $request->pd_qty[$i];
      }
         
      for($i=0;$i<count($request->card_company);$i++){
        $card_info[$i]['card_company'] = $request->card_company[$i];
        $card_info[$i]['card_name'] = $request->card_name[$i];
        $card_info[$i]['card_number'] = $request->card_number[$i];
        $card_info[$i]['card_payment_price'] = $request->card_payment_price[$i];
        $card_info[$i]['card_month_plan'] = $request->card_month_plan[$i];
        $card_info[$i]['card_year_month'] = $request->card_year_month[$i];
        $card_info[$i]['card_approval_number'] = $request->card_approval_number[$i];
        $card_info[$i]['card_approval_name'] = $request->card_approval_name[$i];
        $card_info[$i]['card_approval_date'] = $request->card_approval_date[$i];
        $card_info[$i]['card_password'] = $request->card_password[$i];
      }

      for($i=0;$i<count($request->account_number);$i++){
        $account_info[$i]['account_number'] = $request->account_number[$i];
        $account_info[$i]['account_head'] = $request->account_head[$i];
        $account_info[$i]['account_date'] = $request->account_date[$i];
        $account_info[$i]['account_payment_price'] = $request->account_payment_price[$i];
      }
      
      // dd($request->input(),$account_info,$card_info,$item_info ,explode(" | ",$request->member_info));

      $input_data = [
        "member_seq" => $request->member_seq ?? null,
        "member_id" => explode(" | ",$request->member_info)[0] ?? null,
        "member_name" =>explode(" | ",$request->member_info)[1] ?? null,
        "order_type" => $request->order_type ?? null,
        "center_seq" => $request->center_seq ?? null,
        "receipt_method" => $request->receipt_method ?? null,
        "delivery_name" => $request->delivery_name ?? null,
        "delivery_phone" => $request->delivery_phone ?? null,
        "zipcode" => $request->zipcode ?? null,
        "address" => $request->address ?? null,
        "address_detail" => $request->address_detail ?? null,
        "remark" => $request->remark ?? null,
        "total_amount" => str_replace(',','',$request->total_amount) ?? null,
        "payment_amount" => str_replace(',','',$request->payment_amount) ?? null,
        "remaining_amount" => str_replace(',','',$request->remaining_amount) ?? null,
        "cash_payment" => str_replace(',','',$request->cash_payment) ?? null,
        "point_payment" => str_replace(',','',$request->point_payment) ?? null,
        "account_payment" => str_replace(',','',$request->account_payment) ?? null,
        "item_info" => json_encode($item_info) ?? [],
        "card_info" => json_encode($card_info) ?? [],
        "account_info" => json_encode($account_info) ?? [],
        "order_date" => $request->order_date ?? date("Y-m-d H:i:s"),
      ];


      ExOrder::UpdateOrCreate(
        [
          'id' => $order_seq,
        ],
          $input_data
      );

      return redirect()->route('order-layouts-order-list');
    }

    public function orderDel(Request $request)
    {
      ExOrder::find($request->seq)->delete();
      return redirect()->route('order-layouts-order-list');
    }

    

    
}

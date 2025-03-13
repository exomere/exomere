<?php

namespace App\Http\Controllers\Admin;

use App\Models\ExOrder;
use App\Models\ExItem;
use App\Models\ExMember;

use Illuminate\Http\Request;
use App\Http\Controllers\Exomere;
use App\Models\ExCenter;
use Illuminate\Support\Facades\Storage;

class OrderController extends Exomere
{

    CONST PAYMENT_KIND = [
      'skin' => '스킨케어',
      'health' => '헬스케어',
      'etc' => '기타',
    ];

    CONST APPROVAL_KIND = [
      'Y' => '승인',
      'N' => '미승인',
      'C' => '취소',
    ];

    CONST ORDER_KIND = [
      'new' => "신규주문",
      'repurchase' => "재구매주문",
      'distribute_new' => "분양몰신규",
      'distribute_repurchase' => "분양몰재구문",
    ];

    public function orderList(Request $request)
    {

    
      $limitPage = $this->getPageLimit();
      $page = $request->get('page') ?? 1;
  
      $orders = ExOrder::where("member_seq",$request->session()->get('member_seq'))->orderBy('id', 'desc')->paginate($limitPage);
  
      if (!is_null($request->get('search_text'))) {
        $search_text = $request->get('search_text');
        $orders->where('name', 'LIKE', "%{$request->get('search_text')}%");
      }
  
      $data = [
        "search_text" => $search_text ?? '',
        "orders" =>  $orders ?? [],
        "payment_kind" => self::PAYMENT_KIND,
        "order_kind" => self::ORDER_KIND,
        "approval_kind" => self::APPROVAL_KIND,
        "row_num" => $this->getPageRowNumber($orders->total(), $page, $limitPage),
      ];

      return view('pages.order.list')->with($data);
    }

    public function recruitmentList(Request $request)
    {

    
      $limitPage = $this->getPageLimit();
      $page = $request->get('page') ?? 1;
  
      $orders = ExOrder::where("recommend_seq",$request->session()->get('member_seq'))->orderBy('id', 'desc')->paginate($limitPage);
  
      if (!is_null($request->get('search_text'))) {
        $search_text = $request->get('search_text');
        $orders->where('name', 'LIKE', "%{$request->get('search_text')}%");
      }
  
      $data = [
        "search_text" => $search_text ?? '',
        "orders" =>  $orders ?? [],
        "payment_kind" => self::PAYMENT_KIND,
        "order_kind" => self::ORDER_KIND,
        "approval_kind" => self::APPROVAL_KIND,
        "row_num" => $this->getPageRowNumber($orders->total(), $page, $limitPage),
      ];

      return view('pages.order.r_list')->with($data);
    }

    public function orderDetail(Request $request)
    {

    
      $item_info = [];
      $account_info = [];
      $card_info = [];
  
      if (isset($request->seq)) {
        $order_data = ExOrder::find($request->seq);
        $item_info = json_decode($order_data->item_info);
        $account_info = json_decode($order_data->account_info);
        $card_info = json_decode($order_data->card_info);
        $order_date = date("Y-m-d",strtotime($order_data->order_date));
      }
  
      $items = ExItem::where('is_active', 'Y')->get();
      $itemArray = [];
      $cnt = 0;
      foreach ($items as $item) {
        $itemArray[$cnt]['seq'] = $item->id;
        $itemArray[$cnt]['name'] = $item->name;
        $itemArray[$cnt]['price'] = $item->price;
        $itemArray[$cnt]['pv'] = $item->pv;
  
        $itemArray[$cnt]['planer_price'] = $item->planer_price;
        $itemArray[$cnt]['planer_pv'] = $item->planer_pv;
  
        $itemArray[$cnt]['store_price'] = $item->store_price;
        $itemArray[$cnt]['store_pv'] = $item->store_pv;
  
        $itemArray[$cnt]['exclusive_price'] = $item->exclusive_price;
        $itemArray[$cnt]['exclusive_pv'] = $item->exclusive_pv;
  
        $itemArray[$cnt]['exclusive_price1'] = $item->exclusive_price1;
        $itemArray[$cnt]['exclusive_pv1'] = $item->exclusive_pv1;
  
        $cnt++;
      }
  
      $centerArray = [];
      $cnt = 0;
      $centers = ExCenter::where('is_active', 'Y')->get();
      foreach ($centers as $center) {
        $centerArray[$cnt]['seq'] = $center->id;
        $centerArray[$cnt]['name'] = $center->name;
        $cnt++;
      }
  
      // dd($order_data);
      $data = [
        "order_seq" => $request->seq ?? null,
        "payment_kind" => self::PAYMENT_KIND,
        "order_kind" => self::ORDER_KIND,
        "order_data" => $order_data ?? [],
        "card_compnay" => self::_PAYMENT_CARD_COMPANY,
        "item_info" => $item_info,
        "account_info" => $account_info,
        "card_info" => $card_info,
        "item_array" => $itemArray ?? [],
        "center_array" => $centerArray ?? [],
        "order_date" => $order_date ?? date('Y-m-d'),
      ];
      
      return view('pages.order.detail')->with($data);
    }
    
}

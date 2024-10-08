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
    
}

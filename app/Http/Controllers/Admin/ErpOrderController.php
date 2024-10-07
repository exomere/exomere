<?php

namespace App\Http\Controllers\Admin;

use App\Models\ExOrder;
use App\Models\ExItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Exomere;
use App\Models\ExCenter;
use App\Models\ExMember;

class ErpOrderController extends Exomere
{

  const PAYMENT_KIND = [
    'skin' => '스킨케어',
    'health' => '헬스케어',
    'etc' => '기타',
  ];

  const ORDER_KIND = [
    'new' => "신규주문",
    'repurchase' => "재구매주문",
    'distribute_new' => "분양몰신규",
    'distribute_repurchase' => "분양몰재구문",
  ];

  public function list(Request $request)
  {
    $limitPage = $this->getPageLimit();
    $page = $request->get('page') ?? 1;

    $orders = ExOrder::orderBy('id', 'desc')->paginate($limitPage);

    if (!is_null($request->get('search_text'))) {
      $search_text = $request->get('search_text');
      $orders->where('name', 'LIKE', "%{$request->get('search_text')}%");
    }

    $data = [
      "search_text" => $search_text ?? '',
      "orders" =>  $orders ?? [],
      "payment_kind" => self::PAYMENT_KIND,
      "order_kind" => self::ORDER_KIND,
      "row_num" => $this->getPageRowNumber($orders->total(), $page, $limitPage),
    ];

    return view('pages.erp.order.list')->with($data);
  }

  public function orderRegister(Request $request)
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


    return view('pages.erp.order.register')->with($data);
  }

  public function orderSave(Request $request)
  {

    $order_seq = $request->order_seq ?? null;

    $item_info = [];
    $card_info = [];
    $account_info = [];
    $total_pv = 0;
    if(isset($request->pd_qty)){
      for ($i = 0; $i < count($request->pd_qty); $i++) {
        $item_info[$i]['pd_seq'] = $request->pd_seq[$i];
        $item_info[$i]['pd_qty'] = $request->pd_qty[$i];
        $item_info[$i]['pd_price'] = $request->pd_price[$i];
        $item_info[$i]['pd_name'] = $request->pd_name[$i];
        $item_info[$i]['pd_pv'] = $request->pd_pv[$i];
        $total_pv += ($request->pd_pv[$i] * $request->pd_qty[$i]);
      }
    }
    if(isset($request->card_company)){
      for ($i = 0; $i < count($request->card_company); $i++) {
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
    }
    if(isset($request->account_number)){
      for ($i = 0; $i < count($request->account_number); $i++) {
        $account_info[$i]['account_number'] = $request->account_number[$i];
        $account_info[$i]['account_head'] = $request->account_head[$i];
        $account_info[$i]['account_date'] = $request->account_date[$i];
        $account_info[$i]['account_payment_price'] = $request->account_payment_price[$i];
      }
    }

    $exCenter = ExCenter::find( $request->center_seq );
    $exMember = ExMember::find( $request->member_seq );

    $input_data = [
      "member_seq" => $request->member_seq ?? null,
      "member_id" => explode(" | ", $request->member_info)[0] ?? null,
      "member_name" => explode(" | ", $request->member_info)[1] ?? null,
      "recommend_seq" => $exMember->recommend_seq ?? null,
      "recommend_id" => $exMember->recommend_id ?? null,
      "recommend_name" => $exMember->recommend_name ?? null,
      "order_type" => $request->order_type ?? null,
      "center_seq" => $request->center_seq ?? null,
      "center_name" => $exCenter->name ?? null,
      "receipt_method" => $request->receipt_method ?? null,
      "delivery_name" => $request->delivery_name ?? null,
      "delivery_phone" => $request->delivery_phone ?? null,
      "zipcode" => $request->zipcode ?? null,
      "address" => $request->address ?? null,
      "address_detail" => $request->address_detail ?? null,
      "remark" => $request->remark ?? null,
      "total_amount" => str_replace(',', '', $request->total_amount) ?? null,
      "total_pv" => str_replace(',', '', $total_pv) ?? null,
      
      "payment_amount" => str_replace(',', '', $request->payment_amount) ?? null,
      "remaining_amount" => str_replace(',', '', $request->remaining_amount) ?? null,
      "cash_payment" => str_replace(',', '', $request->cash_payment) ?? null,
      "point_payment" => str_replace(',', '', $request->point_payment) ?? null,
      "card_payment" => str_replace(',', '', $request->card_payment) ?? null,
      "account_payment" => str_replace(',', '', $request->account_payment) ?? null,
      "item_info" => json_encode($item_info) ?? [],
      "card_info" => json_encode($card_info) ?? [],
      "account_info" => json_encode($account_info) ?? [],
      "order_date" => $request->order_date ?? date("Y-m-d H:i:s"),
      "reg_name" => $request->session()->get('member_id'),
    ];


    ExOrder::UpdateOrCreate(
      [
        'id' => $order_seq,
      ],
      $input_data
    );

    return redirect()->route('erp-order-layouts-order-list');
  }

  public function orderDel(Request $request)
  {
    ExOrder::find($request->seq)->delete();
    return redirect()->route('erp-order-layouts-order-list');
  }
}

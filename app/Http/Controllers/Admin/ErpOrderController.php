<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrdersExport;
use App\Http\Controllers\API\OnPlatController;
use App\Models\ExOrder;
use App\Models\ExItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Exomere;
use App\Models\ExCardPayment;
use App\Models\ExCenter;
use App\Models\ExMember;
use App\Models\ExPointLog;
use Maatwebsite\Excel\Facades\Excel;

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

      $site_code = $request->session()->get('site_code') ?? "exomere";

      $ordersQuery = ExOrder::where("site_code",$site_code)->orderBy('id', 'desc');
     
      // 승인구분 필터 추가
      if ($request->filled('approval_status')) {
          $ordersQuery->where('is_approval', $request->get('approval_status'));
      }

      // 주문구분 필터 추가
      if ($request->filled('order_type')) {
          $ordersQuery->where('order_type', $request->get('order_type'));
      }

      // 검색 필드와 검색어 필터 추가
      if ($request->filled('search_text') && $request->filled('search_field')) {
          $searchField = $request->get('search_field');
          $searchText = $request->get('search_text');
          $ordersQuery->where($searchField, 'LIKE', "%{$searchText}%");
      }

      if ($request->filled('start_date')) {
          $ordersQuery->where('order_date', '>=', $request->get('start_date')." 00:00:00");
      }

      if ($request->filled('end_date')) {
          $ordersQuery->where('order_date', '<=', $request->get('end_date')." 23:59:59");
      }

      // $this->getQuery($ordersQuery);

      // 페이지네이션을 통해 데이터 가져오기
      $orders = $ordersQuery->paginate($limitPage);

      // 데이터 배열에 변수 담기
      $data = [
          "approval_status" => $request->get('approval_status') ?? '',
          "order_type" => $request->get('order_type') ?? '',
          "search_field" => $request->get('search_field') ?? 'member_name',
          "search_text" => $request->get('search_text') ?? '',
          "orders" => $orders,
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
      $past_order_data = ExOrder::where('member_seq',$order_data->member_seq)->orderBy('id', 'desc')->get();
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
      "past_order_data" => $past_order_data ?? [],
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

  public function approving(Request $request){
    ExOrder::find($request->seq)->update([
      "is_approval" => $request->type,
    ]);
  }

  public function orderSave(Request $request)
  {
    $onplatAPI = new OnPlatController();
    $exMember = ExMember::find( $request->member_seq );
    $exCenter = ExCenter::find( $exMember->local_store );
  
    $resident_number = substr(str_replace('-','',$exMember->resident_number ?? null),0,6) ;
    $user_phone = str_replace('-','',$request->phone);
    $order_seq = $request->order_seq ?? null;
    $is_approval = 'Y';
    $item_info = [];
    $card_info = [];
    $account_info = [];
    $total_pv = 0;

    if(empty($request->pd_qty)){
      $fail_data = [
          "msg" => "상품 누락",
      ];
      return view('pages.erp.order.order_fail')->with($fail_data);
    }

    if(isset($request->pd_qty)){
      for ($i = 0; $i < count($request->pd_qty); $i++) {
        $item_info[$i]['pd_seq'] = $request->pd_seq[$i];
        $item_info[$i]['pd_qty'] = $request->pd_qty[$i];
        $item_info[$i]['pd_price'] = $request->pd_price[$i];
        $item_info[$i]['pd_name'] = $request->pd_name[$i];
        $item_info[$i]['pd_pv'] = $request->pd_pv[$i];
        $total_pv += (1*($request->pd_pv[$i]) * (1*$request->pd_qty[$i]));
      }
    }

    $cardProductName = $request->pd_name[0]."외 ".(count($request->pd_name)-1);

    if(isset($request->card_company)){
      for ($i = 0; $i < count($request->card_company); $i++) {
        $card_info[$i]['card_company'] = $request->card_company[$i];
        $card_info[$i]['card_name'] = $request->card_name[$i];
        $card_info[$i]['card_number'] = $request->card_number[$i];
        $card_info[$i]['card_payment_price'] = $request->card_payment_price[$i];
        $card_info[$i]['card_month_plan'] = $request->card_month_plan[$i];
        $card_info[$i]['card_year_month'] = $request->card_year_month[$i];
        $card_info[$i]['card_approval_name'] = $request->card_approval_name[$i];
        $card_info[$i]['card_approval_date'] = $request->card_approval_date[$i];
        $card_info[$i]['card_password'] = $request->card_password[$i];
     
        /* 카드결제 */
        $card_payment_info = [
            'productName' => $cardProductName,
            'customerName' => $request->card_approval_name[$i],
            'customerPhone' => $user_phone,
            'totalAmount' => $request->card_payment_price[$i],
            'cardNum' => $request->card_number[$i],
            'cardInst' => $request->card_month_plan[$i],
            'expiryDate' => $request->card_year_month[$i],
            'password2' => $request->card_password[$i],
            'userInfo' => $resident_number,
        ];

        $res = $onplatAPI->userOrderPayment($card_payment_info);

        if(isset($res['storeId'])){
            $return_card_info = [
                "member_seq" => $exMember->id,
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

            $card_info[$i]['card_approval_number'] = $res['approvalNum'];

            if($res['chargeState'] == "승인거절"){
                $fail_data = [
                    "msg" => $res['respMsg'],
                ];
                return view('pages.erp.order.order_fail')->with($fail_data);
            }
        }
      }
    }
    
    if(isset($request->account_number)){
      for ($i = 0; $i < count($request->account_number); $i++) {
        $account_info[$i]['account_number'] = $request->account_number[$i];
        $account_info[$i]['account_head'] = $request->account_head[$i];
        $account_info[$i]['account_date'] = $request->account_date[$i];
        $account_info[$i]['account_payment_price'] = $request->account_payment_price[$i];
        $is_approval = 'N';
      }
    }

    $point_payment = str_replace(',', '', $request->point_payment);

    // if($point_payment > 0){
    //   ExPointLog::create([
    //     "kind" => "use",
    //     "date" => date("Y-m-d H:i:s"),
    //     "member_seq" => $request->member_seq,
    //     "point" => $point_payment,
    //     "remark" => "주문 포인트 결제",
    //     "reg_name" => $request->session()->get('member_name'),
    //   ]);

    //   $exMember->update([
    //       "remain_points" => ($exMember->remain_points - $point_payment),
    //   ]);
    // }

    $input_data = [
      "member_seq" => $request->member_seq ?? null,
      "member_id" => explode(" | ", $request->member_info)[0] ?? null,
      "member_name" => explode(" | ", $request->member_info)[1] ?? null,
      "recommend_seq" => $exMember->recommend_seq ?? null,
      "recommend_id" => $exMember->recommend_id ?? null,
      "recommend_name" => $exMember->recommend_name ?? null,
      "order_type" => $request->order_type ?? null,
      "center_seq" => $exMember->local_store ?? null,
      "center_name" => $exCenter->name ?? null,
      "receipt_method" => $request->receipt_method ?? null,
      "delivery_name" => $request->delivery_name ?? null,
      "delivery_phone" => $request->delivery_phone ?? null,
      "zipcode" => $request->zipcode ?? null,
      "address" => $request->address ?? null,
      "address_detail" => $request->address_detail ?? null,
      "remark" => $request->remark ?? null,
      "total_amount" => str_replace(',', '', $request->total_amount) ?? 0,
      "total_pv" => str_replace(',', '', $total_pv) ?? 0,
      "payment_amount" => str_replace(',', '', $request->payment_amount) ?? 0,
      "remaining_amount" => str_replace(',', '', $request->remaining_amount) ?? 0,
      "delivery_amount" => str_replace(',', '', $request->delivery_amount) ?? 0,
      "cash_payment" => str_replace(',', '', $request->cash_payment) ?? 0,
      "point_payment" => $point_payment ?? 0,
      "card_payment" => str_replace(',', '', $request->card_payment) ?? 0,
      "account_payment" => str_replace(',', '', $request->account_payment) ?? 0,
      "item_info" => json_encode($item_info) ?? [],
      "card_info" => json_encode($card_info) ?? [],
      "account_info" => json_encode($account_info) ?? [],
      "order_date" => $request->order_date ?? date("Y-m-d H:i:s"),
      "nation" => $request->session()->get('member_nation') ?? 'KR',
      "is_approval" => $is_approval,
      "site_code" => $request->session()->get('site_code') ?? "exomere",
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


    public function print($orderId)
    {
        $order_data = ExOrder::findOrFail($orderId);
        $item_info = json_decode($order_data->item_info);
        $account_info = json_decode($order_data->account_info);
        $card_info = json_decode($order_data->card_info);
        $order_date = date("Y-m-d",strtotime($order_data->order_date));
        $card_info2 = ExCardPayment::where('order_id',$orderId)->where('resp_msg','정상승인')->first();
        $member_data = ExMember::find($order_data->member_seq);

        $itemArray = [];
        $cnt = 0;

        foreach ($item_info as $item) {
            $item_data = ExItem::find($item->pd_seq);
            $itemArray[$item->pd_seq]['capacity'] = $item_data->capacity;
            $itemArray[$item->pd_seq]['exclusive_price'] = $item_data->exclusive_price;
            $itemArray[$item->pd_seq]['price'] = $item_data->price;
            
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

        $data = [
            "order_seq" => $request->seq ?? null,
            "payment_kind" => self::PAYMENT_KIND,
            "order_kind" => self::ORDER_KIND,
            "order_data" => $order_data ?? [],
            "card_compnay" => self::_PAYMENT_CARD_COMPANY,
            "item_info" => $item_info,
            "account_info" => $account_info,
            "card_info" => $card_info,
            "card_info2" => $card_info2,
            "item_array" => $itemArray ?? [],
            "center_array" => $centerArray ?? [],
            "order_date" => $order_date ?? date('Y-m-d'),
            "member_data" => $member_data,
        ];

        return view('pages.erp.order.print')->with($data);
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new OrdersExport($request), 'orders_'.date('y_m_d').'.xlsx');
    }
}

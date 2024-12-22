<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order #123 Print View</title>
  <style>
    /* Print styling */
    body { font-family: Arial, sans-serif; }
    .print-container { max-width: 800px; margin: 0 auto; }
    .header { text-align: center; margin-bottom: 20px; }
    .order-details { margin-bottom: 20px; }
    .order-details h3 { margin-bottom: 10px; }
    .items-table { width: 100%; border-collapse: collapse; }
    .items-table th, .items-table td { border: 1px solid #ddd; padding: 8px; }
    .items-table th { background-color: #f4f4f4; }
    .total { text-align: right; margin-top: 10px; font-size: 1.2em; }
    @media print {
      .print-button { display: none; }
    }
  </style>
</head>
<body>
<div class="print-container">
  <div class="header">
    <h1>Order #{{ $order_data->member_name ?? null }}</h1>
    <p>Order Date: {{ $order_date ?? null }}</p>
  </div>

  <div class="order-details">
    <h3>회원 정보</h3>
    <p>
      <strong>회원명:</strong>
      {{ $order_data->member_name ?? null }}
      - @if($order_data->order_type == "new")신규주문@elseif($order_data->order_type == "repurchase")재구매주문@elseif($order_data->order_type == "distribute_new")분양몰신규@elseif($order_data->order_type == "distribute_repurchase")분양몰재구문@endif
    </p>
    <p><strong>회원 ID:</strong> {{ $order_data->member_id ?? null }}</p>
    @isset($order_data->center_seq)
    <p>
      <strong>지역점:</strong>
      @foreach ($center_array as $center)
        @if($order_data->center_seq == $center['seq']) {{$center['name']}} @endif
      @endforeach
    </p>
    @endisset

    @isset($order_data->receipt_method)
    <p><strong>상품수령:</strong> @if($order_data->receipt_method == "delivery")택배수령@elseif($order_data->receipt_method == "scene")현장수령@endif</p>
    @endisset
    <p><strong>주문자(연락처):</strong> {{ $order_data->delivery_name ?? null }} ({{ $order_data->delivery_phone ?? null }})</p>
    <p><strong>주소:</strong> ({{ $order_data->zipcode ?? null }}) {{ $order_data->address ?? null }} {{ $order_data->address_detail ?? null }}</p>
    @isset($order_data->remark)
    <p><strong>비고:</strong> {{ $order_data->remark ?? null }}</p>
    @endisset
  </div>

  <div class="order-items">
    <h3>주문상품 정보</h3>
    <table class="items-table">
      <thead>
      <tr>
        <th>상품명</th>
        <th>판매가</th>
        <th>PV</th>
        <th>수량</th>
        <th>합계</th>
      </tr>
      </thead>
      <tbody>
      @if(isset($item_info))

        @foreach ($item_info as $item)

          <tr>
            <td>{{$item->pd_name}}</td>
            <td>{{number_format($item->pd_price)}}</td>
            <td>{{number_format($item->pd_pv)}}</td>
            <td>{{$item->pd_qty}}</td>
            <td><span class='pd_total' id='pd_total_{{$item->pd_seq}}'>{{number_format($item->pd_price * $item->pd_qty)}}</span></td>
          </tr>
        @endforeach
      @else
        <tr><td style='text-align:center; height:80px;' colspan="6">선택한 상품이 없습니다.</td> </tr>
      @endif
      </tbody>
    </table>
    <div class="total">
      <strong>Grand Total: {{number_format($order_data->total_amount ?? 0)}}</strong>
    </div>
  </div>

  <div class="order-items">
    <h3>카드결제 정보</h3>
    <table class="items-table">
      <thead>
      <tr>
        <th>카드명</th>
        <th>카드번호</th>
        <th>결제금액</th>
        <th>할부</th>
        <th>유효년월</th>
        <th>승인번호</th>
        <th>소유자명</th>
        <th>승인일자</th>
        <th>비밀번호</th>
      </tr>
      </thead>
      <tbody>
      @if(isset($card_info))
        @php $card_cnt = 1; @endphp
        @foreach ($card_info as $card)
          <tr>
            <td>
              {{$card->card_name ?? ''}}
            </td>
            <td>{{$card->card_number ?? ''}}</td>
            <td>{{$card->card_payment_price ?? ''}}</td>
            <td>{{$card->card_month_plan ?? ''}}</td>
            <td>{{$card->card_year_month ?? ''}}</td>
            <td>{{$card->card_approval_number ?? ''}}</td>
            <td>{{$card->card_approval_name ?? ''}}</td>
            <td>{{$card->card_approval_date ?? ''}}</td>
            <td>{{$card->card_password ?? ''}}</td>
          </tr>
          @php $card_cnt++; @endphp
        @endforeach
      @else
        <tr>
          <td style='text-align:center; height:80px;' colspan="10">카드결제 정보가 없습니다.</td>
        </tr>
      @endif
      </tbody>
    </table>
  </div>
  <div class="order-items">
    <h3>계좌이체 결제 정보</h3>
    <table class="items-table">
      <thead>
      <tr>
        <th>입금계좌번호</th>
        <th>입금자</th>
        <th>입금일</th>
        <th>결제금액</th>
      </tr>
      </thead>
      <tbody>
      @if(isset($account_info) && count($account_info) > 0)
        @php $acc_cnt = 1; @endphp
        @foreach ($account_info as $account)
          <tr>
            <td>{{$account->account_number}}</td>
            <td>{{$account->account_head}}/td>
            <td>{{$account->account_date}}</td>
            <td>{{$account->account_payment_price}}</td>
          </tr>
          @php $acc_cnt++; @endphp
        @endforeach
      @else
        <tr>
          <td style='text-align:center; height:80px;' colspan="5">계좌이체 정보가 없습니다.</td>
        </tr>
      @endif
      </tbody>
    </table>
  </div>

  <button onclick="window.print()" class="print-button" style="margin-top: 20px;">Print</button>
</div>
</body>
</html>
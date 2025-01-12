<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>제품 구매 주문서</title>
  <style>
    /* Print styling */
    body { font-family: Arial, sans-serif; }
    .print-container { max-width: 800px; margin: 0 auto; }
    .header { text-align: center; margin-bottom: 20px; }
    .order-details { margin-bottom: 20px; }
    .order-details h3 { margin-bottom: 10px; }
    .items-table { width: 100%; border-collapse: collapse; }
    .items-table th, .items-table td { border: 1px solid #ddd; padding: 8px; }
    .items-table th { background-color: #FFDAB9; }
    .total { text-align: right; margin-top: 10px; font-size: 1.2em; }
    @media print {
      .print-button { display: none; }
    }
  </style>
</head>
<body>
<div class="print-container">
  <div class="header">
    <h1>제품 구매 주문서</h1>
    <h4><input type='checkbox'>신규 <input type='checkbox'>재구매 <input type='checkbox'>고객 <input type='checkbox'>총판</h4>
  </div>

  <div class="order-details">
    <table style='width:100%; border:1px solid #eee;' class='items-table'>
      <tr style=' border:1px solid #eee;'>
        <th style='width:25%;  border:1px solid #eee;'>성 명</th>
        <td style='width:25%;  border:1px solid #eee;'> {{ $order_data->member_name ?? null }}</td>
        <th style='width:25%;  border:1px solid #eee;'>주민등록번호</th>
        <td style='width:25%;  border:1px solid #eee;'></td>
      </tr>
      <tr>
        <th  style='width:25%;  border:1px solid #eee;'>연 락 처</th>
        <td colspan="3">  {{ $order_data->delivery_phone ?? null }} </td>
      </tr>
      <tr>
        <th  style='width:25%;  border:1px solid #eee;'>제품 받을 주소</th>
        <td colspan="3">  {{ $order_data->zipcode ?? null }} {{ $order_data->address ?? null }} {{ $order_data->address_detail ?? null }} </td>
      </tr>
    </table>
  </div>

  <div class="order-items">
    <h3>주문상품 정보</h3>
    <table class="items-table">
      <thead>
      <tr>
        <th>코드NO</th>
        <th>제품명</th>
        <th>규격</th>
        <th>수량</th>
        <th>구매가격(원)</th>
        <th>소비자가격(원)</th>
        <th>합계</th>
      </tr>
      </thead>
      <tbody>
      @if(isset($item_info))
        @foreach ($item_info as $item)
          <tr>
            <td>YNR-{{$item->pd_seq}}</td>
            <td>{{$item->pd_name}}</td>
            <td>{{$item_array[$item->pd_seq]['capacity']}}</td>
            <td>{{$item->pd_qty}}</td>
            <td>{{number_format($item->pd_price)}}</td>
            <td>{{number_format($item_array[$item->pd_seq]['price'])}}</td>
            <td><span class='pd_total' id='pd_total_{{$item->pd_seq}}'>{{number_format($item->pd_price * $item->pd_qty)}}</span></td>
          </tr>
          
        @endforeach
        <tr>
          <th colspan="6">total</th>
          
          <td><span>{{number_format($order_data->total_amount)}}</span></td>
        </tr>
      @else
        <tr><td style='text-align:center; height:80px;' colspan="6">선택한 상품이 없습니다.</td> </tr>
      @endif
      </tbody>
    </table>

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
            <td>{{$account->account_head}}</td>
            <td>{{$account->account_date}}</td>
            <td>{{number_format($account->account_payment_price)}}</td>
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
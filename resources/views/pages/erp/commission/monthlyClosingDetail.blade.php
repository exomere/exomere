@extends('layouts/contentNavbarLayout')
<meta name="csrf-token" content="{{ csrf_token() }}"/>
@section('title', 'Erp - Commission - list')

@section('content')

<div class="card">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">월마감</h5> <small class="text-muted float-end"></small>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table" style="table-layout: fixed">
    <colgroup>
        <col style="width:80px"/>
        <col style="width:100px"/>
        <col style="width:120px"/>
        <col style="width:140px"/>
        <col style="width:140px"/>
        <col style="width:160px"/>
        <col style="width:160px"/>
        <col style="width:140px"/>
        <col style="width:140px"/>
        <col style="width:140px"/>
        <col style="width:140px"/>
        <col style="width:140px"/>
        <col style="width:140px"/>
        <col style="width:140px"/>
        <col style="width:140px"/>
        <col style="width:140px"/>
        <col style="width:140px"/>
        <col style="width:140px"/>
        <col style="width:140px"/>
    </colgroup>
      <thead>
        <tr>
          <th rowspan="2" style=' vertical-align: middle;'>No</th>
          <th rowspan="2" style=' vertical-align: middle;'>상세</th>
          <th rowspan="2" style=' vertical-align: middle;'>회원번호</th>
          <th rowspan="2" style=' vertical-align: middle;'>아이디</th>
          <th rowspan="2" style=' vertical-align: middle;'>회원명</th>
          <th rowspan="2" style=' vertical-align: middle;'>PV</th>
          <th rowspan="2" style=' vertical-align: middle;'>누적매출</th>
          <th colspan="8" style=' vertical-align: middle; text-align:center;'>지급항목</th>
          <th colspan="3" style=' vertical-align: middle;'>수당공제</th>
          <th rowspan="2" style=' vertical-align: middle;'>실지급액</th>
        </tr>
        <tr>
            <th>직접모집관리금</th>
            <th>장려금</th>
            <th>지역사무실지원금</th>
            <th>인센티브</th>
            <th>우수총판기여금</th>
            <th>최우수총판기여금</th>
            <th>지급합계</th>
            <th>포인트 지급합계</th>
            <th>소득세</th>
            <th>주민세</th>
            <th>공제합계</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @php
          $row_num = $row_num ?? $statements->total();
        @endphp
        @foreach ($statements as $statement)
            <tr class="align-middle py-2">
                <td><span class="fw-medium">{{ $row_num-- }}</span></td>
                <td>
                    <a class="badge bg-label-info me-4" href="{{ route('erp-allowance.monthly-user', ['seq' => $statement->member_seq, 'type' => $statement->type]) }}">
                        <span class="fw-medium">상세보기</span>
                    </a>
                </td>
                <td>{{ $statement->member_seq }}</td>
                <td>{{ $statement->member_id }}</td>
                <td>{{ $statement->member_name }}</td>
                <td>{{ number_format($statement->pv) }}</td>
                <td>{{ number_format($statement->total_amount) }}</td>

                <td><a class="dropdown-item getPaymentInfo" data-type='0' data-mem_seq='{{$statement->member_seq}}' data-seq='{{$statement->id}}' data-bs-target="#paymentList" data-bs-toggle="modal"> {{ number_format($statement->recruitment_amount) }} </a></td>
                <td><a class="dropdown-item getPaymentInfo" data-type='1' data-mem_seq='{{$statement->member_seq}}' data-seq='{{$statement->id}}' data-bs-target="#paymentList" data-bs-toggle="modal">{{ number_format($statement->promote_price) }}</a></td>
                <td><a class="dropdown-item getPaymentInfo" data-type='2' data-mem_seq='{{$statement->member_seq}}' data-seq='{{$statement->id}}' data-bs-target="#paymentList" data-bs-toggle="modal">{{ number_format($statement->center_amount) }}</a></td>
                <td><a class="dropdown-item getPaymentInfo" data-type='3' data-mem_seq='{{$statement->member_seq}}' data-seq='{{$statement->id}}' data-bs-target="#paymentList" data-bs-toggle="modal">{{ number_format($statement->incentives) }}</a></td>
                <td><a class="dropdown-item getPaymentInfo" data-type='4' data-mem_seq='{{$statement->member_seq}}' data-seq='{{$statement->id}}' data-bs-target="#paymentList" data-bs-toggle="modal">{{ number_format($statement->contribution_amount) }}</a></td>
                <td><a class="dropdown-item getPaymentInfo" data-type='5' data-mem_seq='{{$statement->member_seq}}' data-seq='{{$statement->id}}' data-bs-target="#paymentList" data-bs-toggle="modal">{{ number_format($statement->contribution_amount2) }}</a></td>
                
                <td>{{ number_format($statement->total_payment) }}</td>
                <td>{{ number_format($statement->payment_points) }}</td>
                <td>{{ number_format($statement->income_tax) }}</td>
                <td>{{ number_format($statement->residence_tax) }}</td>
                <td>{{ number_format($statement->total_deduction) }}</td>
                <td>{{ number_format($statement->actual_amount) }}</td>
                
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="modal fade" id="paymentList" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
      <div class="modal-content">
        <div class="modal-body">
          <div class="text-center mb-6">
            <h4 class="mb-2" id='popTitle'>직접모집 관리금 내역</h4>
          </div>
            <div class="col-12">
              <div class="row mb-3">
                <div class="col-sm-12">
                  <div class="card">
                    <table class="table">
                      <thead>
                        <tr class="text-nowrap">
                          <th>ID</th>
                          <td><span id='info_id'></span></td>
                          <th>이름</th>
                          <td><span id='info_name'></span></td>
                          <th>나의 PV</th>
                          <td><span id='info_self_pv'></span></td>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-12">
                  <div class="card">
                    <div class="table-responsive text-nowrap">
                      <table class="table">
                        <thead>
                          <tr class="text-nowrap">
                            <th>아이디</th>
                            <th>이름</th>
                            <th>금액</th>
                            <th>날짜</th>
                          </tr>
                        </thead>
                        <tbody class="info_body">

                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!--/ Responsive Table -->
                </div>
              </div>
            </div>
            <div class="col-12 text-center">
              <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" style='border:1px solid #eee;' aria-label="Close">확인</button>
            </div>
        </div>
      </div>
    </div>
  </div>
    <div class="card-footer d-flex justify-content-end">
        {{ $statements->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
<!--/ Basic Bootstrap Table -->
@endsection

@section('page-script')
 <script>
  function addComma (value) {
      value = String(value).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      return value;
  }

  $(".getPaymentInfo").on("click",function(){

    var seq = $(this).data("seq");
    var mem_seq = $(this).data("mem_seq");
    var type = $(this).data("type");

    var type_text = [
      '직접모집관리금',
      '장려금',
      '지역사무실지원금',
      '인센티브',
      '우수총판기여금',
      '최우수총판기여금',
    ];

    $("#popTitle").text(type_text[type]);

    $(".info_body").empty();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        dataType:'JSON',
        url: "/management/erp/commission/userCommissionList",
        data: {
            "seq": seq,
            "mem_seq" : mem_seq,
            "type" : type,
        },
        success: function (res) {
          console.log(res);
          var html = "";
            $('#info_id').text(res.member_id);
            $('#info_name').text(res.member_name);
            $('#info_self_pv').text(addComma(res.self_pv));
          if(res.total_count == 0){
            html += "<tr><td colspan='4'>내역이 없습니다.</td></tr>";
          }else{
            $.each(res.orderInfo, function (index, data) {
                html+= "<tr>";
                html += " <td>" + data.id + "</td>";
                html += " <td>" + data.name + "</td>";
                html += " <td>" + addComma(data.total_pv) + "</td>";
                html += " <td>" + data.order_date + "</td>";
                html+= "</tr>";
            });
          }
          
          $(".info_body").append(html);
        }
    });

  });
 </script>
@endsection
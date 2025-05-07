@extends('layouts/contentNavbarLayout')
<meta name="csrf-token" content="{{ csrf_token() }}"/>
@section('title', 'Erp - Commission - list')

@section('content')

<div class="card">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">{{__('erp.monthly_closing_date')}}</h5> <small class="text-muted float-end"></small>
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
          <th rowspan="2" style=' vertical-align: middle;'>{{__('erp.details')}}</th>
          <th rowspan="2" style=' vertical-align: middle;'>{{__('erp.member_number')}}</th>
          <th rowspan="2" style=' vertical-align: middle;'>{{__('erp.id')}}</th>
          <th rowspan="2" style=' vertical-align: middle;'>{{__('erp.member_name')}}</th>
          <th rowspan="2" style=' vertical-align: middle;'>PV</th>
          <th rowspan="2" style=' vertical-align: middle;'>{{__('erp.accumulated_sales')}}</th>
          <th colspan="8" style=' vertical-align: middle; text-align:center;'>{{__('erp.payment_items')}}</th>
          <th colspan="3" style=' vertical-align: middle;'>{{__('erp.allowment_deduction')}}</th>
          <th rowspan="2" style=' vertical-align: middle;'>{{__('erp.actual_payment_amount')}}</th>
        </tr>
        <tr>
            <th>{{__('erp.direct_recruitment_fee')}}</th>
            {{-- <th>{{__('erp.incentive_money')}}</th> --}}
            <th>{{__('erp.local_office_support_fund')}}</th>
            {{-- <th>{{__('erp.incentive')}}</th> --}}
            <th>{{__('erp.excellent_exclusive_distributor_contribution')}}</th>
            <th>{{__('erp.standing_contribution')}}</th>
            <th>{{__('erp.contributions_sales')}}</th>
            <th>{{__('erp.best_exclusive_distributor_contribution')}}</th>
            <th>{{__('erp.payment_total')}}</th>
            <th>{{__('erp.points_total_payment')}}</th>
            <th>{{__('erp.income_tax')}}</th>
            <th>{{__('erp.residence_tax')}}</th>
            <th>{{__('erp.total_deduction')}}</th>
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
                        <span class="fw-medium">{{__('erp.view_details')}}</span>
                    </a>
                </td>
                <td>{{ $statement->member_seq }}</td>
                <td>{{ $statement->member_id }}</td>
                <td>{{ $statement->member_name }}</td>
                <td>{{ number_format($statement->pv) }}</td>
                <td>{{ number_format($statement->total_amount) }}</td>

                <td><a class="dropdown-item getPaymentInfo" data-type='0' data-mem_seq='{{$statement->member_seq}}' data-seq='{{$statement->id}}' data-bs-target="#paymentList" data-bs-toggle="modal"> {{ number_format($statement->recruitment_amount) }} </a></td>
                {{-- <td><a class="dropdown-item getPaymentInfo" data-type='1' data-mem_seq='{{$statement->member_seq}}' data-seq='{{$statement->id}}' data-bs-target="#paymentList" data-bs-toggle="modal">{{ number_format($statement->promote_price) }}</a></td> --}}
                <td><a class="dropdown-item getPaymentInfo" data-type='1' data-mem_seq='{{$statement->member_seq}}' data-seq='{{$statement->id}}' data-bs-target="#paymentList" data-bs-toggle="modal">{{ number_format($statement->center_amount) }}</a></td>
                {{-- <td><a class="dropdown-item getPaymentInfo" data-type='3' data-mem_seq='{{$statement->member_seq}}' data-seq='{{$statement->id}}' data-bs-target="#paymentList" data-bs-toggle="modal">{{ number_format($statement->incentives) }}</a></td> --}}
                <td><a class="dropdown-item getPaymentInfo" data-type='2' data-mem_seq='{{$statement->member_seq}}' data-seq='{{$statement->id}}' data-bs-target="#paymentList" data-bs-toggle="modal">{{ number_format($statement->contribution_amount) }}</a></td>
                <td><a class="dropdown-item getPaymentInfo" data-type='3' data-mem_seq='{{$statement->member_seq}}' data-seq='{{$statement->id}}' data-bs-target="#paymentList" data-bs-toggle="modal">{{ number_format($statement->standing_contribution) }}</a></td>
                <td><a class="dropdown-item getPaymentInfo" data-type='4' data-mem_seq='{{$statement->member_seq}}' data-seq='{{$statement->id}}' data-bs-target="#paymentList" data-bs-toggle="modal">{{ number_format($statement->contributions_sales) }}</a></td>
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
            <h4 class="mb-2" id='popTitle'>{{__('erp.direct_recruitment_details')}}</h4>
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
                          <th>{{__('erp.name')}}</th>
                          <td><span id='info_name'></span></td>
                          <th>{{__('erp.my_pv')}}</th>
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
                            <th>{{__('erp.id')}}</th>
                            <th>{{__('erp.name')}}</th>
                            <th>{{__('erp.amount')}}</th>
                            <th>{{__('erp.name')}}</th>
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
              <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" style='border:1px solid #eee;' aria-label="Close">
                  {{__('erp.confirm')}}
              </button>
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
      '{{__('erp.direct_recruitment_fee')}}',
      '{{__('erp.incentive_money')}}',
      '{{__('erp.local_office_support_fund')}}',
      '{{__('erp.incentive')}}',
      '{{__('erp.excellent_exclusive_distributor_contribution')}}',
      '{{__('erp.best_exclusive_distributor_contribution')}}',
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
            html += "<tr><td colspan='4'>{{__('erp.no_details')}}</td></tr>";
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
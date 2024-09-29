@extends('layouts/contentNavbarLayout')
<meta name="csrf-token" content="{{ csrf_token() }}"/>
@section('title', 'Erp - Commission - list')

@section('content')
<!-- Basic -->
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
  <div class="container-fluid">
    <a class="navbar-brand" href="javascript:void(0)"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        </li>
        <li class="nav-item">
        </li>
       
        <li class="nav-item">
        </li>
      </ul>
      <form class="d-flex" method="post" action="{{route('erp.term.calculation')}}">
        @csrf
        <label class="col-form-label" style='font-size:16px;' for="start_date">정산일자 : </label>
        <input type="text" class="form-control" style='margin-left:10px; margin-right:10px; width:120px;' readonly id="start_date" name='start_date' />
        <label class="col-form-label" style='font-size:16px;' for="end_date"> ~ </label>
        <input type="text" class="form-control" style='margin-left:10px; margin-right:10px; width:120px;' readonly id="end_date" name='end_date' />
        <button class="btn btn-outline-primary" style='margin-left:10px; margin-right:10px; width:240px;' type="submit">수당계산</button>
      </form>
    </div>
  </div>
</nav>
<!--/ Basic -->
<div class="card">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">기마감</h5> <small class="text-muted float-end"></small>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table" >
      <thead>
        <tr>
          <th style=' vertical-align: middle;'>No</th>
          <th style=' vertical-align: middle;'>상세</th>
          <th style=' vertical-align: middle;'>마감일자</th>
          <th style=' vertical-align: middle;'>시작일자</th>
          <th style=' vertical-align: middle;'>종료일자</th>
          <th style=' vertical-align: middle;'>매출액</th>
          <th style=' vertical-align: middle;'>PV</th>
          <th style=' vertical-align: middle;'>합계금액</th>
          <th style=' vertical-align: middle;'>실지급액</th>
          <th style=' vertical-align: middle;'>마감자</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @isset($statements)
            @foreach ($statements as $statement)
                <tr class="align-middle py-2">
                    <td><span class="fw-medium">{{ $row_num-- }}</span></td>
                    <td>
                        <a class="badge bg-label-info me-4" href="{{ route('erp-allowance.monthly-detail', ['code' => $statement->code, 'type' => $statement->type]) }}">
                            <span class="fw-medium">상세보기</span>
                        </a>
                    </td>
                    <td><span class="fw-medium">{{ date("Y-m-d",strtotime($statement->deadline_date)) }}</span></td>
                    <td><span class="fw-medium">{{ date("Y-m-d",strtotime($statement->s_date)) }}</span></td>
                    <td><span class="fw-medium">{{ date("Y-m-d",strtotime($statement->e_date)) }}</span></td>
                    <td>{{ number_format($statement->total_amount) }}</td>
                    <td>{{ number_format($statement->total_pv) }}</td>
                    <td>{{ number_format($statement->total_payment) }}</td>
                    <td>{{ number_format($statement->actual_amount) }}</td>
                    <td>{{ $statement->reg_name }}</td>
                </tr>
            @endforeach
        @endisset
      </tbody>
    </table>
  </div>
  <div class="card-footer d-flex justify-content-end">
    @isset($statements)
      {{ $statements->links('vendor.pagination.bootstrap-4') }}
    @endisset
  </div>
</div>
<!--/ Basic Bootstrap Table -->
@endsection
@section("page-script")
<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
<script src="/assets/js/jquery.monthpicker.js"></script>
<script>
    $(function () {
        var now = new Date();
        var year = "<?php echo date('Y')?>";
        var month = now.getMonth()+1;
        var last = new Date(year, month, 0);
        var last_day = last.getDate();
        if(month < 10){
            month = "0"+(month);
        }

        if(last_day < 10){
            last_day = "0"+(now.getDate());
        }

        // $("#settlement_month").monthpicker();                    
        $('#settlement_month').monthpicker({
            pattern: 'yyyy-mm', // Default is 'mm/yyyy' and separator char is not mandatory
            monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월']
        });

        $("#deadline_date").datepicker();
        $("#deadline_date").datepicker("option", "dateFormat", 'yy-mm-dd');
        $("#start_date").datepicker();
        $("#start_date").datepicker("option", "dateFormat", 'yy-mm-dd');
        $("#end_date").datepicker();
        $("#end_date").datepicker("option", "dateFormat", 'yy-mm-dd');
                
        $("#settlement_month").val(year+"-"+month);
        $("#deadline_date").val(year+"-"+month+"-"+last_day);
        $("#start_date").val(year+"-"+month+"-01");
        $("#end_date").val(year+"-"+month+"-"+last_day);
    });  
</script>
@endsection
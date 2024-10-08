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
      <form class="d-flex" method="post" action="{{route('term-closing')}}">
        @csrf
        <label class="col-form-label" style='font-size:16px;' for="start_date">정산일자 : </label>
        <input type="text" class="form-control" style='margin-left:10px; margin-right:10px; width:120px;' readonly id="start_date" name='start_date' />
        <label class="col-form-label" style='font-size:16px;' for="end_date"> ~ </label>
        <input type="text" class="form-control" style='margin-left:10px; margin-right:10px; width:120px;' readonly id="end_date" name='end_date' />
        <button class="btn btn-outline-primary" style='margin-left:10px; margin-right:10px; width:240px;' type="submit">검색</button>
      </form>
    </div>
  </div>
</nav>
<!--/ Basic -->
<div class="card">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">기마감 내역</h5> <small class="text-muted float-end"></small>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table" >
      <thead>
        <tr>
          <th rowspan="2" style=' vertical-align: middle;'>No</th>
          <th rowspan="2" style=' vertical-align: middle;'>마감일</th>
          <th rowspan="2" style=' vertical-align: middle;'>정착지원금</th>
          <th rowspan="2" style=' vertical-align: middle;'>모집축하금</th>
          <th colspan="3" style=' vertical-align: middle; text-align:center;'>수당공제</th>
          <th rowspan="2" style=' vertical-align: middle;'>실지급액</th>
        </tr>
        <tr>
          <th>소득세</th>
          <th>주민세</th>
          <th>공제합계</th>
      </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @isset($output_data)
            @foreach ($output_data as $data)
                <tr class="align-middle py-2">
                    <td><span class="fw-medium">{{ $data['no'] }}</span></td>
                    <td><span class="fw-medium">{{ $data['code'] }}</span></td>
                    <td><span class="fw-medium">{{ number_format($data['settlement_subsidy'] )}}</span></td>
                    <td><span class="fw-medium">{{ number_format($data['recruitment_amount'] )}}</span></td>
                    <td><span class="fw-medium">{{ number_format($data['income_tax'])}}</span></td>
                    <td><span class="fw-medium">{{ number_format($data['residence_tax'])}}</span></td>
                    <td><span class="fw-medium">{{ number_format($data['total_deduction'])}}</span></td>
                    <td><span class="fw-medium">{{ number_format($data['actual_amount'])}}</span></td>
                </tr>
            @endforeach
        @endisset
      </tbody>
    </table>
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
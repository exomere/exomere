@extends('layouts/contentNavbarLayout')
<meta name="csrf-token" content="{{ csrf_token() }}"/>
@section('title', 'Erp - Commission - list')

@section('content')

<div class="card">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">기마감 유저</h5> <small class="text-muted float-end"></small>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table" style="table-layout: fixed">
    <colgroup>
        <col style="width:80px"/>
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
    </colgroup>
      <thead>
        <tr>
          <th rowspan="2" style=' vertical-align: middle;'>No</th>
          <th rowspan="2" style=' vertical-align: middle;'>회원번호</th>
          <th rowspan="2" style=' vertical-align: middle;'>아이디</th>
          <th rowspan="2" style=' vertical-align: middle;'>회원명</th>
          <th rowspan="2" style=' vertical-align: middle;'>PV</th>
          <th rowspan="2" style=' vertical-align: middle;'>누적매출</th>
          <th colspan="3" style=' vertical-align: middle; text-align:center;'>지급항목</th>
          <th colspan="3" style=' vertical-align: middle; text-align:center;'>수당공제</th>
          <th rowspan="2" style=' vertical-align: middle;'>실지급액</th>
        </tr>
        <tr>
            <th>직접모집축하금</th>
            <th>정착지원금</th>
            <th>지급합계</th>
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
                <td>{{ $statement->member_seq }}</td>
                <td>{{ $statement->member_id }}</td>
                <td>{{ $statement->member_name }}</td>
                <td>{{ number_format($statement->pv) }}</td>
                <td>{{ number_format($statement->total_amount) }}</td>
                <td>{{ number_format($statement->recruitment_amount) }}</td>
                <td>{{ number_format($statement->settlement_subsidy) }}</td>
                <td>{{ number_format($statement->total_payment) }}</td>
                <td>{{ number_format($statement->income_tax) }}</td>
                <td>{{ number_format($statement->residence_tax) }}</td>
                <td>{{ number_format($statement->total_deduction) }}</td>
                <td>{{ number_format($statement->actual_amount) }}</td>
                
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
    <div class="card-footer d-flex justify-content-end">
        {{ $statements->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
<!--/ Basic Bootstrap Table -->
@endsection
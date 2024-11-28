@extends('layouts/contentNavbarLayout')
<meta name="csrf-token" content="{{ csrf_token() }}"/>
@section('title', 'Erp - Commission - list')

@section('content')

<div class="card">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">{{__('erp.gi_closing_date')}} {{__('erp.member')}}</h5> <small class="text-muted float-end"></small>
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
          <th rowspan="2" style=' vertical-align: middle;'>{{__('erp.member_number')}}</th>
          <th rowspan="2" style=' vertical-align: middle;'>{{__('erp.id')}}</th>
          <th rowspan="2" style=' vertical-align: middle;'>{{__('erp.member_name')}}</th>
          <th rowspan="2" style=' vertical-align: middle;'>PV</th>
          <th rowspan="2" style=' vertical-align: middle;'>{{__('erp.accumulated_sales')}}</th>
          <th colspan="3" style=' vertical-align: middle; text-align:center;'>{{__('erp.payment_items')}}</th>
          <th colspan="3" style=' vertical-align: middle; text-align:center;'>{{__('erp.allowment_deduction')}}</th>
          <th rowspan="2" style=' vertical-align: middle;'>{{__('erp.actual_payment_amount')}}</th>
        </tr>
        <tr>
            <th>{{__('erp.recruitment_congratulatory_money')}}</th>
            <th>{{__('erp.settlement_subsidy_money')}}</th>
            <th>{{__('erp.payment_total')}}</th>
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
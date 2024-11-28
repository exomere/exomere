@extends('layouts/contentNavbarLayout')
<meta name="csrf-token" content="{{ csrf_token() }}"/>
@section('title', 'Erp - Commission - list')

@section('content')

<div class="card">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">{{__('erp.monthly_closing_date')}} {{__('erp.member')}}</h5> <small class="text-muted float-end"></small>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table" style="table-layout: fixed">
    <colgroup>
        <col style="width:80px"/>
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
          <th rowspan="2" style=' vertical-align: middle;'>{{__('erp.closing_date')}}</th>
          <th rowspan="2" style=' vertical-align: middle;'>PV</th>
          <th rowspan="2" style=' vertical-align: middle;'>{{__('erp.accumulated_sales')}}</th>
          <th colspan="8" style=' vertical-align: middle; text-align:center;'>{{__('erp.payment_items')}}</th>
          <th colspan="3" style=' vertical-align: middle;  text-align:center;'>{{__('erp.allowment_deduction')}}</th>
          <th rowspan="2" style=' vertical-align: middle;'>{{__('erp.actual_payment_amount')}}</th>
        </tr>
        <tr>
            <th>{{__('erp.direct_recruitment_fee')}}</th>
            <th>{{__('erp.incentive_money')}}</th>
            <th>{{__('erp.local_office_support_fund')}}</th>
            <th>{{__('erp.incentive')}}</th>
            <th>{{__('erp.excellent_exclusive_distributor_contribution')}}</th>
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
                <td>{{ $statement->code }}</td>
                <td>{{ number_format($statement->pv) }}</td>
                <td>{{ number_format($statement->total_amount) }}</td>
                <td>{{ number_format($statement->recruitment_amount) }}</td>
                <td>{{ number_format($statement->promote_price) }}</td>
                <td>{{ number_format($statement->center_amount) }}</td>
                <td>{{ number_format($statement->incentives) }}</td>
                <td>{{ number_format($statement->contribution_amount) }}</td>
                <td>{{ number_format($statement->contribution_amount2) }}</td>
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
    <div class="card-footer d-flex justify-content-end">
        {{ $statements->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
<!--/ Basic Bootstrap Table -->
@endsection
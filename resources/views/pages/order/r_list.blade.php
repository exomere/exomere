@extends('layouts/contentNavbarLayout')

@section('title', 'Order - list')

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
    </div>
  </div>
</nav>
<!--/ Basic -->
<div class="card">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">주문 내역</h5> <small class="text-muted float-end">
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table" >
      <thead>
        <tr>
          <th style='vertical-align: middle;'>No</th>
          <th style='vertical-align: middle;'>주문번호</th>
          <th style='vertical-align: middle;'>주문구분</th>
          <th style='vertical-align: middle;'>주문일자</th>
          <th style='vertical-align: middle;'>매출</th>
          <th style='vertical-align: middle;'>PV1</th>
          <th style='vertical-align: middle;'>상태</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

        @foreach ($orders as $list)
          <tr>
            <td> <span class="fw-medium">{{$row_num--}}</span></td>
            <td> <span class="fw-medium">{{$list->id}}</span></td>
            <td> <span class="fw-medium">{{ $order_kind[$list->order_type] }}</span></td>
            <td> <span class="fw-medium">{{date("Y-m-d",strtotime($list->order_date))}}</span></td>
            <td> <span class="fw-medium">{{number_format($list->total_amount)}}</span></td>
            <td> <span class="fw-medium">{{number_format($list->total_pv)}}</span></td>
            <td> <span class="fw-medium">{{$approval_kind[$list->is_approval]}}</span></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-footer d-flex justify-content-end">
      {{ $orders->links('vendor.pagination.bootstrap-4') }}
  </div>
</div>
<!--/ Basic Bootstrap Table -->
@endsection

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
      <form class="d-flex" action="{{ route('erp-order-layouts-order-list') }}" method="GET">
        <input type="date" name="start_date" style="ime-mode:inactive;" class="form-control" value="{{ request('start_date') }}" placeholder="시작일">
        <input type="date" name="end_date"  style="ime-mode:inactive;" class="form-control" value="{{ request('end_date') }}" placeholder="종료일">

        <select name="approval_status" id="approval_status" class="form-select color-dropdown">
          <option value="" {{ request('approval_status') == '' ? 'selected' : '' }}>:: {{__('erp.approval_classification')}} ::</option>
          <option value="Y" {{ request('approval_status') == 'Y' ? 'selected' : '' }}>{{__('erp.approval_complete')}}</option>
          <option value="P" {{ request('approval_status') == 'P' ? 'selected' : '' }}>{{__('erp.awaiting_approval')}}</option>
          <option value="N" {{ request('approval_status') == 'N' ? 'selected' : '' }}>{{__('erp.cancel')}}</option>
        </select>

        <select name="order_type" id="order_type" class="form-select color-dropdown">
          <option value="" {{ request('order_type') == '' ? 'selected' : '' }}>:: {{__('erp.order_classification')}} ::</option>
          <option value="new" {{ request('order_type') == 'new' ? 'selected' : '' }}>{{__('erp.new_order')}}</option>
          <option value="repurchase" {{ request('order_type') == 'repurchase' ? 'selected' : '' }}>{{__('erp.repurchase_order')}}</option>
          <option value="distribute_new" {{ request('order_type') == 'distribute_new' ? 'selected' : '' }}>{{__('erp.new_sale_mall')}}</option>
          <option value="distribute_repurchase" {{ request('order_type') == 'distribute_repurchase' ? 'selected' : '' }}>{{__('erp.repurchase_in_sale_mall')}}</option>
        </select>

        <select name="search_field" id="search_field" class="form-select color-dropdown">
          <option value="member_name" {{ request('search_field') == 'member_name' ? 'selected' : '' }}>{{__('erp.member_name')}}</option>
          <option value="member_id" {{ request('search_field') == 'member_id' ? 'selected' : '' }}>{{__('erp.member_id')}}</option>
          <option value="member_seq" {{ request('search_field') == 'member_seq' ? 'selected' : '' }}>{{__('erp.member_number')}}</option>
          <option value="order_seq" {{ request('search_field') == 'order_seq' ? 'selected' : '' }}>{{__('erp.order_number')}}</option>
        </select>

        <input class="form-control me-2" style='width:240px;' name="search_text" type="search" placeholder="Search" aria-label="Search" value="{{ request('search_text') }}">
        <button class="btn btn-outline-primary" type="submit">{{__('erp.search')}}</button>
      </form>
    </div>
  </div>
</nav>
<!--/ Basic -->
<div class="card">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">{{__('erp.order_list')}}</h5>
    <small class="text-muted float-end">
      <form action="{{ route('erp-order.export') }}" method="GET" class="d-inline">
        <input type="hidden" name="start_date" value="{{ request('start_date') }}">
        <input type="hidden" name="end_date" value="{{ request('end_date') }}">
        <input type="hidden" name="approval_status" value="{{ request('approval_status') }}">
        <input type="hidden" name="order_type" value="{{ request('order_type') }}">
        <input type="hidden" name="search_field" value="{{ request('search_field') }}">
        <input type="hidden" name="search_text" value="{{ request('search_text') }}">
        <button type="submit" class="btn btn-info">Excel</button>
      </form>
      <button onclick="location.href='{{route('erp-order-layouts-order-register')}}'" class="btn btn-primary">{{__('erp.order_registration')}}</button>
    </small>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table" >
      <thead>
        <tr>
          <th style='vertical-align: middle;' rowspan='2'>No</th>
          <th style='vertical-align: middle;' rowspan='2'>{{__('erp.is_approval')}}</th>
          <th style='vertical-align: middle;' rowspan='2'>{{__('erp.order_classification')}}</th>
          <th style='vertical-align: middle;' rowspan='2'>{{__('erp.order_receipt_method')}}</th>
          
          {{-- <th style='vertical-align: middle;' rowspan='2'>주문서</th> --}}
          <th style='vertical-align: middle;' rowspan='2'>{{__('erp.order_amount')}}</th>
          <th style='vertical-align: middle;' rowspan='2'>PV1</th>
          <th style='vertical-align: middle;' rowspan='2'>{{__('erp.orderer')}}</th>
          <th style='vertical-align: middle;' rowspan='2'>{{__('erp.order_date')}}</th>
          <th style='vertical-align: middle;' rowspan='2'>{{__('erp.order_number')}}</th>
          <th style='vertical-align: middle;' rowspan='2'>{{__('erp.id')}}</th>
          <th style='vertical-align: middle;' rowspan='2'>{{__('erp.name')}}</th>
          <th style='vertical-align: middle;' rowspan='2'>{{__('erp.local_branch')}}</th>
          <th style='vertical-align: middle;' rowspan='2'>{{__('erp.product')}}</th>
          <th style='text-align:center;' colspan='2'>{{__('erp.recruiter')}}</th>
          <th style='vertical-align: middle;' rowspan='2'>{{__('erp.remarks')}}</th>
          <th style='vertical-align: middle;' rowspan='2'>{{__('erp.registrant')}}</th>
          <th style='vertical-align: middle;' rowspan='2'>{{__('erp.management')}}</th>
        </tr>
        <tr>
          <th>{{__('erp.id')}}</th>
          <th>{{__('erp.name')}}</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

        @foreach ($orders as $list)
          <tr>
            <td> <span class="fw-medium">{{$row_num--}}</span></td>
            <td>
              @if ($list->is_approval == 'Y')
                <span class="fw-medium">{{__('erp.approval')}}</span>
              @elseif ($list->is_approval == 'C')
                <span class="fw-medium">{{__('erp.cancel')}}</span>
              @else
                <input type='button' class='cfOrder' data-seq='{{$list->id}}' data-type='Y' value='{{__('erp.approval')}}'>
                <input type='button' class='cfOrder' data-seq='{{$list->id}}' data-type='C' value='{{__('erp.cancel')}}'>
              @endif

            </td>
            {{-- <td>
              <a class="badge bg-label-info me-2" >
                  <span class="fw-medium">주문서</span>
              </a>
            </td> --}}
            <td> <span class="fw-medium">{{ $order_kind[$list->order_type] ?? "" }}</span></td>
            <td> <span class="fw-medium">{{($list->receipt_method == 'scene') ? '현장수령' : '택배수령'}}</span></td>
            <td> <span class="fw-medium">{{number_format($list->total_amount)}}</span></td>
            <td> <span class="fw-medium">{{number_format($list->total_pv)}}</span></td>
            <td> <span class="fw-medium">{{$list->delivery_name ?? $list->member_name}}</span></td>
            <td> <span class="fw-medium">{{date("Y-m-d",strtotime($list->order_date))}}</span></td>
            <td> <span class="fw-medium">{{$list->id}}</span></td>
            <td> <span class="fw-medium">{{$list->member_id}}</span></td>
            <td> <span class="fw-medium">{{$list->member_name}}</span></td>
            <td> <span class="fw-medium">{{$list->getCenterName()}}</span></td>
            <td> <span class="fw-medium">상품</span></td>
            <td>{{$list->findByMemberRecommend()->get()->value('recommend_id')}}</td>
            <td>{{$list->findByMemberRecommend()->get()->value('recommend_name')}}</td>
            <td> <span class="fw-medium">{{$list->remark}}</span></td>
            <td> <span class="fw-medium">{{$list->reg_name ?? 'oley'}}</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);" onclick="printOrderDetails({{ $list->id }})">
                    <i class="bx bx-printer me-1"></i> 발주서
                  </a>
                  <form action="{{ route('erp-order.print.detail') }}" method="GET" class="d-inline">
                    <input type="hidden" name="order_id" value="{{ $list->id  }}">
                    <button type="submit" class="btn btn-info" style='margin-left:15px;'>발주 Excel</button>
                  </form> 
                  <a class="dropdown-item" href="{{route('erp-order-layouts-order-register',$list->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <a class="dropdown-item" style='color:red;' href="{{route('erp-order.del',$list->id)}}"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-footer d-flex justify-content-end">
    {{ $orders->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
  </div>
</div>
<!--/ Basic Bootstrap Table -->
@endsection

@section('page-script')
 <script>
  $(".cfOrder").on("click",function(){

    var seq = $(this).data("seq");
    var type = $(this).data("type");

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: "/management/erp/order/approving",
        data: {
            "seq": seq,
            "type": type,
        },
        success: function (res) {
          alert('{{__('erp.processing_completed')}}');
          location.reload();
        }
    });
  });
  function printOrderDetails(orderId) {
    // Option 1: Open a new window or modal for a detailed view and print
    const printWindow = window.open(`/management/erp/order/print/${orderId}`, '_blank');
    printWindow.onload = function () {
      printWindow.print();
    };
  }

 </script>
@endsection
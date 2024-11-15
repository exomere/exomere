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
        <select name="approval_status" id="approval_status" class="form-select color-dropdown">
          <option value="" {{ request('approval_status') == '' ? 'selected' : '' }}>:: 승인구분 ::</option>
          <option value="Y" {{ request('approval_status') == 'Y' ? 'selected' : '' }}>승인완료</option>
          <option value="P" {{ request('approval_status') == 'P' ? 'selected' : '' }}>승인대기</option>
          <option value="N" {{ request('approval_status') == 'N' ? 'selected' : '' }}>취소</option>
        </select>

        <select name="order_type" id="order_type" class="form-select color-dropdown">
          <option value="" {{ request('order_type') == '' ? 'selected' : '' }}>:: 주문구분 ::</option>
          <option value="new" {{ request('order_type') == 'new' ? 'selected' : '' }}>신규주문</option>
          <option value="repurchase" {{ request('order_type') == 'repurchase' ? 'selected' : '' }}>재구매주문</option>
          <option value="distribute_new" {{ request('order_type') == 'distribute_new' ? 'selected' : '' }}>분양몰신규</option>
          <option value="distribute_repurchase" {{ request('order_type') == 'distribute_repurchase' ? 'selected' : '' }}>분양몰재구매</option>
        </select>

        <select name="search_field" id="search_field" class="form-select color-dropdown">
          <option value="member_name" {{ request('search_field') == 'member_name' ? 'selected' : '' }}>회원명</option>
          <option value="member_id" {{ request('search_field') == 'member_id' ? 'selected' : '' }}>회원아이디</option>
          <option value="member_seq" {{ request('search_field') == 'member_seq' ? 'selected' : '' }}>회원번호</option>
          <option value="order_seq" {{ request('search_field') == 'order_seq' ? 'selected' : '' }}>주문번호</option>
        </select>

        <input class="form-control me-2" style='width:240px;' name="search_text" type="search" placeholder="Search" aria-label="Search" value="{{ request('search_text') }}">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<!--/ Basic -->
<div class="card">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">주문 리스트</h5> <small class="text-muted float-end"><button onclick="location.href='{{route('erp-order-layouts-order-register')}}'" class="btn btn-primary">주문등록</button></small>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table" >
      <thead>
        <tr>
          <th style='vertical-align: middle;' rowspan='2'>No</th>
          <th style='vertical-align: middle;' rowspan='2'>승인여부</th>
          <th style='vertical-align: middle;' rowspan='2'>주문구분</th>
          {{-- <th style='vertical-align: middle;' rowspan='2'>주문서</th> --}}
          <th style='vertical-align: middle;' rowspan='2'>주문금액</th>
          <th style='vertical-align: middle;' rowspan='2'>PV1</th>
          <th style='vertical-align: middle;' rowspan='2'>주문자</th>
          <th style='vertical-align: middle;' rowspan='2'>주문일자</th>
          <th style='vertical-align: middle;' rowspan='2'>주문번호</th>
          <th style='vertical-align: middle;' rowspan='2'>아이디</th>
          <th style='vertical-align: middle;' rowspan='2'>이름</th>
          <th style='vertical-align: middle;' rowspan='2'>지역점</th>
          <th style='vertical-align: middle;' rowspan='2'>상품</th>
          <th style='text-align:center;' colspan='2'>모집인</th>
          <th style='vertical-align: middle;' rowspan='2'>비고</th>
          <th style='vertical-align: middle;' rowspan='2'>등록자</th>
          <th style='vertical-align: middle;' rowspan='2'>관리</th>
        </tr>
        <tr>
          <th>아이디</th>
          <th>이름</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

        @foreach ($orders as $list)
          <tr>
            <td> <span class="fw-medium">{{$row_num--}}</span></td>
            <td>
              @if ($list->is_approval == 'Y')
                <span class="fw-medium">승인</span>    
              @elseif ($list->is_approval == 'C')
                <span class="fw-medium">취소</span>    
              @else
                <input type='button' class='cfOrder' data-seq='{{$list->id}}' data-type='Y' value='승인'>
                <input type='button' class='cfOrder' data-seq='{{$list->id}}' data-type='C' value='취소'>
              @endif 
              
            </td>
            {{-- <td>
              <a class="badge bg-label-info me-2" >
                  <span class="fw-medium">주문서</span>
              </a>
            </td> --}}
            <td> <span class="fw-medium">{{ $order_kind[$list->order_type] ?? "" }}</span></td>
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
                    <i class="bx bx-printer me-1"></i> Print
                  </a>
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
      {{ $orders->links('vendor.pagination.bootstrap-4') }}
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
          alert('처리가 완료되었습니다.');
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
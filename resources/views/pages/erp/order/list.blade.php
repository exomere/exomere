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
      <form class="d-flex" onsubmit="return false">
        <select id="selectTypeOpt" class="form-select color-dropdown">
          <option value="" selected="">:: 승인구분 ::</option>
          <option value="Y">승인완료</option>
          <option value="Y">승인대기</option>
          <option value="N">취소</option>
        </select>
        <select id="selectTypeOpt" class="form-select color-dropdown">
            <option value="" selected="">:: 주문구분 ::</option>
            <option value="0">신규주문</option>
            <option value="1">재구매주문</option>
            <option value="2">분양몰신규</option>
            <option value="3">분양몰재구매</option>
        </select>
        <select id="selectTypeOpt" class="form-select color-dropdown">
            <option value="member_name">회원명</option>
            <option value="member_id">회원아이디</option>
            <option value="member_seq">회원번호</option>
            <option value="order_seq">주문번호</option>
        </select>
        <input class="form-control me-2" style='width:240px;' type="search" placeholder="Search" aria-label="Search">
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
          <th style='vertical-align: middle;' rowspan='2'>센터</th>
          <th style='vertical-align: middle;' rowspan='2'>상품</th>
          <th style='text-align:center;' colspan='2'>추천인</th>
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
            <td> <span class="fw-medium">{{($list->is_approval == 'Y') ? '승인' : '미승인'}}</span></td>
            {{-- <td>
              <a class="badge bg-label-info me-2" >
                  <span class="fw-medium">주문서</span>
              </a>
            </td> --}}
            <td> <span class="fw-medium">{{ $order_kind[$list->order_type] }}</span></td>
            <td> <span class="fw-medium">{{number_format($list->total_amount)}}</span></td>
            <td> <span class="fw-medium">{{number_format($list->total_amount)}}</span></td>
            <td> <span class="fw-medium">{{$list->delivery_name ?? $list->member_name}}</span></td>
            <td> <span class="fw-medium">{{date("Y-m-d",strtotime($list->order_date))}}</span></td>
            <td> <span class="fw-medium">{{$list->id}}</span></td>
            <td> <span class="fw-medium">{{$list->member_id}}</span></td>
            <td> <span class="fw-medium">{{$list->member_name}}</span></td>
            <td> <span class="fw-medium">{{$list->center_seq}}</span></td>
            <td> <span class="fw-medium">상품</span></td>
            <td>{{$list->findByMemberRecommend()->get()->value('recommend_id')}}</td>
            <td>{{$list->findByMemberRecommend()->get()->value('recommend_name')}}</td>
            <td> <span class="fw-medium">{{$list->remark}}</span></td>
            <td> <span class="fw-medium">{{$list->reg_name ?? 'oley'}}</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
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

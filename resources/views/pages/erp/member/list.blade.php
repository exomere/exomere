@extends('layouts/contentNavbarLayout')

@section('title', 'Erp - basic - Manager - list')

@section('content')
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
              <option value="" selected="">사용여부</option>
              <option value="Y">사용</option>
              <option value="N">미사용</option>
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
      <h5 class="mb-0">회원 리스트</h5> <small class="text-muted float-end"><button onclick="location.href='{{route('basic-layouts-member-register')}}'" class="btn btn-primary">회원 등록</button></small>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table" >
        <thead>
          <tr>
            <th rowspan="2" style='vertical-align: middle;' >No</th>
            <th rowspan="2" style='vertical-align: middle;' >회원관리</th>
            <th rowspan="2" style='vertical-align: middle;' >총판구분</th>
            <th rowspan="2" style='vertical-align: middle;' >회원번호</th>
            <th rowspan="2" style='vertical-align: middle;' >아이디</th>
            <th rowspan="2" style='vertical-align: middle;' >이름</th>
            <th rowspan="2" style='vertical-align: middle;' >이메일</th>
            <th rowspan="2" style='vertical-align: middle;' >회원구분</th>
            <th rowspan="2" style='vertical-align: middle;' >분양몰</th>
            <th rowspan="2" style='vertical-align: middle;' >센터</th>
            <th rowspan="2" style='vertical-align: middle;' >가입일자</th>
            <th rowspan="2" style='vertical-align: middle;' >연락처</th>
            <th rowspan="2" style='vertical-align: middle;' >매출합계</th>
            <th colspan="3" style='text-align:center;'>추천인</th>
            <th rowspan="2" style='vertical-align: middle;'>비고</th>
          </tr>
          <tr>
            <th style='text-align:center;'>회원번호</th>
            <th style='text-align:center;'>아이디</th>
            <th style='text-align:center;'>이름</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          
          @foreach ($ex_members as $list)
            <tr>
              <td>{{$row_num--}}</td>
              <td>
                <a class="badge bg-label-info me-2" >
                    <span class="fw-medium">상세보기</span>
                </a>
                <a class="badge bg-label-info me-2" >
                    <span class="fw-medium">상세보기</span>
                </a>
                <a class="badge bg-label-info me-2" >
                    <span class="fw-medium">상세보기</span>
                </a>
              </td>
              <td>0점</td>
              <td>{{$list->id}}</td>
              <td>{{$list->member_id}}</td>
              <td>{{$list->name}}</td>
              <td>{{$list->email}}</td>
              <td>{{$list->member_position}}</td>
              <td>N</td>
              <td>{{$list->local_store}}</td>
              <td>{{ date("Y-m-d",strtotime($list->created_at)) }}</td>
              <td>{{$list->tel}}</td>
              <td>{{number_format($list->getMemberOrderAmountSum())}}</td>
              <td>{{$list->recommend_seq}}</td>
              <td>{{$list->recommend_id}}</td>
              <td>{{$list->recommend_name}}</td>
              <td>{{$list->remark}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex justify-content-end">
        {{ $ex_members->links('vendor.pagination.bootstrap-4') }}
    </div>
  </div>
  <!--/ Basic Bootstrap Table -->
@endsection
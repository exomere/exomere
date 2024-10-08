@extends('layouts/contentNavbarLayout')

@section('title', 'Erp - Point - list')

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
              <option value="member_name">회원명</option>
              <option value="member_id">회원아이디</option>
              <option value="member_seq">회원번호</option>
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
      <h5 class="mb-0">보너스포인트</h5>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table" >
        <thead>
          <tr>
            <th>No</th>
            <th>관리</th>
            <th>회원번호</th>
            <th>아이디</th>
            <th>이름</th>
            <th>핸드폰번호</th>
            <th>가입일자</th>
            <th>잔여포인트</th>
            <th>지급포인트</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach ($ex_members as $list)
            <tr>
              <td>{{$row_num--}}</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item"><i class="bx bx-edit-alt me-1"></i> 포인트지급</a>
                    <a class="dropdown-item"><i class="bx bx-trash me-1"></i> 포인트내역</a>
                  </div>
                </div>
              </td>
              <td>{{$list->id}}</td>
              <td>{{$list->member_id}}</td>
              <td>{{$list->name}}</td>
              <td>{{$list->tel}}</td>
              <td>{{$list->created_at}}</td>
              <td>{{number_format($list->remain_points)}}</td>
              <td>{{number_format($list->payment_points)}}</td>
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
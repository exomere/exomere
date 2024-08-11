@extends('layouts/contentNavbarLayout')

@section('title', 'Center - list')

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
    <h5 class="mb-0">센터 리스트</h5> <small class="text-muted float-end"><button onclick="location.href='{{route('basic-layouts-item-register')}}'" class="btn btn-primary">상품등록</button></small>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table" >
      <thead>
        <tr>
          <th>No</th>
          <th>센터코드</th>
          <th>센터명</th>
          <th>연락처</th>
          <th>센터장아이디</th>
          <th>센터장</th>
          <th>추천인아이디</th>
          <th>추천인</th>
          <th>사용여부</th>
          <th>관리</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        
      </tbody>
    </table>
  </div>
</div>
<!--/ Basic Bootstrap Table -->
@endsection

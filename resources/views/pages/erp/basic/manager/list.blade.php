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
      <h5 class="mb-0">관리자 리스트</h5> <small class="text-muted float-end"><button onclick="location.href='{{route('basic-layouts-member-register')}}'" class="btn btn-primary">관리자 등록</button></small>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table" >
        <thead>
          <tr>
            <th>No</th>
            <th>아이디</th>
            <th>관리자명</th>
            <th>사용유무</th>
            <th>관리</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          
          @foreach ($ex_members as $list)
            <tr>
              <td>{{$row_num--}}</td>
              <td>{{$list->member_id}}</td>
              <td>{{$list->name}}</td>
              <td>{{($list->is_delete == 'N' ? '사용' : '미사용')}}</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{route('basic-layouts-member-register',$list->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                    <a class="dropdown-item" style='color:red;' href="{{route('member.del',$list->id)}}"><i class="bx bx-trash me-1"></i> Delete</a>
                  </div>
                </div>
              </td>
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
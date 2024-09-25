@extends('layouts/contentNavbarLayout')

@section('title', 'Item - list')

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
    <h5 class="mb-0">상품 리스트</h5> <small class="text-muted float-end"><button onclick="location.href='{{route('basic-layouts-item-register')}}'" class="btn btn-primary">상품등록</button></small>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table" >
      <thead>
        <tr>
          <th>No</th>
          <th>이미지</th>
          <th>상품코드</th>
          <th>카테고리</th>
          <th>상품명</th>
          <th>상품금액</th>
          <th>회원가</th>
          <th>뷰티플래너가</th>
          <th>대리점가</th>
          <th>총판가</th>
          <th>웹노출</th>
          <th>사용여부</th>
          <th>관리</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($items->get() as $list)
          <tr>
            <td> <span class="fw-medium">{{$row_num--;}}</span></td>
            <td><img style='width:80px;' src="{{ asset('storage/data/'.$list->thum_img) }}" alt="상품이미지" onerror="this.src='{{ asset('storage/data/noimg.jpg') }}'"  ></td>
            <td> <span class="fw-medium">{{$list->code}}</span></td>
            <td> <span class="fw-medium">{{$item_category[$list->category]}}</span></td>
            <td> <span class="fw-medium">{{$list->name}}</span></td>
            <td> <span class="fw-medium">{{number_format($list->price)}}</span></td>
            <td> <span class="fw-medium">{{number_format($list->mem_price)}}</span></td>
            <td> <span class="fw-medium">{{number_format($list->planer_price)}}</span></td>
            <td> <span class="fw-medium">{{number_format($list->store_price)}}</span></td>
            <td> <span class="fw-medium">{{number_format($list->exclusive_price)}}</span></td>
            <td> <span class="fw-medium">{{$list->is_view == 'Y' ? '노출' : '미노출'}}</span></td>
            <td> <span class="fw-medium">{{$list->is_active == 'Y' ? '사용' : '미사용'}}</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{route('basic-layouts-item-register',$list->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <a class="dropdown-item" style='color:red;' href="{{route('item.del',$list->id)}}"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!--/ Basic Bootstrap Table -->
@endsection

@extends('layouts/contentNavbarLayout')

@section('title', 'Stock - list')

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
      <form class="d-flex" action="{{ route('basic-layouts-stock-list') }}" method="GET">
        <input type="date" name="s_date" style="ime-mode:inactive;" class="form-control" value="{{ request('s_date') }}" placeholder="시작일">
        <input type="date" name="e_date"  style="ime-mode:inactive;" class="form-control" value="{{ request('e_date') }}" placeholder="종료일">
        <input class="form-control me-2" style='width:240px;' name="search_text" type="search" placeholder="Search" aria-label="Search" value="{{ request('search_text') }}">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<!--/ Basic -->
<div class="card">
  <div class="card-header d-flex align-items-center justify-content-between">
    {{-- <h5 class="mb-0">{{__('erp.product')}} {{__('erp.list')}}</h5> --}}
    <h5 class="mb-0"> 재고 {{__('erp.list')}}</h5>
    <button onclick="location.href='{{route('stock.register')}}'" class="btn btn-primary">재고등록</button>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table table-bordered" >
      <thead>
        <tr>
            <th rowspan='2' class="sticky-col">품목명</th>
            <th rowspan='2'>재고</th>
            <th rowspan='2'>기간출고</th>
            <th rowspan='2'>기간입고</th>
            <th colspan="{{count($date_array)}}" style='text-align:center;'> 일별 출고</th>
        </tr>
        <tr>
            @foreach ($date_array as $date)
                <th>{{$date}}</th>
            @endforeach
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($items as $key => $value)
            <tr>
                {{-- 품목명 --}}
                <td class="sticky-col">{{$key}}</td>
                {{-- 재고 --}}
                <td>{{ $item_stock[$value] ?? '' }}</td>
                {{-- 기간출고 --}}
                <td>{{$date_item_array[$value]['total'] ?? ''}}</td>
                {{-- 기간입고 --}}
                <td>{{$date_item_array[$value]['receiving'] ?? ''}}</td>
                @foreach ($date_array as $date)
                    <td>
                        {{ $date_item_array[$value][$date] ?? ''}}
                    </td>
                @endforeach
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-footer d-flex justify-content-end">
      {{-- {{ $items->links('vendor.pagination.bootstrap-4') }} --}}
  </div>
</div>
<!--/ Basic Bootstrap Table -->
@endsection

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
      <form class="d-flex" action="{{ route('basic-layouts-member-list') }}" method="GET">
        <input class="form-control me-2" style='width:240px;' name="search_text" type="search" placeholder="Search" aria-label="Search" value="{{ request('search_text') }}">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
  <!--/ Basic -->
  <div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">{{__('erp.manager')}} {{__('erp.list')}}</h5>
      <small class="text-muted float-end"><button onclick="location.href='{{route('basic-layouts-member-register')}}'" class="btn btn-primary">{{__('erp.manager')}} {{__('erp.register')}}</button></small>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table" >
        <thead>
          <tr>
            <th>No</th>
            <th>{{__('erp.id')}}</th>
            <th>{{__('erp.manager_name')}}</th>
            <th>{{__('erp.usage_status')}}</th>
            <th>{{__('erp.management')}}</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          
          @foreach ($ex_members as $list)
            <tr>
              <td>{{$row_num--}}</td>
              <td>{{$list->member_id}}</td>
              <td>{{$list->name}}</td>
              <td>{{($list->is_delete == 'N' ? __('erp.use') : __('erp.unused'))}}</td>
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
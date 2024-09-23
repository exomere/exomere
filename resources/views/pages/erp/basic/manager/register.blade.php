@extends('layouts/contentNavbarLayout')

@section('title', ' Member - Register')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic Layout -->
  <form method='post' action="{{route('member.save')}}" enctype="multipart/form-data">
    @csrf
    <input type='hidden' name='member_seq' value='{{ $member_seq ?? null }}'> 
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">관리자 등록</h5> <small class="text-muted float-end"><button type="submit" class="btn btn-primary">저장</button></small>
        </div>
        <div class="card-body">
          <form>
            @csrf
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-member_id">  <span style='color:red;'>*</span>관리자 아이디 </label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="basic-default-member_id" name='member_id' value="{{ $member->member_id ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-name">  <span style='color:red;'>*</span>관리자명 </label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="basic-default-name" name='name' value="{{ $member->name ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-member_pw"> <span style='color:red;'>*</span>비밀번호</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-member_pw" class="form-control" name='member_pw' />
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label"><span style='color:red;'>*</span>사용여부</label>
              <div class="col-sm-6">
                <div class="btn-group" role="group">
                  <input type="radio" class="btn-check" name="is_delete" id="is_delete1" value='N' @isset($member->is_delete) @if($member->is_delete == 'N') checked @endif @endisset>
                  <label class="btn btn-outline-primary" for="is_delete1">사용</label>
                  <input type="radio" class="btn-check" name="is_delete" id="is_delete2" value='Y' @isset($member->is_delete) @if($member->is_delete == 'Y') checked @endif @endisset>
                  <label class="btn btn-outline-primary" for="is_delete2">미사용</label>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-remark">비고</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-remark" class="form-control" name='remark' value="{{ $member->remark ?? null }}"/>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </form>
  
</div>

@endsection
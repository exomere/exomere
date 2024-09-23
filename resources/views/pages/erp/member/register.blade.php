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
          <h5 class="mb-0">회원 등록</h5> <small class="text-muted float-end"><button type="submit" class="btn btn-primary">저장</button></small>
        </div>
        <div class="card-body">
          <form>
            @csrf
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-member_id">  <span style='color:red;'>*</span>회원 아이디 </label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="basic-default-member_id" name='member_id' value="{{ $member->member_id ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-name">  <span style='color:red;'>*</span>회원명 </label>
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
              <div class="row mb-3">
                <label class="col-sm-1 col-form-label" for="recommended_info"> <span style='color:red;'>*</span> 추천인 </label>
                <div class="col-sm-6">
                  <div class="input-group">
                    <input type="hidden" class="form-control" id="recommended_seq" readonly name='recommended_seq' value="{{ $center->recommended_seq ?? null }}"/>
                    <input type="text" class="form-control" id="recommended_info" readonly name='recommended_info' value="{{ $recommended_info ?? null }}"/>
                    <a href="javascript:void(0);" class="btn btn-primary me-4" data-bs-target="#editUser" data-bs-toggle="modal">검색</a>
                 </div>
                </div>
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

  <div class="modal fade" id="editUser" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
      <div class="modal-content">
        <div class="modal-body">
          <div class="text-center mb-6">
            <h4 class="mb-2">회원검색</h4>
          </div>
            <div class="col-12">
              <div class="row mt-5">
                <select id="searchMemberType_member" class="form-select color-dropdown" style='width:22%; margin-left:10%;'>
                  <option value="name">회원 이름</option>
                  <option value="member_id">회원 아이디</option>
                  <option value="id">회원 번호</option>
                </select>
                <input class="form-control me-2" style='width:40%;' id='searchMemberText_member' type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary searchMember" data-mode='member'  style='width:22%;' type="button">Search</button>
              </div>
            </div>
            <div class="col-12">
              <div class="row mb-3">
                <div class="col-sm-12">
                  <hr class="my-5">
                  <!-- Responsive Table -->
                  <div class="card">
                    <div class="table-responsive text-nowrap">
                      
                      <table class="table">
                        <thead>
                          <tr class="text-nowrap">
                            <th>회원번호</th>
                            <th>회원명</th>
                            <th>로그인ID</th>
                            <th>직급</th>
                            <th>등록일</th>
                            <th>관리</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0 memberBody_member">
                          
                          <tr>
                            <th colspan="6" style='height:80px; text-align:center;'>회원을 검색해주세요.</th>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!--/ Responsive Table -->
                </div>
              </div>
            </div>
            <div class="col-12 text-center">
              <button type="reset" class="btn btn-label-secondary cancelMemberInfo" data-bs-dismiss="modal" style='border:1px solid #eee;' aria-label="Close">취소</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('page-script')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
<script src="/assets/js/admin/center-register.js"></script>
@endsection
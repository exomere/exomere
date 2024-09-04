@extends('layouts/contentNavbarLayout')

@section('title', ' Center - Register')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic Layout -->
  <form method='post' action="{{route('center.save')}}" enctype="multipart/form-data">
    @csrf
    <input type='hidden' name='center_seq' value='{{ $center_seq ?? null }}'> 
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">센터등록</h5> <small class="text-muted float-end"><button type="submit" class="btn btn-primary">저장</button></small>
        </div>
        <div class="card-body">
          <form>
            @csrf
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-name"> <span style='color:red;'>*</span> 센터명 </label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="basic-default-name" name='name' value="{{ $center->name ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <div class="row mb-3">
                <label class="col-sm-1 col-form-label" for="director_info"> <span style='color:red;'>*</span> 센터선택 </label>
                <div class="col-sm-6">
                  <div class="input-group">
                    <input type="hidden" class="form-control" id="director_seq" readonly name='director_seq' value="{{ $center->director_seq ?? null }}"/>
                    <input type="text" class="form-control" id="director_info" readonly name='director_info' value="{{ $director_info ?? '' }}"/>
                    <a href="javascript:void(0);" class="btn btn-primary me-4" data-bs-target="#editCenter" data-bs-toggle="modal">검색</a>
                 </div>
                </div>
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
              <label class="col-sm-1 col-form-label">연락처</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name='phone' id='phone' value="{{ $center->phone ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">FAX</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name='fax' id='fax' value="{{ $center->fax ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-zipcode">우편번호</label>
              <div class="col-sm-2">
                <div class="input-group">
                  <input type="text" name="zipcode" id="zipcode" class="form-control" readonly value="{{ $center->zipcode ?? null }}"/>
                  <button type="button" class="btn btn-outline-secondary getPostCode">{{ __('messages.search') }}</button>
              </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">기본주소</label>
              <div class="col-sm-5">
                <input type="text" readonly class="form-control" name='address' id='address' value="{{ $center->address ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">상세주소</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name='address_detail' id='address_detail' value="{{ $center->address_detail ?? null }}"/>
              </div>
            </div>
         
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label">사용여부</label>
            <div class="col-sm-5">
              <div class="btn-group" role="group">
                <input type="radio" class="btn-check" name="is_active" id="is_active1" value='Y' @isset($center->is_active) @if($center->is_active == 'Y') checked @endif @endisset>
                <label class="btn btn-outline-primary" for="is_active1">사용</label>
                <input type="radio" class="btn-check" name="is_active" id="is_active2" value='N' @isset($center->is_active) @if($center->is_active == 'N') checked @endif @endisset>
                <label class="btn btn-outline-primary" for="is_active2">미사용</label>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="remark"> 비고 </label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="remark" name='remark' value="{{ $center->remark ?? null }}"/>
            </div>
          </div>
        </div>
          </form>
        </div>
      </div>
    </div>
  </form>
  <div class="modal fade" id="editCenter" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
      <div class="modal-content">
        <div class="modal-body">
          <div class="text-center mb-6">
            <h4 class="mb-2">회원검색</h4>
          </div>
            <div class="col-12">
              <div class="row mt-5">
                <select id="searchMemberType_center" class="form-select color-dropdown" style='width:22%; margin-left:10%;'>
                  <option value="name">회원 이름</option>
                  <option value="member_id">회원 아이디</option>
                  <option value="id">회원 번호</option>
                </select>
                <input class="form-control me-2" style='width:40%;' id='searchMemberText_center' type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary searchMember"  data-mode='center' style='width:22%;' type="button">Search</button>
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
                        <tbody class="table-border-bottom-0 memberBody_center">
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
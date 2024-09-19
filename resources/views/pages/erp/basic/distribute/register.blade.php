@extends('layouts/contentNavbarLayout')

@section('title', ' Distribute - Register')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic Layout -->
  <form method='post' action="{{route('distribute.save')}}" enctype="multipart/form-data">
    @csrf
    <input type='hidden' name='distribute_seq' value='{{ $distribute_seq ?? null }}'> 
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">분양몰 등록</h5> <small class="text-muted float-end"><button type="submit" class="btn btn-primary">저장</button></small>
        </div>
        <div class="card-body">
          <form>
            @csrf
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="director_info"> <span style='color:red;'>*</span> 분양몰 관리자 </label>
              <div class="col-sm-6">
                <div class="input-group">
                  <input type="hidden" class="form-control" id="director_seq" readonly name='director_seq' value="{{ $distribute->director_seq ?? null }}"/>
                  <input type="text" class="form-control" id="director_info" readonly name='director_info' value="{{ $director_info ?? null }}"/>
                  <a href="javascript:void(0);" class="btn btn-primary me-4" data-bs-target="#editUser" data-bs-toggle="modal">검색</a>
               </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-name">  <span style='color:red;'>*</span>분양몰명 </label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="basic-default-name" name='name' value="{{ $distribute->name ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-code"> <span style='color:red;'>*</span>분양몰 코드</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-code" class="form-control" name='code' value="{{ $distribute->code ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-business_name">대표자명</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-business_name" class="form-control" name='business_name' value="{{ $distribute->business_name ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-pg_code">PG사 코드</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-pg_code" class="form-control" name='pg_code' value="{{ $distribute->pg_code ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-business_num">사업자등록번호</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-business_num" class="form-control" name='business_num' value="{{ $distribute->business_num ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-director_phone">담당자 연락처</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-director_phone" class="form-control" name='director_phone' value="{{ $distribute->director_phone ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-phone">전화번호</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-phone" class="form-control" name='phone' value="{{ $distribute->phone ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-fax">FAX 번호</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-fax" class="form-control" name='fax' value="{{ $distribute->fax ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-zipcode">우편번호</label>
              <div class="col-sm-2">
                <div class="input-group">
                  <input type="text" name="zipcode" id="zipcode" class="form-control" readonly value="{{ $distribute->zipcode ?? null }}"/>
                  <button type="button" class="btn btn-outline-secondary getPostCode">{{ __('messages.search') }}</button>
              </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">기본주소</label>
              <div class="col-sm-5">
                <input type="text" readonly class="form-control" name='address' id='address' value="{{ $distribute->address ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">상세주소</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name='address_detail' id='address_detail' value="{{ $distribute->address_detail ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-bank">은행</label>
              <div class="col-sm-1">
                <select class="form-control" id="basic-default-bank" name='bank'>
                  @foreach ($bank_list as $key => $val)
                    <option value='{{$key}}' @isset($distribute->bank) @if($distribute->bank == $key) selected @endif @endisset>{{$val}}</option>  
                  @endforeach
                </select>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-account_num">계좌번호</label>
              <div class="col-sm-3">
                <input type="text" id="basic-default-account_num" class="form-control" name='account_num' value="{{ $distribute->account_num ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-account_holder">예금주</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-account_holder" class="form-control" name='account_holder' value="{{ $distribute->account_holder ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-remark">비고</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-remark" class="form-control" name='remark' value="{{ $distribute->remark ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">사용여부</label>
              <div class="col-sm-6">
                <div class="btn-group" role="group">
                  <input type="radio" class="btn-check" name="is_active" id="is_active1" value='Y' @isset($distribute->is_active) @if($distribute->is_active == 'Y') checked @endif @endisset>
                  <label class="btn btn-outline-primary" for="is_active1">사용</label>
                  <input type="radio" class="btn-check" name="is_active" id="is_active2" value='N' @isset($distribute->is_active) @if($distribute->is_active == 'N') checked @endif @endisset>
                  <label class="btn btn-outline-primary" for="is_active2">미사용</label>
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
                        <select id="searchMemberType" class="form-select color-dropdown" style='width:22%; margin-left:10%;'>
                          <option value="name">회원 이름</option>
                          <option value="member_id">회원 아이디</option>
                          <option value="id">회원 번호</option>
                        </select>
                        <input class="form-control me-2" style='width:40%;' id='searchMemberText' type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-primary searchMember"  style='width:22%;' type="button">Search</button>
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
                                <tbody class="table-border-bottom-0 memberBody">
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
      </div>
    </div>
  </form>
  
</div>

@endsection

@section('page-script')
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
  <script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
  <script src="/assets/js/admin/distribute-register.js"></script>
@endsection

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
          <h5 class="mb-0">{{__('erp.local_branch')}} {{__('erp.register')}}</h5>
          <small class="text-muted float-end"><button type="submit" class="btn btn-primary">{{__('erp.save')}}</button></small>
        </div>
        <div class="card-body">
          <form>
            @csrf
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-name"> <span style='color:red;'>*</span> {{__('erp.local_branch_name')}}</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="basic-default-name" name='name' value="{{ $center->name ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <div class="row mb-3">
                <label class="col-sm-1 col-form-label" for="director_info"> <span style='color:red;'>*</span> {{__('erp.select_local_point')}}</label>
                <div class="col-sm-6">
                  <div class="input-group">
                    <input type="hidden" class="form-control" id="director_seq" readonly name='director_seq' value="{{ $center->director_seq ?? null }}"/>
                    <input type="text" class="form-control" id="director_info" readonly name='director_info' value="{{ $director_info ?? '' }}"/>
                    <a href="javascript:void(0);" class="btn btn-primary me-4" data-bs-target="#editCenter" data-bs-toggle="modal">{{__('erp.search')}}</a>
                 </div>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="row mb-3">
                <label class="col-sm-1 col-form-label" for="recommended_info"> <span style='color:red;'>*</span> {{__('erp.recruiter')}} </label>
                <div class="col-sm-6">
                  <div class="input-group">
                    <input type="hidden" class="form-control" id="recommended_seq" readonly name='recommended_seq' value="{{ $center->recommended_seq ?? null }}"/>
                    <input type="text" class="form-control" id="recommended_info" readonly name='recommended_info' value="{{ $recommended_info ?? null }}"/>
                    <a href="javascript:void(0);" class="btn btn-primary me-4" data-bs-target="#editUser" data-bs-toggle="modal">{{__('erp.search')}}</a>
                 </div>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">{{__('erp.contact')}}</label>
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
              <label class="col-sm-1 col-form-label" for="basic-default-zipcode">{{__('erp.zip_code')}}</label>
              <div class="col-sm-2">
                <div class="input-group">
                  <input type="text" name="zipcode" id="zipcode" class="form-control" readonly value="{{ $center->zipcode ?? null }}"/>
                  <button type="button" class="btn btn-outline-secondary getPostCode">{{ __('messages.search') }}</button>
              </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">{{__('erp.basic_address')}}</label>
              <div class="col-sm-5">
                <input type="text" readonly class="form-control" name='address' id='address' value="{{ $center->address ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">{{__('erp.detailed_address')}}</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name='address_detail' id='address_detail' value="{{ $center->address_detail ?? null }}"/>
              </div>
            </div>
         
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label">{{__('erp.usage_status')}}</label>
            <div class="col-sm-5">
              <div class="btn-group" role="group">
                <input type="radio" class="btn-check" name="is_active" id="is_active1" value='Y' @isset($center->is_active) @if($center->is_active == 'Y') checked @endif @endisset>
                <label class="btn btn-outline-primary" for="is_active1">{{__('erp.use')}}</label>
                <input type="radio" class="btn-check" name="is_active" id="is_active2" value='N' @isset($center->is_active) @if($center->is_active == 'N') checked @endif @endisset>
                <label class="btn btn-outline-primary" for="is_active2">{{__('erp.unused')}}</label>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="remark"> {{__('erp.remarks')}} </label>
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
            <h4 class="mb-2">{{__('erp.member_search')}}</h4>
          </div>
            <div class="col-12">
              <div class="row mt-5">
                <select id="searchMemberType_center" class="form-select color-dropdown" style='width:22%; margin-left:10%;'>
                  <option value="name">{{__('erp.member_name')}}</option>
                  <option value="member_id">{{__('erp.member_id')}}</option>
                  <option value="id">{{__('erp.member_number')}}</option>
                </select>
                <input class="form-control me-2" style='width:40%;' id='searchMemberText_center' type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary searchMember"  data-nation='{{request()->session()->get('member_nation')}}' data-mode='center' style='width:22%;' type="button">Search</button>
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
                            <th>{{__('erp.member_number')}}</th>
                            <th>{{__('erp.member_name')}}</th>
                            <th>{{__('erp.member_id')}}</th>
                            <th>{{__('erp.position')}}</th>
                            <th>{{__('erp.registration_date')}}</th>
                            <th>{{__('erp.management')}}</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0 memberBody_center">
                          <tr>
                            <th colspan="6" style='height:80px; text-align:center;'>{{__('erp.search_member')}}</th>
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
              <button type="reset" class="btn btn-label-secondary cancelMemberInfo" data-bs-dismiss="modal" style='border:1px solid #eee;' aria-label="Close">{{__('erp.cancel')}}</button>
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
            <h4 class="mb-2">{{__('erp.member_search')}}</h4>
          </div>
            <div class="col-12">
              <div class="row mt-5">
                <select id="searchMemberType_member" class="form-select color-dropdown" style='width:22%; margin-left:10%;'>
                  <option value="name">{{__('erp.member_name')}}</option>
                  <option value="member_id">{{__('erp.member_id')}}</option>
                  <option value="id">{{__('erp.member_number')}}</option>
                </select>
                <input class="form-control me-2" style='width:40%;' id='searchMemberText_member' type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary searchMember" data-nation='{{request()->session()->get('member_nation')}}' data-mode='member'  style='width:22%;' type="button">Search</button>
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
                            <th>{{__('erp.member_number')}}</th>
                            <th>{{__('erp.member_name')}}</th>
                            <th>{{__('erp.member_id')}}</th>
                            <th>{{__('erp.position')}}</th>
                            <th>{{__('erp.registration_date')}}</th>
                            <th>{{__('erp.management')}}</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0 memberBody_member">
                          
                          <tr>
                            <th colspan="6" style='height:80px; text-align:center;'>{{__('erp.search_member')}}</th>
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
              <button type="reset" class="btn btn-label-secondary cancelMemberInfo" data-bs-dismiss="modal" style='border:1px solid #eee;' aria-label="Close">{{__('erp.cancel')}}</button>
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
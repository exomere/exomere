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
          <h5 class="mb-0">{{__('erp.sale_mall')}} {{__('erp.register')}}</h5> <small class="text-muted float-end"><button type="submit" class="btn btn-primary">{{__('erp.save')}}</button></small>
        </div>
        <div class="card-body">
          <form>
            @csrf
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="director_info"> <span style='color:red;'>*</span> {{__('erp.sale_mall')}} {{__('erp.manager')}} </label>
              <div class="col-sm-6">
                <div class="input-group">
                  <input type="hidden" class="form-control" id="director_seq" readonly name='director_seq' value="{{ $distribute->director_seq ?? null }}"/>
                  <input type="text" class="form-control" id="director_info" readonly name='director_info' value="{{ $director_info ?? null }}"/>
                  <a href="javascript:void(0);" class="btn btn-primary me-4" data-bs-target="#editUser" data-bs-toggle="modal">검색</a>
               </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-name">  <span style='color:red;'>*</span>{{__('erp.sales_mall_name')}} </label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="basic-default-name" name='name' value="{{ $distribute->name ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-code"> <span style='color:red;'>*</span>{{__('erp.sales_mall_code')}}</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-code" class="form-control" name='code' value="{{ $distribute->code ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-business_name">{{__('erp.representative_name')}}</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-business_name" class="form-control" name='business_name' value="{{ $distribute->business_name ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-business_mail">e-mail</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-business_mail" class="form-control" name='business_mail' value="{{ $distribute->business_mail ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-pg_code">{{__('erp.pg_company_code')}}</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-pg_code" class="form-control" name='pg_code' value="{{ $distribute->pg_code ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-business_num">{{__('erp.business_registration_number')}}</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-business_num" class="form-control" name='business_num' value="{{ $distribute->business_num ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-director_phone">{{__('erp.contact_person_in_charge')}}</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-director_phone" class="form-control" name='director_phone' value="{{ $distribute->director_phone ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-phone">{{__('erp.contact')}}</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-phone" class="form-control" name='phone' value="{{ $distribute->phone ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-fax">FAX {{__('erp.contact_number')}}</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-fax" class="form-control" name='fax' value="{{ $distribute->fax ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-zipcode">{{__('erp.zip_code')}}</label>
              <div class="col-sm-2">
                <div class="input-group">
                  <input type="text" name="zipcode" id="zipcode" class="form-control" readonly value="{{ $distribute->zipcode ?? null }}"/>
                  <button type="button" class="btn btn-outline-secondary getPostCode">{{ __('messages.search') }}</button>
              </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">{{__('erp.basic_address')}}</label>
              <div class="col-sm-5">
                <input type="text" readonly class="form-control" name='address' id='address' value="{{ $distribute->address ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">{{__('erp.detailed_address')}}</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name='address_detail' id='address_detail' value="{{ $distribute->address_detail ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-bank">{{__('erp.bank')}}</label>
              <div class="col-sm-1">
                <select class="form-control" id="basic-default-bank" name='bank'>
                  @foreach ($bank_list as $key => $val)
                    <option value='{{$key}}' @isset($distribute->bank) @if($distribute->bank == $key) selected @endif @endisset>{{$val}}</option>  
                  @endforeach
                </select>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-account_num">{{__('erp.account_number')}}</label>
              <div class="col-sm-3">
                <input type="text" id="basic-default-account_num" class="form-control" name='account_num' value="{{ $distribute->account_num ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-account_holder">{{__('erp.depositor')}}</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-account_holder" class="form-control" name='account_holder' value="{{ $distribute->account_holder ?? null }}"/>
              </div>
            </div>       
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-remark">{{__('erp.remarks')}}</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-remark" class="form-control" name='remark' value="{{ $distribute->remark ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">{{__('erp.usage_status')}}</label>
              <div class="col-sm-6">
                <div class="btn-group" role="group">
                  <input type="radio" class="btn-check" name="is_active" id="is_active1" value='Y' @isset($distribute->is_active) @if($distribute->is_active == 'Y') checked @endif @endisset>
                  <label class="btn btn-outline-primary" for="is_active1">{{__('erp.use')}}</label>
                  <input type="radio" class="btn-check" name="is_active" id="is_active2" value='N' @isset($distribute->is_active) @if($distribute->is_active == 'N') checked @endif @endisset>
                  <label class="btn btn-outline-primary" for="is_active2">{{__('erp.unused')}}</label>
                </div>
              </div>
            </div>
          </form>
          <div class="modal fade" id="editUser" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="text-center mb-6">
                    <h4 class="mb-2">{{__('erp.member_search')}}</h4>
                  </div>
                    <div class="col-12">
                      <div class="row mt-5">
                        <select id="searchMemberType" class="form-select color-dropdown" style='width:22%; margin-left:10%;'>
                          <option value="name">{{__('erp.member_name')}}</option>
                          <option value="member_id">{{__('erp.member_id')}}</option>
                          <option value="id">{{__('erp.member_number')}}</option>
                        </select>
                        <input class="form-control me-2" style='width:40%;' id='searchMemberText' type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-primary searchMember"  data-nation='{{request()->session()->get('member_nation')}}' style='width:22%;' type="button">Search</button>
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
                                <tbody class="table-border-bottom-0 memberBody">
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

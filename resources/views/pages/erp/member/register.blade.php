@extends('layouts/contentNavbarLayout')

@section('title', ' Member - Register')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic Layout -->
  <form method='post' action="{{route('erp-member.save')}}" enctype="multipart/form-data">
    @csrf
    <input type='hidden' name='member_seq' value='{{ $member_seq ?? null }}'> 
    <input type='hidden' id='created_at' value='{{ $member->created_at ?? date("Y-m-d") }}'> 
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">{{__('erp.member_registration')}}</h5> <small class="text-muted float-end"><button type="submit" class="btn btn-primary">{{__('erp.save')}}</button></small>
        </div>
        <div class="card-body">
          <form>
            @csrf
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-member_id">  <span style='color:red;'>*</span>{{__('erp.member_id')}} </label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="basic-default-member_id" name='member_id' value="{{ $member->member_id ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="member_reg_date">  <span style='color:red;'>*</span>{{__('erp.registration_date')}} </label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="member_reg_date" readonly  name='member_reg_date' value=""/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-name">  <span style='color:red;'>*</span>{{__('erp.member_name')}} </label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="basic-default-name" name='name' value="{{ $member->name ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-member_pw"> <span style='color:red;'>*</span>{{__('erp.password')}}</label>
              <div class="col-sm-4">
                <input type="text" id="basic-default-member_pw" class="form-control" name='member_pw' />
              </div>
            </div>
            <div class="row mb-3">
              <div class="row mb-3">
                <label class="col-sm-1 col-form-label" for="recommend_info"> <span style='color:red;'>*</span> {{__('erp.recruiter')}} </label>
                <div class="col-sm-4">
                  <div class="input-group">
                    <input type="hidden" class="form-control" id="recommend_seq" readonly name='recommend_seq' value="{{ $member->recommend_seq ?? null }}"/>
                    <input type="text" class="form-control" id="recommend_info" readonly name='recommend_info' value="{{ $recommend_info ?? null }}"/>
                    <a href="javascript:void(0);" class="btn btn-primary me-4" data-bs-target="#editUser" data-bs-toggle="modal">{{__('erp.search')}}</a>
                 </div>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-resident_number"> {{__('erp.resident_registration_number')}} </label>
              <div class="col-sm-1">
                <input type="text" class="form-control" id="basic-default-resident_number" maxlength="6" placeholder="{{__('erp.resident_registration_number')}} {{__('erp.first_digit')}}" name='resident_number' value="{{ $resident_number_info[0] ?? null }}"/>
              </div>
              <div class="col-sm-1">
                <input type="text" class="form-control" id="basic-default-resident_number" maxlength='7' placeholder="{{__('erp.resident_registration_number')}} {{__('erp.last_digit')}}" name='resident_number2' value="{{ $resident_number_info[1] ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-phone"> {{__('erp.contact')}} </label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="basic-default-phone" name='phone' value="{{ $member->phone ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-email"> {{__('erp.email')}} </label>
              <div class="col-sm-1">
                <input type="text" class="form-control" id="basic-default-email" name='email' value="{{ $email_info[0] ?? null }}"/>
              </div>
              <div class="col-sm-1">
                <input type="text" class="form-control" id="email2" name='email2' value="{{ $email_info[1] ?? null }}"/>
              </div>
              <div class="col-sm-1">
                <select class="form-control" id='emailSelect'>
                  <option value="custom">{{__('erp.direct_entry')}}</option>
                  <option @isset($email_info[1]) @if($email_info[1] == "gmail.com")  selected  @endif @endisset value="gmail.com">gmail.com</option>
                  <option @isset($email_info[1]) @if($email_info[1] == "naver.com")  selected  @endif @endisset value="naver.com">naver.com</option>
                  <option @isset($email_info[1]) @if($email_info[1] == "hanmail.net")  selected  @endif @endisset value="hanmail.net">hanmail.net</option>
                  <option @isset($email_info[1]) @if($email_info[1] == "hotmail.com")  selected  @endif @endisset value="hotmail.com">hotmail.com</option>
                  <option @isset($email_info[1]) @if($email_info[1] == "nate.com")  selected  @endif @endisset value="nate.com">nate.com</option>
                  <option @isset($email_info[1]) @if($email_info[1] == "yahoo.co.kr")  selected  @endif @endisset value="yahoo.co.kr">yahoo.co.kr</option>
                  <option @isset($email_info[1]) @if($email_info[1] == "empas.com")  selected  @endif @endisset value="empas.com">empas.com</option>
                  <option @isset($email_info[1]) @if($email_info[1] == "dreamwiz.com")  selected  @endif @endisset value="dreamwiz.com">dreamwiz.com</option>
                  <option @isset($email_info[1]) @if($email_info[1] == "freechal.com")  selected  @endif @endisset value="freechal.com">freechal.com</option>
                  <option @isset($email_info[1]) @if($email_info[1] == "lycos.co.kr")  selected  @endif @endisset value="lycos.co.kr">lycos.co.kr</option>
                  <option @isset($email_info[1]) @if($email_info[1] == "korea.com")  selected  @endif @endisset value="korea.com">korea.com</option>
                  <option @isset($email_info[1]) @if($email_info[1] == "hanmir.com")  selected  @endif @endisset value="hanmir.com">hanmir.com</option>
                  <option @isset($email_info[1]) @if($email_info[1] == "paran.com")  selected  @endif @endisset value="paran.com">paran.com</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-member_pw"> <span style='color:red;'>*</span>{{__('erp.member_classification')}}</label>
              <div class="col-sm-2">
                <select class="form-control" name='member_position'>
                  <option value="회원" selected="">회원</option>
                  @if(request()->session()->get('member_level') == 99)
                    <option value="뷰티플래너">뷰티플래너</option>
                    <option value="대리점">대리점</option>
                  @endif
                  <option value="총판">총판</option>
                  <option value="우수총판">우수총판</option>
                  <option value="최우수총판">최우수총판</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="local_store"> {{__('erp.local_branch')}} </label>
              <div class="col-md-4">
                <select class="form-select" name="local_store" id="local_store">
                  <option value="">{{__('erp.local_branch')}}</option>
                  @foreach ($center_array as $center)
                    <option @isset($member->local_store) @if($member->local_store == $center['seq'])  selected  @endif @endisset value='{{$center['seq']}}'>{{$center['name']}}
                    </option>
                  @endforeach
                </select>      
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="distribute_seq"> {{__('erp.sale_mall')}} </label>
              <div class="col-md-4">
                <select class="form-select" name="distribute_seq" id="distribute_seq">
                  <option value="46">(주)엑소미어</option>
                  @foreach ($distribute_array as $distribute)
                    <option @isset($member->local_store) @if($member->distribute_seq == $distribute['seq'])  selected  @endif @endisset value='{{$distribute['seq']}}'>{{$distribute['name']}}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-bank">{{__('erp.bank')}}</label>
              <div class="col-sm-1">
                <select class="form-control" id="basic-default-bank" name='bank'>
                  @foreach ($bank_list as $key => $val)
                    <option value='{{$key}}' @isset($member->bank) @if($member->bank == $key) selected @endif @endisset>{{$val}}</option>  
                  @endforeach
                </select>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-account_number">{{__('erp.account_number')}}</label>
              <div class="col-sm-3">
                <input type="text" id="basic-default-account_number" class="form-control" name='account_number' value="{{ $member->account_number ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-account_holder">{{__('erp.depositor')}}</label>
              <div class="col-sm-4">
                <input type="text" id="basic-default-account_holder" class="form-control" name='account_holder' value="{{ $member->account_holder ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="zipcode">{{__('erp.zip_code')}}</label>
              <div class="col-sm-2">
                <div class="input-group">
                  <input type="text" name="zipcode" id="zipcode" class="form-control" readonly value="{{ $member->zip_code ?? null }}"/>
                  <button type="button" class="btn btn-outline-secondary getPostCode">{{ __('messages.search') }}</button>
              </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">{{__('erp.basic_address')}}</label>
              <div class="col-sm-5">
                <input type="text" readonly class="form-control" name='address' id='address' value="{{ $member->address ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">{{__('erp.detailed_address')}}</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name='address_detail' id='address_detail' value="{{ $member->address_detail ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label"><span style='color:red;'>*</span>{{__('erp.status')}}</label>
              <div class="col-sm-4">
                <div class="btn-group" role="group">
                  <input type="radio" class="btn-check" name="is_delete" id="is_delete1" value='N' @isset($member->is_delete) @if($member->is_delete == 'N') checked @endif @endisset>
                  <label class="btn btn-outline-primary" for="is_delete1">{{__('erp.normal')}}</label>
                  <input type="radio" class="btn-check" name="is_delete" id="is_delete2" value='Y' @isset($member->is_delete) @if($member->is_delete == 'Y') checked @endif @endisset>
                  <label class="btn btn-outline-primary" for="is_delete2">{{__('erp.withdrawal')}}</label>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-remark">{{__('erp.remarks')}}</label>
              <div class="col-sm-4">
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
            <h4 class="mb-2">{{__('erp.member')}}{{__('erp.search')}}</h4>
          </div>
            <div class="col-12">
              <div class="row mt-5">
                <select id="searchMemberType_member" class="form-select color-dropdown" style='width:22%; margin-left:10%;'>
                  <option value="name">{{__('erp.member_name')}}</option>
                  <option value="member_id">{{__('erp.member_id')}}</option>
                  <option value="id">{{__('erp.member_number')}}</option>
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
  <script src="/assets/js/admin/member-register.js"></script>
@endsection
@extends('layouts/contentNavbarLayout')

@section('title', ' Distribute - Register')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic Layout -->
  <form method='post' action="{{route('item.save')}}" enctype="multipart/form-data">
    @csrf
    <input type='hidden' name='item_seq' value='{{ $item_seq ?? null }}'> 
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">상품등록</h5> <small class="text-muted float-end"><button type="submit" class="btn btn-primary">저장</button></small>
        </div>
        <div class="card-body">
          <form>
            @csrf
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-director_seq"> <span style='color:red;'>*</span> 분양몰 관리자 </label>
              <div class="col-sm-6">
                <div class="input-group">
                  <input type="text" class="form-control" id="basic-default-director_seq" readonly name='director_seq' value="{{ $item->director_seq ?? null }}"/>
                  <a href="javascript:;" class="btn btn-primary me-4" data-bs-target="#editUser" data-bs-toggle="modal">검색</a>
               </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-name">  <span style='color:red;'>*</span>분양몰명 </label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="basic-default-name" name='name' value="{{ $item->name ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-code"> <span style='color:red;'>*</span>분양몰 코드</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-code" class="form-control" name='code' value="{{ $item->code ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-director_name">대표자명</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-director_name" class="form-control" name='director_name' value="{{ $item->director_name ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-pg_code">PG사 코드</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-pg_code" class="form-control" name='pg_code' value="{{ $item->pg_code ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-business_num">사업자등록번호</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-business_num" class="form-control" name='business_num' value="{{ $item->business_num ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-director_phone">담당자 연락처</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-director_phone" class="form-control" name='director_phone' value="{{ $item->director_phone ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-phone">전화번호</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-phone" class="form-control" name='phone' value="{{ $item->phone ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-fax">FAX 번호</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-fax" class="form-control" name='fax' value="{{ $item->fax ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-zipcode">우편번호</label>
              <div class="col-sm-2">
                <div class="input-group">
                  <input type="text" name="zipcode" id="zipcode" class="form-control" readonly/>
                  <button type="button" class="btn btn-outline-secondary" onclick="getPostCode();">{{ __('messages.search') }}</button>
               </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">기본주소</label>
              <div class="col-sm-5">
                <input type="text" readonly class="form-control" name='address' id='address' value="{{ $item->address ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">상세주소</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name='address_detail' id='address_detail' value="{{ $item->address_detail ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-bank">은행</label>
              <div class="col-sm-1">
                <select class="form-control" id="basic-default-bank" name='bank'>
                  @foreach ($bank_list as $key => $val)
                    <option value='{{$key}}' @isset($item->bank) @if($item->bank == $key) selected @endif @endisset>{{$val}}</option>  
                  @endforeach
                </select>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-account_num">계좌번호</label>
              <div class="col-sm-3">
                <input type="text" id="basic-default-account_num" class="form-control" name='account_num' value="{{ $item->account_num ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_pv">예금주</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-exclusive_pv" class="form-control" name='exclusive_pv' value="{{ $item->exclusive_pv ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-account_holder">비고</label>
              <div class="col-sm-6">
                <input type="text" id="basic-default-account_holder" class="form-control" name='account_holder' value="{{ $item->account_holder ?? null }}"/>
              </div>
            </div>
            
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">사용여부</label>
              <div class="col-sm-6">
                <div class="btn-group" role="group">
                  <input type="radio" class="btn-check" name="is_active" id="is_active1" value='Y' @isset($item['is_active']) @if($item['is_active'] == 'Y') checked @endif @endisset>
                  <label class="btn btn-outline-primary" for="is_active1">사용</label>
                  <input type="radio" class="btn-check" name="is_active" id="is_active2" value='N' @isset($item['is_active']) @if($item['is_active'] == 'N') checked @endif @endisset>
                  <label class="btn btn-outline-primary" for="is_active2">미사용</label>
                </div>
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
            <h4 class="mb-2">User Information</h4>
          </div>
            <div class="col-12">
              <div class="form-check form-switch my-2 ms-2">
                <input type="checkbox" class="form-check-input" id="editBillingAddress" checked="">
                <label for="editBillingAddress" class="switch-label">Use as a billing address?</label>
              </div>
            </div>
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary me-3">Submit</button>
              <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('page-script')
  <script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
  <script>
    function getPostCode(){
      new daum.Postcode({
        oncomplete: function(data) {
            // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

            // 각 주소의 노출 규칙에 따라 주소를 조합한다.
            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
            var fullAddr = ''; // 최종 주소 변수
            var extraAddr = ''; // 조합형 주소 변수

            // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
            if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                fullAddr = data.roadAddress;

            } else { // 사용자가 지번 주소를 선택했을 경우(J)
                fullAddr = data.jibunAddress;
            }

            // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
            if(data.userSelectedType === 'R'){
                //법정동명이 있을 경우 추가한다.
                if(data.bname !== ''){
                    extraAddr += data.bname;
                }
                // 건물명이 있을 경우 추가한다.
                if(data.buildingName !== ''){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
            }

            var postArr = new Array();
            postArr.push(data.zonecode);
            postArr.push(fullAddr);

            $("#zipcode").val(postArr[0]);
            $("#address").val(postArr[1]);
            $("#address_detail").val('');
            $("#address_detail").focus();
        }
      }).open();
    }
  </script>
@endsection

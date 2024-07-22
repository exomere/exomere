@extends('layouts/contentNavbarLayout')

@section('title', ' Horizontal Layouts - Forms')

@section('content')

<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic Layout -->
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">상품등록</h5> <small class="text-muted float-end"><button type="submit" class="btn btn-primary">저장</button></small>
      </div>
      <div class="card-body">
        <form>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-name"> <span style='color:red;'>*</span> 상품명 </label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="basic-default-name" placeholder="John Doe" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-company">카테고리</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" id="basic-default-company" placeholder="ACME Inc." />
            </div>
            <label class="col-sm-1 col-form-label" for="basic-default-email">상품구분</label>
            <div class="col-sm-5">
              <div class="input-group input-group-merge">
                <input type="text" id="basic-default-email" class="form-control" placeholder="john.doe" aria-label="john.doe" aria-describedby="basic-default-email2" />
                </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">소비자가</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
            </div>
            <label class="col-sm-1 col-form-label" for="basic-default-phone">부가세</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">PV1</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
            </div>
            <label class="col-sm-1 col-form-label" for="basic-default-phone">PV2</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">회원가</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
            </div>
            <label class="col-sm-1 col-form-label" for="basic-default-phone">회원PV</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">뷰티플래너가</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
            </div>
            <label class="col-sm-1 col-form-label" for="basic-default-message">뷰티플래너PV</label>
            <div class="col-sm-5">
                <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">대리점가</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
            </div>
            <label class="col-sm-1 col-form-label" for="basic-default-phone">대리점PV</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">총판가</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
            </div>
            <label class="col-sm-1 col-form-label" for="basic-default-phone">총판PV</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">사용여부</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
            </div>
            <label class="col-sm-1 col-form-label" for="basic-default-phone">웹노출</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">목록이미지</label>
            <div class="col-sm-6">
                <div class="input-group">
                    <input type="file" class="form-control" id="inputGroupFile02">
                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">상세이미지</label>
            <div class="col-sm-6">
                <div class="input-group">
                    <input type="file" class="form-control" id="inputGroupFile02">
                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">비고</label>
            <div class="col-sm-6">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Basic with Icons -->
  
</div>
@endsection

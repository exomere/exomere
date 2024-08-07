@extends('layouts/contentNavbarLayout')

@section('title', ' Item - Register')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}"/>
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
          @csrf
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-name"> <span style='color:red;'>*</span> 상품명 </label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="basic-default-name" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-name"> 간략설명 </label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="basic-default-name" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-company">카테고리</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" id="basic-default-company" />
            </div>
            <label class="col-sm-1 col-form-label" for="basic-default-email">상품구분</label>
            <div class="col-sm-5">
              <div class="input-group input-group-merge">
                <input type="text" id="basic-default-email" class="form-control" />
                </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">소비자가</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control" />
            </div>
            <label class="col-sm-1 col-form-label" for="basic-default-phone">부가세</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">PV1</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control" />
            </div>
            <label class="col-sm-1 col-form-label" for="basic-default-phone">PV2</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">회원가</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control" />
            </div>
            <label class="col-sm-1 col-form-label" for="basic-default-phone">회원PV</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">뷰티플래너가</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control" />
            </div>
            <label class="col-sm-1 col-form-label" for="basic-default-message">뷰티플래너PV</label>
            <div class="col-sm-5">
                <input type="text" id="basic-default-phone" class="form-control" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">대리점가</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control" />
            </div>
            <label class="col-sm-1 col-form-label" for="basic-default-phone">대리점PV</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">총판가</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control" />
            </div>
            <label class="col-sm-1 col-form-label" for="basic-default-phone">총판PV</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">사용여부</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control" />
            </div>
            <label class="col-sm-1 col-form-label" for="basic-default-phone">웹노출</label>
            <div class="col-sm-5">
              <input type="text" id="basic-default-phone" class="form-control" />
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

          <div class="row mb-3" style='height:400px;'>
            <label class="col-sm-1 col-form-label" for="basic-default-phone">상품상세설명</label>
            <div class="col-sm-12">
                <textarea class="form-control" id='content_detail' name="content_detail" rows="3"></textarea>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">비고</label>
            <div class="col-sm-7">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">용량</label>
            <div class="col-sm-7">
              <input type="text" id="basic-default-phone" class="form-control" />
            </div>
          </div>
          <div class="row mb-4">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">기능성화장품유무</label>
            <div class="col-sm-7">
              <input type="text" id="basic-default-phone" class="form-control" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">효능효과</label>
            <div class="col-sm-7">
              <input type="text" id="basic-default-phone" class="form-control" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">용법용량</label>
            <div class="col-sm-7">
              <input type="text" id="basic-default-phone" class="form-control" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">사용 시 주의사항</label>
            <div class="col-sm-7">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">품질보증기간</label>
            <div class="col-sm-7">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">제조업자</label>
            <div class="col-sm-7">
              <input type="text" id="basic-default-phone" class="form-control" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">책임판매업자</label>
            <div class="col-sm-7">
              <input type="text" id="basic-default-phone" class="form-control" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">소비자 상담문의</label>
            <div class="col-sm-7">
              <input type="text" id="basic-default-phone" class="form-control" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">제조번호<br>사용기한</label>
            <div class="col-sm-7">
              <input type="text" id="basic-default-phone" class="form-control" />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label" for="basic-default-phone">제조국</label>
            <div class="col-sm-7">
              <input type="text" id="basic-default-phone" class="form-control" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>


  ClassicEditor
      .create( document.querySelector( '#content_detail' ),{
        ckfinder:{
          uploadUrl:"{{route('ckeditor.upload',['_token'=>csrf_token()])}}",
        },
      }).catch( error => {
          console.error( error );
      } );
</script>
@endsection

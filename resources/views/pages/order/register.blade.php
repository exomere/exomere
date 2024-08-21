@extends('layouts/contentNavbarLayout')

@section('title', ' Order - Register')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic Layout -->
  <form method='post' action="{{route('order.save')}}" enctype="multipart/form-data">
    @csrf
    <input type='hidden' name='order_seq' value='{{ $order_seq ?? null }}'> 
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
                <input type="text" class="form-control" id="basic-default-name" name='name' value="{{ $order_data->name ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-description"> 간략설명 </label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="basic-default-description" name='description'value="{{ $order_data->description ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-code"> <span style='color:red;'>*</span> 상품코드 </label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="basic-default-code" name='code' value="{{ $order_data->code ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-category">카테고리</label>
              <div class="col-sm-5">
                <select class="form-control" id="basic-default-category" name='category'>
                  @foreach ($order_data_category as $key => $val)
                    <option value='{{$key}}' @isset($order_data->category) @if($order_data->category == $key) selected @endif @endisset>{{$val}}</option>  
                  @endforeach
                </select>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-kind">상품구분</label>
              <div class="col-sm-5">
                <div class="input-group input-group-merge">
                  <select class="form-control" id="basic-default-kind" name='kind'>
                      @foreach ($order_data_kind as $key => $val)
                        <option value='{{$key}}' @isset($order_data->kind) @if($order_data->kind == $key) selected @endif @endisset>{{$val}}</option>  
                      @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-price">소비자가</label>
              <div class="col-sm-5">
                <input type="number" id="basic-default-price" class="form-control" name='price' value="{{ $order_data->price ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-tax">부가세</label>
              <div class="col-sm-5">
                <input type="number" id="basic-default-tax" class="form-control" name='tax' value="{{ $order_data->tax ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-pv">PV1</label>
              <div class="col-sm-5">
                <input type="number" id="basic-default-pv" class="form-control" name='pv' value="{{ $order_data->pv ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-pv2">PV2</label>
              <div class="col-sm-5">
                <input type="number" id="basic-default-pv2" class="form-control" name='pv2' value="{{ $order_data->pv2 ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-mem_price">회원가</label>
              <div class="col-sm-5">
                <input type="number" id="basic-default-mem_price" class="form-control" name='mem_price' value="{{ $order_data->mem_price ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-mem_pv">회원PV</label>
              <div class="col-sm-5">
                <input type="number" id="basic-default-mem_pv" class="form-control" name='mem_pv' value="{{ $order_data->mem_pv ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-planer_price">뷰티플래너가</label>
              <div class="col-sm-5">
                <input type="number" id="basic-default-planer_price" class="form-control" name='planer_price' value="{{ $order_data->planer_price ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-planer_pv">뷰티플래너PV</label>
              <div class="col-sm-5">
                  <input type="number" id="basic-default-planer_pv" class="form-control" name='planer_pv' value="{{ $order_data->planer_pv ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-store_price">대리점가</label>
              <div class="col-sm-5">
                <input type="number" id="basic-default-store_price" class="form-control" name='store_price' value="{{ $order_data->store_price ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-store_pv">대리점PV</label>
              <div class="col-sm-5">
                <input type="number" id="basic-default-store_pv" class="form-control" name='store_pv' value="{{ $order_data->store_pv ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_price">총판가</label>
              <div class="col-sm-5">
                <input type="number" id="basic-default-exclusive_price" class="form-control" name='exclusive_price' value="{{ $order_data->exclusive_price ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_pv">총판PV</label>
              <div class="col-sm-5">
                <input type="number" id="basic-default-exclusive_pv" class="form-control" name='exclusive_pv' value="{{ $order_data->exclusive_pv ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-stock">재고</label>
              <div class="col-sm-5">
                <input type="number" id="basic-default-stock" class="form-control" name='stock' value="{{ $order_data->stock ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-thum_img">목록이미지</label>
              @isset($order_data->thum_img)
                <div class="col-sm-1">
                   <img style='width:50px;' src='{{Storage::url('public/data/'.$order_data->thum_img)}}'>
                </div>
              @endisset
              <div class="col-sm-5">
                <div class="input-group">
                    <input type="file" class="form-control" id="thum_img" name="thum_img">
                    <label class="input-group-text" for="thum_img">Upload</label>
                </div>
            </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-img">상세이미지</label>
              @isset($order_data->img)
                <div class="col-sm-1">
                  <img style='width:50px;' src='{{Storage::url('public/data/'.$order_data->img)}}'>
                </div>
              @endisset
              <div class="col-sm-6">
                  <div class="input-group">
                      <input type="file" class="form-control" id="img" name="img">
                      <label class="input-group-text" for="img" name="img">Upload</label>
                  </div>
              </div>
            </div>

            <div class="row mb-3" style='height:700px;'>
              <label class="col-sm-1 col-form-label" for="basic-default-content">상품상세설명</label>
              <div class="col-sm-12">
                  <textarea class="form-control" id='content' name="content" rows="3">{{ $order_data->content ?? null }}</textarea>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-remark">비고</label>
              <div class="col-sm-7">
                  <textarea class="form-control" id="remark" name='remark' rows="3">{{ $order_data->remark ?? null }}</textarea>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-capacity">용량</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-capacity" class="form-control" name='capacity' value="{{ $order_data->capacity ?? null }}"/>
              </div> 
            </div>

            <div class="row mb-4">
              <label class="col-sm-1 col-form-label" for="basic-default-functionality">기능성화장품유무</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-functionality" class="form-control" name='functionality' value="{{ $order_data->functionality ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-efficacy">효능효과</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-efficacy" class="form-control" name='efficacy' value="{{ $order_data->efficacy ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-usage_capacity">사용법</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-usage_capacity" class="form-control" name='usage_capacity' value="{{ $order_data->usage_capacity ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-precautions">사용 시 주의사항</label>
              <div class="col-sm-7">
                  <textarea class="form-control" id="precautions" name='precautions' rows="3">{{ $order_data->precautions ?? null }}</textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-quality_standard">품질보증기간</label>
              <div class="col-sm-7">
                  <textarea class="form-control" id="quality_standard" name='quality_standard' rows="3">{{ $order_data->quality_standard ?? null }}</textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-manufacturer">제조업자</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-manufacturer" class="form-control" name='manufacturer' value="{{ $order_data->manufacturer ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-responsible_seller">책임판매업자</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-responsible_seller" class="form-control" name='responsible_seller' value="{{ $order_data->responsible_seller ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-inquiries">소비자 상담문의</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-inquiries" class="form-control" name='inquiries' value="{{ $order_data->inquiries ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-expiration_date">제조번호<br>사용기한</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-expiration_date" class="form-control" name='expiration_date' value="{{ $order_data->expiration_date ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-country_manufacture">제조국</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-country_manufacture" class="form-control" name='country_manufacture' value="{{ $order_data->country_manufacture ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">사용여부</label>
              <div class="col-sm-5">
                <div class="btn-group" role="group">
                  <input type="radio" class="btn-check" name="is_active" id="is_active1" value='Y' @isset($order_data['is_active']) @if($order_data['is_active'] == 'Y') checked @endif @endisset>
                  <label class="btn btn-outline-primary" for="is_active1">사용</label>
                  <input type="radio" class="btn-check" name="is_active" id="is_active2" value='N' @isset($order_data['is_active']) @if($order_data['is_active'] == 'N') checked @endif @endisset>
                  <label class="btn btn-outline-primary" for="is_active2">미사용</label>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">노출여부</label>
              <div class="col-sm-5">
                <div class="btn-group" role="group">
                  <input type="radio" class="btn-check" name="is_view" id="is_view1" value='Y' @isset($order_data['is_view']) @if($order_data['is_view'] == 'Y') checked @endif @endisset>
                  <label class="btn btn-outline-primary" for="is_view1">노출</label>
                  <input type="radio" class="btn-check" name="is_view" id="is_view2" value='N' @isset($order_data['is_view']) @if($order_data['is_view'] == 'N') checked @endif @endisset>
                  <label class="btn btn-outline-primary" for="is_view2">미노출</label>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </form>
</div>

<script>
  ClassicEditor
      .create( document.querySelector( '#content' ),{
        ckfinder:{
          uploadUrl:"{{route('ckeditor.upload',['_token'=>csrf_token()])}}",
        },
      }).catch( error => {
          console.error( error );
      } );
</script>
@endsection

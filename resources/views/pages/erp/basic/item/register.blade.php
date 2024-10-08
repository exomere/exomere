@extends('layouts/contentNavbarLayout')

@section('title', ' Item - Register')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic Layout -->
  <form method='post' action="{{route('item.save')}}" enctype="multipart/form-data" id='formItem'>
    @csrf
    <input type='hidden' name='item_seq' value='{{ $item_seq ?? null }}'> 
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">상품등록</h5> <small class="text-muted float-end"><button type="button" class="btn btn-primary doSave">저장</button></small>
        </div>
        <div class="card-body">
          <form>
            @csrf
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-name"> <span style='color:red;'>*</span> 상품명 </label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="basic-default-name" name='name' value="{{ $item->name ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-name"> <span style='color:red;'>*</span> 상품명 (EN) </label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="basic-default-name" name='name' value="{{ $item->name ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-description"> 간략설명 </label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="basic-default-description" name='description'value="{{ $item->description ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-description"> 간략설명 (EN)</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="basic-default-description" name='description'value="{{ $item->description ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-code"> <span style='color:red;'>*</span> 상품코드 </label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="basic-default-code" name='code' value="{{ $item->code ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-category">카테고리</label>
              <div class="col-sm-2">
                <select class="form-control" id="basic-default-category" name='category'>
                  @foreach ($item_category as $key => $val)
                    <option value='{{$key}}' @isset($item->category) @if($item->category == $key) selected @endif @endisset>{{$val}}</option>  
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-kind">상품구분</label>
              <div class="col-sm-2">
                <div class="input-group input-group-merge">
                  <select class="form-control" id="basic-default-kind" name='kind'>
                      @foreach ($item_kind as $key => $val)
                        <option value='{{$key}}' @isset($item->kind) @if($item->kind == $key) selected @endif @endisset>{{$val}}</option>  
                      @endforeach
                  </select>
                </div>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-sort">상품순서2</label>
              <div class="col-sm-3">
                <div class="input-group input-group-merge">
                  <input type="text" id="basic-default-sort" maxlength="6" class="form-control" name='sort' value="{{ $item->sort ?? null }}"/>
                </div>
              </div>
            </div>

            
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-price">소비자가(₩)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-price" class="form-control" name='price' value="{{ $item->price ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-tax">부가세(₩)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-tax" class="form-control" name='tax' value="{{ $item->tax ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-pv">PV1(₩)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-pv" class="form-control" name='pv' value="{{ $item->pv ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-pv2">PV2(₩)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-pv2" class="form-control" name='pv2' value="{{ $item->pv2 ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-mem_price">회원가(₩)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-mem_price" class="form-control" name='mem_price' value="{{ $item->mem_price ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-mem_pv">회원PV(₩)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-mem_pv" class="form-control" name='mem_pv' value="{{ $item->mem_pv ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-planer_price">뷰티플래너가(₩)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-planer_price" class="form-control" name='planer_price' value="{{ $item->planer_price ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-planer_pv">뷰티플래너PV(₩)</label>
              <div class="col-sm-2">
                  <input type="number" id="basic-default-planer_pv" class="form-control" name='planer_pv' value="{{ $item->planer_pv ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-store_price">대리점가(₩)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-store_price" class="form-control" name='store_price' value="{{ $item->store_price ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-store_pv">대리점PV(₩)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-store_pv" class="form-control" name='store_pv' value="{{ $item->store_pv ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_price">총판가(₩)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_price" class="form-control" name='exclusive_price' value="{{ $item->exclusive_price ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_pv">총판PV(₩)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_pv" class="form-control" name='exclusive_pv' value="{{ $item->exclusive_pv ?? null }}"/>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-price">소비자가($)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-price" class="form-control" name='price_d' value="{{ $item->price_d ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-tax">부가세($)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-tax" class="form-control" name='tax_d' value="{{ $item->tax_d ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-pv">PV1($)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-pv" class="form-control" name='pv_d' value="{{ $item->pv_d ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-pv2">PV2($)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-pv2" class="form-control" name='pv2_d' value="{{ $item->pv2_d ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-mem_price">회원가($)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-mem_price" class="form-control" name='mem_price_d' value="{{ $item->mem_price_d ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-mem_pv">회원PV($)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-mem_pv" class="form-control" name='mem_pv_d' value="{{ $item->mem_pv_d ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-planer_price">뷰티플래너가($)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-planer_price" class="form-control" name='planer_price_d' value="{{ $item->planer_price_d ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-planer_pv">뷰티플래너PV($)</label>
              <div class="col-sm-2">
                  <input type="number" id="basic-default-planer_pv" class="form-control" name='planer_pv_d' value="{{ $item->planer_pv_d ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-store_price">대리점가($)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-store_price" class="form-control" name='store_price_d' value="{{ $item->store_price_d ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-store_pv">대리점PV($)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-store_pv" class="form-control" name='store_pv_d' value="{{ $item->store_pv_d ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_price">총판가($)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_price" class="form-control" name='exclusive_price_d' value="{{ $item->exclusive_price_d ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_pv">총판PV($)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_pv" class="form-control" name='exclusive_pv_d' value="{{ $item->exclusive_pv_d ?? null }}"/>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-price">소비자가(¥)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-price" class="form-control" name='price_y' value="{{ $item->price_y ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-tax">부가세(¥)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-tax" class="form-control" name='tax_y' value="{{ $item->tax_y ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-pv">PV1(¥)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-pv" class="form-control" name='pv_y' value="{{ $item->pv_y ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-pv2">PV2(¥)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-pv2" class="form-control" name='pv2_y' value="{{ $item->pv2_y ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-mem_price">회원가(¥)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-mem_price" class="form-control" name='mem_price_y' value="{{ $item->mem_price_y ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-mem_pv">회원PV(¥)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-mem_pv" class="form-control" name='mem_pv_y' value="{{ $item->mem_pv_y ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-planer_price">뷰티플래너가(¥)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-planer_price" class="form-control" name='planer_price_y' value="{{ $item->planer_price_y ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-planer_pv">뷰티플래너PV(¥)</label>
              <div class="col-sm-2">
                  <input type="number" id="basic-default-planer_pv" class="form-control" name='planer_pv_y' value="{{ $item->planer_pv_y ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-store_price">대리점가(¥)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-store_price" class="form-control" name='store_price_y' value="{{ $item->store_price_y ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-store_pv">대리점PV(¥)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-store_pv" class="form-control" name='store_pv_y' value="{{ $item->store_pv_y ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_price">총판가(¥)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_price" class="form-control" name='exclusive_price_y' value="{{ $item->exclusive_price_y ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_pv">총판PV(¥)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_pv" class="form-control" name='exclusive_pv_y' value="{{ $item->exclusive_pv_y ?? null }}"/>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-price">소비자가(Ұ)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-price" class="form-control" name='price_c' value="{{ $item->price_c ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-tax">부가세(Ұ)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-tax" class="form-control" name='tax_c' value="{{ $item->tax_c ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-pv">PV1(Ұ)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-pv" class="form-control" name='pv_c' value="{{ $item->pv_c ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-pv2">PV2(Ұ)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-pv2" class="form-control" name='pv2_c' value="{{ $item->pv2_c ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-mem_price">회원가(Ұ)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-mem_price" class="form-control" name='mem_price_c' value="{{ $item->mem_price_c ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-mem_pv">회원PV(Ұ)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-mem_pv" class="form-control" name='mem_pv_c' value="{{ $item->mem_pv_c ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-planer_price">뷰티플래너가(Ұ)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-planer_price" class="form-control" name='planer_price_c' value="{{ $item->planer_price_c ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-planer_pv">뷰티플래너PV(Ұ)</label>
              <div class="col-sm-2">
                  <input type="number" id="basic-default-planer_pv" class="form-control" name='planer_pv_c' value="{{ $item->planer_pv_c ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-store_price">대리점가(Ұ)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-store_price" class="form-control" name='store_price_c' value="{{ $item->store_price_c ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-store_pv">대리점PV(Ұ)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-store_pv" class="form-control" name='store_pv_c' value="{{ $item->store_pv_c ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_price">총판가(Ұ)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_price" class="form-control" name='exclusive_price_c' value="{{ $item->exclusive_price_c ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_pv">총판PV(Ұ)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_pv" class="form-control" name='exclusive_pv_c' value="{{ $item->exclusive_pv_c ?? null }}"/>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-stock">재고</label>
              <div class="col-sm-5">
                <input type="number" id="basic-default-stock" class="form-control" name='stock' value="{{ $item->stock ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3" style='margin-top:5px;'>
              <label class="col-sm-1 col-form-label" for="basic-default-thum_img">목록이미지</label>
              @isset($item->thum_img)
                <div class="col-sm-1">
                   <img style='width:50px;' src='{{Storage::url('public/data/'.$item->thum_img)}}'>
                </div>
              @endisset
              <div class="col-sm-5">
                <div class="input-group">
                    <input type="file" class="form-control" id="thum_img" name="thum_img">
                    <label class="input-group-text" for="thum_img">Upload</label>
                </div>
            </div>
            <div class="row mb-3" style='margin-top:15px;'>
              <label class="col-sm-1 col-form-label" for="basic-default-thum_img2">목록이미지2</label>
              @isset($item->thum_img2)
                <div class="col-sm-1">
                   <img style='width:50px;' src='{{Storage::url('public/data/'.$item->thum_img2)}}'>
                </div>
              @endisset
              <div class="col-sm-5">
                <div class="input-group">
                    <input type="file" class="form-control" id="thum_img2" name="thum_img2">
                    <label class="input-group-text" for="thum_img2">Upload</label>
                </div>
            </div>
            <div class="row mb-3" style='margin-top:15px;'>
              <label class="col-sm-1 col-form-label" for="basic-default-img">상세이미지</label>
              @isset($item->img)
                <div class="col-sm-1">
                  <img style='width:50px;' src='{{Storage::url('public/data/'.$item->img)}}'>
                </div>
              @endisset
              <div class="col-sm-6">
                  <div class="input-group">
                      <input type="file" class="form-control" id="img" name="img">
                      <label class="input-group-text" for="img" name="img">Upload</label>
                  </div>
              </div>
            </div>
            {{-- 
              <div class="row mb-3" style='height:700px;'>
                <label class="col-sm-1 col-form-label" for="basic-default-content">상품상세설명</label>
                <div class="col-sm-12">
                    <textarea class="form-control" id='content' name="content" rows="3">{{ $item->content ?? null }}</textarea>
                </div>
              </div> 
            --}}

            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-remark">비고</label>
              <div class="col-sm-7">
                  <textarea class="form-control" id="remark" name='remark' rows="3">{{ $item->remark ?? null }}</textarea>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-capacity">용량</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-capacity" class="form-control" name='capacity' value="{{ $item->capacity ?? null }}"/>
              </div> 
            </div>

            <div class="row mb-4">
              <label class="col-sm-1 col-form-label" for="basic-default-functionality">기능성화장품유무</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-functionality" class="form-control" name='functionality' value="{{ $item->functionality ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-efficacy">효능효과</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-efficacy" class="form-control" name='efficacy' value="{{ $item->efficacy ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-usage_capacity">사용법</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-usage_capacity" class="form-control" name='usage_capacity' value="{{ $item->usage_capacity ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-precautions">사용 시 주의사항</label>
              <div class="col-sm-7">
                  <textarea class="form-control" id="precautions" name='precautions' rows="3">{{ $item->precautions ?? null }}</textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-quality_standard">품질보증기간</label>
              <div class="col-sm-7">
                  <textarea class="form-control" id="quality_standard" name='quality_standard' rows="3">{{ $item->quality_standard ?? null }}</textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-manufacturer">제조업자</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-manufacturer" class="form-control" name='manufacturer' value="{{ $item->manufacturer ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-responsible_seller">책임판매업자</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-responsible_seller" class="form-control" name='responsible_seller' value="{{ $item->responsible_seller ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-inquiries">소비자 상담문의</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-inquiries" class="form-control" name='inquiries' value="{{ $item->inquiries ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-expiration_date">제조번호<br>사용기한</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-expiration_date" class="form-control" name='expiration_date' value="{{ $item->expiration_date ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-country_manufacture">제조국</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-country_manufacture" class="form-control" name='country_manufacture' value="{{ $item->country_manufacture ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">사용여부</label>
              <div class="col-sm-5">
                <div class="btn-group" role="group">
                  <input type="radio" class="btn-check" name="is_active" id="is_active1" value='Y' @isset($item['is_active']) @if($item['is_active'] == 'Y') checked @endif @endisset>
                  <label class="btn btn-outline-primary" for="is_active1">사용</label>
                  <input type="radio" class="btn-check" name="is_active" id="is_active2" value='N' @isset($item['is_active']) @if($item['is_active'] == 'N') checked @endif @endisset>
                  <label class="btn btn-outline-primary" for="is_active2">미사용</label>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">노출여부</label>
              <div class="col-sm-5">
                <div class="btn-group" role="group">
                  <input type="radio" class="btn-check" name="is_view" id="is_view1" value='Y' @isset($item['is_view']) @if($item['is_view'] == 'Y') checked @endif @endisset>
                  <label class="btn btn-outline-primary" for="is_view1">노출</label>
                  <input type="radio" class="btn-check" name="is_view" id="is_view2" value='N' @isset($item['is_view']) @if($item['is_view'] == 'N') checked @endif @endisset>
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
  $(".doSave").on('click',function(){
    $("#formItem").submit();
  });
</script>
@endsection

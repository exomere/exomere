@extends('layouts/contentNavbarLayout')

@section('title', ' Item - Register')

@section('content')
<style>
.ck-editor__editable_inline {
    min-height: 600px;
}
</style>
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
          <h5 class="mb-0">{{__('erp.product')}}{{__('erp.register')}}</h5> <small class="text-muted float-end"><button type="button" class="btn btn-primary doSave">{{__('erp.save')}}</button></small>
        </div>
        <div class="card-body">
          <form>
            @csrf
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-name"> <span style='color:red;'>*</span> {{__('erp.product_name')}} </label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="basic-default-name" name='name' value="{{ $item->name ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-name"> <span style='color:red;'>*</span> {{__('erp.product_name')}} (EN) </label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="basic-default-name" name='name_en' value="{{ $item->name_en ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-description"> {{__('erp.brief_description')}} </label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="basic-default-description" name='description'value="{{ $item->description ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-description"> {{__('erp.brief_description')}} (EN)</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="basic-default-description" name='description_en'value="{{ $item->description_en ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-code"> <span style='color:red;'>*</span> {{__('erp.product_code')}} </label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="basic-default-code" name='code' value="{{ $item->code ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-category">{{__('erp.category')}}</label>
              <div class="col-sm-2">
                <select class="form-control" id="basic-default-category" name='category'>
                  @foreach ($item_category as $key => $val)
                    <option value='{{$key}}' @isset($item->category) @if($item->category == $key) selected @endif @endisset>{{$val}}</option>  
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-kind">{{__('erp.product_classification')}}</label>
              <div class="col-sm-2">
                <div class="input-group input-group-merge">
                  <select class="form-control" id="basic-default-kind" name='kind'>
                      @foreach ($item_kind as $key => $val)
                        <option value='{{$key}}' @isset($item->kind) @if($item->kind == $key) selected @endif @endisset>{{$val}}</option>  
                      @endforeach
                  </select>
                </div>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-sort">{{__('erp.product_order')}}2</label>
              <div class="col-sm-3">
                <div class="input-group input-group-merge">
                  <input type="text" id="basic-default-sort" maxlength="6" class="form-control" name='sort' value="{{ $item->sort ?? null }}"/>
                </div>
              </div>
            </div>

            
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-price">{{__('erp.consumer_price')}}(₩)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-price" class="form-control" name='price' value="{{ $item->price ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-tax">{{__('erp.value_added_tax')}}(₩)</label>
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
              <label class="col-sm-1 col-form-label" for="basic-default-mem_price">{{__('erp.membership_price')}}(₩)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-mem_price" class="form-control" name='mem_price' value="{{ $item->mem_price ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-mem_pv">{{__('erp.member')}}PV(₩)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-mem_pv" class="form-control" name='mem_pv' value="{{ $item->mem_pv ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-planer_price">{{__('erp.beauty_planner_price')}}(₩)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-planer_price" class="form-control" name='planer_price' value="{{ $item->planer_price ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-planer_pv">{{__('erp.beauty_planner')}}PV(₩)</label>
              <div class="col-sm-2">
                  <input type="number" id="basic-default-planer_pv" class="form-control" name='planer_pv' value="{{ $item->planer_pv ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-store_price">{{__('erp.distributor_price')}}(₩)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-store_price" class="form-control" name='store_price' value="{{ $item->store_price ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-store_pv">{{__('erp.distributor')}}PV(₩)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-store_pv" class="form-control" name='store_pv' value="{{ $item->store_pv ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_price">{{__('erp.exclusive_distributor_price')}}(₩)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_price" class="form-control" name='exclusive_price' value="{{ $item->exclusive_price ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_pv">{{__('erp.exclusive_distributor')}}PV(₩)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_pv" class="form-control" name='exclusive_pv' value="{{ $item->exclusive_pv ?? null }}"/>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_price1">{{__('erp.exclusive_distributor')}}1(₩)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_price1" class="form-control" name='exclusive_price1' value="{{ $item->exclusive_price1 ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_pv1">{{__('erp.exclusive_distributor')}}1PV(₩)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_pv1" class="form-control" name='exclusive_pv1' value="{{ $item->exclusive_pv1 ?? null }}"/>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-price">{{__('erp.consumer_price')}}($)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-price" class="form-control" name='price_d' value="{{ $item->price_d ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-tax">{{__('erp.value_added_tax')}}($)</label>
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
              <label class="col-sm-1 col-form-label" for="basic-default-mem_price">{{__('erp.membership_price')}}($)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-mem_price" class="form-control" name='mem_price_d' value="{{ $item->mem_price_d ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-mem_pv">{{__('erp.member')}}PV($)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-mem_pv" class="form-control" name='mem_pv_d' value="{{ $item->mem_pv_d ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-planer_price">{{__('erp.beauty_planner_price')}}($)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-planer_price" class="form-control" name='planer_price_d' value="{{ $item->planer_price_d ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-planer_pv">{{__('erp.beauty_planner')}}PV($)</label>
              <div class="col-sm-2">
                  <input type="number" id="basic-default-planer_pv" class="form-control" name='planer_pv_d' value="{{ $item->planer_pv_d ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-store_price">{{__('erp.distributor_price')}}($)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-store_price" class="form-control" name='store_price_d' value="{{ $item->store_price_d ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-store_pv">{{__('erp.distributor')}}PV($)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-store_pv" class="form-control" name='store_pv_d' value="{{ $item->store_pv_d ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_price">{{__('erp.exclusive_distributor_price')}}($)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_price" class="form-control" name='exclusive_price_d' value="{{ $item->exclusive_price_d ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_pv">{{__('erp.exclusive_distributor')}}PV($)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_pv" class="form-control" name='exclusive_pv_d' value="{{ $item->exclusive_pv_d ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_price1_d">{{__('erp.exclusive_distributor')}}1($)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_price1_d" class="form-control" name='exclusive_price1_d' value="{{ $item->exclusive_price1_d ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_pv1_d">{{__('erp.exclusive_distributor')}}1PV($)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_pv1_d" class="form-control" name='exclusive_pv1_d' value="{{ $item->exclusive_pv1_d ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-price">{{__('erp.consumer_price')}}(¥)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-price" class="form-control" name='price_y' value="{{ $item->price_y ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-tax">{{__('erp.value_added_tax')}}(¥)</label>
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
              <label class="col-sm-1 col-form-label" for="basic-default-mem_price">{{__('erp.membership_price')}}(¥)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-mem_price" class="form-control" name='mem_price_y' value="{{ $item->mem_price_y ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-mem_pv">{{__('erp.member')}}PV(¥)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-mem_pv" class="form-control" name='mem_pv_y' value="{{ $item->mem_pv_y ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-planer_price">{{__('erp.beauty_planner_price')}}(¥)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-planer_price" class="form-control" name='planer_price_y' value="{{ $item->planer_price_y ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-planer_pv">{{__('erp.beauty_planner')}}PV(¥)</label>
              <div class="col-sm-2">
                  <input type="number" id="basic-default-planer_pv" class="form-control" name='planer_pv_y' value="{{ $item->planer_pv_y ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-store_price">{{__('erp.distributor_price')}}(¥)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-store_price" class="form-control" name='store_price_y' value="{{ $item->store_price_y ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-store_pv">{{__('erp.distributor')}}PV(¥)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-store_pv" class="form-control" name='store_pv_y' value="{{ $item->store_pv_y ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_price">{{__('erp.exclusive_distributor_price')}}(¥)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_price" class="form-control" name='exclusive_price_y' value="{{ $item->exclusive_price_y ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_pv">{{__('erp.exclusive_distributor')}}PV(¥)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_pv" class="form-control" name='exclusive_pv_y' value="{{ $item->exclusive_pv_y ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_price1_y">{{__('erp.exclusive_distributor')}}1(¥)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_price1_y" class="form-control" name='exclusive_price1_y' value="{{ $item->exclusive_price1_y ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_pv1_y">{{__('erp.exclusive_distributor')}}1PV(¥)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_pv1_y" class="form-control" name='exclusive_pv1_y' value="{{ $item->exclusive_pv1_y ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-price">{{__('erp.consumer_price')}}(元)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-price" class="form-control" name='price_c' value="{{ $item->price_c ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-tax">{{__('erp.value_added_tax')}}(元)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-tax" class="form-control" name='tax_c' value="{{ $item->tax_c ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-pv">PV1(元)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-pv" class="form-control" name='pv_c' value="{{ $item->pv_c ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-pv2">PV2(元)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-pv2" class="form-control" name='pv2_c' value="{{ $item->pv2_c ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-mem_price">{{__('erp.membership_price')}}(元)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-mem_price" class="form-control" name='mem_price_c' value="{{ $item->mem_price_c ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-mem_pv">{{__('erp.member')}}PV(元)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-mem_pv" class="form-control" name='mem_pv_c' value="{{ $item->mem_pv_c ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-planer_price">{{__('erp.beauty_planner_price')}}(元)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-planer_price" class="form-control" name='planer_price_c' value="{{ $item->planer_price_c ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-planer_pv">{{__('erp.beauty_planner')}}PV(元)</label>
              <div class="col-sm-2">
                  <input type="number" id="basic-default-planer_pv" class="form-control" name='planer_pv_c' value="{{ $item->planer_pv_c ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-store_price">{{__('erp.distributor_price')}}(元)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-store_price" class="form-control" name='store_price_c' value="{{ $item->store_price_c ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-store_pv">{{__('erp.distributor')}}PV(元)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-store_pv" class="form-control" name='store_pv_c' value="{{ $item->store_pv_c ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_price">{{__('erp.exclusive_distributor_price')}}(元)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_price" class="form-control" name='exclusive_price_c' value="{{ $item->exclusive_price_c ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_pv">{{__('erp.exclusive_distributor')}}PV(元)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_pv" class="form-control" name='exclusive_pv_c' value="{{ $item->exclusive_pv_c ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_price1_c">{{__('erp.exclusive_distributor')}}1(元)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_price1_c" class="form-control" name='exclusive_price1_c' value="{{ $item->exclusive_price1_c ?? null }}"/>
              </div>
              <label class="col-sm-1 col-form-label" for="basic-default-exclusive_pv1_c">{{__('erp.exclusive_distributor')}}1PV(元)</label>
              <div class="col-sm-2">
                <input type="number" id="basic-default-exclusive_pv1_c" class="form-control" name='exclusive_pv1_c' value="{{ $item->exclusive_pv1_c ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-stock">{{__('erp.inventory')}}</label>
              <div class="col-sm-5">
                <input type="number" id="basic-default-stock" class="form-control" name='stock' value="{{ $item->stock ?? null }}"/>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-category2">{{__('erp.product_classification')}}</label>
              <div class="col-sm-2">
                <select class="form-control" id="basic-default-category2" name='category2'>
                    <option value="">{{__('erp.select_product_classification')}}</option>
                    <option @isset($item->category2) @if($item->category2 == "toners_mists") selected @endif @endisset value="toners_mists">Toners Mists</option>
                    <option @isset($item->category2) @if($item->category2 == "serums_essences") selected @endif @endisset value="serums_essences">Serums Essences</option>
                    <option @isset($item->category2) @if($item->category2 == "creams") selected @endif @endisset value="creams">Creams</option>
                    <option @isset($item->category2) @if($item->category2 == "sheet_masks") selected @endif @endisset value="sheet_masks">Sheet Masks</option>
                    <option @isset($item->category2) @if($item->category2 == "cushions") selected @endif @endisset value="cushions">Cushions</option>
                    <option @isset($item->category2) @if($item->category2 == "devices") selected @endif @endisset value="devices">Device</option>
                </select>
              </div>
            </div>

            <div class="row mb-3" style='margin-top:5px;'>
              <label class="col-sm-1 col-form-label" for="basic-default-thum_img">{{__('erp.list_image')}}</label>
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
              <label class="col-sm-1 col-form-label" for="basic-default-thum_img2">{{__('erp.list_image')}}2</label>
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
            {{-- <div class="row mb-3" style='margin-top:15px;'>
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
            </div> --}}
            
              <div class="row mb-3" style='height:700px;'>
                <label class="col-sm-1 col-form-label" for="basic-default-content">{{__('erp.detailed_product_description')}}</label>
                <div class="col-sm-8">
                    <textarea class="form-control" id='content' name="content" rows="3">{{ $item->content ?? null }}</textarea>
                </div>
              </div> 

              <div class="row mb-3" style='height:700px;'>
                <label class="col-sm-1 col-form-label" for="basic-default-content">{{__('erp.detailed_product_description')}} US</label>
                <div class="col-sm-8">
                    <textarea class="form-control" id='content_us' name="content_us" rows="3">{{ $item->content_us ?? null }}</textarea>
                </div>
              </div> 

              <div class="row mb-3" style='height:700px;'>
                <label class="col-sm-1 col-form-label" for="basic-default-content">{{__('erp.detailed_product_description')}} JP</label>
                <div class="col-sm-8">
                    <textarea class="form-control" id='content_jp' name="content_jp" rows="3">{{ $item->content_jp ?? null }}</textarea>
                </div>
              </div> 

              <div class="row mb-3" style='height:700px;'>
                <label class="col-sm-1 col-form-label" for="basic-default-content">{{__('erp.detailed_product_description')}} CN</label>
                <div class="col-sm-8">
                    <textarea class="form-control" id='content_cn' name="content_cn" rows="3">{{ $item->content_cn ?? null }}</textarea>
                </div>
              </div> 
           

            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-remark">{{__('erp.remarks')}}</label>
              <div class="col-sm-7">
                  <textarea class="form-control" id="remark" name='remark' rows="3">{{ $item->remark ?? null }}</textarea>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-capacity">{{__('erp.capacity')}}</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-capacity" class="form-control" name='capacity' value="{{ $item->capacity ?? null }}"/>
              </div> 
            </div>

            <div class="row mb-4">
              <label class="col-sm-1 col-form-label" for="basic-default-functionality">{{__('erp.functional_cosmetics')}}</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-functionality" class="form-control" name='functionality' value="{{ $item->functionality ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-efficacy">{{__('erp.effectiveness')}}</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-efficacy" class="form-control" name='efficacy' value="{{ $item->efficacy ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-usage_capacity">{{__('erp.how_to_use')}}</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-usage_capacity" class="form-control" name='usage_capacity' value="{{ $item->usage_capacity ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-precautions">{{__('erp.precautions_for_use')}}</label>
              <div class="col-sm-7">
                  <textarea class="form-control" id="precautions" name='precautions' rows="3">{{ $item->precautions ?? null }}</textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-quality_standard">{{__('erp.quality_warranty_period')}}</label>
              <div class="col-sm-7">
                  <textarea class="form-control" id="quality_standard" name='quality_standard' rows="3">{{ $item->quality_standard ?? null }}</textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-manufacturer">{{__('erp.manufacturer')}}</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-manufacturer" class="form-control" name='manufacturer' value="{{ $item->manufacturer ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-responsible_seller">{{__('erp.responsible_seller')}}</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-responsible_seller" class="form-control" name='responsible_seller' value="{{ $item->responsible_seller ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-inquiries">{{__('erp.consumer_inquiry')}}</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-inquiries" class="form-control" name='inquiries' value="{{ $item->inquiries ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-expiration_date">{{__('erp.manufacturing_number')}}<br>{{__('erp.use_by_date')}}</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-expiration_date" class="form-control" name='expiration_date' value="{{ $item->expiration_date ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-country_manufacture">{{__('erp.country_of_manufacture')}}</label>
              <div class="col-sm-7">
                <input type="text" id="basic-default-country_manufacture" class="form-control" name='country_manufacture' value="{{ $item->country_manufacture ?? null }}"/>
              </div> 
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">{{__('erp.usage_status')}}</label>
              <div class="col-sm-5">
                <div class="btn-group" role="group">
                  <input type="radio" class="btn-check" name="is_active" id="is_active1" value='Y' @isset($item['is_active']) @if($item['is_active'] == 'Y') checked @endif @endisset>
                  <label class="btn btn-outline-primary" for="is_active1">{{__('erp.use')}}</label>
                  <input type="radio" class="btn-check" name="is_active" id="is_active2" value='N' @isset($item['is_active']) @if($item['is_active'] == 'N') checked @endif @endisset>
                  <label class="btn btn-outline-primary" for="is_active2">{{__('erp.unused')}}</label>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label">{{__('erp.exposed_status')}}</label>
              <div class="col-sm-5">
                <div class="btn-group" role="group">
                  <input type="radio" class="btn-check" name="is_fo_view" id="is_fo_view1" value='Y' @isset($item['is_fo_view']) @if($item['is_fo_view'] == 'Y') checked @endif @endisset>
                  <label class="btn btn-outline-primary" for="is_fo_view1">노출</label>
                  <input type="radio" class="btn-check" name="is_fo_view" id="is_fo_view2" value='N' @isset($item['is_fo_view']) @if($item['is_fo_view'] == 'N') checked @endif @endisset>
                  <label class="btn btn-outline-primary" for="is_fo_view2">미노출</label>
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

  ClassicEditor.create( document.querySelector( '#content' ),{
    ckfinder:{
      uploadUrl:"{{route('ckeditor.upload',['_token'=>csrf_token()])}}",
    },
  }).catch( error => {
      console.error( error );
  } );

  ClassicEditor.create( document.querySelector( '#content_us' ),{
    ckfinder:{
      uploadUrl:"{{route('ckeditor.upload',['_token'=>csrf_token()])}}",
    },
  }).catch( error => {
      console.error( error );
  } );

  ClassicEditor.create( document.querySelector( '#content_jp' ),{
    ckfinder:{
      uploadUrl:"{{route('ckeditor.upload',['_token'=>csrf_token()])}}",
    },
  }).catch( error => {
      console.error( error );
  } );

  ClassicEditor.create( document.querySelector( '#content_cn' ),{
    ckfinder:{
      uploadUrl:"{{route('ckeditor.upload',['_token'=>csrf_token()])}}",
    },
  }).catch( error => {
      console.error( error );
  } );

</script>
@endsection

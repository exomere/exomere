@extends('layouts/contentNavbarLayout')

@section('title', 'stock - Register')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic Layout -->
  <form method='post' id="stock_form" action="{{route('stock.save')}}" enctype="multipart/form-data">
    @csrf
    <input type='hidden' id='stock_date2' value='{{ date("Y-m-d") }}'> 
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">재고등록</h5>
          <small class="text-muted float-end"><input type="submit" class="btn btn-primary saveBtn" value='{{__('erp.save')}}'></small>
        </div>
        <div class="card-body">
          <form>
            @csrf
            
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="stock_date"> <span style='color:red;'>*</span> 재고날짜 </label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="stock_date" name='stock_date' value="{{ date("Y-m-d") }}"/>
              </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-1 col-form-label" for="item_seq"> <span style='color:red;'>*</span> 상품 </label>
                <div class="col-sm-2">
                    <select class="form-select" name="item_seq" id="item_seq" required>
                    @foreach($items as $name => $key)
                        <option value='{{$key}}'>{{$name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-1 col-form-label" for="stock_type"> <span style='color:red;'>*</span> 입출구분 </label>
                <div class="col-sm-2">
                    <select class="form-select" name="stock_type" id="stock_type" required>
                    <option value='P'>입고</option>
                    <option value='M'>출고</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-1 col-form-label" for="stock"> <span style='color:red;'>*</span> 수량 </label>
                <div class="col-sm-2">
                    <input class="form-select" type='number' name='stock' id='stock' value='0'>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-1 col-form-label" for="remark"> <span style='color:red;'>*</span> 메모 </label>
                <div class="col-sm-2">
                    <input class="form-select" type='text' name='remark' id='remark' >
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

<script>
$(document).ready(function() {
    $("#stock_date").datepicker();
    $("#stock_date").datepicker("option", "dateFormat", 'yy-mm-dd');
    $('#item_seq').select2();

    $("#stock_date").val($("#stock_date2").val());
});  


</script>
@endsection
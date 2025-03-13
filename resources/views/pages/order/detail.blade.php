@extends('layouts/contentNavbarLayout')

@section('title', 'Order - list')

@section('content')
<!-- Basic -->

<!--/ Basic -->
<div class="card">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">주문 내역</h5> 
  </div>
  <div class="table-responsive text-nowrap">
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row mb-3">
                    <label class="col-sm-1 col-form-label" for="order_date"> {{__('erp.order_date')}} </label>
                    <div class="col-sm-3">
                        <span id="order_date" class="form-control">{{ $order_date ?? date("Y-m-d") }}</span>
                    </div>
                </div>
                <div style="display:@isset($order_data->receipt_method) @if($order_data->receipt_method == "delivery") block @endif @endisset" id="receiptDiv">
                    <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="delivery_name"> {{__('erp.orderer')}} </label>
                        <div class="col-sm-6">
                            <span class="form-control">{{ $order_data->delivery_name ?? null }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="delivery_phone"> {{__('erp.contact')}} </label>
                        <div class="col-sm-6">
                            <span class="form-control">{{ $order_data->delivery_phone ?? null }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-1 col-form-label">{{__('erp.zip_code')}}</label>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <span class="form-control" readonly>{{ $order_data->zipcode ?? null }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-1 col-form-label">{{__('erp.basic_address')}}</label>
                        <div class="col-sm-5">
                            <span class="form-control" readonly>{{ $order_data->address ?? null }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-1 col-form-label">{{__('erp.detailed_address')}}</label>
                        <div class="col-sm-5">
                            <span class="form-control">{{ $order_data->address_detail ?? null }}</span>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <label class="col-sm-1 col-form-label" for="remark"> {{__('erp.remarks')}} </label>
                    <div class="col-sm-2">
                      <textarea class="form-control" readonly> {{ $order_data->remark ?? '' }} </textarea>
                    </div>
                </div>
                <div class="row mt-3">
                  <label class="col-sm-1 col-form-label" for="total_amount"> {{__('erp.total_amount')}} </label>
                  <div class="col-sm-2">
                   <span class="form-control"> {{number_format($order_data->total_amount ?? 0)}} </span>
                  </div>
                  <label class="col-sm-1 col-form-label" for="payment_amount"> {{__('erp.payment_amount')}} </label>
                  <div class="col-sm-2">
                    <span class="form-control">{{number_format($order_data->payment_amount ?? 0)}} </span>
                  </div>
              </div>
            </div>
            <br>
            <div class="row mb-3">
              <div class="col-sm-8">
                <div class="card">
                  <h5 class="card-header">{{__('erp.ordered_product_list')}}</h5>
                  <div class="table-responsive text-nowrap">
                    <table class="table">
                      <thead>
                        <tr class="text-nowrap">
                          <th>{{__('erp.product_name')}}</th>
                          <th>{{__('erp.sales_price')}}</th>
                          <th>PV</th>
                          <th>{{__('erp.quantity')}}</th>
                          <th>{{__('erp.total')}}</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0 product_info_body">
                        
                          @if(isset($item_info))
                          
                            @foreach ($item_info as $item)
                            
                              <tr class='product_info_tr p_info_{{$item->pd_seq}}'>
                                <td>{{$item->pd_name}} </td>
                                <td>{{number_format($item->pd_price)}}</td>
                                <td>{{number_format($item->pd_pv)}}</td>
                                <td>{{$item->pd_qty}}</td>
                                <td><span class='pd_total' id='pd_total_{{$item->pd_seq}}'>{{number_format($item->pd_price * $item->pd_qty)}}</span></td>
                              </tr>
                            @endforeach
                          @else
                            <tr><td style='text-align:center; height:80px;' colspan="6">{{__('erp.no_selected_products')}}</td> </tr>
                          @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ Basic Bootstrap Table -->
@endsection

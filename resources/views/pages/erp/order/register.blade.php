@extends('layouts/contentNavbarLayout')

@section('title', 'Order - Register')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic Layout -->
  <form method='post' id="order_form" action="{{route('erp-order.save')}}" enctype="multipart/form-data">
    @csrf
    <input type='hidden' name='order_seq' value='{{ $order_seq ?? null }}'> 
    <input type='hidden' id='order_date2' value='{{ $order_date ?? date("Y-m-d") }}'> 
    
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">{{__('erp.order_registration')}}</h5>
          <small class="text-muted float-end"><input type="button" class="btn btn-primary saveBtn" value='{{__('erp.save')}}'></small>
        </div>
        <div class="card-body">
          <form>
            @csrf
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="member_info"> <span style='color:red;'>*</span> {{__('erp.member_selection')}} </label>
              <div class="col-sm-6">
                <div class="input-group">
                  <input type="hidden" class="form-control" id="member_position" value="{{ $order_data->member_seq ?? null }}"/>
                  <input type="hidden" class="form-control" id="member_seq" name='member_seq' value="{{ $order_data->member_seq ?? null }}"/>
                  <input type="text" class="form-control" id="member_info" readonly name='member_info' value="{{ $order_data->member_id  ?? null }} | {{ $order_data->member_name ?? null }}"/>
                  <a href="javascript:void(0);" class="btn btn-primary me-4" data-bs-target="#editUser" data-bs-toggle="modal">{{__('erp.search')}}</a>
               </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="order_date"> <span style='color:red;'>*</span> {{__('erp.order_date')}} </label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="order_date" name='order_date' value="{{ $order_date ?? date("Y-m-d") }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="order_type"> <span style='color:red;'>*</span> {{__('erp.order_classification')}} </label>
              <div class="col-sm-2">
                <select class="form-select" name="order_type" id="order_type" required>
                  <option value=''>== {{__('erp.order_classification')}} ==</option>
                  <option value='new' @isset($order_data->order_type) @if($order_data->order_type == "new") selected @endif @endisset>{{__('erp.new_order')}}</option>
                  <option value='repurchase' @isset($order_data->order_type) @if($order_data->order_type == "repurchase") selected @endif @endisset>{{__('erp.repurchase_order')}}</option>
                  <option value='distribute_new' @isset($order_data->order_type) @if($order_data->order_type == "distribute_new") selected @endif @endisset>{{__('erp.new_sale_mall')}}</option>
                  <option value='distribute_repurchase' @isset($order_data->order_type) @if($order_data->order_type == "distribute_repurchase") selected @endif @endisset>{{__('erp.repurchase_in_sale_mall')}}</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="receipt_method"> {{__('erp.product_receipt')}} </label>
              <div class="col-sm-2">
                <select class="form-select" name="receipt_method" id="receipt_method">
                  <option value='delivery' @isset($order_data->receipt_method) @if($order_data->receipt_method == "delivery") selected @endif @endisset>{{__('erp.delivery_receipt')}}</option>
                  <option value='scene' @isset($order_data->receipt_method) @if($order_data->receipt_method == "scene") selected @endif @endisset>{{__('erp.on_site_receipt')}}</option>
                </select>
              </div>
            </div>
            <div style="display:@isset($order_data->receipt_method) @if($order_data->receipt_method == "delivery") block @endif @endisset" id="receiptDiv">
              <div class="row mb-3">
                <label class="col-sm-1 col-form-label" for="delivery_name"> {{__('erp.orderer')}} </label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="delivery_name" name='delivery_name' value="{{ $order_data->delivery_name ?? null }}" />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-1 col-form-label" for="delivery_phone"> {{__('erp.contact')}} </label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="delivery_phone" name="delivery_phone" value="{{ $order_data->delivery_phone ?? null }}" />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-1 col-form-label" for="zipcode">{{__('erp.zip_code')}}</label>
                <div class="col-sm-2">
                  <div class="input-group">
                    <input type="text" name="zipcode" id="zipcode" class="form-control" readonly value="{{ $order_data->zipcode ?? null }}" />
                    <button type="button" class="btn btn-outline-secondary getPostCode">{{ __('messages.search') }}</button>
                </div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-1 col-form-label">{{__('erp.basic_address')}}</label>
                <div class="col-sm-5">
                  <input type="text" readonly class="form-control" name='address' id='address' value="{{ $order_data->address ?? null }}"/>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-1 col-form-label">{{__('erp.detailed_address')}}</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name='address_detail' id='address_detail' value="{{ $order_data->address_detail ?? null }}"/>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="remark"> {{__('erp.remarks')}} </label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="remark" name='remark' value="{{ $order_data->remark ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-code"> {{__('erp.product')}} </label>
              <div class="col-md-4">
                <select class="form-select" name="product_select" id="product_select">
                  <option value="">{{__('erp.select_product')}}</option>
                  @foreach ($item_array as $item)
                    <option value='{{$item['seq']}}'
                        data-price='{{$item['price']}}'
                        data-pv='{{$item['pv']}}'
                        data-planer_price='{{$item['planer_price']}}'
                        data-planer_pv='{{$item['planer_pv']}}'
                        data-store_price='{{$item['store_price']}}'
                        data-store_pv='{{$item['store_pv']}}'
                        data-exclusive_price='{{$item['exclusive_price']}}'
                        data-exclusive_pv='{{$item['exclusive_pv']}}'
                        data-exclusive_price1='{{$item['exclusive_price1']}}'
                        data-exclusive_pv1='{{$item['exclusive_pv1']}}'
                        data-name='{{$item['name']}}'
                    >{{$item['name']}} ({{number_format($item['price'])}})
                    </option>
                  @endforeach
                </select>      
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-12">
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
                          <th>{{__('erp.management')}}</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0 product_info_body">
                        
                          @if(isset($item_info))
                          
                            @foreach ($item_info as $item)
                            
                              <tr class='product_info_tr p_info_{{$item->pd_seq}}'>
                                <td> <input type='hidden' name='pd_seq[]' value='{{$item->pd_seq}}'>
                                      <input type='hidden' name='pd_price[]' value='{{$item->pd_price}}'>
                                      <input type='hidden' name='pd_name[]' value='{{$item->pd_name}}'>
                                      <input type='hidden' name='pd_pv[]' value='{{$item->pd_pv}}'>{{$item->pd_name}}
                                  </td>
                                <td>{{number_format($item->pd_price)}}</td>
                                <td>{{number_format($item->pd_pv)}}</td>
                                <td><input style='width:80px;' class='form-control qtyProduct' id='pd_qty_{{$item->pd_seq}}' name='pd_qty[]' data-seq='{{$item->pd_seq}}' data-price='{{$item->pd_price}}' type='number' value='{{$item->pd_qty}}'/></td>
                                <td><span class='pd_total' id='pd_total_{{$item->pd_seq}}'>{{number_format($item->pd_price * $item->pd_qty)}}</span></td>
                                <td><button type='button' class='btn btn-outline-danger infoRowDel' data-type='product' data-idx='{{$item->pd_seq}}'>{{__('erp.remove')}}</button></td>
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
              <div class="row mt-3">
                <label class="col-sm-1 col-form-label" for="total_amount"> {{__('erp.total_amount')}} </label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="total_amount" name='total_amount' readonly style='width:170px;' value='{{number_format($order_data->total_amount ?? 0)}}'/>
                  <input type="hidden" class="form-control" id="total_pv" name='total_pv' readonly style='width:170px;' value='{{number_format($order_data->total_pv ?? 0)}}'/>
                </div>
                <label class="col-sm-1 col-form-label" for="payment_amount"> {{__('erp.payment_amount')}} </label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="payment_amount" name='payment_amount' readonly style='width:170px;' value='{{number_format($order_data->payment_amount ?? 0)}}'/>
                </div>
                <label class="col-sm-1 col-form-label" for="remain_amount"> {{__('erp.remaining_amount')}} </label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="remain_amount" name='remaining_amount' readonly style='width:170px;' value='{{number_format($order_data->remaining_amount ?? 0)}}'/>
                </div>
              </div>
              <div class="row mt-3">
                <label class="col-sm-1 col-form-label" for="cash_payment"> {{__('erp.cash_payment')}} </label>
                <div class="col-sm-2">
                  <input type="text" class="form-control totalRecalculating" id="cash_payment" name="cash_payment" value='{{number_format($order_data->cash_payment ?? 0)}}'/>
                </div>
                <label class="col-sm-1 col-form-label" for="card_payment"> {{__('erp.card_payment')}} </label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="card_payment" readonly name="card_payment" value='{{number_format($order_data->card_payment ?? 0)}}'/>
                </div>
                <label class="col-sm-1 col-form-label" for="account_payment"> {{__('erp.account_transfer')}} </label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="account_payment" readonly name="account_payment" value='{{number_format($order_data->account_payment ?? 0)}}'/>
                </div>
              </div>
              <div class="row mt-3">
                <label class="col-sm-1 col-form-label" for="point_payment"> {{__('erp.use_points')}} </label>
                <div class="col-sm-2">
                  <input type="text" class="form-control totalRecalculating" data-type='point' id="point_payment" name="point_payment" value='{{$order_data->point_paymen ?? 0}}'/>
                </div>
                <label class="col-sm-1 col-form-label" for="remain_points"> {{__('erp.remaining_points')}} </label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="remain_points" readonly value='0'/>
                </div>
              </div>
            <div class="row " data-select2-id="38">
              <div class="col" data-select2-id="37">
                <h5 class="mt-4"> {{__('erp.payment_method')}} </h5>
                <div class="card mb-6" data-select2-id="36">
                  <div class="card-header p-0 nav-align-top">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button type='button' class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-tabs-personal" role="tab" aria-selected="true">{{__('erp.card_payment')}}</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button type='button' class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-account" role="tab" aria-selected="false" tabindex="-1">{{__('erp.account_transfer')}}</button>
                      </li>
                    </ul>
                  </div>
            
                  <div class="tab-content" data-select2-id="35">
                    <!-- Personal Info -->
                    <div class="tab-pane fade active show" id="form-tabs-personal" role="tabpanel" data-select2-id="form-tabs-personal">
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="payment_card_1"> {{__('erp.card_company')}} </label>
                        <div class="col-sm-2">
                          <select class="form-select" id="payment_card_1">
                            <option value="">{{__('erp.select_card')}}</option>
                            @foreach ($card_compnay as $key => $val)
                              <option value="{{$key}}">{{$val}}</option>
                            @endforeach
                          </select>
                        </div>
                        <label class="col-sm-1 col-form-label" for="payment_card_2"> {{__('erp.card_number')}} </label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" id="payment_card_2" maxlength="20"/>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="payment_card_3"> {{__('erp.owner_name')}} </label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" id="payment_card_3"/>
                        </div>
                        <label class="col-sm-1 col-form-label" for="payment_card_4"> {{__('erp.password')}} </label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" id="payment_card_4" maxlength="2"/>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="payment_card_5"> {{__('erp.installment_month')}} </label>
                        <div class="col-sm-2">
                          <select class="form-select"  id="payment_card_5">
                            <option value="0">일시불</option>
                            @for ($i = 2; $i < 13; $i++)
                                <option value="{{$i}}">{{$i}}{{__('erp.month')}}</option>
                            @endfor
                          </select>
                        </div>
                        <label class="col-sm-1 col-form-label" for="payment_card_6"> {{__('erp.validity_period')}} </label>
                        <div class="col-sm-1">
                          <select class="form-select"  id="payment_card_6">
                             @php
                              $month_val = "0";
                             @endphp
                            @for ($i = date("y"); $i < (date("y")+15); $i++)
                
                                <option value="{{$i}}">{{$i}}{{__('erp.year')}}</option>
                            @endfor
                          </select>
                        </div>
                        <div class="col-sm-1">
                          <select class="form-select"  id="payment_card_7">
                            @for ($i = 1; $i < 13; $i++)
                              @if($i < 10)
                                @php $month_val = "0".$i @endphp
                              @else
                                @php $month_val = $i @endphp
                              @endif
                              <option value="{{$month_val}}">{{$i}}{{__('erp.month')}}</option>
                            @endfor
                          </select>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="payment_card_8"> {{__('erp.approval_number')}} </label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control"  id='payment_card_8'/>
                        </div>
                        <label class="col-sm-1 col-form-label" for="payment_card_9"> {{__('erp.approval_date')}} </label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control"  id='payment_card_9' readonly/>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="payment_card_10"> {{__('erp.payment_amount')}} </label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control"  id='payment_card_10'/>
                        </div>
                      </div>
                      <div class="row mt-6">
                        <div class="col-md-6">
                          <div class="row justify-content-end">
                            <div class="col-sm-9">
                              <button type="button" class="btn btn-primary me-3 addCardPaymentInfo">{{__('erp.add')}}</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="form-tabs-account" role="tabpanel">
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="payment_account_1"> {{__('erp.deposit_account')}} </label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="payment_account_1" readonly value="KB국민 계좌번호 989801-00-072129 ㈜엑소미어" />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="payment_account_2"> {{__('erp.depositor_name')}} </label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="payment_account_2" />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="payment_account_3"> {{__('erp.deposit_date')}} </label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="payment_account_3" name='payment_account_3' readonly/>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="payment_account_4"> {{__('erp.payment_amount')}} </label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="payment_account_4" />
                        </div>
                      </div>
                      <div class="row mt-6">
                        <div class="col-md-6">
                          <div class="row justify-content-end">
                            <div class="col-sm-9">
                              <button type="button" class="btn btn-primary me-3 addAccountInfoBody">{{__('erp.add')}}</button>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-sm-12">
                <hr class="my-5">
                <!-- Responsive Table -->
                <div class="card">
                  <h5 class="card-header">{{__('erp.card_payment_info')}}</h5>
                  <div class="table-responsive text-nowrap">
                    <table class="table">
                      <thead>
                        <tr class="text-nowrap">
                          <th>{{__('erp.card_name')}}</th>
                          <th>{{__('erp.card_number')}}</th>
                          <th>{{__('erp.payment_amount')}}</th>
                          <th>{{__('erp.installment_month')}}</th>
                          <th>{{__('erp.expiration_date')}}</th>
                          <th>{{__('erp.approval_number')}}</th>
                          <th>{{__('erp.owner_name')}}</th>
                          <th>{{__('erp.approval_date')}}</th>
                          <th>{{__('erp.password')}}</th>
                          <th>{{__('erp.management')}}</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0 cardInfoBody">
                        @if(isset($card_info))
                          @php $card_cnt = 1; @endphp
                            @foreach ($card_info as $card)
                              <tr class='cardInfoTr cardInfo_row_{{$card_cnt}}'>
                                  <td>
                                  <input type='hidden' class='form-control' readonly name='card_company[]' value='{{$card->card_company}}'>
                                  <input type='text' class='form-control' readonly name='card_name[]' value='{{$card->card_name}}'>
                                  </td>
                                  <td><input type='text' class='form-control' readonly name='card_number[]' value='{{$card->card_number ?? null}}'></td>
                                  <td><input type='text' class='form-control card_payment_price' readonly name='card_payment_price[]' value='{{$card->card_payment_price ?? null}}'></td>
                                  <td><input type='text' class='form-control' readonly name='card_month_plan[]' value='{{$card->card_month_plan ?? null}}'></td>
                                  <td><input type='text' class='form-control' readonly name='card_year_month[]' value='{{$card->card_year_month ?? null}}'></td>
                                  <td><input type='text' class='form-control' readonly name='card_approval_number[]' value='{{$card->card_approval_number ?? null}}'></td>
                                  <td><input type='text' class='form-control' readonly name='card_approval_name[]' value='{{$card->card_approval_name ?? null}}'></td>
                                  <td><input type='text' class='form-control' readonly name='card_approval_date[]' value='{{$card->card_approval_date ?? null}}'></td>
                                  <td><input type='text' class='form-control' readonly name='card_password[]' value='{{$card->card_password ?? null}}'></td>
                                  <td><button type='button' class='btn btn-outline-danger infoRowDel' data-type='card' data-idx='{{$card_cnt ?? null}}' >{{__('erp.remove')}}</button></td>
                              </tr>
                              @php $card_cnt++; @endphp
                            @endforeach
                          @else
                            <tr>
                              <td style='text-align:center; height:80px;' colspan="10">{{__('erp.no_card_payment_info')}}</td>
                            </tr>
                          @endif
                      </tbody>
                    </table>
                  </div>
                </div>
                <!--/ Responsive Table -->
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-12">
                <hr class="my-5">
                <!-- Responsive Table -->
                <div class="card">
                  <h5 class="card-header">{{__('erp.bank_transfer_info')}}</h5>
                  <div class="table-responsive text-nowrap">
                    <table class="table">
                      <thead>
                        <tr class="text-nowrap">
                          <th>{{__('erp.deposit_account_number')}}</th>
                          <th>{{__('erp.depositor_name')}}</th>
                          <th>{{__('erp.deposit_date')}}</th>
                          <th>{{__('erp.payment_amount')}}</th>
                          <th>{{__('erp.management')}}</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0 accountInfoBody">
                        @if(isset($account_info))
                          @php $acc_cnt = 1; @endphp
                          @foreach ($account_info as $account)
                            <tr class='accountInfoTr accountInfo_row_{{$acc_cnt}}'>
                                <td><input type='text' class='form-control' readonly name='account_number[]' value='{{$account->account_number}}'></td>
                                <td><input type='text' class='form-control' readonly name='account_head[]' value='{{$account->account_head}}'></td>
                                <td><input type='text' class='form-control' readonly name='account_date[]' value='{{$account->account_date}}'></td>
                                <td><input type='text' class='form-control account_payment_price' readonly name='account_payment_price[]' value='{{$account->account_payment_price}}'></td>
                                <td><button type='button' class='btn btn-outline-danger infoRowDel' data-type='account' data-idx='{{$acc_cnt}}'>{{__('erp.remove')}}</button></td>
                            </tr>
                            @php $acc_cnt++; @endphp
                          @endforeach
                        @else
                          <tr>
                            <td style='text-align:center; height:80px;' colspan="5">{{__('erp.no_account_transfer_info')}}</td>
                          </tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
                <!--/ Responsive Table past_order_data -->
                
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-12">
                <hr class="my-5">
                <!-- Responsive Table -->
                <div class="card">
                  <h5 class="card-header">{{__('erp.past_order_info')}}</h5>
                  <div class="table-responsive text-nowrap">
                    <table class="table">
                      <thead>
                        <tr class="text-nowrap">
                          <th>{{__('erp.order_number')}}</th>
                          <th>{{__('erp.order_date')}}</th>
                          <th>{{__('erp.orderer')}}</th>
                          <th>{{__('erp.order_amount')}}</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        @if(isset($past_order_data))
                          @foreach ($past_order_data as $past)
                            @if($past->id != $order_seq)
                              <tr>
                                <td><a href='/management/erp/order/register/{{$past->id}}'> {{$past->id}} </a></td>
                                <td>{{date("Y-m-d",strtotime($past->order_date))}}</td>
                                <td>{{$past->member_name}}</td>
                                <td>{{ number_format($past->total_amount)}}</td>
                              </tr>
                            @endif
                          @endforeach
                        @else
                          <tr>
                            <td style='text-align:center; height:80px;' colspan="5">{{__('erp.no_past_order_info')}}</td>
                          </tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
                <!--/ Responsive Table  -->
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
                <button class="btn btn-outline-primary searchMember"  style='width:22%;' type="button">Search</button>
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
 
@endsection
@section('page-script')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
<script src="/assets/js/admin/order-register.js"></script>

<script>
$(document).ready(function() {
    $('#product_select').select2();
    $("#payment_card_9").datepicker();
    $("#payment_account_3").datepicker();
    $("#order_date").datepicker();
    $("#order_date").datepicker("option", "dateFormat", 'yy-mm-dd');
    $("#payment_card_9").datepicker("option", "dateFormat", 'yy-mm-dd');
    $("#payment_account_3").datepicker("option", "dateFormat", 'yy-mm-dd');

    $("#order_date").val($("#order_date2").val());
});  


</script>
@endsection
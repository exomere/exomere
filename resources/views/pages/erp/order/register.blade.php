@extends('layouts/contentNavbarLayout')

@section('title', 'Order - Register')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<!-- Basic Layout & Basic with Icons -->
<div class="row">
  <!-- Basic Layout -->
  <form method='post' action="{{route('erp-order.save')}}" enctype="multipart/form-data">
    @csrf
    <input type='hidden' name='order_seq' value='{{ $order_seq ?? null }}'> 
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">주문등록</h5> <small class="text-muted float-end"><input type="submit" class="btn btn-primary" value='저장'></small>
        </div>
        <div class="card-body">
          <form>
            @csrf
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="order_date"> <span style='color:red;'>*</span> 주문일 </label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="order_date" name='order_date' value="{{ $order_date ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="member_info"> <span style='color:red;'>*</span> 회원선택 </label>
              <div class="col-sm-6">
                <div class="input-group">
                  <input type="hidden" class="form-control" id="member_seq" readonly name='member_seq' value="{{ $order_data->recommend_seq ?? null }}"/>
                  <input type="text" class="form-control" id="member_info" readonly name='member_info' value="{{ $order_data->recommend_id  ?? null }} | {{ $order_data->recommend_name ?? null }}"/>
                  <a href="javascript:void(0);" class="btn btn-primary me-4" data-bs-target="#editUser" data-bs-toggle="modal">검색</a>
               </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="order_type"> <span style='color:red;'>*</span> 주문구분 </label>
              <div class="col-sm-2">
                <select class="form-select" name="order_type" id="order_type" required>
                  <option value='new' @isset($order_data->order_type) @if($order_data->order_type == "new") selected @endif @endisset>신규주문</option>
                  <option value='repurchase' @isset($order_data->order_type) @if($order_data->order_type == "repurchase") selected @endif @endisset>재구매주문</option>
                  <option value='distribute_new' @isset($order_data->order_type) @if($order_data->order_type == "distribute_new") selected @endif @endisset>분양몰신규</option>
                  <option value='distribute_repurchase' @isset($order_data->order_type) @if($order_data->order_type == "distribute_repurchase") selected @endif @endisset>분양몰재구문</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="center_seq"> 센터 </label>
              <div class="col-md-4">
                <select class="form-select" name="center_seq" id="center_seq">
                  <option value="">센터 선택</option>
                  @foreach ($center_array as $center)
                    <option value='{{$center['seq']}}' @isset($order_data->center_seq) @if($order_data->center_seq == $center['seq']) selected @endif @endisset>{{$center['name']}} </option>
                  @endforeach
                </select>      
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="receipt_method"> 상품수령 </label>
              <div class="col-sm-2">
                <select class="form-select" name="receipt_method" id="receipt_method">
                  <option value='delivery' @isset($order_data->receipt_method) @if($order_data->receipt_method == "delivery") selected @endif @endisset>택배수령</option>
                  <option value='scene' @isset($order_data->receipt_method) @if($order_data->receipt_method == "scene") selected @endif @endisset>현장수령</option>
                </select>
              </div>
            </div>
            <div style="display:@isset($order_data->receipt_method) @if($order_data->receipt_method == "delivery") block @endif @endisset" id="receiptDiv">
              <div class="row mb-3">
                <label class="col-sm-1 col-form-label" for="delivery_name"> 주문자 </label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="delivery_name" name='delivery_name' value="{{ $order_data->delivery_name ?? null }}" />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-1 col-form-label" for="delivery_phone"> 연락처 </label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="delivery_phone" name="delivery_phone" value="{{ $order_data->delivery_phone ?? null }}" />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-1 col-form-label" for="zipcode">우편번호</label>
                <div class="col-sm-2">
                  <div class="input-group">
                    <input type="text" name="zipcode" id="zipcode" class="form-control" readonly value="{{ $order_data->zipcode ?? null }}" />
                    <button type="button" class="btn btn-outline-secondary getPostCode">{{ __('messages.search') }}</button>
                </div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-1 col-form-label">기본주소</label>
                <div class="col-sm-5">
                  <input type="text" readonly class="form-control" name='address' id='address' value="{{ $order_data->address ?? null }}"/>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-1 col-form-label">상세주소</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name='address_detail' id='address_detail' value="{{ $order_data->address_detail ?? null }}"/>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="remark"> 비고 </label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="remark" name='remark' value="{{ $order_data->remark ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-code"> 상품 </label>
              <div class="col-md-4">
                <select class="form-select" name="product_select" id="product_select">
                  <option value="">상품 선택</option>
                  @foreach ($item_array as $item)
                    <option value='{{$item['seq']}}'
                        data-price='{{$item['price']}}'
                        data-pv='{{$item['pv']}}'
                        data-name='{{$item['name']}}'
                    >{{$item['name']}}
                    </option>
                  @endforeach
                </select>      
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-12">
                <div class="card">
                  <h5 class="card-header">주문상품 리스트</h5>
                  <div class="table-responsive text-nowrap">
                    <table class="table">
                      <thead>
                        <tr class="text-nowrap">
                          <th>상품명</th>
                          <th>판매가</th>
                          <th>PV</th>
                          <th>수량</th>
                          <th>합계</th>
                          <th>관리</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0 product_info_body">
                        
                          @if(isset($item_info))
 
                            @foreach ($item_info as $item)
                              <tr class='product_info_tr p_info_{{$item->pd_seq}}'>
                                <td> <input type='hidden' name='pd_seq[]' value='{{$item->pd_seq}}'>
                                      <input type='hidden' name='pd_price[]' value='{{$item->pd_price}}'>
                                      <input type='hidden' name='pd_name[]' value='{{$item->pd_name}}'>
                                      <input type='hidden' name='pd_pv[]' value='"+pv+"'>{{$item->pd_name}}</td>
                                <td>{{number_format($item->pd_price)}}</td>
                                <td>{{number_format($item->pd_pv)}}</td>
                                <td><input style='width:80px;' class='form-control qtyProduct' id='pd_qty_{{$item->pd_seq}}' name='pd_qty[]' data-seq='{{$item->pd_seq}}' data-price='{{$item->pd_price}}' type='number' value='{{$item->pd_qty}}'/></td>
                                <td><span class='pd_total' id='pd_total_{{$item->pd_seq}}'>{{number_format($item->pd_price * $item->pd_qty)}}</span></td>
                                <td><button type='button' class='btn btn-outline-danger infoRowDel' data-type='product' data-idx='{{$item->pd_seq}}'>삭제</button></td>
                              </tr>
                            @endforeach
                          @else
                            <tr><td style='text-align:center; height:80px;' colspan="6">선택한 상품이 없습니다.</td> </tr>
                          @endif
                      
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <label class="col-sm-1 col-form-label" for="total_amount"> 총금액 </label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="total_amount" name='total_amount' readonly style='width:170px;' value='{{number_format($order_data->total_amount ?? 0)}}'/>
                  <input type="hidden" class="form-control" id="total_pv" name='total_pv' readonly style='width:170px;' value='{{number_format($order_data->total_pv ?? 0)}}'/>
                </div>
                <label class="col-sm-1 col-form-label" for="payment_amount"> 결제금액 </label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="payment_amount" name='payment_amount' readonly style='width:170px;' value='{{number_format($order_data->payment_amount ?? 0)}}'/>
                </div>
                <label class="col-sm-1 col-form-label" for="remain_amount"> 남은금액 </label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="remain_amount" name='remaining_amount' readonly style='width:170px;' value='{{number_format($order_data->remaining_amount ?? 0)}}'/>
                </div>
              </div>
              <div class="row mt-3">
                <label class="col-sm-1 col-form-label" for="cash_payment"> 현금결제 </label>
                <div class="col-sm-2">
                  <input type="text" class="form-control totalRecalculating" id="cash_payment" name="cash_payment" value='{{number_format($order_data->cash_payment ?? 0)}}'/>
                </div>
                <label class="col-sm-1 col-form-label" for="card_payment"> 카드결제 </label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="card_payment" readonly name="card_payment" value='{{number_format($order_data->card_payment ?? 0)}}'/>
                </div>
                <label class="col-sm-1 col-form-label" for="account_payment"> 계좌이체 </label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="account_payment" readonly name="account_payment" value='{{number_format($order_data->account_payment ?? 0)}}'/>
                </div>
              </div>
              <div class="row mt-3">
                <label class="col-sm-1 col-form-label" for="point_payment"> 포인트사용 </label>
                <div class="col-sm-2">
                  <input type="text" class="form-control totalRecalculating" data-type='point' id="point_payment" name="point_payment" value='{{$order_data->point_paymen ?? 0}}'/>
                </div>
                <label class="col-sm-1 col-form-label" for="remain_points"> 잔여포인트 </label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="remain_points" readonly value='0'/>
                </div>
              </div>
            <div class="row " data-select2-id="38">
              <div class="col" data-select2-id="37">
                <h5 class="mt-4"> 결제방법 </h5>
                <div class="card mb-6" data-select2-id="36">
                  <div class="card-header p-0 nav-align-top">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button type='button' class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-tabs-personal" role="tab" aria-selected="true">카드결제</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button type='button' class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-account" role="tab" aria-selected="false" tabindex="-1">계좌이체</button>
                      </li>
                    </ul>
                  </div>
            
                  <div class="tab-content" data-select2-id="35">
                    <!-- Personal Info -->
                    <div class="tab-pane fade active show" id="form-tabs-personal" role="tabpanel" data-select2-id="form-tabs-personal">
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="payment_card_1"> 카드사 </label>
                        <div class="col-sm-2">
                          <select class="form-select" id="payment_card_1">
                            <option value="">카드선택</option>
                            @foreach ($card_compnay as $key => $val)
                              <option value="{{$key}}">{{$val}}</option>
                            @endforeach
                          </select>
                        </div>
                        <label class="col-sm-1 col-form-label" for="payment_card_2"> 카드번호 </label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" id="payment_card_2" maxlength="20"/>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="payment_card_3"> 소유자명 </label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" id="payment_card_3"/>
                        </div>
                        <label class="col-sm-1 col-form-label" for="payment_card_4"> 비밀번호 </label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" id="payment_card_4" maxlength="2"/>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="payment_card_5"> 할부개월 </label>
                        <div class="col-sm-2">
                          <select class="form-select"  id="payment_card_5">
                            @for ($i = 1; $i < 13; $i++)
                                <option value="{{$i}}">{{$i}}개월</option>
                            @endfor
                          </select>
                        </div>
                        <label class="col-sm-1 col-form-label" for="payment_card_6"> 유효기간 </label>
                        <div class="col-sm-1">
                          <select class="form-select"  id="payment_card_6">
                            @for ($i = date("y"); $i < (date("y")+15); $i++)
                                <option value="{{$i}}">{{$i}}년</option>
                            @endfor
                          </select>
                        </div>
                        <div class="col-sm-1">
                          <select class="form-select"  id="payment_card_7">
                            @for ($i = 1; $i < 13; $i++)
                              <option value="{{$i}}">{{$i}}월</option>
                          @endfor
                          </select>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="payment_card_8"> 승인번호 </label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control"  id='payment_card_8'/>
                        </div>
                        <label class="col-sm-1 col-form-label" for="payment_card_9"> 승인일자 </label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control"  id='payment_card_9' readonly/>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="payment_card_10"> 결제금액 </label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control"  id='payment_card_10'/>
                        </div>
                      </div>
                      <div class="row mt-6">
                        <div class="col-md-6">
                          <div class="row justify-content-end">
                            <div class="col-sm-9">
                              <button type="button" class="btn btn-primary me-3 addCardPaymentInfo">추가</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="form-tabs-account" role="tabpanel">
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="payment_account_1"> 입금계좌 </label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="payment_account_1" readonly value="기업은행 414-105162-04-023 (주)엑소미어" />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="payment_account_2"> 입금자명 </label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="payment_account_2" />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="payment_account_3"> 입금일 </label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="payment_account_3" name='payment_account_3' readonly/>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="payment_account_4"> 결제금액 </label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="payment_account_4" />
                        </div>
                      </div>
                      <div class="row mt-6">
                        <div class="col-md-6">
                          <div class="row justify-content-end">
                            <div class="col-sm-9">
                              <button type="button" class="btn btn-primary me-3 addAccountInfoBody">추가</button>
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
                  <h5 class="card-header">카드결제정보</h5>
                  <div class="table-responsive text-nowrap">
                    <table class="table">
                      <thead>
                        <tr class="text-nowrap">
                          <th>카드명</th>
                          <th>카드번호</th>
                          <th>결제금액</th>
                          <th>할부</th>
                          <th>유효년월</th>
                          <th>승인번호</th>
                          <th>소유자명</th>
                          <th>승인일자</th>
                          <th>비밀번호</th>
                          <th>관리</th>
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
                                  <td><input type='text' class='form-control' readonly name='card_number[]' value='{{$card->card_number}}'></td>
                                  <td><input type='text' class='form-control card_payment_price' readonly name='card_payment_price[]' value='{{$card->card_payment_price}}'></td>
                                  <td><input type='text' class='form-control' readonly name='card_month_plan[]' value='{{$card->card_month_plan}}'></td>
                                  <td><input type='text' class='form-control' readonly name='card_year_month[]' value='{{$card->card_year_month}}'></td>
                                  <td><input type='text' class='form-control' readonly name='card_approval_number[]' value='{{$card->card_approval_number}}'></td>
                                  <td><input type='text' class='form-control' readonly name='card_approval_name[]' value='{{$card->card_approval_name}}'></td>
                                  <td><input type='text' class='form-control' readonly name='card_approval_date[]' value='{{$card->card_approval_date}}'></td>
                                  <td><input type='text' class='form-control' readonly name='card_password[]' value='{{$card->card_password}}'></td>
                                  <td><button type='button' class='btn btn-outline-danger infoRowDel' data-type='card' data-idx='{{$card_cnt}}' >삭제</button></td>
                              </tr>
                              @php $card_cnt++; @endphp
                            @endforeach
                          @else
                            <tr>
                              <td style='text-align:center; height:80px;' colspan="10">카드결제 정보가 없습니다.</td>
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
                  <h5 class="card-header">계좌이체 결제 정보</h5>
                  <div class="table-responsive text-nowrap">
                    <table class="table">
                      <thead>
                        <tr class="text-nowrap">
                          <th>입금계좌번호</th>
                          <th>입금자</th>
                          <th>입금일</th>
                          <th>결제금액</th>
                          <th>관리</th>
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
                                <td><button type='button' class='btn btn-outline-danger infoRowDel' data-type='account' data-idx='{{$acc_cnt}}'>삭제</button></td>
                            </tr>
                            @php $acc_cnt++; @endphp
                          @endforeach
                        @else
                          <tr>
                            <td style='text-align:center; height:80px;' colspan="5">계좌이체 정보가 없습니다.</td>
                          </tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
                <!--/ Responsive Table -->
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
            <h4 class="mb-2">회원검색</h4>
          </div>
            <div class="col-12">
              <div class="row mt-5">
                <select id="searchMemberType" class="form-select color-dropdown" style='width:22%; margin-left:10%;'>
                  <option value="name">회원 이름</option>
                  <option value="member_id">회원 아이디</option>
                  <option value="id">회원 번호</option>
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
                            <th>회원번호</th>
                            <th>회원명</th>
                            <th>로그인ID</th>
                            <th>직급</th>
                            <th>등록일</th>
                            <th>관리</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0 memberBody">
                          <tr>
                            <th colspan="6" style='height:80px; text-align:center;'>회원을 검색해주세요.</th>
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
              <button type="reset" class="btn btn-label-secondary cancelMemberInfo" data-bs-dismiss="modal" style='border:1px solid #eee;' aria-label="Close">취소</button>
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
@endsection
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
          <h5 class="mb-0">주문등록</h5> <small class="text-muted float-end"><button type="submit" class="btn btn-primary">저장</button></small>
        </div>
        <div class="card-body">
          <form>
            @csrf
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="order_date"> <span style='color:red;'>*</span> 주문일 </label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="order_date" name='order_date' value="{{ $order_data->name ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-description"> <span style='color:red;'>*</span> 회원선택 </label>
              <div class="col-sm-6">
                <div class="input-group">
                  <input type="text" class="form-control" id="basic-default-director_seq" readonly name='director_seq' value="{{ $item->director_seq ?? null }}"/>
                  <a href="javascript:;" class="btn btn-primary me-4" data-bs-target="#editUser" data-bs-toggle="modal">검색</a>
               </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-code"> <span style='color:red;'>*</span> 주문구분 </label>
              <div class="col-sm-2">
                <select class="form-select" name="local_store" id="local_store" required>
                  <option value='new'>신규주문</option>
                  <option value='repurchase'>재구매주문</option>
                  <option value='distribute_new'>분양몰신규</option>
                  <option value='distribute_repurchase'>분양몰재구문</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-code"> <span style='color:red;'>*</span> 센터 </label>
              <div class="col-sm-6">
                <div class="input-group">
                  <input type="text" class="form-control" id="basic-default-director_seq" readonly name='director_seq' value="{{ $item->director_seq ?? null }}"/>
                  <a href="javascript:;" class="btn btn-primary me-4" data-bs-target="#editUser" data-bs-toggle="modal">검색</a>
               </div>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-code"> 상품수령 </label>
              <div class="col-sm-2">
                <select class="form-select" name="receipt_method" id="receipt_method" required>
                  <option value='scene'>현장수령</option>
                  <option value='delivery'>택배수령</option>
                </select>
              </div>
            </div>
            <div style="display:{{ $order_data->code ?? 'none' }};" id="receiptDiv">
              <div class="row mb-3">
                <label class="col-sm-1 col-form-label" for="basic-default-code"> 주문자 </label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="basic-default-code" name='code' value="{{ $order_data->code ?? null }}"/>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-1 col-form-label" for="basic-default-code"> 연락처 </label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="basic-default-code" name='code' value="{{ $order_data->code ?? null }}"/>
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
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-code"> 비고 </label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="basic-default-code" name='code' value="{{ $order_data->code ?? null }}"/>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-1 col-form-label" for="basic-default-code"> 상품 </label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="basic-default-code" name='code' value="{{ $order_data->code ?? null }}"/>
              </div>
            </div>
            
            <div class="row" data-select2-id="38">
              <div class="col" data-select2-id="37">
                <h6 class="mt-4"> 결제방법 </h6>
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
                        <label class="col-sm-1 col-form-label" for="basic-default-code"> 카드사 </label>
                        <div class="col-sm-2">
                          <select class="form-select" name="local_store" id="local_store">
                            <option value="">카드선택</option>
                            @foreach ($card_compnay as $key => $val)
                              <option value="{{$key}}">{{$val}}</option>
                            @endforeach
                          </select>
                        </div>
                        <label class="col-sm-1 col-form-label" for="basic-default-code"> 카드번호 </label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" id="basic-default-code" name='code' value="{{ $order_data->code ?? null }}"/>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="basic-default-code"> 소유자명 </label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" id="basic-default-code" name='code' value="{{ $order_data->code ?? null }}"/>
                        </div>
                        <label class="col-sm-1 col-form-label" for="basic-default-code"> 비밀번호 </label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" id="basic-default-code" name='code' value="{{ $order_data->code ?? null }}"/>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="basic-default-code"> 할부개월 </label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" id="basic-default-code" name='code' value="{{ $order_data->code ?? null }}"/>
                        </div>
                        <label class="col-sm-1 col-form-label" for="basic-default-code"> 유효기간 </label>
                        <div class="col-sm-1">
                          <select class="form-select" name="local_store" id="local_store">
                            @for ($i = date("y"); $i < (date("y")+15); $i++)
                                <option value="{{$i}}">{{$i}}년</option>
                            @endfor
                          </select>
                        </div>
                        <div class="col-sm-1">
                          <select class="form-select" name="local_store" id="local_store">
                            @for ($i = 1; $i < 13; $i++)
                              <option value="{{$i}}">{{$i}}월</option>
                          @endfor
                          </select>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="basic-default-code"> 승인번호 </label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" id="basic-default-code" name='code' value="{{ $order_data->code ?? null }}"/>
                        </div>
                        <label class="col-sm-1 col-form-label" for="cf_date"> 승인일자 </label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" id="cf_date" name='cf_date' readonly value="{{ $order_data->code ?? null }}"/>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="basic-default-code"> 결제금액 </label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" id="basic-default-code" name='code' value="{{ $order_data->code ?? null }}"/>
                        </div>
                      </div>
                      <div class="row mt-6">
                        <div class="col-md-6">
                          <div class="row justify-content-end">
                            <div class="col-sm-9">
                              <button type="button" class="btn btn-primary me-3">추가</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="form-tabs-account" role="tabpanel">
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="basic-default-code"> 입금계좌 </label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="basic-default-code" name='code' value="{{ $order_data->code ?? null }}"/>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="basic-default-code"> 입금자명 </label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="basic-default-code" name='code' value="{{ $order_data->code ?? null }}"/>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="deposit_date"> 입금일 </label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="deposit_date" name='deposit_date' readonly  value="{{ $order_data->code ?? null }}"/>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-1 col-form-label" for="basic-default-code"> 결제금액 </label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="basic-default-code" name='code' value="{{ $order_data->code ?? null }}"/>
                        </div>
                      </div>
                      <div class="row mt-6">
                        <div class="col-md-6">
                          <div class="row justify-content-end">
                            <div class="col-sm-9">
                              <button type="button" class="btn btn-primary me-3">추가</button>
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
                          <th>No</th>
                          <th>카드코드</th>
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
                      <tbody class="table-border-bottom-0">
                        <tr>
                          <th scope="row">1</th>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                        </tr>
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
                          <th>No</th>
                          <th>입금계좌번호</th>
                          <th>입금자</th>
                          <th>입금일</th>
                          <th>결제금액</th>
                          <th>관리</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        <tr>
                          <th scope="row">1</th>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                        </tr>
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
              <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" style='border:1px solid #eee;' aria-label="Close">취소</button>
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

  <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
  <script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
  <script>
     $( function() {
          $("#cf_date").datepicker();
          $("#deposit_date").datepicker();
          $("#order_date").datepicker();
          $("#order_date").datepicker( "option", "dateFormat",'yy-mm-dd');
          $("#cf_date").datepicker( "option", "dateFormat",'yy-mm-dd');
          $("#deposit_date").datepicker( "option", "dateFormat",'yy-mm-dd');
          
      } );
    $("#receipt_method").on("change",function(){
      var val = $(this).val();
      if(val == 'scene'){
        $("#receiptDiv").hide();
      }else{
        $("#receiptDiv").show();
      }

    });
    $(".searchMember").on("click",function(){
      var text = $("#searchMemberText").val();
      var type = $("#searchMemberType").val();

      if(text == ''){
        alert('검색어를 입력해주세요.');
        return false;
      }
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'post',
          dataType: "json",
          url: "/management/member/serarchMember",
          data : {
            "type" : type,
            "text" : text,
          }, 
          success: function (res) {
            console.log(res.length);
            var html = "";
            if(res.length == 0){
              alert('검색결과가 없습니다.');
            }else{
              $(".memberBody").empty();
              $.each(res, function(index,data){
                html += "<tr>";
                html += " <td>"+data.seq+"</td>";
                html += " <td>"+data.name+"</td>";
                html += " <td>"+data.member_id+"</td>";
                html += " <td>"+data.member_position+"</td>";
                html += " <td>"+data.created_at+"</td>";
                html += " <td><button type='button' class='btn btn-primary me-3' data-seq='"+data.seq+"' data-name='"+data.name+"' data-member_id='"+data.member_id+"'>선택</button></td>"
                html += "</tr>";
              });
            }
            $(".memberBody").append(html);
          }
      });

    });

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

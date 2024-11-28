@extends('layouts/contentNavbarLayout')

@section('title', 'Erp - Point - list')
<meta name="csrf-token" content="{{ csrf_token() }}"/>
@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
  <div class="container-fluid">
    <a class="navbar-brand" href="javascript:void(0)"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        </li>
        <li class="nav-item">
        </li>
       
        <li class="nav-item">
        </li>
      </ul>
      <form class="d-flex" action="{{ route('erp-point.list') }}" method="GET">
        <input class="form-control me-2" style='width:240px;' name="search_text" type="search" placeholder="Search" aria-label="Search" value="{{ request('search_text') }}">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
  <!--/ Basic -->
  <div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">{{__('erp.bonus_points')}}</h5>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table" >
        <thead>
          <tr>
            <th>No</th>
            <th>{{__('erp.management')}}</th>
            <th>{{__('erp.member_number')}}</th>
            <th>{{__('erp.id')}}</th>
            <th>{{__('erp.name')}}</th>
            <th>{{__('erp.mobile_phone_number')}}</th>
            <th>{{__('erp.subscription_date')}}</th>
            <th>{{__('erp.remaining_points')}}</th>
            <th>{{__('erp.payment_points')}}</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach ($ex_members as $list)
            <tr>
              <td>{{$row_num--}}</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item provisionPoint" 
                      data-seq="{{$list->id}}"
                      data-member_id="{{$list->member_id}}"
                      data-name="{{$list->name}}"
                      data-remain_points="{{$list->remain_points}}"
                      data-bs-target="#provisionPoint" data-bs-toggle="modal"><i class="bx bx-edit-alt me-1"></i> {{__('erp.points_payment')}}</a>
                    <a class="dropdown-item provisionPointList" data-seq="{{$list->id}}" data-bs-target="#pointList" data-bs-toggle="modal"><i class="bx bx-trash me-1"></i> {{__('erp.point_details')}}</a>
                  </div>
                </div>
              </td>
              <td>{{$list->id}}</td>
              <td>{{$list->member_id}}</td>
              <td>{{$list->name}}</td>
              <td>{{$list->phone}}</td>
              <td>{{$list->created_at}}</td>
              <td>{{number_format($list->remain_points)}}</td>
              <td>{{number_format($list->payment_points)}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex justify-content-end">
        {{ $ex_members->links('vendor.pagination.bootstrap-4') }}
    </div>
  </div>
  <div class="modal fade" id="provisionPoint" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
      <div class="modal-content">
        <div class="modal-body">
          <div class="text-center mb-6">
            <h4 class="mb-2">{{__('erp.points_payment')}}</h4>
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
                            <th>{{__('erp.member_id')}}</th>
                            <th>{{__('erp.member_name')}}</th>
                            <th>{{__('erp.current_point')}}</th>
                            <th>{{__('erp.points_payment_amount')}}</th>
                            <th>{{__('erp.reason')}}</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0 memberBody">
                          @csrf
                          <tr>
                            <td>
                              <input type='hidden' name='member_seq' id='member_seq' >
                              <span id='sp_member_seq'></span>
                            </td>
                            <td>
                              <input type='hidden' name='member_id' id='member_id' >
                              <span id='sp_member_id'></span>
                            </td>
                            <td>
                              <input type='hidden' name='member_name' id='member_name' >
                              <span id='sp_member_name'></span>
                            </td>
                            <td>
                              <input type='hidden' name='remain_points' id='remain_points' >
                              <span id='sp_remain_points'></span>
                            </td>
                            <td>
                              <input style='width:80px;' type='number' name='provision_point' id='provision_point' value='0' >
                            </td>
                            <td>
                              <textarea name='remark' id='remark' ></textarea>
                            </td>
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
              <button type="button" class="btn btn-label-secondary submitPoints" data-bs-dismiss="modal" style='background-color:#514141; color:#fff;'>{{__('erp.payment')}}</button>
              <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" style='border:1px solid #eee;' aria-label="Close">{{__('erp.cancel')}}</button>
            </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="pointList" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
      <div class="modal-content">
        <div class="modal-body">
          <div class="text-center mb-6">
            <h4 class="mb-2">{{__('erp.point_details')}}</h4>
          </div>
            <div class="col-12">
              <div class="row mb-3">
                <div class="col-sm-12">
                  <div class="card">
                    <table class="table">
                      <thead>
                        <tr class="text-nowrap">
                          <th>ID</th>
                          <td><span id='point_info_id'></span></td>
                          <th>{{__('erp.name')}}</th>
                          <td><span id='point_info_name'></span></td>
                          <th>{{__('erp.total_payment_points')}}</th>
                          <td><span id='point_info_payment_points'></span></td>
                          <th>{{__('erp.remaining_points')}}</th>
                          <td><span id='point_info_remain_points'></span></td>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-12">
                  <div class="card">
                    <div class="table-responsive text-nowrap">
                      <table class="table">
                        <thead>
                          <tr class="text-nowrap">
                            <th>{{__('erp.date')}}</th>
                            <th>{{__('erp.type')}}</th>
                            <th>{{__('erp.point')}}</th>
                            <th>{{__('erp.reason')}}</th>
                            <th>{{__('erp.registrant')}}</th>
                          </tr>
                        </thead>
                        <tbody class="point_info_body">

                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!--/ Responsive Table -->
                </div>
              </div>
            </div>
            <div class="col-12 text-center">
              <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" style='border:1px solid #eee;' aria-label="Close">{{__('erp.confirm')}}</button>
            </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Basic Bootstrap Table -->
@endsection
@section('page-script')
 <script>
  $(".provisionPoint").on("click",function(){
      var seq = $(this).data("seq");
      var member_id = $(this).data("member_id");
      var name = $(this).data("name");
      var remain_points = $(this).data("remain_points");
      
      $("#member_seq").val(seq);
      $("#member_id").val(member_id);
      $("#member_name").val(name);
      $("#remain_points").val(remain_points);

      $("#sp_member_seq").text(seq);
      $("#sp_member_id").text(member_id);
      $("#sp_member_name").text(name);
      $("#sp_remain_points").text(remain_points);
  });

  $(".submitPoints").on("click",function(){

    var seq = $("#member_seq").val();
    var member_id =  $("#member_id").val();
    var name = $("#member_name").val();
    var remain_points =  $("#remain_points").val();
    var provision_point =  $("#provision_point").val();
    var remark =  $("#remark").val();
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: "/management/erp/point/provision",
        data: {
            "member_seq": seq,
            "member_id": member_id,
            "member_name": name,
            "remain_points": remain_points,
            "provision_point": provision_point,
            "remark" : remark,
        },
        success: function (res) {
          $("#provision_point").val(0);
          alert('{{__('erp.point_payment_completed')}}');
          location.reload();
        }
    });

  });

  $(".provisionPointList").on("click",function(){

    var seq = $(this).data("seq");
    
    $(".point_info_body").empty();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        dataType:'JSON',
        url: "/management/erp/point/getPointList",
        data: {
            "seq": seq,
        },
        success: function (res) {
          var html = "";
            $('#point_info_id').text(res.member_id);
            $('#point_info_name').text(res.member_name);
            $('#point_info_payment_points').text(res.payment_points);
            $('#point_info_remain_points').text(res.remain_points);
          if(res.total_count == 0){
            html += "<tr><td colspan='5'>{{__('erp.no_point_history')}}</td></tr>";
          }else{
            $.each(res.pointInfo, function (index, data) {
                html+= "<tr>";
                html += " <td>" + data.date + "</td>";
                html += " <td>" + data.kind + "</td>";
                html += " <td>" + data.point + "</td>";
                html += " <td>" + data.remark + "</td>";
                html += " <td>" + data.reg_name + "</td>";
                html+= "</tr>";
            });
          }
          
          $(".point_info_body").append(html);
        }
    });

  });
 </script>
@endsection
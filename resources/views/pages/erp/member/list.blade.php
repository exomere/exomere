@extends('layouts/contentNavbarLayout')

@section('title', 'Erp - basic - Manager - list')

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
        <form class="d-flex" action="{{ route('erp-member.list') }}" method="GET">
          <input class="form-control me-2" style='width:240px;' name="search_text" type="search" placeholder="Search" aria-label="Search" value="{{ request('search_text') }}">
          <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <!--/ Basic -->
  <div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">회원 리스트</h5> <small class="text-muted float-end"><button onclick="location.href='{{route('erp-member.create')}}'" class="btn btn-primary">회원 등록</button></small>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table" >
        <thead>
          <tr>
            <th rowspan="2" style='vertical-align: middle;' >No</th>
            <th rowspan="2" style='vertical-align: middle;' >회원관리</th>
            {{-- <th rowspan="2" style='vertical-align: middle;' >총판구분</th> --}}
            <th rowspan="2" style='vertical-align: middle;' >회원번호</th>
            <th rowspan="2" style='vertical-align: middle;' >아이디</th>
            <th rowspan="2" style='vertical-align: middle;' >이름</th>
            <th rowspan="2" style='vertical-align: middle;' >이메일</th>
            <th rowspan="2" style='vertical-align: middle;' >회원구분</th>
            <th rowspan="2" style='vertical-align: middle;' >분양몰</th>
            <th rowspan="2" style='vertical-align: middle;' >지역점</th>
            <th rowspan="2" style='vertical-align: middle;' >가입일자</th>
            <th rowspan="2" style='vertical-align: middle;' >연락처</th>
            <th rowspan="2" style='vertical-align: middle;' >매출합계</th>
            <th colspan="3" style='text-align:center;'>모집인</th>
            <th rowspan="2" style='vertical-align: middle;'>비고</th>
            <th rowspan="2" style='vertical-align: middle;'>관리</th>
          </tr>
          <tr>
            <th style='text-align:center;'>회원번호</th>
            <th style='text-align:center;'>아이디</th>
            <th style='text-align:center;'>이름</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          
          @foreach ($ex_members as $list)
            <tr>
              <td>{{$row_num--}}</td>
              <td>
                <a class="badge bg-label-info me-2" href="{{route('erp-member.create',$list->id)}}">
                    <span class="fw-medium">상세보기</span>
                </a>
              </td>
              {{-- <td>0점</td> --}}
              <td>{{$list->id}}</td>
              <td>{{$list->member_id}}</td>
              <td>{{$list->name}}</td>
              <td>{{$list->email}}</td>
              <td>{{$list->member_position}}</td>
              <td>N</td>
              <td>{{$list->getCenterName()}}</td>
              <td>{{ date("Y-m-d",strtotime($list->created_at)) }}</td>
              <td>{{$list->phone}}</td>
              <td>{{number_format($list->getMemberOrderAmountSum())}}</td>
              <td>{{$list->recommend_seq}}</td>
              <td>{{$list->recommend_id}}</td>
              <td>{{$list->recommend_name}}</td>
              <td>{{$list->remark}}</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item memberModifyList" data-seq="{{$list->id}}" data-bs-target="#memberModifyList" data-bs-toggle="modal"><i class="bx bx-trash me-1"></i> 변경내역</a>
                    <a class="dropdown-item" href="{{route('erp-member.create',$list->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                    <a class="dropdown-item" style='color:red;' href="{{route('member.del',$list->id)}}"><i class="bx bx-trash me-1"></i> Delete</a>
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex justify-content-end">
        {{ $ex_members->links('vendor.pagination.bootstrap-4') }}
    </div>
  </div>

<div class="modal fade" id="memberModifyList" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-edit-user">
    <div class="modal-content">
      <div class="modal-body">
        <div class="text-center mb-6">
          <h4 class="mb-2">변경 내역</h4>
        </div>
        <div class="col-12">
          <div class="row mb-3">
            <div class="col-sm-12">
              <div class="card">
                <table class="table">
                  <thead>
                  <tr class="text-nowrap">
                    <th>ID</th>
                    <td><span id='member_info_id'></span></td>
                    <th>이름</th>
                    <td><span id='member_info_name'></span></td>
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
                      <th>일자</th>
                      <th>변경 필드</th>
                      <th>변경전</th>
                      <th>변경후</th>
                      <th>수정자</th>
                    </tr>
                    </thead>
                    <tbody class="member_info_body">

                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Responsive Table -->
            </div>
          </div>
        </div>
        <div class="col-12 text-center">
          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" style='border:1px solid #eee;' aria-label="Close">확인</button>
        </div>
      </div>
    </div>
  </div>
</div>
  <!--/ Basic Bootstrap Table -->
@endsection


@section('page-script')
  <script>
    $(".memberModifyList").on("click",function(){
      const seq = $(this).data("seq");

      $(".point_info_body").empty();

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        type: 'post',
        dataType:'JSON',
        url: "/management/erp/member/modifyList",
        data: {
          "seq": seq,
        },
        success: function (res) {
          let rows = '';
          $("#member_info_id").text(res.member_info.member_id);
          $("#member_info_name").text(res.member_info.name);

          if (!res.modify_info.length) {
            rows = '<tr><td colspan="5" style="text-align: center">변경 내역이 없습니다.</td></tr>';
          } else {
            res.modify_info.forEach(log => {
              rows += `
                    <tr>
                        <td>${new Date(log.created_at).toLocaleDateString()}</td>
                        <td>${log.field_name}</td>
                        <td>${log.old_value}</td>
                        <td>${log.new_value}</td>
                        <td>${log.member_id || 'System'}</td>
                    </tr>
                `;
            });
          }

          $(".member_info_body").html(rows);
        },
        error: function() {
          $(".member_info_body").html('<tr><td colspan="5">Failed to load modification history.</td></tr>');
        }
      });

    });
  </script>
@endsection
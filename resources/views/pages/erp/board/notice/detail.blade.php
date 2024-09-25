@extends('layouts/contentNavbarLayout')

@section('title', 'Notice - Detail')

@section('content')
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">공지사항 상세</h5>
                    <a href="{{ route('erp-board.notice.list') }}" class="btn btn-secondary">목록으로 돌아가기</a>
                </div>
                <div class="card-body">
                    <!-- Notice Title -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">제목:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $notice->title }}</p>
                        </div>
                    </div>

                    <!-- Notice Author -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">작성자:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $notice->author_name }}</p>
                        </div>
                    </div>

                    <!-- Notice Content -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">내용:</label>
                        <div class="col-sm-10">
                            <div class="form-control-plaintext">
                                {!! $notice->content !!}
                            </div>
                        </div>
                    </div>

                    <!-- Notice Date -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">등록일:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $notice->created_at->format('Y-m-d') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
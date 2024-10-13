@extends('layouts/contentNavbarLayout')

@section('title', 'banner - Detail')

@section('content')
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">배너 상세</h5>
                    <a href="{{ route('erp-board.banner.list') }}" class="btn btn-secondary">목록으로 돌아가기</a>
                </div>
                <div class="card-body">
                    <!-- banner Title -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">제목:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $banner->title }}</p>
                        </div>
                    </div>
                    <!-- banner category -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">간략설명:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $banner->sub_title }}</p>
                        </div>
                    </div>
                    <!-- banner category -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">링크:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $banner->link }}</p>
                        </div>
                    </div>
                    <!-- banner category -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">타입:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $banner->type }}</p>
                        </div>
                    </div>
                    <!-- banner Author -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">작성자:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $banner->author_name }}</p>
                        </div>
                    </div>

                       <!-- banner thumbnail -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">이미지 / 비디오 : </label>
                        <div class="col-sm-10">
                            <div class="form-control-plaintext">
                                <td><img style='width:80px;' src="{{ asset($banner->thumbnail) }}" alt="상품이미지" onerror="this.src='{{ asset('storage/data/noimg.jpg') }}'"  ></td>
                            </div>
                        </div>
                    </div>
                    <!-- banner Author -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">노출여부:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $banner->is_active }}</p>
                        </div>
                    </div>
                    <!-- banner Date -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">등록일:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $banner->created_at->format('Y-m-d') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
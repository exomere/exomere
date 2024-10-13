@extends('layouts/contentNavbarLayout')

@section('title', 'video - Detail')

@section('content')
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">브랜드영상 상세</h5>
                    <a href="{{ route('erp-board.video.list') }}" class="btn btn-secondary">목록으로 돌아가기</a>
                </div>
                <div class="card-body">
                    <!-- video Title -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">제목:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $video->title }}</p>
                        </div>
                    </div>
                    <!-- video category -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">카테고리:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $video->category }}</p>
                        </div>
                    </div>
                    <!-- video Author -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">작성자:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $video->author_name }}</p>
                        </div>
                    </div>

                    <!-- video Content -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">내용:</label>
                        <div class="col-sm-10">
                            <div class="form-control-plaintext">
                                {!! $video->contents !!}
                            </div>
                        </div>
                    </div>

                       <!-- video thumbnail -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">썸네일 : </label>
                        <div class="col-sm-10">
                            <div class="form-control-plaintext">
                                <td><img style='width:80px;' src="{{ asset('storage/data/board/'.$video->thumbnail) }}" alt="썸네일" onerror="this.src='{{ asset('storage/data/noimg.jpg') }}'"  ></td>
                            </div>
                        </div>
                    </div>

                      <!-- video  -->
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">비디오 : </label>
                        <div class="col-sm-10">
                            <div class="form-control-plaintext">
                                <td><img style='width:80px;' src="{{ asset('storage/data/board/video'.$video->video) }}" alt="비디오" onerror="this.src='{{ asset('storage/data/noimg.jpg') }}'"  ></td>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">노출여부:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $video->is_active }}</p>
                        </div>
                    </div>
                    <!-- video Date -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">등록일:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $video->created_at->format('Y-m-d') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
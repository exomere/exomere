@extends('layouts/contentNavbarLayout')

@section('title', 'banner - Edit')

@section('content')
    <!-- Basic Layout -->
    <div class="row">
        <form id="bannerForm" method="post" action="{{ route('erp-board.banner.update', $banner->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use PATCH for updates -->

            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">배너 수정</h5>
                        <small class="text-muted float-end">
                            <button type="submit" class="btn btn-primary">저장</button>
                        </small>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="title">
                                <span style="color:red;">*</span> 제목
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name='title' value="{{ old('title', $banner->title) }}"/>
                                <div id="titleError" class="text-danger" style="display: none;">제목은 필수입니다.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="category">
                                <span style='color:red;'>*</span> 타입
                            </label>
                            <div class="col-sm-1">
                                <select class="form-control" name="type">
                                    <option value="image" @isset($banner->type) @if($banner->type == 'image') selected @endif @endisset>이미지</option>
                                    <option value="video" @isset($banner->type) @if($banner->type == 'video') selected @endif @endisset>비디오</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="sub_title">
                                <span style="color:red;">*</span> 간략설명
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="sub_title" name='sub_title' value="{{ old('sub_title', $banner->sub_title) }}"/>
                                <div id="sub_titleError" class="text-danger" style="display: none;">제목은 필수입니다.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="link">
                                <span style="color:red;">*</span> 링크
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="link" name='link' value="{{ old('link', $banner->link) }}"/>
                                <div id="titleError" class="text-danger" style="display: none;">제목은 필수입니다.</div>
                            </div>
                        </div>
                      
                      
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="contents">
                                썸네일
                            </label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                                    <label class="input-group-text" for="thumbnail" name="thumbnail">Upload</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">현재 등록 이미지 / 비디오 :</label>
                            <div class="col-sm-10">
                                <div class="form-control-plaintext">
                                    <td>{{ $banner->thumbnail }}</td>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-1 col-form-label">노출여부</label>
                            <div class="col-sm-5">
                                <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="is_active" id="is_active1" value='Y' @isset($banner->is_active) @if($banner->is_active == 'Y') checked @endif @endisset>
                                <label class="btn btn-outline-primary" for="is_active1">노출</label>
                                <input type="radio" class="btn-check" name="is_active" id="is_active2" value='N' @isset($banner->is_active) @if($banner->is_active == 'N') checked @endif @endisset>
                                <label class="btn btn-outline-primary" for="is_active2">미노출</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
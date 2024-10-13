@extends('layouts/contentNavbarLayout')

@section('title', 'news - Edit')

@section('content')
    <!-- Basic Layout -->
    <div class="row">
        <form id="newsForm" method="post" action="{{ route('erp-board.news.update', $news->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use PATCH for updates -->

            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">언론보도 수정</h5>
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
                                <input type="text" class="form-control" id="title" name='title' value="{{ old('title', $news->title) }}"/>
                                <div id="titleError" class="text-danger" style="display: none;">제목은 필수입니다.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="category">
                                <span style='color:red;'>*</span> 카테고리
                            </label>
                            <div class="col-sm-1">
                                <select class="form-control" name="category">
                                    <option value="social"  @isset($video->category) @if($video->category == 'social') selected @endif @endisset >소셜</option>
                                    <option value="rnd"  @isset($video->category) @if($video->category == 'rnd') selected @endif @endisset >R&D</option>
                                    <option value="company"  @isset($video->category) @if($video->category == 'company') selected @endif @endisset >회사</option>
                                </select>
                            </div>
                        </div>
                        <!-- Content -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="contents">
                                <span style='color:red;'>*</span> 내용
                            </label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id='contents' name="contents" rows="5">{{ old('contents', $news->contents) }}</textarea>
                                <div id="contentError" class="text-danger" style="display: none;">내용은 필수입니다.</div>
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
                            <label class="col-sm-2 col-form-label">현재 등록 썸네일 :</label>
                            <div class="col-sm-10">
                                <div class="form-control-plaintext">
                                    <td><img style='width:80px;' src="{{ asset($news->thumbnail) }}" alt="상품이미지" onerror="this.src='{{ asset('storage/data/noimg.jpg') }}'"  ></td>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-1 col-form-label">노출여부</label>
                            <div class="col-sm-5">
                                <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="is_active" id="is_active1" value='Y' @isset($news->is_active) @if($news->is_active == 'Y') checked @endif @endisset>
                                <label class="btn btn-outline-primary" for="is_active1">노출</label>
                                <input type="radio" class="btn-check" name="is_active" id="is_active2" value='N' @isset($news->is_active) @if($news->is_active == 'N') checked @endif @endisset>
                                <label class="btn btn-outline-primary" for="is_active2">미노출</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            let editorInstance;

            // Initialize Classic Editor
            ClassicEditor
                .create(document.querySelector('#contents'), {
                    ckfinder: {
                        uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}"
                    }
                })
                .then(editor => {
                    editorInstance = editor;
                })
                .catch(error => {
                    console.error(error);
                });

            $('#newsForm').on('submit', function(event) {
                $('#titleError').hide();
                $('#contentError').hide();

                const title = $('#title').val().trim();
                const content = editorInstance ? editorInstance.getData().trim() : '';

                let isValid = true;

                if (title === '') {
                    $('#titleError').show();
                    isValid = false;
                }

                if (content === '') {
                    $('#contentError').show();
                    isValid = false;
                } else {
                    $('#contents').val(content);
                }

                if (!isValid) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection
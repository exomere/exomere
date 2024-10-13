@extends('layouts/contentNavbarLayout')

@section('title', 'news - Create')

@section('content')
    <!-- Basic Layout -->
    <div class="row">
        <!-- Basic Layout Form -->
        <form id="newsForm" method='post' action="{{ route('erp-board.news.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">언론보도 등록</h5>
                        <small class="text-muted float-end">
                            <button type="submit" class="btn btn-primary">저장</button>
                        </small>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="title">
                                <span style='color:red;'>*</span> 제목
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="title" name='title'/>
                                <div id="titleError" class="text-danger" style="display: none;">제목은 필수입니다.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="category">
                                <span style='color:red;'>*</span> 카테고리
                            </label>
                            <div class="col-sm-1">
                                <select class="form-control" name="category">
                                    <option value="social">소셜</option>
                                    <option value="rnd">R&D</option>
                                    <option value="company">회사</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="contents">
                                <span style='color:red;'>*</span> 내용
                            </label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id='contents' name="contents" rows="5"></textarea>
                                <div id="contentError" class="text-danger" style="display: none;">내용은 필수입니다.</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="content">
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
                            <label class="col-sm-1 col-form-label">노출여부</label>
                            <div class="col-sm-5">
                                <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="is_active" id="is_active1" value='Y'>
                                <label class="btn btn-outline-primary" for="is_active1">노출</label>
                                <input type="radio" class="btn-check" name="is_active" id="is_active2" value='N'>
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
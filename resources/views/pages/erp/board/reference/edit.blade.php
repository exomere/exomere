@extends('layouts/contentNavbarLayout')

@section('title', 'reference - Edit')

@section('content')
    <!-- Basic Layout -->
    <div class="row">
        <form id="referenceForm" method="post" action="{{ route('erp-board.reference.update', $reference->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use PATCH for updates -->

            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">자료실 수정</h5>
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
                                <input type="text" class="form-control" id="title" name='title' value="{{ old('title', $reference->title) }}"/>
                                <div id="titleError" class="text-danger" style="display: none;">제목은 필수입니다.</div>
                            </div>
                        </div>
                     
                        <!-- Content -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="contents">
                                <span style='color:red;'>*</span> 내용
                            </label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id='contents' name="contents" rows="5">{{ old('contents', $reference->contents) }}</textarea>
                                <div id="contentError" class="text-danger" style="display: none;">내용은 필수입니다.</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="file1">
                                file - 1
                            </label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="file" class="form-control" id="file1" name="file1">
                                    <label class="input-group-text" for="file1" name="file1">Upload</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="file2">
                                file - 2
                            </label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="file" class="form-control" id="file2" name="file2">
                                    <label class="input-group-text" for="file2" name="file2">Upload</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="file3">
                                file - 3
                            </label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="file" class="form-control" id="file3" name="file3">
                                    <label class="input-group-text" for="file3" name="file3">Upload</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="file4">
                                file - 4
                            </label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="file" class="form-control" id="file4" name="file4">
                                    <label class="input-group-text" for="file4" name="file4">Upload</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="file5">
                                file - 5
                            </label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="file" class="form-control" id="file5" name="file5">
                                    <label class="input-group-text" for="file5" name="file5">Upload</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">현재 등록된 파일 : </label>
                            @foreach ($reference->attachments as $attachment)
                                <a
                                href="{{ asset('storage/data/board/upload/'.$attachment) }}"
                                download="{{ basename($attachment) }}"
                                class="text-blue-600 hover:underline">{{ basename($attachment) }}</a>
                            @endforeach
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-1 col-form-label">노출여부</label>
                            <div class="col-sm-5">
                                <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="is_active" id="is_active1" value='Y' @isset($reference->is_active) @if($reference->is_active == 'Y') checked @endif @endisset>
                                <label class="btn btn-outline-primary" for="is_active1">노출</label>
                                <input type="radio" class="btn-check" name="is_active" id="is_active2" value='N' @isset($reference->is_active) @if($reference->is_active == 'N') checked @endif @endisset>
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

            $('#referenceForm').on('submit', function(event) {
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
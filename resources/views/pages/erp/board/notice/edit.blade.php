@extends('layouts/contentNavbarLayout')

@section('title', 'Notice - Edit')

@section('content')
    <!-- Basic Layout -->
    <div class="row">
        <form id="noticeForm" method="post" action="{{ route('erp-board.notice.update', $notice->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use PATCH for updates -->

            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">{{__('erp.notice')}} {{__('erp.edit')}}</h5>
                        <small class="text-muted float-end">
                            <button type="submit" class="btn btn-primary">{{__('erp.save')}}</button>
                        </small>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="title">
                                <span style="color:red;">*</span> {{__('erp.title')}}
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name='title' value="{{ old('title', $notice->title) }}"/>
                                <div id="titleError" class="text-danger" style="display: none;">{{__('erp.title_required')}}</div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="content">
                                <span style='color:red;'>*</span> {{__('erp.content')}}
                            </label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id='content' name="content" rows="5">{{ old('content', $notice->content) }}</textarea>
                                <div id="contentError" class="text-danger" style="display: none;">{{__('erp.content_required')}}</div>
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
                .create(document.querySelector('#content'), {
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

            $('#noticeForm').on('submit', function(event) {
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
                    $('#content').val(content);
                }

                if (!isValid) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection
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
                        <h5 class="mb-0">{{__('erp.news')}} {{__('erp.register')}}</h5>
                        <small class="text-muted float-end">
                            <button type="submit" class="btn btn-primary">{{__('erp.save')}}</button>
                        </small>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="title">
                                <span style='color:red;'>*</span> {{__('erp.title')}}
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="title" name='title'/>
                                <div id="titleError" class="text-danger" style="display: none;">{{__('erp.title_required')}}</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="category">
                                <span style='color:red;'>*</span> {{__('erp.category')}}
                            </label>
                            <div class="col-sm-1">
                                <select class="form-control" name="category">
                                    <option value="social">{{__('erp.social')}}</option>
                                    <option value="rnd">{{__('erp.rnd')}}</option>
                                    <option value="company">{{__('erp.company')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="contents">
                                <span style='color:red;'>*</span> {{__('erp.content')}}
                            </label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id='contents' name="contents" rows="5"></textarea>
                                <div id="contentError" class="text-danger" style="display: none;">{{__('erp.content_required')}}</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="content">
                                {{__('erp.thumbnail')}}
                            </label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                                    <label class="input-group-text" for="thumbnail" name="thumbnail">Upload</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{__('erp.exposed_status')}}</label>
                            <div class="col-sm-5">
                                <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="is_active" id="is_active1" value='Y'>
                                <label class="btn btn-outline-primary" for="is_active1">{{__('erp.exposed')}}</label>
                                <input type="radio" class="btn-check" name="is_active" id="is_active2" value='N'>
                                <label class="btn btn-outline-primary" for="is_active2">{{__('erp.not_exposed')}}</label>
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
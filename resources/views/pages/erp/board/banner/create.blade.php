@extends('layouts/contentNavbarLayout')

@section('title', 'banner - Create')

@section('content')
    <!-- Basic Layout -->
    <div class="row">
        <!-- Basic Layout Form -->
        <form id="bannerForm" method='post' action="{{ route('erp-board.banner.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">{{__('erp.banner')}} {{__('erp.register')}}</h5>
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
                            <label class="col-sm-2 col-form-label" for="type">
                                <span style='color:red;'>*</span> {{__('erp.type')}}
                            </label>
                            <div class="col-sm-1">
                                <select class="form-control" name="type">
                                    <option value="image">{{__('erp.image')}}</option>
                                    <option value="veido">{{__('erp.video')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="sub_title">
                                <span style='color:red;'>*</span> {{__('erp.brief_description')}}
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="sub_title" name='sub_title'/>
                                <div id="sub_titleError" class="text-danger" style="display: none;">{{__('erp.brief_description_required')}}</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="link">
                                <span style='color:red;'>*</span> {{__('erp.link')}}
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="link" name='link'/>
                                <div id="linkError" class="text-danger" style="display: none;">{{__('erp.link_required')}}</div>
                            </div>
                        </div>
   
                       
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="content">
                                {{__('erp.image')}} / {{__('erp.video')}}
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

 
@endsection
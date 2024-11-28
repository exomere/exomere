@extends('layouts/contentNavbarLayout')

@section('title', 'banner - Detail')

@section('content')
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">{{__('erp.banner')}} {{__('erp.details')}}</h5>
                    <a href="{{ route('erp-board.banner.list') }}" class="btn btn-secondary">{{__('erp.return_to_list')}}</a>
                </div>
                <div class="card-body">
                    <!-- banner Title -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.title')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $banner->title }}</p>
                        </div>
                    </div>
                    <!-- banner category -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.brief_description')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $banner->sub_title }}</p>
                        </div>
                    </div>
                    <!-- banner category -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.link')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $banner->link }}</p>
                        </div>
                    </div>
                    <!-- banner category -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.type')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $banner->type }}</p>
                        </div>
                    </div>
                    <!-- banner Author -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.author')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $banner->author_name }}</p>
                        </div>
                    </div>

                       <!-- banner thumbnail -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.image')}} / {{__('erp.video')}} : </label>
                        <div class="col-sm-10">
                      {{ asset($banner->thumbnail) }}
                        </div>
                    </div>
                    <!-- banner Author -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.exposed_status')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $banner->is_active }}</p>
                        </div>
                    </div>
                    <!-- banner Date -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.created_date')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $banner->created_at->format('Y-m-d') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
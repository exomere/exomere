@extends('layouts/contentNavbarLayout')

@section('title', 'video - Detail')

@section('content')
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">{{__('erp.brand_video')}} {{__('erp.details')}}</h5>
                    <a href="{{ route('erp-board.video.list') }}" class="btn btn-secondary">{{__('erp.return_to_list')}}</a>
                </div>
                <div class="card-body">
                    <!-- video Title -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.title')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $video->title }}</p>
                        </div>
                    </div>
                    <!-- video category -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.category')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $video->category }}</p>
                        </div>
                    </div>
                    <!-- video Author -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.author')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $video->author_name }}</p>
                        </div>
                    </div>

                    <!-- video Content -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.content')}}:</label>
                        <div class="col-sm-10">
                            <div class="form-control-plaintext">
                                {!! $video->contents !!}
                            </div>
                        </div>
                    </div>

                       <!-- video thumbnail -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.thumbnail')}} : </label>
                        <div class="col-sm-10">
                            <div class="form-control-plaintext">
                                <td><img style='width:80px;' src="{{ asset($video->thumbnail) }}" alt="{{__('erp.thumbnail')}}" onerror="this.src='{{ asset('storage/data/noimg.jpg') }}'"  ></td>
                            </div>
                        </div>
                    </div>

                      <!-- video  -->
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.video')}} code : </label>
                        <div class="col-sm-10">
                            <div class="form-control-plaintext">
                                {{-- <td><img style='width:80px;' src="{{ asset($video->video) }}" alt="{{__('erp.video')}}" onerror="this.src='{{ asset('storage/data/noimg.jpg') }}'"  ></td> --}}
                                {{ $video->video ?? ''}}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.exposed_status')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $video->is_active }}</p>
                        </div>
                    </div>
                    <!-- video Date -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.created_date')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $video->created_at->format('Y-m-d') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
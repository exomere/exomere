@extends('layouts/contentNavbarLayout')

@section('title', 'news - Detail')

@section('content')
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">{{__('erp.news')}} {{__('erp.details')}}</h5>
                    <a href="{{ route('erp-board.news.list') }}" class="btn btn-secondary">{{__('erp.return_to_list')}}</a>
                </div>
                <div class="card-body">
                    <!-- news Title -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.title')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $news->title }}</p>
                        </div>
                    </div>
                    <!-- news category -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.category')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $news->category }}</p>
                        </div>
                    </div>
                    <!-- news Author -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.author')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $news->author_name }}</p>
                        </div>
                    </div>

                    <!-- news Content -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.content')}}:</label>
                        <div class="col-sm-10">
                            <div class="form-control-plaintext">
                                {!! $news->contents !!}
                            </div>
                        </div>
                    </div>

                       <!-- news thumbnail -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.thumbnail')}} : </label>
                        <div class="col-sm-10">
                            <div class="form-control-plaintext">
                                <td><img style='width:80px;' src="{{ asset($news->thumbnail) }}" alt="상품이미지" onerror="this.src='{{ asset('storage/data/noimg.jpg') }}'"  ></td>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.exposed_status')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $news->is_active }}</p>
                        </div>
                    </div>
                    <!-- news Date -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.created_date')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $news->created_at->format('Y-m-d') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
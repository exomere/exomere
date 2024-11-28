@extends('layouts/contentNavbarLayout')

@section('title', 'reference - Detail')

@section('content')
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">{{__('erp.data_room')}} {{__('erp.edit')}}</h5>
                    <a href="{{ route('erp-board.reference.list') }}" class="btn btn-secondary">{{__('erp.return_to_list')}}</a>
                </div>
                <div class="card-body">
                    <!-- reference Title -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.title')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $reference->title }}</p>
                        </div>
                    </div>
                    <!-- reference Author -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.author')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $reference->author_name }}</p>
                        </div>
                    </div>

                    <!-- reference Content -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.content')}}:</label>
                        <div class="col-sm-10">
                            <div class="form-control-plaintext">
                                {!! $reference->contents !!}
                            </div>
                        </div>
                    </div>
   
                    @foreach ($reference->attachments as $attachment)
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">file:</label>
                            <div class="col-sm-10">
                                <a
                                href="{{ asset($attachment) }}"
                                download="{{ basename($attachment) }}"
                                class="text-blue-600 hover:underline">{{ basename($attachment) }}</a>
                            </div>
                        </div>
                    @endforeach
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.exposed_status')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $reference->is_active }}</p>
                        </div>
                    </div>
                    <!-- reference Date -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.created_date')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $reference->created_at->format('Y-m-d') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
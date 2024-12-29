@extends('layouts/contentNavbarLayout')

@section('title', 'Review - Detail')

@section('content')
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">{{__('erp.review')}} {{__('erp.details')}}</h5>
                    <a href="{{ route('erp-board.review.list') }}" class="btn btn-secondary">{{__('erp.return_to_list')}}</a>
                </div>
                <div class="card-body">
                    <!-- Inquiry Title -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.title')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $item->title }}</p>
                        </div>
                    </div>

                    <!-- Inquiry Author -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.author')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $item->author_name }}</p>
                        </div>
                    </div>

                    <!-- Inquiry Content -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.content')}}:</label>
                        <div class="col-sm-10">
                            <div class="form-control-plaintext">
                                {!! $item->content !!}
                            </div>
                        </div>
                    </div>

                    <!-- Inquiry Date -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{__('erp.created_date')}}:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $item->created_at->format('Y-m-d') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">{{__('erp.answer')}}</h5>
                </div>
                <div class="card-body">
                    <!-- Display existing comments -->
                    @if ($item->comments->isEmpty())
                        <p>{{__('erp.no_response_yet')}}</p>
                    @else
                        @foreach ($item->comments as $comment)
                            <div class="mb-3">
                                <strong>{{ $comment->author_name }}</strong> <span class="text-muted">({{ $comment->created_at->format('Y-m-d H:i') }})</span>
                                <p>{{ $comment->content }}</p>
                            </div>
                            <hr>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Comment Form -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">{{__('erp.write_response')}}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('erp-board.review.comment.store', $item->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="content" class="form-label">{{__('erp.content')}}</label>
                            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">{{__('erp.register')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
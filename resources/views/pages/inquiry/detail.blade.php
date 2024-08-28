@extends('layouts/contentNavbarLayout')

@section('title', 'Inquiry - Detail')

@section('content')
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">1:1 문의 상세</h5>
                    <a href="{{ route('inquiry.list') }}" class="btn btn-secondary">목록으로 돌아가기</a>
                </div>
                <div class="card-body">
                    <!-- Inquiry Title -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">제목:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $inquiry->title }}</p>
                        </div>
                    </div>

                    <!-- Inquiry Author -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">작성자:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $inquiry->author_name }}</p>
                        </div>
                    </div>

                    <!-- Inquiry Content -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">내용:</label>
                        <div class="col-sm-10">
                            <div class="form-control-plaintext">
                                {!! $inquiry->content !!}
                            </div>
                        </div>
                    </div>

                    <!-- Inquiry Date -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">등록일:</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $inquiry->created_at->format('Y-m-d') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">답변</h5>
                </div>
                <div class="card-body">
                    <!-- Display existing comments -->
                    @if ($inquiry->comments->isEmpty())
                        <p>아직 답변이 없습니다.</p>
                    @else
                        @foreach ($inquiry->comments as $comment)
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
                    <h5 class="mb-0">답변 작성</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('inquiry.comment.store', $inquiry->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="content" class="form-label">내용</label>
                            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">작성</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
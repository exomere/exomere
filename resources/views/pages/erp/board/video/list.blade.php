@extends('layouts/contentNavbarLayout')

@section('title', 'video - list')

@section('content')
    <!-- Display success message if available -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">브랜드영상</h5>
            <small class="text-muted float-end">
                <button onclick="location.href='{{ route('erp-board.video.create') }}'" class="btn btn-primary">브랜드영상 등록</button>
            </small>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr style='vertical-align: middle;'>
                    <th class="w-10">No</th>
                    <th class="w-50">제목</th>
                    <th class="w-20">노출여부</th>
                    <th class="w-20">작성자</th>
                    <th class="w-20">작성일</th>
                    <th class="w-10">관리</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @php
                    $row_num = $row_num ?? $videos->total();
                @endphp
                @foreach ($videos as $video)
                    <tr class="align-middle py-2">
                        <td><span class="fw-medium">{{ $row_num-- }}</span></td>
                        <td>
                            <a class="dropdown-item" href="{{ route('erp-board.video.detail', $video->id) }}">
                                <span class="fw-medium">{{ $video->title }}</span>
                            </a>
                        </td>
                        <td><span class="fw-medium">{{ $video->is_active }}</span></td>
                        <td><span class="fw-medium">{{ $video->author_name }}</span></td>
                        <td><span class="fw-medium">{{ $video->created_at->format('Y-m-d') }}</span></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('video.edit', $video->id) }}">
                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('erp-board.video.delete', $video->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item" style='color:red;'>
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination Links -->
        <div class="card-footer d-flex justify-content-end">
            {{ $videos->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
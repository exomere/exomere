@extends('layouts/contentNavbarLayout')

@section('title', 'Inquiry - list')

@section('content')
    <!-- Display success message if available -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">1:1 문의</h5>
            <small class="text-muted float-end">
                {{-- <button onclick="location.href='{{ route('erp-board.inquiry.create') }}'" class="btn btn-primary">문의등록</button> --}}
            </small>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr style='vertical-align: middle;'>
                    <th class="w-10">No</th>
                    <th class="w-50">제목</th>
                    <th class="w-10">작성자</th>
                    <th class="w-10">상태</th>
                    <th class="w-10">작성일</th>
                    <th class="w-10">관리</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @php
                    $row_num = $row_num ?? $inquires->total();
                @endphp
                @foreach ($inquires as $inquire)
                    <tr class="align-middle py-2">
                        <td><span class="fw-medium">{{ $row_num-- }}</span></td>
                        <td>
                            <a class="dropdown-item" href="{{ route('inquiry.detail', $inquire->id) }}">
                                <span class="fw-medium">{{ $inquire->title }}</span>
                            </a>
                        </td>
                        <td><span class="fw-medium">{{ $inquire->author_name }}</span></td>
                        <td>{!! $inquire->status == "pending" ? "<span class='badge bg-label-danger me-4'>답변대기</span>" : "<span class='badge bg-label-info me-4'>답변완료</span>" !!}</td>
                        <td><span class="fw-medium">{{ $inquire->created_at->format('Y-m-d') }}</span></td>
                        <td>
                            @if($inquire->status == "pending")
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('inquiry.edit', $inquire->id) }}">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('inquiry.delete', $inquire->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item" style='color:red;'>
                                                <i class="bx bx-trash me-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination Links -->
        <div class="card-footer d-flex justify-content-end">
            {{ $inquires->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
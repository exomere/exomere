@extends('layouts/contentNavbarLayout')

@section('title', 'review - list')

@section('content')
    <!--  Add bootstrap icon Library  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .checked {
            color : rgb(253 224 71 / var(--tw-text-opacity, 1));
            font-size : 20px;
        }
        .unchecked {
            font-size : 20px;
        }
    </style>

    <!-- Display success message if available -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:void(0)"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    </li>
                    <li class="nav-item">
                    </li>

                    <li class="nav-item">
                    </li>
                </ul>
                <form class="d-flex" action="{{ route('erp-board.review.list') }}" method="GET">
                    <input class="form-control me-2" style='width:240px;' name="search_text" type="search" placeholder="Search" aria-label="Search" value="{{ request('search_text') }}">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">{{ __('erp.integrated').__('erp.review') }}</h5>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr style="vertical-align: middle;">
                    <th class="w-10">No</th>
                    <th class="w-10">{{ __('erp.product_information') }}</th>
                    <th class="w-10">{{ __('erp.category') }}</th>
                    <th class="w-25">{{ __('erp.title') }}</th>
                    <th class="w-10">{{ __('erp.author') }}</th>
                    <th class="w-10">{{ __('erp.recommendation') }}</th>
                    <th class="w-10">{{ __('erp.star_point') }}</th>
                    <th class="w-10">{{ __('erp.created_date') }}</th>
                    <th class="w-10">{{ __('erp.management') }}</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @php
                    $row_num = $row_num ?? $lists->total();
                @endphp
                @foreach ($lists as $list)
                    <tr class="align-middle py-2">
                        <td><span class="fw-medium">{{ $row_num-- }}</span></td>
                        <td>{{ app()->getLocale() == 'ko' ? $list->item->name : $list->item->name_en }}</td>
                        <td>{{ $list->item->code }}</td>
                        <td>{{ $list->title }}</td>
                        <td>{{ $list->author_name }}</td>
                        <td>{{ $list->likes_count }}</td>
                        <td>
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $list->rating)
                                    <!-- 채워진 별 -->
                                    <span class = "fa fa-star checked"></span>
                                @else
                                    <!-- 빈 별 -->
                                    <span class = "fa fa-star unchecked"></span>
                                @endif
                            @endfor
                        </td>
                        <td>{{ substr($list->created_at, 0, 10) }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('erp-board.review.detail', $list->id) }}">
                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                    </a>
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
            {{ $lists->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection

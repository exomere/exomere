@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 col-lg-4 order-2 mb-2">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">Fee details</h5>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
              <a class="dropdown-item" href="javascript:void(0);">이번달</a>
              <a class="dropdown-item" href="javascript:void(0);">3개월</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <ul class="p-0 m-0">

            <li class="d-flex mb-2 pb-1" style='border-bottom:1px solid #eee;'>
              {{-- <div class="avatar flex-shrink-0 me-3">
                <img src="{{asset('assets/img/icons/unicons/chart.png')}}" alt="User" class="rounded">
              </div> --}}
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <h6 class="mb-0">{{__('erp.recruitment_congratulatory_money')}}</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-1">
                  <h6 class="mb-0">0</h6> <span class="text-muted">원</span>
                </div>
              </div>
            </li>
            <li class="d-flex mb-2 pb-1" style='border-bottom:1px solid #eee;'>
              {{-- <div class="avatar flex-shrink-0 me-3">
                <img src="{{asset('assets/img/icons/unicons/cc-success.png')}}" alt="User" class="rounded">
              </div> --}}
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <h6 class="mb-0">{{__('erp.settlement_subsidy_money')}}</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-1">
                  <h6 class="mb-0">0</h6> <span class="text-muted">원</span>
                </div>
              </div>
            </li>
            <li class="d-flex mb-2 pb-1" style='border-bottom:1px solid #eee;'>
              {{-- <div class="avatar flex-shrink-0 me-3">
                <img src="{{asset('assets/img/icons/unicons/wallet.png')}}" alt="User" class="rounded">
              </div> --}}
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <h6 class="mb-0">{{__('erp.direct_recruitment_fee')}}</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-1">
                  <h6 class="mb-0">0</h6> <span class="text-muted">원</span>
                </div>
              </div>
            </li>
            <li class="d-flex mb-2 pb-1" style='border-bottom:1px solid #eee;'>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <h6 class="mb-0">{{__('erp.incentive_money')}}</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-1">
                  <h6 class="mb-0">0</h6> <span class="text-muted">원</span>
                </div>
              </div>
            </li>
            <li class="d-flex mb-2 pb-1" style='border-bottom:1px solid #eee;'>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <h6 class="mb-0">{{__('erp.excellent_exclusive_distributor_contribution')}}</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-1">
                  <h6 class="mb-0">0</h6> <span class="text-muted">원</span>
                </div>
              </div>
            </li>
            <li class="d-flex mb-2 pb-1" style='border-bottom:1px solid #eee;'>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <h6 class="mb-0">{{__('erp.incentive')}}</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-1">
                  <h6 class="mb-0">0</h6> <span class="text-muted">원</span>
                </div>
              </div>
            </li>
            <li class="d-flex mb-2 pb-1" style='border-bottom:1px solid #eee;'>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <h6 class="mb-0">{{__('erp.recruitment_congratulatory_money')}}</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-1">
                  <h6 class="mb-0">0</h6> <span class="text-muted">원</span>
                </div>
              </div>
            </li>
            <li class="d-flex">
              {{-- <div class="avatar flex-shrink-0 me-3">
                <img src="{{asset('assets/img/icons/unicons/cc-warning.png')}}" alt="User" class="rounded">
              </div> --}}
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <h6 class="mb-0">{{__('erp.actual_payment_amount')}}</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-1">
                  <h6 class="mb-0">0</h6> <span class="text-muted">원</span>
                </div>
              </div>
            </li>
            
          </ul>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-2">
      <div class="card">
        <div class="row row-bordered g-0">
          <div class="col-md-8">
            <h5 class="card-header m-0 me-2 pb-3">Month Fee</h5>
            <div id="totalRevenueChart" class="px-2"></div>
          </div>
          <div class="col-md-4">
            <div class="card-body">
              <div class="text-center">
                
              </div>
            </div>
            <div id="growthChart"></div>
            <div class="text-center fw-medium pt-3 mb-2">Year Total</div>
  
            <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
              <div class="d-flex">
                <div class="me-2">
                  <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                </div>
                <div class="d-flex flex-column">
                  <small>2024</small>
                  <h6 class="mb-0">0</h6>
                </div>
              </div>
              <div class="d-flex">
                <div class="me-2">
                  <span class="badge bg-label-info p-2"><i class="bx bx-dollar text-info"></i></span>
                </div>
                <div class="d-flex flex-column">
                  <small>2025</small>
                  <h6 class="mb-0">0</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

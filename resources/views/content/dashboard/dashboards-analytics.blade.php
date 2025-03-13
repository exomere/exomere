
@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/swiper/swiper.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>

    <script>
        // JSON 데이터
        const data = @json($json_chart_data);
        
        const jsonData = JSON.parse(data);
   
        // fc
        const fcData = jsonData.fc_data;
        const createBarChart = (id, opt) => {
            var options = {
                chart: {
                    type: 'bar',
                    height: 240,
                    stacked: true,

                },
                series: opt.series,
                xaxis: {
                    categories: opt.category
                },
                legend: {
                    position: 'bottom'
                }
            };

            console.log(options);

            var chart = new ApexCharts(document.querySelector(id), options);
            chart.render();
        };

        let opt = {
            category: fcData.category,
            series: [
                   
                {
                    name: "이번년도",
                    data: fcData.beauty.map(item => item.year)
                },
                {
                    name: "당월",
                    data: fcData.beauty.map(item => item.month)
                }
            ]
        };

        let opt2 = {
            category: ["대리점", "뷰티"],
            series: [
                {
                    name: "당월(신규)",
                    data: fcData.beauty.map(item => item.new_members)
                },
                {
                    name: "합계",
                    data: fcData.beauty.map(item => item.total_members)
                }
            ]
        }

        // Initialize charts for Group 1
        createBarChart('#bar-chart-group1-new', opt);
        // Initialize charts for Group 2
        createBarChart('#bar-chart-group2-new', opt2);

        // Tab switching functionality
        const tabs2 = document.querySelectorAll('.tab2');
        const contents2 = document.querySelectorAll('.tab-content2');

        tabs2.forEach(tab => {
            tab.addEventListener('click', () => {
                const target = tab.getAttribute('data-tab');

                // Remove active class from all tabs and contents
                tabs2.forEach(t => t.classList.remove('active'));
                contents2.forEach(c => c.classList.remove('active'));

                // Add active class to clicked tab and corresponding content
                tab.classList.add('active');
                document.getElementById(target).classList.add('active');
            });
        });


        // 실적
        const performData = jsonData.perform;

        const createDonutChart = (id, newCnt, repurchase) => {
            var options = {
                chart: {
                    height: 290,
                    type: 'donut'
                },
                series: [newCnt, repurchase],
                labels: ['신규실적', '재구매 실적'],
                colors: ['#00E396', '#FEB019'],
                legend: {
                    position: 'bottom'
                }
            };

            var chart = new ApexCharts(document.querySelector(id), options);
            chart.render();
        };

        // Initialize charts for Group 1
        createDonutChart('#donut-chart-group1-new', performData.business.new, performData.business.repurchase);
        // Initialize charts for Group 2
        createDonutChart('#donut-chart-group2-new', performData.beauty.new, performData.beauty.repurchase);

        // Tab switching functionality
        const tabs = document.querySelectorAll('.tab');
        const contents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const target = tab.getAttribute('data-tab');
                console.log(target);

                // Remove active class from all tabs and contents
                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));

                // Add active class to clicked tab and corresponding content
                tab.classList.add('active');
                document.getElementById(target).classList.add('active');
            });
        });

    </script>
@endsection

@section('content')
    <style>
        .tab-content, .tab-content2 {
            display: none;
        }

        .tab-content.active, .tab-content2.active {
            display: block;
            margin-top: 20px;
        }
    </style>

    <div class="row">
        <div class="col-12 col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title d-flex align-items-center justify-content-between">
                        <div class="d-flex">
                            <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary">
                                             <i class='bx bxs-user-account'></i>
                                        </span>
                            </div>
                            <h5 class="card-title card-title-elements mb-0 text-nowrap">
                                회원 현황
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-title d-flex align-items-start justify-content-between">
                            </div>
                            <div class="d-flex flex-column justify-content-between">
                                <div class="row">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <h5 class="text-primary">
                                            직책별 총원
                                        </h5>
                                    </div>
                                    <div>
                                        @foreach ($chart_data['fc_data']['business'] as $fc)
                                            <div class="d-flex justify-content-between mb-4 pb-1">
                                                <h6 class="card-title text-nowrap mb-1"><i
                                                        class='bx bx-check'></i> {{ $fc['name'] }}</h6>
                                                <small
                                                    class="fw-medium">
                                                    <i class='bx'></i>
                                                    {{-- 매출 {{ number_format($fc['new_members']) }}원 / --}}
                                                     {{ $fc['total_members'] }}명
                                                </small>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <hr>
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <h5 class="text-primary">
                                        직책별 매출
                                    </h5>
                                </div>
                                <div class="d-flex flex-column justify-content-between">
                                    <div>
                                        <div style="">
                                            @foreach ($chart_data['fc_data']['beauty'] as $fc)
                                                <div class="d-flex justify-content-between mb-4 pb-1">
                                                    <h6 class="card-title text-nowrap mb-1"><i
                                                            class='bx bx-check'></i> {{ $fc['name'] }}</h6>
                                                    <small class="fw-medium">
                                                        (M)  {{ number_format($fc['month']) }}원 <br>
                                                        (Y)  {{ number_format($fc['year'] )}}원 
                                                    </small>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <!-- Content for Group 1 -->
                                    <div id="business_bar" class="tab-content2 active">
                                        <div id="bar-chart-group1-new"></div>
                                    </div>

                                    <!-- Content for Group 2 -->
                                    <div id="beauty_bar" class="tab-content2">
                                        <div id="bar-chart-group2-new"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          
            </div>
        </div>
        <div class="col-lg-8 order-1">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title d-flex align-items-center justify-content-between">
                                <div class="d-flex">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary">
                                            <i class='bx bxs-bar-chart-square'></i>
                                        </span>
                                    </div>
                                    <h5 class="card-title card-title-elements mb-0 text-nowrap">
                                        실적 환황
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-12 col-lg-5">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <h5 class="text-primary">
                                            이번달
                                        </h5>
                                        {{-- <button class="btn p-0" type="button" onclick="alert('준비중')">
                                            <small class="text-muted">더보기 &gt;</small>
                                        </button> --}}
                                    </div>
                                    <div class="d-flex flex-column justify-content-between">
                                        <div class="row">
                                            <div>
                                                <div class="d-flex justify-content-between mb-4 pb-1">
                                                    <h6 class="card-title text-nowrap mb-1"><i
                                                            class='bx bx-check'></i> 신규</h6>
                                                    <small
                                                        class="text-muted fw-medium">
                                                        {{ number_format($new_order_month) }}원
                                                    </small>

                                                </div>
                                                <div class="d-flex justify-content-between mb-4 pb-1">
                                                    <h6 class="card-title text-nowrap mb-1"><i
                                                            class='bx bx-check'></i> 재구매</h6>
                                                    <small
                                                        class="text-muted fw-medium">
                                                        {{ number_format($repurchase_order_month) }}원
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <h5 class="text-primary">
                                                이번년도
                                            </h5>
                                            {{-- <button class="btn p-0" type="button" onclick="alert('준비중')">
                                                <small class="text-muted">더보기 &gt;</small>
                                            </button> --}}
                                        </div>
                                        <div class="d-flex flex-column justify-content-between">
                                            <div class="row">
                                                <div>
                                                    <div class="d-flex justify-content-between mb-4 pb-1">
                                                        <h6 class="card-title text-nowrap mb-1"><i
                                                                class='bx bx-check'></i> 신규</h6>
                                                        <small
                                                            class="text-muted fw-medium">
                                                            {{ number_format($new_order_year) }}원
                                                        </small>

                                                    </div>
                                                    <div class="d-flex justify-content-between mb-4 pb-1">
                                                        <h6 class="card-title text-nowrap mb-1"><i
                                                                class='bx bx-check'></i> 재구매</h6>
                                                        <small
                                                            class="text-muted fw-medium">
                                                            {{ number_format($repurchase_order_year) }}원
                                                        </small>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-7">
                                    <ul class="tabs nav nav-pills nav-justified">
                                        <li class="nav-item">
                                            <button data-tab="business" type="button" class="tab nav-link active">
                                                이번달
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button data-tab="beauty" type="button" class="tab nav-link">이번년도</button>
                                        </li>
                                    </ul>

                                    <!-- Content for Group 1 -->
                                    <div id="business" class="tab-content active">
                                        <div id="donut-chart-group1-new"></div>
                                        <div id="donut-chart-group1-repurchase"></div>
                                    </div>

                                    <!-- Content for Group 2 -->
                                    <div id="beauty" class="tab-content">
                                        <div id="donut-chart-group2-new"></div>
                                        <div id="donut-chart-group2-repurchase"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <div class="card justify-content-center">
                        <div class="row row-bordered g-0">
                            <div class="col-md-8">
                                <div class="card-header">
                                    <div class="d-flex">
                                        <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary">
                                            <i class='bx bx-line-chart'></i>
                                        </span>
                                        </div>
                                        <h5 class="card-title card-title-elements mb-0 text-nowrap">
                                            Month Fee
                                        </h5>
                                    </div>
                                </div>

                                <div id="totalRevenueChart" class="px-2"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-body">
                                    <div class="text-center">
                                    </div>
                                </div>
                                <div id="growthChart"></div>
                                <div class="text-center fw-medium pt-3 mb-2">Year Total</div>

                                <div
                                    class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-around">
                                    <div class="d-flex">
                                        <div class="me-2">
                                <span class="badge bg-label-primary p-2"><i
                                        class="bx bx-dollar text-primary"></i></span>
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
        </div>
    </div>

    {{--    리뷰/ 문의 --}}
    {{-- <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="justify-content-between flex-row gap-3">
                        <div class="card-title">
                            <h5 class="text-nowrap mb-4">Recently Q&A</h5>
                        </div>
                        <div class="mt-sm-auto">
                            <ul class="p-0 m-0">
                                @foreach(['2025.1.5','2025.1.23','2025.1.30'] as $item)
                                    <li class="d-flex mb-4 pb-1 overflow-hidden">
                                        <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                class='bx bx-mobile-alt'></i>
                                        </span>
                                        </div>
                                        <div
                                            class="flex-column w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0">문의합니다 </h6>
                                                <small class="text-muted text-truncate">
                                                        <?php
                                                        echo \Illuminate\Foundation\Inspiring::quote();
                                                        ?>
                                                </small>
                                            </div>
                                            <div class="user-progress">
                                                <small class="fw-medium">2025.3.5</small>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@extends('admin.layouts.app')
@section('title', 'Dashboard')
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css" />
    <style>
        .legend-box {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #00000033;
            margin-right: 4px;
            border-radius: 3px;
        }

        .bg-primary {
            background-color: rgba(54, 162, 235, 0.8);
        }

        .bg-trong {
            background-color: rgba(255, 99, 132, 0.2);
            border: 2px solid rgba(255, 99, 132, 0.8);
        }
    </style>
@endpush
@section('content')
    {{-- <x-admin-layout> --}}
    <main id="content" role="main" class="main pointer-event">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm mb-2 mb-sm-0">
                        <h1 class="page-header-title">Trang thống kê</h1>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->

            <!-- Stats 1 -->
            <div class="row gx-2 gx-lg-3">
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <div class="card text-left card-hover-shadow h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-1">
                                <h2 class="mb-0 mr-2">{{ $totalToaNha }}</h2>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <span class="text-dark">Tòa nhà</span>
                            </div>
                            <div class="d-flex gap-2">
                                <div class="border rounded py-2 text-center flex-fill">
                                    <div class="h5 mb-0">{{ $totalPhongDangThue }}</div>
                                    <small class="text-dark">Phòng đang thuê</small>
                                </div>
                                <div class="border rounded py-2 text-center flex-fill">
                                    <div class="h5 mb-0">{{ $totalPhongConTrong }}</div>
                                    <small class="text-dark">Phòng còn trống</small>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <div class="card text-left card-hover-shadow h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-1">
                                <h2 class="mb-0 mr-2">{{ $totalKhachThue }}</h2>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <span class="text-dark">Khách thuê</span>

                            </div>
                            <div class="d-flex gap-2">
                                <div class="border rounded py-2 text-center flex-fill">
                                    <div class="h5 mb-0">{{ $userActive }}</div>
                                    <small class="text-dark">Tài khoản đang hoạt động</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <div class="card text-left card-hover-shadow h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-1">
                                <h2 class="mb-0 mr-2">{{ $totalHopDong }}</h2>
                                <span class="badge badge-soft-primary">{{ $hopDongMoi }} hợp đồng mới</span>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <span class="text-dark">Hợp đồng</span>
                            </div>
                            <div class="d-flex gap-2">
                                <div class="border rounded py-2 text-center flex-fill">
                                    <div class="h5 mb-0">{{ $hopDongHieuLuc }}</div>
                                    <small class="text-dark">Còn hiệu lực</small>
                                </div>
                                <div class="border rounded py-2 text-center flex-fill">
                                    <div class="h5 mb-0">{{ $hopDongDaThanhLy }}</div>
                                    <small class="text-dark">Đã thanh lý</small>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <div class="card text-left card-hover-shadow h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-1">
                                <h2 class="mb-0 mr-2">{{ $totalHoaDon }}</h2>
                                <span class="badge badge-soft-primary">{{ $hoaDonMoi }} hóa đơn mới</span>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <span class="text-dark">Hóa đơn</span>
                            </div>
                            <div class="d-flex gap-2">
                                <div class="border rounded py-2 text-center flex-fill">
                                    <div class="h5 mb-0">{{ $hoaDonChuaTT }}</div>
                                    <small class="text-dark">Chưa thanh toán</small>
                                </div>
                                <div class="border rounded py-2 text-center flex-fill">
                                    <div class="h5 mb-0">{{ $hoaDonDaTT }}</div>
                                    <small class="text-dark">Đã thanh toán</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End Stats -->

            <!-- thời gian thuê -->
            {{-- <div class="">
                <div class="mb-3">
                    <form method="GET" action="{{ route('admin.thongke.doanh_thu_thang') }}">
                        <div class="row">
                            <div class="col-sm-4 ">
                                <select name="toa_nha" id="toa_nha" class="form-control mr-3">
                                    <option value="">-- Tòa Nhà --</option>
                                    @foreach ($dsToaNha as $tn)
                                    <option value="{{ $tn->ma_toa_nha }}"
                                        {{ request('toa_nha') == $tn->ma_toa_nha ? 'selected' : '' }}>
                                        {{ $tn->ten_toa_nha }}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <select name="nam" id="nam" class="form-control mr-3">
                                    @for ($i = date('Y'); $i >= 2020; $i--)
                                    <option value="{{ $i }}"
                                        {{ request('nam', date('Y')) == $i ? 'selected' : '' }}>
                                        {{ $i }}</option>
                                @endfor
                                </select>
                            </div>

                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary" name ="filter"><i
                                        class="tio-filter-outlined"></i>
                                </button>
                                <a href="{{ route('admin.thongke.doanh_thu_thang') }}" class="btn btn-white"
                                    title="Reset bộ lọc">
                                    <i class="tio-refresh"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mb-3 mb-lg-5">
                <div class="mt-5 card-header">
                    <h5 class="mb-3 card-header-title">
                        Thống kê thời gian thuê
                    </h5>

                </div>
                <div class="card-body text-center">

                    <canvas id="thoiGianThueChart" class="chartjs-custom mx-auto"
                        style="width: 100%; height: 400px;"></canvas>

                </div>


            </div> --}}
            <div class="row">
                <div class="col-md-4">
                    <label for="year">Chọn năm:</label>
                    <input type="number" id="yearInput" value="{{ date('Y') }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="toa_nha">Chọn tòa nhà:</label>
                    <select id="toaNhaSelect" class="form-control">
                        <option value="">Tất cả</option>
                        @foreach ($dsToaNhaCB as $toa)
                            <option value="{{ $toa->ma_toa_nha }}">{{ $toa->ten_toa_nha }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button id="loadChartBtn" class="btn btn-primary"><i class="tio-filter-outlined"></i></button>
                    <a href="{{ route('admin.thongke.index') }}" class="btn btn-white" title="Reset bộ lọc">
                        <i class="tio-refresh"></i>
                    </a>
                </div>
            </div>
            <div class="card mb-3 mb-lg-5">
            </div>
            <div class="card mb-3 mb-lg-5">
                <div class="mt-5 card-header">
                    <h5 class="mb-3 card-header-title">
                        Thống kê thời gian thuê
                    </h5>
                    <div>
                        <div class="d-flex justify-content-center align-items-center mt-3 gap-3">
                            <div class="d-flex align-items-center">
                                <span class="legend-box bg-primary"></span> <span class="ms-1">Đang thuê</span>
                            </div>

                        </div>
                        <div class="d-flex justify-content-center align-items-center mt-3 gap-3">
                            <div class="d-flex align-items-center">
                                <span class="legend-box bg-trong"></span> <span class="ms-1">Còn trống</span>
                            </div>

                        </div>
                    </div>



                </div>
                <div class="card-body text-center">

                    <canvas id="thoiGianThueChart" class="chartjs-custom mx-auto" style="width: 100%;"></canvas>


                </div>


            </div>
            {{-- <canvas id="thoiGianThueChart" class="chartjs-custom mx-auto" style="width: 100%; height: 400px;"></canvas> --}}

            <!-- End thời gian thuê -->
        </div>
        <!-- End Content -->

        <!-- Footer -->

        <div class="footer">
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    <p class="font-size-sm mb-0">&copy; Front. <span class="d-none d-sm-inline-block">2020
                            Htmlstream.</span></p>
                </div>
                <div class="col-auto">
                    <div class="d-flex justify-content-end">
                        <!-- List Dot -->
                        <ul class="list-inline list-separator">
                            <li class="list-inline-item">
                                <a class="list-separator-link" href="#">FAQ</a>
                            </li>

                            <li class="list-inline-item">
                                <a class="list-separator-link" href="#">License</a>
                            </li>

                            <li class="list-inline-item">
                                <!-- Keyboard Shortcuts Toggle -->
                                <div class="hs-unfold">
                                    <a class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                                        href="javascript:;"
                                        data-hs-unfold-options='{
                          "target": "#keyboardShortcutsSidebar",
                          "type": "css-animation",
                          "animationIn": "fadeInRight",
                          "animationOut": "fadeOutRight",
                          "hasOverlay": true,
                          "smartPositionOff": true
                         }'>
                                        <i class="tio-command-key"></i>
                                    </a>
                                </div>
                                <!-- End Keyboard Shortcuts Toggle -->
                            </li>
                        </ul>
                        <!-- End List Dot -->
                    </div>
                </div>
            </div>
        </div>



        <!-- End Footer -->
    </main>
    {{-- </x-admin-layout> --}}
@endsection

{{-- @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const rawData = @json($data);

        const labels = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']; // Tháng 1–12
        const datasets = rawData.map(item => {
            const values = Object.values(item.thoi_gian).map(v => v === 'thue' ? 1 : 0);
            const colors = values.map(v => v ? 'rgba(54,162,235,0.8)' : 'rgba(255,99,132,0.5)');
            return {
                label: item.ten_van_phong,
                data: values,
                backgroundColor: colors,
                borderWidth: 1
            };
        });

        const ctx = document.getElementById('thoiGianThueChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels,
                datasets
            },
            options: {
                responsive: true,
                indexAxis: 'y',
                scales: {
                    x: {
                        stacked: true,
                        ticks: {
                            stepSize: 1,
                            callback: v => v ? 'Thuê' : ''
                        },
                        max: 1
                    },
                    y: {
                        stacked: true
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label(ctx) {
                                const thang = ctx.label;
                                return ctx.dataset.label + ' - Tháng ' + thang + ': ' + (ctx.raw ? 'Đang thuê' :
                                    'Trống');
                            }
                        }
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
@endpush --}}

{{-- @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let chartInstance = null;

        //ổn nhất nè
        document.getElementById('loadChartBtn').addEventListener('click', function() {
            const year = document.getElementById('yearInput').value;
            const toaNha = document.getElementById('toaNhaSelect').value;

            fetch(`/admin/thongke/thoigian?year=${year}&toa_nha=${toaNha}`)
                .then(response => response.json())
                .then(data => {
                    //const ctx = document.getElementById('thoiGianThueChart').getContext('2d');
                    const canvas = document.getElementById('thoiGianThueChart');
                    const ctx = canvas.getContext('2d');

                    if (window.chartInstance) window.chartInstance.destroy();
                    const vpCount = data.length;
                    let canvasHeight = 400;

                    if (vpCount === 1 || vpCount === 2) {
                        canvasHeight = 70;
                    } else if (vpCount >= 3 && vpCount <= 4) {
                        canvasHeight = 150;
                    } else {
                        canvasHeight = vpCount * 30;
                    }

                    canvas.style.height = `${canvasHeight}px`;

                    const monthLabels = Array.from({
                        length: 12
                    }, (_, i) => `Tháng ${i + 1}`);
                    const labels = data.map(item => item.ten_van_phong);

                    const thang = [
                        'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
                        'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                    ];

                    const bgThue = 'rgba(54, 162, 235, 0.8)';
                    const bgTrong = 'rgba(255, 99, 132, 0.2)';

                    const datasets = monthLabels.map((thang, i) => {
                        const thangIndex = i + 1;
                        return {
                            label: thang,
                            data: data.map(vp => vp.thoi_gian[thangIndex] === 'thue' ? 1 : 1),
                            backgroundColor: data.map(vp => vp.thoi_gian[thangIndex] === 'thue' ?
                                bgThue : bgTrong),
                            borderWidth: 1,
                            stack: 'stack1'
                        };
                    });

                    window.chartInstance = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: datasets
                        },
                        options: {
                            indexAxis: 'y',
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                x: {
                                    stacked: true,
                                    min: 0,
                                    max: 12,
                                    ticks: {
                                        stepSize: 1,
                                        callback: function(value) {
                                            if (value >= 1 && value <= 12) {
                                                return `Tháng ${value}`;
                                            }
                                            return '';
                                        },
                                        autoSkip: false,
                                    },

                                    grid: {
                                        display: false
                                    }
                                },
                                y: {
                                    stacked: true,
                                    ticks: {
                                        autoSkip: false
                                    },

                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: ctx => {
                                            const label = ctx.dataset.label;
                                            const status = ctx.raw === 1 ?
                                                ctx.dataset.backgroundColor[ctx.dataIndex] ===
                                                bgThue ?
                                                'Đang thuê' : 'Trống' :
                                                '';
                                            return `${label}: ${status}`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                });
        });
    </script>
@endpush --}}
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let chartInstance = null;

        function loadChart() {
            const year = document.getElementById('yearInput').value;
            const toaNha = document.getElementById('toaNhaSelect').value;

            fetch(`/admin/thongke/thoigian?year=${year}&toa_nha=${toaNha}`)
                .then(response => response.json())
                .then(data => {
                    const canvas = document.getElementById('thoiGianThueChart');
                    const ctx = canvas.getContext('2d');

                    if (window.chartInstance) window.chartInstance.destroy();

                    const vpCount = data.length;
                    let canvasHeight = 400;

                    if (vpCount === 1 || vpCount === 2) {
                        canvasHeight = 70;
                    } else if (vpCount >= 3 && vpCount <= 4) {
                        canvasHeight = 150;
                    } else {
                        canvasHeight = vpCount * 30;
                    }

                    canvas.style.height = `${canvasHeight}px`;

                    const monthLabels = Array.from({
                        length: 12
                    }, (_, i) => `Tháng ${i + 1}`);
                    const labels = data.map(item => item.ten_van_phong);

                    const bgThue = 'rgba(54, 162, 235, 0.8)';
                    const bgTrong = 'rgba(255, 99, 132, 0.2)';

                    const datasets = monthLabels.map((thang, i) => {
                        const thangIndex = i + 1;
                        return {
                            label: thang,
                            data: data.map(vp => vp.thoi_gian[thangIndex] === 'thue' ? 1 : 1),
                            backgroundColor: data.map(vp =>
                                vp.thoi_gian[thangIndex] === 'thue' ? bgThue : bgTrong),
                            borderWidth: 1,
                            stack: 'stack1'
                        };
                    });

                    window.chartInstance = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: datasets
                        },
                        options: {
                            indexAxis: 'y',
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                x: {
                                    stacked: true,
                                    min: 0,
                                    max: 12,
                                    ticks: {
                                        stepSize: 1,
                                        callback: value => (value >= 1 && value <= 12) ? `Tháng ${value}` : '',
                                        autoSkip: false
                                    },
                                    grid: {
                                        display: false
                                    }
                                },
                                y: {
                                    stacked: true,
                                    ticks: {
                                        autoSkip: false
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: ctx => {
                                            const label = ctx.dataset.label;
                                            const status = ctx.raw === 1 ?
                                                (ctx.dataset.backgroundColor[ctx.dataIndex] === bgThue ?
                                                    'Đang thuê' : 'Trống') :
                                                '';
                                            return `${label}: ${status}`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                });
        }

        document.getElementById('loadChartBtn').addEventListener('click', loadChart);

        window.addEventListener('DOMContentLoaded', function() {
            loadChart();
        });
    </script>
@endpush

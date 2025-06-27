@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')
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
            <div class="mb-3">
                <form method="GET" action="{{ route('admin.thongke.doanh_thu_thang') }}">
                    <div class="row">
                        <div class="col-sm-4 ">
                            {{-- <label for="toa_nha" class="mr-2">Tòa nhà:</label> --}}
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
                            {{-- <label for="nam" class="mr-2">Năm:</label> --}}
                            <select name="nam" id="nam" class="form-control mr-3">
                                @for ($i = date('Y'); $i >= 2020; $i--)
                                    <option value="{{ $i }}"
                                        {{ request('nam', date('Y')) == $i ? 'selected' : '' }}>
                                        {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-sm-2">
                            {{-- <label for="filter" class="mr-2">Lọc</label> --}}
                            <button type="submit" class="btn btn-primary form-control mr-3" name ="filter">Lọc</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-12 mb-3">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-header-title">Doanh thu theo tháng - Năm {{ $year }}</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="doanhThuChart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tháng/Năm</th>
                        <th>Tiền cọc</th>
                        <th>Tiền thuê <small>(bao gồm điện nước)</small></th>
                        <th>Dịch vụ phụ</th>
                        <th>Tổng doanh thu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($report as $item)
                        <tr>
                            <td>{{ date('m/Y', strtotime($item->thang)) }}</td>
                            <td>{{ number_format($item->tien_coc) }}</td>
                            <td>{{ number_format($item->tien_thu) }}</td>
                            <td>{{ number_format($item->dich_vu_phu) }}</td>
                            <td>{{ number_format($item->tien_coc + $item->tien_thu + $item->dich_vu_phu) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>



        </div>
    </main>

@endsection

@push('scripts')
    {{-- <script>
        // Lấy dữ liệu từ Blade
        const labels = @json($report->map(fn($item) => date('m/Y', strtotime($item->thang))));
        const tienCoc = @json($report->pluck('tien_coc'));
        const tienThu = @json($report->pluck('tien_thu'));
        const dichVuPhu = @json($report->pluck('dich_vu_phu'));

        // Tính tổng doanh thu
        const tongDoanhThu = tienCoc.map((val, idx) => val + tienThu[idx] + dichVuPhu[idx]);

        // Khởi tạo Chart.js
        const ctx = document.getElementById('doanhThuChart').getContext('2d');
        const doanhThuChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Tiền cọc',
                        data: tienCoc,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)'
                    },
                    {
                        label: 'Tiền thuê',
                        data: tienThu,
                        backgroundColor: 'rgba(255, 206, 86, 0.7)'
                    },
                    {
                        label: 'Dịch vụ phụ',
                        data: dichVuPhu,
                        backgroundColor: 'rgba(75, 192, 192, 0.7)'
                    },
                    {
                        label: 'Tổng doanh thu',
                        data: tongDoanhThu,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)'
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Số tiền (VNĐ)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tháng'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y.toLocaleString('vi-VN') +
                                    ' VNĐ';
                            }
                        }
                    },
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    </script> --}}

    {{-- <script>
        // Lấy dữ liệu từ Blade
        const labels = @json($report->map(fn($item) => date('m/Y', strtotime($item->thang))));
        const tienCoc = @json($report->pluck('tien_coc'));
        const tienThu = @json($report->pluck('tien_thu'));
        const dichVuPhu = @json($report->pluck('dich_vu_phu'));



        // Tính tổng doanh thu
        const tongDoanhThu = tienCoc.map((val, idx) => val + tienThu[idx] + dichVuPhu[idx]);
        console.log(labels, tienCoc, tienThu, dichVuPhu, tongDoanhThu);

        // Khởi tạo Chart.js
        const ctx = document.getElementById('doanhThuChart').getContext('2d');
        const doanhThuChart = new Chart(ctx, {
            data: {
                labels: labels,
                datasets: [{
                        label: 'Tiền cọc',
                        data: tienCoc,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        type: 'bar'
                    },
                    {
                        label: 'Tiền thuê',
                        data: tienThu,
                        backgroundColor: 'rgba(255, 206, 86, 0.7)',
                        type: 'bar'
                    },
                    {
                        label: 'Dịch vụ phụ',
                        data: dichVuPhu,
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                        type: 'bar'
                    },
                    {
                        label: 'Tổng doanh thu',
                        data: tongDoanhThu,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.1)',
                        type: 'line',
                        fill: false,
                        tension: 0.4,
                        pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                        yAxisID: 'y1',
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Số tiền (VNĐ)'
                        }
                    },
                    y1: {
                        beginAtZero: true,
                        position: 'right',
                        grid: {
                            drawOnChartArea: false
                        },
                        title: {
                            display: true,
                            text: 'Tổng doanh thu'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tháng'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y.toLocaleString('vi-VN') +
                                    ' VNĐ';
                            }
                        }
                    },
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy dữ liệu từ Blade
            const labels = @json($report->map(fn($item) => date('m/Y', strtotime($item->thang))));
            const tienCoc = @json($report->pluck('tien_coc')->map(fn($x) => (float) $x)->toArray());
            const tienThu = @json($report->pluck('tien_thu')->map(fn($x) => (float) $x)->toArray());
            const dichVuPhu = @json($report->pluck('dich_vu_phu')->map(fn($x) => (float) $x)->toArray());


            // Tính tổng doanh thu
            const tongDoanhThu = tienCoc.map((val, idx) => val + tienThu[idx] + dichVuPhu[idx]);

            console.log(labels, tienCoc, tienThu, dichVuPhu, tongDoanhThu);

            // Kiểm tra dữ liệu
            if (!labels || labels.length === 0) {
                console.error('Không có dữ liệu để hiển thị biểu đồ');
                return;
            }

            // Khởi tạo Chart.js
            const ctx = document.getElementById('doanhThuChart').getContext('2d');

            try {
                const doanhThuChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                                label: 'Tiền cọc',
                                data: tienCoc,
                                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Tiền thuê',
                                data: tienThu,
                                backgroundColor: 'rgba(255, 206, 86, 0.7)',
                                borderColor: 'rgba(255, 206, 86, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Dịch vụ phụ',
                                data: dichVuPhu,
                                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Tổng doanh thu',
                                data: tongDoanhThu,
                                type: 'line',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                backgroundColor: 'rgba(255, 99, 132, 0.1)',
                                borderWidth: 2,
                                fill: true
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Số tiền (VNĐ)'
                                },
                                ticks: {
                                    callback: function(value) {
                                        return value.toLocaleString('vi-VN') + ' VNĐ';
                                    }
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Tháng'
                                }
                            }
                        },
                        interaction: {
                            mode: 'index', // khi rê chuột vào một điểm trên trục x, hiện tooltip của tất cả các dataset cùng tháng đó
                            intersect: false // cho phép hover trong khoảng giữa các điểm vẫn hiện tooltip
                        },
                        plugins: {
                            tooltip: {
                                mode: 'index', // tooltip hiện cùng lúc các dữ liệu theo index (tháng)
                                intersect: false,
                                callbacks: {
                                    label: function(context) {
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.parsed.y !== null) {
                                            label += context.parsed.y.toLocaleString('vi-VN') + ' VNĐ';
                                        }
                                        return label;
                                    }
                                }
                            },
                            legend: {
                                position: 'top'
                            }
                        }
                    }
                });
            } catch (error) {
                console.error('Lỗi khi khởi tạo biểu đồ:', error);
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')
    {{-- <x-admin-layout> --}}
    <main id="content" role="main" class="main pointer-event">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm mb-2 mb-sm-0">
                        <h1 class="page-header-title">Trang chủ</h1>
                    </div>


                </div>
            </div>
            <!-- End Page Header -->

            <!-- Stats -->
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
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4">
                    <canvas id="toaNhaChart"></canvas>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <canvas id="khachThueChart"></canvas>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <canvas id="hopDongChart"></canvas>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <canvas id="hoaDonChart"></canvas>
                </div>
            </div>

            <!-- End Stats -->

            <!-- Table -->
            <div class="card mb-3 mb-lg-5">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center flex-grow-1">
                        <div class="col-12 col-md">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-header-title">Khách thuê</h5>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="row align-items-sm-center">
                                <div class="col-sm-auto">
                                    <a class="btn btn-white" href="{{ route('admin.khachhang.index') }}" title="Xem tất cả">
                                        <i class="tio-arrow-forward"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive datatable-custom">
                    <table id="datatable"
                        class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                        data-hs-datatables-options='{
                     "columnDefs": [{
                        "targets": [0, 9],
                        "orderable": false
                      }],
                     "order": [],
                     "info": {
                       "totalQty": "#datatableWithPaginationInfoTotalQty"
                     },
                     "search": "#datatableSearch",
                     "entries": "#datatableEntries",
                     "pageLength": 15,
                     "isResponsive": false,
                     "isShowPaging": false,
                     "pagination": "datatablePagination"
                   }'>
                        <thead class="thead-light">
                            <tr>
                                <th class="table-column-pr-0">

                                </th>
                                <th class="table-column-pl-0">Mã khách</th>
                                <th>Tên khách</th>
                                <th>Email</th>
                                <th>CCCD</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Vai trò</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($khachhangs as $khachhang)
                                <tr>
                                    <td class="table-column-pr-0">
                                    </td>
                                    <td>
                                        <a href="#">{{ $khachhang->id }}</a>
                                    </td>
                                    <td class="text-break px-3">{{ $khachhang->name }}</td>
                                    <td class="text-break px-3">{{ $khachhang->email }}</td>
                                    <td class="text-break px-3">{{ $khachhang->cccd }}</td>
                                    <td class="text-break px-3">{{ $khachhang->so_dien_thoai }}</td>
                                    <td class="text-break px-3" style="max-width: 12rem; white-space: normal;">
                                        {{ $khachhang->dia_chi }}
                                    </td>
                                    <td class="text-break px-3">
                                        @if ($khachhang->vai_tro === 'admin')
                                            Admin
                                        @else
                                            Khách hàng
                                        @endif
                                    </td>
                                    <td class="text-break px-3">
                                        @if ($khachhang->trang_thai === 1)
                                            <span class="legend-indicator bg-success"></span> Đang hoạt dộng
                                        @else
                                            <span class="legend-indicator bg-danger"></span> Ngừng hoạt động
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End Table -->

            <div class="card mb-3 mb-lg-5">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-header-title">Doanh thu tháng {{ $month }}/{{ $year }}</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="doanhThuChart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>


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

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const labels = ["{{ $year }}-{{ $month }}"];
            const tienCoc = [{{ $doanhThuHienTai->tien_coc }}];
            const tienThu = [{{ $doanhThuHienTai->tien_thu }}];
            const dichVuPhu = [{{ $doanhThuHienTai->dich_vu_phu }}];

            const tongDoanhThu = tienCoc.map((val, idx) => val + tienThu[idx] + dichVuPhu[idx]);
            console.log(labels, tienCoc, tienThu, dichVuPhu, tongDoanhThu);

            if (!labels || labels.length === 0) {
                console.error('Không có dữ liệu để hiển thị biểu đồ');
                return;
            }

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
                            mode: 'index',
                            intersect: false
                        },
                        plugins: {
                            tooltip: {
                                mode: 'index',
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

        const toaNhaChart = new Chart(document.getElementById('toaNhaChart'), {
            type: 'pie',
            data: {
                labels: ['Đang thuê', 'Còn trống'],
                datasets: [{
                    data: [{{ $totalPhongDangThue }}, {{ $totalPhongConTrong }}],
                    backgroundColor: ['#4caf50', '#ff9800'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Tòa nhà'
                    }
                }
            }
        });

        const khachThueChart = new Chart(document.getElementById('khachThueChart'), {
            type: 'pie',
            data: {
                labels: ['Đang hoạt động', 'Không hoạt động'],
                datasets: [{
                    data: [{{ $userActive }}, {{ $totalKhachThue - $userActive }}],
                    backgroundColor: ['#2196f3', '#e91e63'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Khách thuê'
                    }
                }
            }
        });

        const hopDongChart = new Chart(document.getElementById('hopDongChart'), {
            type: 'pie',
            data: {
                labels: ['Còn hiệu lực', 'Đã thanh lý'],
                datasets: [{
                    data: [{{ $hopDongHieuLuc }}, {{ $hopDongDaThanhLy }}],
                    backgroundColor: ['#9c27b0', '#ffc107'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Hợp đồng'
                    }
                }
            }
        });

        const hoaDonChart = new Chart(document.getElementById('hoaDonChart'), {
            type: 'pie',
            data: {
                labels: ['Đã thanh toán', 'Chưa thanh toán'],
                datasets: [{
                    data: [{{ $hoaDonDaTT }}, {{ $hoaDonChuaTT }}],
                    backgroundColor: ['#00bcd4', '#f44336'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Hóa đơn'
                    }
                }
            }
        });
    </script>
@endpush

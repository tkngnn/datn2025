@extends('admin.layouts.app')
@section('title', 'Dashboard')
@push('styles')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
@endpush
@section('content')

    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center mb-3">
                    <div class="col-sm">
                        <h1 class="page-header-title">Danh Sách Hợp Đồng <span
                                class="badge badge-soft-dark ml-2">{{ $hopDongs->count() }}</span></h1>

                        <div class="mt-2">
                            <a class="text-body mr-3" href="javascript:;" data-toggle="modal"
                                data-target="#exportOrdersModal">
                                <i class="tio-download-to mr-1"></i> Xuất
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <a class="btn btn-primary" href="{{ route('admin.hopdong.create') }}">Thêm hợp đồng</a>
                    </div>
                </div>
                <!-- End Row -->

                <!-- Nav Scroller -->
                <div class="js-nav-scroller hs-nav-scroller-horizontal">
                    <span class="hs-nav-scroller-arrow-prev" style="display: none;">
                        <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                            <i class="tio-chevron-left"></i>
                        </a>
                    </span>

                    <span class="hs-nav-scroller-arrow-next" style="display: none;">
                        <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                            <i class="tio-chevron-right"></i>
                        </a>
                    </span>

                    <!-- Nav -->
                    <ul class="nav nav-tabs page-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Tất cả hợp đồng</a>
                        </li>
                    </ul>
                    <!-- End Nav -->
                </div>
                <!-- End Nav Scroller -->

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Thành công!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Lỗi!</strong> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <script>
                    // Sau 5 giây (5000ms), tự động ẩn các alert có class `.alert`
                    setTimeout(function() {
                        const alerts = document.querySelectorAll('.alert');
                        alerts.forEach(alert => {
                            if (alert.id !== 'noDebtMessage') {
                                alert.classList.remove('show');
                                alert.classList.add('fade');
                                setTimeout(() => alert.remove(), 300);
                            }
                        });
                    }, 5000);
                </script>
            </div>
            <!-- End Page Header -->

            <!-- Card -->
            <div class="card">
                <!-- Header -->
                <div class="card-header">
                    <div class="row justify-content-between align-items-center flex-grow-1">
                        <div class="col-lg-6 mb-3 mb-lg-0">
                            <form>
                                <!-- Search -->
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tio-search"></i>
                                        </div>
                                    </div>
                                    <input id="datatableSearch" type="search" class="form-control"
                                        placeholder="Search orders" aria-label="Search orders">
                                </div>
                                <!-- End Search -->
                            </form>
                        </div>

                        <div class="col-lg-6">
                            <div class="d-sm-flex justify-content-sm-end align-items-sm-center">
                                <!-- Datatable Info -->
                                <div id="datatableCounterInfo" class="mr-2 mb-2 mb-sm-0" style="display: none;">
                                    <div class="d-flex align-items-center">
                                        <span class="font-size-sm mr-3">
                                            <span id="datatableCounter">0</span>
                                            Selected
                                        </span>
                                        <a class="btn btn-sm btn-outline-danger" href="javascript:;">
                                            <i class="tio-delete-outlined"></i> Delete
                                        </a>
                                    </div>
                                </div>
                                <!-- End Datatable Info -->

                                <!-- Unfold -->
                                <div class="hs-unfold mr-2">
                                    <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle" href="javascript:;"
                                        data-hs-unfold-options='{
                       "target": "#usersExportDropdown",
                       "type": "css-animation"
                     }'>
                                        <i class="tio-download-to mr-1"></i> Export
                                    </a>

                                    <div id="usersExportDropdown"
                                        class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                                        <span class="dropdown-header">Options</span>
                                        <a id="export-copy" class="dropdown-item" href="javascript:;">
                                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                                src="assets\svg\illustrations\copy.svg" alt="Image Description">
                                            Copy
                                        </a>
                                        <a id="export-print" class="dropdown-item" href="javascript:;">
                                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                                src="assets\svg\illustrations\print.svg" alt="Image Description">
                                            Print
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <span class="dropdown-header">Download options</span>
                                        <a id="export-excel" class="dropdown-item" href="javascript:;">
                                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                                src="assets\svg\brands\excel.svg" alt="Image Description">
                                            Excel
                                        </a>
                                        <a id="export-csv" class="dropdown-item" href="javascript:;">
                                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                                src="assets\svg\components\placeholder-csv-format.svg"
                                                alt="Image Description">
                                            .CSV
                                        </a>
                                        <a id="export-pdf" class="dropdown-item" href="javascript:;">
                                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                                src="assets\svg\brands\pdf.svg" alt="Image Description">
                                            PDF
                                        </a>
                                    </div>
                                </div>
                                <!-- End Unfold -->

                                <!-- Unfold -->
                                <div class="hs-unfold">
                                    <a class="js-hs-unfold-invoker btn btn-sm btn-white" href="javascript:;"
                                        data-hs-unfold-options='{
                       "target": "#showHideDropdown",
                       "type": "css-animation"
                     }'>
                                        <i class="tio-table mr-1"></i> Columns <span
                                            class="badge badge-soft-dark rounded-circle ml-1">7</span>
                                    </a>

                                    <div id="showHideDropdown"
                                        class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right dropdown-card"
                                        style="width: 15rem;">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="mr-2">Order</span>

                                                    <!-- Checkbox Switch -->
                                                    <label class="toggle-switch toggle-switch-sm"
                                                        for="toggleColumn_order">
                                                        <input type="checkbox" class="toggle-switch-input"
                                                            id="toggleColumn_order" checked="">
                                                        <span class="toggle-switch-label">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                    </label>
                                                    <!-- End Checkbox Switch -->
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="mr-2">Date</span>

                                                    <!-- Checkbox Switch -->
                                                    <label class="toggle-switch toggle-switch-sm" for="toggleColumn_date">
                                                        <input type="checkbox" class="toggle-switch-input"
                                                            id="toggleColumn_date" checked="">
                                                        <span class="toggle-switch-label">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                    </label>
                                                    <!-- End Checkbox Switch -->
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="mr-2">Customer</span>

                                                    <!-- Checkbox Switch -->
                                                    <label class="toggle-switch toggle-switch-sm"
                                                        for="toggleColumn_customer">
                                                        <input type="checkbox" class="toggle-switch-input"
                                                            id="toggleColumn_customer" checked="">
                                                        <span class="toggle-switch-label">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                    </label>
                                                    <!-- End Checkbox Switch -->
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="mr-2">Payment status</span>

                                                    <!-- Checkbox Switch -->
                                                    <label class="toggle-switch toggle-switch-sm"
                                                        for="toggleColumn_payment_status">
                                                        <input type="checkbox" class="toggle-switch-input"
                                                            id="toggleColumn_payment_status" checked="">
                                                        <span class="toggle-switch-label">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                    </label>
                                                    <!-- End Checkbox Switch -->
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="mr-2">Fulfillment status</span>

                                                    <!-- Checkbox Switch -->
                                                    <label class="toggle-switch toggle-switch-sm"
                                                        for="toggleColumn_fulfillment_status">
                                                        <input type="checkbox" class="toggle-switch-input"
                                                            id="toggleColumn_fulfillment_status">
                                                        <span class="toggle-switch-label">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                    </label>
                                                    <!-- End Checkbox Switch -->
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="mr-2">Payment method</span>

                                                    <!-- Checkbox Switch -->
                                                    <label class="toggle-switch toggle-switch-sm"
                                                        for="toggleColumn_payment_method">
                                                        <input type="checkbox" class="toggle-switch-input"
                                                            id="toggleColumn_payment_method" checked="">
                                                        <span class="toggle-switch-label">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                    </label>
                                                    <!-- End Checkbox Switch -->
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="mr-2">Total</span>

                                                    <!-- Checkbox Switch -->
                                                    <label class="toggle-switch toggle-switch-sm"
                                                        for="toggleColumn_total">
                                                        <input type="checkbox" class="toggle-switch-input"
                                                            id="toggleColumn_total" checked="">
                                                        <span class="toggle-switch-label">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                    </label>
                                                    <!-- End Checkbox Switch -->
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="mr-2">Actions</span>

                                                    <!-- Checkbox Switch -->
                                                    <label class="toggle-switch toggle-switch-sm"
                                                        for="toggleColumn_actions">
                                                        <input type="checkbox" class="toggle-switch-input"
                                                            id="toggleColumn_actions" checked="">
                                                        <span class="toggle-switch-label">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                    </label>
                                                    <!-- End Checkbox Switch -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Unfold -->
                            </div>
                        </div>
                    </div>
                    <!-- End Row -->
                </div>
                <!-- End Header -->

                <!-- Table -->
                <div class="table-responsive datatable-custom">
                    <table id="datatable"
                        class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                        style="width: 100%"
                        data-hs-datatables-options='{
                   "columnDefs": [{
                      "targets": [0],
                      "orderable": false
                    }],
                   "order": [],
                   "info": {
                     "totalQty": "#datatableWithPaginationInfoTotalQty"
                   },
                   "search": "#datatableSearch",
                   "entries": "#datatableEntries",
                   "pageLength": 12,
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatablePagination"
                 }'>
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="table-column-pr-0">
                                    <div class="custom-control custom-checkbox">
                                        <input id="datatableCheckAll" type="checkbox" class="custom-control-input">
                                        <label class="custom-control-label" for="datatableCheckAll"></label>
                                    </div>
                                </th>
                                <th class="table-column-pl-0">Số hợp đồng</th>
                                <th>Thao tác</th>
                                <th>Đại diện</th>
                                <th>Giá thuế</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($hopDongs as $hopdong)
                                @foreach ($hopdong->chiTietHopDongs as $chiTiet)
                                    <tr>
                                        <td class="table-column-pr-0">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="hopdongCheck{{ $hopdong->ma_hop_dong }}">
                                                <label class="custom-control-label"
                                                    for="hopdongCheck{{ $hopdong->ma_hop_dong }}"></label>
                                            </div>
                                        </td>
                                        <td class="table-column-pl-0">
                                            <a href="#">#{{ $hopdong->ma_hop_dong }}</a>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" style="gap: 0.5rem;">
                                                <a class="btn btn-sm btn-primary btn-xem-hopdong" href="javascript:;"
                                                    data-hopdong='@json($hopdong)'
                                                    data-chitiet='@json($chiTiet)'
                                                    data-id="{{ $hopdong->ma_hop_dong }}"
                                                    data-export-url="{{ route('admin.hopdong.export_pdf', $hopdong->ma_hop_dong) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Xem">
                                                    <i class="tio-visible-outlined"></i>
                                                </a>

                                                <a class="btn btn-sm btn-secondary"
                                                    href="{{ route('admin.hopdong.edit', $hopdong->ma_hop_dong) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Chỉnh sửa">
                                                    <i class="tio-edit"></i>
                                                </a>
                                                <a class="btn btn-sm btn-dark"
                                                    href="{{ route('admin.hopdong.export_pdf', $hopdong->ma_hop_dong) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Tải PDF">
                                                    <i class="tio-download-to"></i>
                                                </a>
                                                <a href="javascript:;" class="btn btn-sm btn-success btn-thanh-ly"
                                                    data-hopdong='@json($hopdong)'
                                                    data-hoadons='@json($hopdong->hoaDons)'
                                                    data-da-thanh-ly="{{ $hopdong->da_thanh_ly ? '1' : '0' }}"
                                                    data-toggle="tooltip" data-placement="top" title="Thanh lý"><i
                                                        class="tio-checkmark-circle"></i>
                                                </a>

                                                <a class="btn btn-sm btn-danger" href="#" data-toggle="tooltip"
                                                    data-placement="top" title="Xóa">
                                                    <i class="tio-delete"></i>
                                                </a>

                                            </div>
                                        </td>
                                        <td>
                                            <div><strong>{{ $hopdong->user->name ?? 'Không có' }}</strong></div>
                                            <div>Tòa Nhà: {{ $chiTiet->vanPhong->toaNha->ten_toa_nha ?? 'Không có' }}</div>
                                            <div>Phòng: {{ $chiTiet->vanPhong->ma_van_phong ?? 'Không có' }}</div>
                                        </td>
                                        <td>
                                            {{ number_format($chiTiet->gia_thue, 0, ',', '.') }} đ
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($hopdong->ngay_bat_dau)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($hopdong->ngay_ket_thuc)->format('d/m/Y') }}</td>
                                        <td>
                                            <span
                                                class="badge badge-soft-{{ $hopdong->tinh_trang == 'dang thue' ? 'success' : 'danger' }}">
                                                <span
                                                    class="legend-indicator bg-{{ $hopdong->tinh_trang == 'dang thue' ? 'success' : 'danger' }}"></span>
                                                {{ $hopdong->tinh_trang }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <!-- End Table -->

                <!-- Footer -->
                <div class="card-footer">
                    <!-- Pagination -->
                    <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                        <div class="col-sm mb-2 mb-sm-0">
                            <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                                <span class="mr-2">Showing:</span>

                                <!-- Select -->
                                <select id="datatableEntries" class="js-select2-custom"
                                    data-hs-select2-options='{
                          "minimumResultsForSearch": "Infinity",
                          "customClass": "custom-select custom-select-sm custom-select-borderless",
                          "dropdownAutoWidth": true,
                          "width": true
                        }'>
                                    <option value="12" selected="">12</option>
                                    <option value="14">14</option>
                                    <option value="16">16</option>
                                    <option value="18">18</option>
                                </select>
                                <!-- End Select -->

                                <span class="text-secondary mr-2">of</span>

                                <!-- Pagination Quantity -->
                                <span id="datatableWithPaginationInfoTotalQty"></span>
                            </div>
                        </div>

                        <div class="col-sm-auto">
                            <div class="d-flex justify-content-center justify-content-sm-end">
                                <!-- Pagination -->
                                <nav id="datatablePagination" aria-label="Activity pagination"></nav>
                            </div>
                        </div>
                    </div>
                    <!-- End Pagination -->
                </div>
                <!-- End Footer -->
            </div>
            <!-- End Card -->
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

        <!-- HopDong Modal Popup -->
        <div class="modal fade" id="modalChiTietHopDong" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body" id="noiDungHopDong">
                        <!-- Nội dung sẽ được load qua Ajax -->
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-danger btn-tai-pdf">
                            <i class="bi bi-file-earmark-pdf"></i> Tải PDF
                        </a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- End HopDong Modal Popup -->

        <!-- Thanh Ly Modal -->
        <div class="modal fade" id="thanhLyModal" tabindex="-1" aria-labelledby="thanhLyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="POST" id="formThanhLy" action="">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title">Biên bản Thanh lý Hợp đồng</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                        </div>

                        <div class="modal-body">
                            <h2 class="text-primary">1. Thông tin hợp đồng</h2>
                            <input type="hidden" name="ma_hop_dong" id="maHopDong">
                            <input type="hidden" name="tong_no" id="inputTongNo" value="0">
                            <input type="hidden" name="phi_phat" id="inputPhiPhat" value="0">
                            <input type="hidden" name="hoan_tra_coc" id="inputHoanTraCoc" value="0">
                            <input type="hidden" name="tong_cong" id="inputTongCong" value="0">

                            <table class="table table-bordered rounded shadow-sm">
                                <tbody>
                                    <tr>
                                        <th class="w-50">Đại diện:</th>
                                        <td><span id="daiDien"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Ngày khách vào:</th>
                                        <td><span id="ngayBatDau"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Hạn hợp đồng:</th>
                                        <td><span id="ngayKetThuc"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Tiền đặt cọc:</th>
                                        <td><span id="tienDatCoc"></span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mb-2">
                                <label>Lý do thanh lý:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="radio" name="ly_do" id="lyDo1" value="Khách rời phòng"
                                                required aria-label="Radio button for Khách rời phòng">
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" value="Khách rời phòng"
                                        aria-label="Text input with radio button 1" readonly>
                                </div>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="radio" name="ly_do" id="lyDo2" value="Khách bỏ cọc"
                                                required aria-label="Radio button for Khách bỏ cọc">
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" value="Khách bỏ cọc"
                                        aria-label="Text input with radio button 2" readonly>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label>Ngày chuyển đi:</label>
                                <input type="date" name="ngay_thanh_ly" class="form-control" required>
                            </div>

                            <div id="thongTinCongNo">
                                <h2 class="mt-4 text-primary">2. Công nợ khách hàng</h2>
                                <div id="hoaDonTableContainer">
                                    <table class="table table-bordered" id="hoaDonTable">
                                        <thead>
                                            <tr>
                                                <th>Mã hóa đơn</th>
                                                <th>Số tiền (VNĐ)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- JS sẽ đổ dữ liệu vào đây -->
                                        </tbody>
                                    </table>
                                </div>
                                <p id="noDebtMessage" class="alert alert-soft-primary">Khách hàng không còn nợ khoản
                                    tiền
                                    nào.
                                </p>



                                <h2 class="mt-4 text-primary">3. Hoàn cọc và phí phạt</h2>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label>Hoàn trả cọc:</label>
                                        <input type="number" name="hoan_tra_coc" id="hoanTraCoc" class="form-control"
                                            value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Phí phạt:</label>
                                        <input type="number" name="phi_phat" id="phiPhat" class="form-control"
                                            value="0">
                                    </div>
                                </div>

                                <h2 class="mt-4 text-primary">4. Tổng hợp</h2>
                                <table class="table table-bordered text-dark">
                                    <tbody>
                                        <tr>
                                            <th class="w-50">Tổng tiền khách nợ: (1)</th>
                                            <td><span id="tongNo" class="text-end">0</span></td>
                                        </tr>
                                        <tr>
                                            <th>Tổng phí phạt: (2)</th>
                                            <td><span id="tongPhiPhat">0</span></td>
                                        </tr>
                                        <tr>
                                            <th>Hoàn cọc: (3)</th>
                                            <td><span id="hoanCoc">0</span></td>
                                        </tr>
                                        <tr>
                                            <th class="fw-bold">Tổng cộng: (4) = (1) + (2) - (3)</th>
                                            <td class="fw-bold text-danger"><span id="tongCong">0</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Xác nhận Thanh lý</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- End Thanh Ly Modal -->

        <!-- Biên Ban Thanh Ly Modal -->

        <div id="modalBienBanThanhLy" class="modal"
            style="display:none; position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5);">
            <div style="background: white; max-width: 800px; margin: 50px auto; padding: 20px; position: relative;">
                <button id="closeModal" style="position: absolute; top: 10px; right: 10px;">&times;</button>
                <div id="modalContent">
                    <!-- Nội dung biên bản thanh lý sẽ được load vào đây -->
                    Đang tải...
                </div>
            </div>
        </div>


        <!-- End Biên Ban Thanh Ly Modal -->
    </main>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.selectpicker').selectpicker();

            $('.btn-xem-hopdong').click(function() {
                let id = $(this).data('id');
                let exportUrl = $(this).data('export-url');
                fetch(`/admin/hopdong/${id}/view`)
                    .then(res => res.text())
                    .then(html => {
                        $('#noiDungHopDong').html(html);
                        $('#modalChiTietHopDong .btn-tai-pdf').attr('href', exportUrl);
                        let modal = new bootstrap.Modal(document.getElementById('modalChiTietHopDong'));
                        modal.show();
                    })
                    .catch(err => {
                        alert('Lỗi khi tải hợp đồng');
                    });
            });
        });

        document.querySelectorAll('.btn-thanh-ly').forEach(btn => {
            btn.addEventListener('click', function() {
                // Lấy dữ liệu hợp đồng từ data attribute
                const hopdong = JSON.parse(this.getAttribute('data-hopdong'));
                const hoaDons = JSON.parse(this.getAttribute('data-hoadons'));
                const daThanhLy = this.getAttribute('data-da-thanh-ly');

                // Kiểm tra nếu hợp đồng đã thanh lý
                if (daThanhLy === '1') {
                    // Khởi tạo modal Bootstrap
                    const modal = new bootstrap.Modal(document.getElementById('modalBienBanThanhLy'));
                    const modalContent = document.getElementById('modalContent');

                    // Load nội dung biên bản thanh lý
                    fetch(`/admin/hopdong/${hopdong.ma_hop_dong}/bien-ban-thanh-ly`)
                        .then(response => {
                            if (!response.ok) throw new Error('Không tải được nội dung');
                            return response.text();
                        })
                        .then(html => {
                            modalContent.innerHTML = html;
                            modal.show(); // Hiển thị modal sau khi load xong nội dung
                        })
                        .catch(error => {
                            modalContent.innerHTML =
                                `<p class="text-danger">Lỗi khi tải nội dung: ${error.message}</p>`;
                            modal.show();
                        });
                    // Không hiện modal form thanh lý, thoát luôn
                    return;
                } else {
                    // Cập nhật form action (thay bằng route hoặc url đúng của bạn)
                    document.getElementById('formThanhLy').action =
                        `/admin/hopdong/thanhly/${hopdong.ma_hop_dong}`;

                    // Điền các giá trị vào modal
                    document.getElementById('maHopDong').value = hopdong.ma_hop_dong;
                    document.getElementById('daiDien').innerText = hopdong.user.name;
                    document.getElementById('ngayBatDau').innerText = new Date(hopdong.ngay_bat_dau)
                        .toLocaleDateString('vi-VN');
                    document.getElementById('ngayKetThuc').innerText = new Date(hopdong.ngay_ket_thuc)
                        .toLocaleDateString('vi-VN');
                    document.getElementById('tienDatCoc').innerText = new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(hopdong.tong_tien_coc);
                    document.getElementById('hoanTraCoc').value = hopdong.tong_tien_coc;

                    // Xử lý bảng công nợ
                    const tbody = document.querySelector('#hoaDonTable tbody');
                    tbody.innerHTML = ''; // Clear cũ
                    if (hoaDons.length > 0) {
                        console.log('hoaDons:', hoaDons);
                        document.getElementById('hoaDonTableContainer').classList.remove('d-none');
                        document.getElementById('noDebtMessage').classList.add('d-none');

                        hoaDons.forEach(hd => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                    <td>HD${hd.ma_hoa_don}</td>
                    <td>${new Intl.NumberFormat('vi-VN', {
                        style: 'currency', currency: 'VND'
                    }).format(hd.tong_tien)}</td>
                `;
                            tbody.appendChild(row);
                        });
                    } else {
                        document.getElementById('hoaDonTableContainer').classList.add('d-none');
                        document.getElementById('noDebtMessage').classList.remove('d-none');
                    }

                    //Tổng hợp công nợ
                    let tongNo = hoaDons.reduce((sum, hd) => {
                        // Chuyển chuỗi sang số thập phân
                        const tien = parseFloat(hd.tong_tien);
                        return sum + (isNaN(tien) ? 0 : tien);
                    }, 0);
                    document.getElementById('tongNo').innerText = new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(tongNo);

                    // Hàm cập nhật tổng cộng
                    function capNhatTongCong() {

                        const lyDo = document.querySelector('input[name="ly_do"]:checked')?.value;
                        if (lyDo === 'Khách bỏ cọc') {
                            // Reset hết về 0
                            document.getElementById('tongPhiPhat').innerText = '0 ₫';
                            document.getElementById('hoanCoc').innerText = '0 ₫';
                            document.getElementById('tongCong').innerText = '0 ₫';

                            document.getElementById('inputTongNo').value = 0;
                            document.getElementById('inputPhiPhat').value = 0;
                            document.getElementById('inputHoanTraCoc').value = 0;
                            document.getElementById('inputTongCong').value = 0;

                            return; // Không tính toán nữa
                        }
                        // Lấy các giá trị số từ input, nếu rỗng thì mặc định 0
                        const phiPhat = Number(document.getElementById('phiPhat').value) || 0;
                        const hoanCoc = Number(document.getElementById('hoanTraCoc').value) || 0;

                        // Tính tổng cộng: (1) + (2) - (3)
                        let tongCong = tongNo + phiPhat - hoanCoc;

                        // Cập nhật giao diện (định dạng tiền)
                        document.getElementById('tongPhiPhat').innerText = new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(phiPhat);

                        document.getElementById('hoanCoc').innerText = new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(hoanCoc);

                        // Cập nhật tổng cộng
                        document.getElementById('tongCong').innerText = new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(tongCong);

                        document.getElementById('inputTongNo').value = tongNo;
                        document.getElementById('inputPhiPhat').value = phiPhat;
                        document.getElementById('inputHoanTraCoc').value = hoanCoc;
                        document.getElementById('inputTongCong').value = tongCong;
                    }

                    // Gọi 1 lần lúc mở modal
                    capNhatTongCong();

                    // Lắng nghe thay đổi input phí phạt, hoàn cọc nếu cần tính lại
                    document.getElementById('phiPhat').addEventListener('input', capNhatTongCong);
                    document.getElementById('hoanTraCoc').addEventListener('input', capNhatTongCong);

                    // Hiển thị modal
                    var thanhLyModal = new bootstrap.Modal(document.getElementById('thanhLyModal'));
                    thanhLyModal.show();
                }
            });

        });

        document.addEventListener('DOMContentLoaded', function() {
            const radios = document.querySelectorAll('input[name="ly_do"]');
            const thongTinCongNo = document.getElementById('thongTinCongNo');

            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'Khách bỏ cọc') {
                        thongTinCongNo.classList.add('d-none');

                        // Reset giá trị nếu bỏ cọc
                        document.getElementById('inputTongNo').value = 0;
                        document.getElementById('inputPhiPhat').value = 0;
                        document.getElementById('inputHoanTraCoc').value = 0;
                        document.getElementById('inputTongCong').value = 0;
                    } else {
                        thongTinCongNo.classList.remove('d-none');
                        // Cập nhật lại tổng cộng
                        capNhatTongCong();
                    }
                });
            });
        });
    </script>
@endpush

@extends('admin.layouts.app')
@section('title', 'Dashboard')
@push('styles')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    <style>
        .font-reset {
            font-family: inherit !important;
        }
    </style>
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


            </div>
            <div id="hopdong-alert-container" class="mt-2"></div>
            <!-- End Page Header -->
            @if (session('success'))
                <div class="alert alert-soft-success" role="alert">
                    <strong>Thành công!</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Đóng">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-soft-danger" role="alert">
                    <strong>Lỗi!</strong> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Đóng">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <script>
                setTimeout(function() {
                    const alerts = document.querySelectorAll('.alert');
                    alerts.forEach(alert => {
                        if (alert.id !== 'noDebtMessage' || alert.classList.contains(
                                'tong-hop-dong-can-thanh-ly')) {
                            alert.classList.remove('show');
                            alert.classList.add('fade');
                            setTimeout(() => alert.remove(), 300);
                        }
                    });
                }, 5000);
            </script>

            @if ($hopDongsCanThanhLy->count())
                <div class="alert alert-soft-warning tong-hop-dong-can-thanh-ly" role="alert">
                    <strong>Chú ý!</strong> Có <span class="font-weight-bold">{{ $hopDongsCanThanhLy->count() }}</span>
                    hợp đồng sắp hết hạn/đã hết hạn cần thanh lý.
                </div>
            @endif
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

                        <div class="col-auto">
                            <!-- Unfold -->
                            <div class="hs-unfold mr-2">
                                <a class="js-hs-unfold-invoker btn btn-soft-primary btn-sm" href="javascript:;"
                                    data-hs-unfold-options='{
                                        "target": "#datatableFilterSidebar",
                                        "type": "css-animation",
                                        "animationIn": "fadeInRight",
                                        "animationOut": "fadeOutRight",
                                        "hasOverlay": true,
                                        "smartPositionOff": true
                                    }'>
                                    <i class="tio-filter-list mr-1"></i>
                                </a>
                            </div>
                            <!-- End Unfold -->
                            <!-- Unfold -->
                            <div class="hs-unfold mr-2">
                                <a href="{{ url()->current() }}" class="btn btn-soft-secondary btn-sm ml-2">
                                    <i class="tio-refresh"></i>
                                </a>
                            </div>
                            <!-- End Unfold -->
                        </div>


                        <!-- Sidebar filter -->
                        <div id="datatableFilterSidebar"
                            class="hs-unfold-content sidebar sidebar-bordered sidebar-box-shadow">
                            <div class="card mb-5">
                                <div class="card-header">
                                    <h5 class="mb-0">Lọc</h5>
                                    <a class="js-hs-unfold-invoker btn btn-icon btn-xs btn-ghost-dark ml-2"
                                        href="javascript:;"
                                        data-hs-unfold-options='{
                                        "target": "#datatableFilterSidebar",
                                        "type": "css-animation",
                                        "animationIn": "fadeInRight",
                                        "animationOut": "fadeOutRight",
                                        "hasOverlay": true,
                                        "smartPositionOff": true
                                       }'>
                                        <i class="tio-clear tio-lg"></i>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <form method="GET" action="{{ route('admin.hopdong.index') }}">

                                        <div class="form-group">
                                            <label for="filterYear">Năm ký hợp đồng</label>
                                            <select name="nam" id="filterYear" class="form-control selectpicker"
                                                data-live-search="true" title="Chọn năm">
                                                <option value="">-- Tất cả --</option>
                                                @for ($y = date('Y'); $y >= 2020; $y--)
                                                    <option value="{{ $y }}"
                                                        {{ request('nam') == $y ? 'selected' : '' }}>{{ $y }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Trạng thái hợp đồng</label>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="dangThue"
                                                    name="tinh_trang_hop_dong[]" value="dang thue"
                                                    {{ in_array('dang thue', (array) request('tinh_trang_hop_dong')) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="dangThue">Đang thuê</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="daThanhLy"
                                                    name="tinh_trang_hop_dong[]" value="da thanh ly"
                                                    {{ in_array('da thanh ly', (array) request('tinh_trang_hop_dong')) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="daThanhLy">Đã thanh lý</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="hetHan"
                                                    name="tinh_trang_hop_dong[]" value="het han"
                                                    {{ in_array('het han', (array) request('tinh_trang_hop_dong')) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="hetHan">Hết hạn</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="filterToaNha">Tòa nhà</label>
                                            <select name="toa_nha" id="filterToaNha" class="form-control selectpicker"
                                                data-live-search="true" title="Chọn tòa nhà">
                                                <option value="">-- Tất cả --</option>
                                                @foreach ($dsToaNha as $tn)
                                                    <option value="{{ $tn->ma_toa_nha }}"
                                                        {{ request('toa_nha') == $tn->ma_toa_nha ? 'selected' : '' }}>
                                                        {{ $tn->ten_toa_nha }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Lọc</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- End Sidebar filter -->
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
                                </th>
                                <th class="table-column-pl-0">Số hợp đồng</th>
                                <th>Đại diện</th>
                                <th>Giá thuê</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($hopDongs as $hopdong)
                                @foreach ($hopdong->chiTietHopDongs as $chiTiet)
                                    <tr>
                                        <td class="table-column-pr-0">
                                        </td>
                                        <td class="table-column-pl-0">
                                            <a class="btn-xem-hopdong" href="javascript:;"
                                                data-hopdong='@json($hopdong)'
                                                data-chitiet='@json($chiTiet)'
                                                data-id="{{ $hopdong->ma_hop_dong }}"
                                                data-export-url="{{ route('admin.hopdong.export_pdf', $hopdong->ma_hop_dong) }}"
                                                data-toggle="tooltip" data-placement="top" title="Xem">
                                                {{ $hopdong->ma_hop_dong }}
                                                @php
                                                    $ngayKetThuc = \Carbon\Carbon::parse($hopdong->ngay_ket_thuc);
                                                    $soNgayConLai = $ngayKetThuc->diffInDays(now(), false);

                                                    $isCanhBao =
                                                        !$hopdong->da_thanh_ly &&
                                                        ($ngayKetThuc->isPast() ||
                                                            ($soNgayConLai <= 7 && $soNgayConLai >= 0));
                                                @endphp
                                                @if ($isCanhBao)
                                                    <i class="tio-warning text-warning" data-toggle="tooltip"
                                                        title="Hợp đồng sắp hết hạn hoặc quá hạn"></i>
                                                @endif

                                            </a>
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
                                        @php
                                            $today = \Carbon\Carbon::now();
                                            $ngayKetThuc = \Carbon\Carbon::parse($hopdong->ngay_ket_thuc);
                                            $ngayConLai =
                                                !$hopdong->da_thanh_ly && $ngayKetThuc->gt($today)
                                                    ? (int) $today->diffInDays($ngayKetThuc, false)
                                                    : 0;
                                        @endphp
                                        <td>
                                            <span
                                                class="badge badge-soft-{{ $hopdong->tinh_trang == 'dang thue' ? 'success' : 'danger' }}">
                                                <span
                                                    class="legend-indicator bg-{{ $hopdong->tinh_trang == 'dang thue' ? 'success' : 'danger' }}"></span>
                                                {{ $hopdong->tinh_trang == 'dang thue' ? 'Đang thuê' : 'Đã thanh lý' }}
                                            </span>
                                            @if (!$hopdong->da_thanh_ly && $ngayKetThuc->gt($today))
                                                <br>
                                                <small class="text-muted">Còn {{ $ngayConLai }} ngày</small>
                                            @elseif($hopdong->da_thanh_ly)
                                                <br>
                                                <small class="text-muted">Đã thanh lý</small>
                                            @else
                                                <br>
                                                <small class="text-danger">Đã hết hạn</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" style="gap: 0.2rem;">
                                                <a class="btn btn-sm btn-white btn-xem-hopdong" href="javascript:;"
                                                    data-hopdong='@json($hopdong)'
                                                    data-chitiet='@json($chiTiet)'
                                                    data-id="{{ $hopdong->ma_hop_dong }}"
                                                    data-export-url="{{ route('admin.hopdong.export_pdf', $hopdong->ma_hop_dong) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Xem">
                                                    <i class="tio-visible-outlined"></i>
                                                </a>
                                                <a class="btn btn-sm btn-white btn-edit-hopdong" href="javascript:;"
                                                    data-id="{{ $hopdong->ma_hop_dong }}"
                                                    data-da-thanh-ly="{{ $hopdong->da_thanh_ly ? '1' : '0' }}"
                                                    data-url="{{ route('admin.hopdong.edit', $hopdong->ma_hop_dong) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Chỉnh sửa">
                                                    <i class="tio-edit"></i>
                                                </a>

                                                <a class="btn btn-sm btn-white"
                                                    href="{{ route('admin.hopdong.export_pdf', $hopdong->ma_hop_dong) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Tải PDF">
                                                    <i class="tio-download-to"></i>
                                                </a>
                                                <a href="javascript:;" class="btn btn-sm btn-white btn-thanh-ly"
                                                    data-hopdong='@json($hopdong)'
                                                    data-hoadons='@json($hopdong->hoaDons)'
                                                    data-da-thanh-ly="{{ $hopdong->da_thanh_ly ? '1' : '0' }}"
                                                    data-toggle="tooltip" data-placement="top" title="Thanh lý"><i
                                                        class="tio-checkmark-circle"></i>
                                                </a>

                                                <a class="btn btn-sm btn-white" href="#" data-toggle="tooltip"
                                                    data-placement="top" title="Xóa">
                                                    <i class="tio-delete"></i>
                                                </a>

                                            </div>
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
                                <span class="mr-2">Hiển thị:</span>

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

                                <span class="text-secondary mr-2">của</span>

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

        <!-- HopDong Modal Popup -->
        <div class="modal fade" id="modalChiTietHopDong" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title"></h1>
                        <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary" data-dismiss="modal"
                            aria-label="Close">
                            <i class="tio-clear tio-lg"></i>
                        </button>
                    </div>
                    <div class="modal-body" id="noiDungHopDong">
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-danger btn-tai-pdf">
                            <i class="tio-download-to"></i>
                        </a>
                        <button type="button" class="btn btn-primary" onclick="inNoiDungHopDong()">
                            <i class="tio-print"></i>
                        </button>

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
                            <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary" data-dismiss="modal"
                                aria-label="Close">
                                <i class="tio-clear tio-lg"></i>
                            </button>
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
        <div class="modal fade" id="modalBienBanThanhLy" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary ms-auto"
                            data-dismiss="modal" aria-label="Close">
                            <i class="tio-clear tio-lg"></i>
                        </button>
                    </div>
                    <div class="modal-body" id="modalContent">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="inNoiDungBienBan()">
                            <i class="tio-print"></i>
                        </button>

                    </div>
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

        document.querySelectorAll('.btn-edit-hopdong').forEach(btn => {
            btn.addEventListener('click', function() {
                const maHopDong = this.getAttribute('data-id');
                const daThanhLy = this.getAttribute('data-da-thanh-ly');
                const url = this.getAttribute('data-url');
                if (daThanhLy === '1') {
                    const alertBox = `
                        <div class="alert alert-soft-danger alert-dismissible fade show mt-3" role="alert">
                            <strong>Không thể chỉnh sửa!</strong> Hợp đồng này đã được thanh lý.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Đóng">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `;
                    $('#hopdong-alert-container').html(alertBox);
                    setTimeout(() => {
                        $('.alert').alert('close');
                    }, 5000);
                    return;
                }
                window.location.href = url;
            });
        });

        document.querySelectorAll('.btn-thanh-ly').forEach(btn => {
            btn.addEventListener('click', function() {
                const hopdong = JSON.parse(this.getAttribute('data-hopdong'));
                const hoaDons = JSON.parse(this.getAttribute('data-hoadons'));
                const daThanhLy = this.getAttribute('data-da-thanh-ly');

                if (daThanhLy === '1') {
                    const modal = new bootstrap.Modal(document.getElementById('modalBienBanThanhLy'));
                    const modalContent = document.getElementById('modalContent');

                    fetch(`/admin/hopdong/${hopdong.ma_hop_dong}/bien-ban-thanh-ly`)
                        .then(response => {
                            if (!response.ok) throw new Error('Không tải được nội dung');
                            return response.text();
                        })
                        .then(html => {
                            modalContent.innerHTML = html;
                            modal.show();
                        })
                        .catch(error => {
                            modalContent.innerHTML =
                                `<p class="text-danger">Lỗi khi tải nội dung: ${error.message}</p>`;
                            modal.show();
                        });
                    return;
                } else {
                    document.getElementById('formThanhLy').action =
                        `/admin/hopdong/thanhly/${hopdong.ma_hop_dong}`;

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

                    const tbody = document.querySelector('#hoaDonTable tbody');
                    tbody.innerHTML = '';
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

                    let tongNo = hoaDons.reduce((sum, hd) => {
                        const tien = parseFloat(hd.tong_tien);
                        return sum + (isNaN(tien) ? 0 : tien);
                    }, 0);
                    document.getElementById('tongNo').innerText = new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(tongNo);

                    function capNhatTongCong() {

                        const lyDo = document.querySelector('input[name="ly_do"]:checked')?.value;
                        if (lyDo === 'Khách bỏ cọc') {
                            document.getElementById('tongPhiPhat').innerText = '0 ₫';
                            document.getElementById('hoanCoc').innerText = '0 ₫';
                            document.getElementById('tongCong').innerText = '0 ₫';

                            document.getElementById('inputTongNo').value = 0;
                            document.getElementById('inputPhiPhat').value = 0;
                            document.getElementById('inputHoanTraCoc').value = 0;
                            document.getElementById('inputTongCong').value = 0;

                            return;
                        }
                        const phiPhat = Number(document.getElementById('phiPhat').value) || 0;
                        const hoanCoc = Number(document.getElementById('hoanTraCoc').value) || 0;

                        let tongCong = tongNo + phiPhat - hoanCoc;

                        document.getElementById('tongPhiPhat').innerText = new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(phiPhat);

                        document.getElementById('hoanCoc').innerText = new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(hoanCoc);

                        document.getElementById('tongCong').innerText = new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(tongCong);

                        document.getElementById('inputTongNo').value = tongNo;
                        document.getElementById('inputPhiPhat').value = phiPhat;
                        document.getElementById('inputHoanTraCoc').value = hoanCoc;
                        document.getElementById('inputTongCong').value = tongCong;
                    }

                    capNhatTongCong();

                    document.getElementById('phiPhat').addEventListener('input', capNhatTongCong);
                    document.getElementById('hoanTraCoc').addEventListener('input', capNhatTongCong);

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

                        document.getElementById('inputTongNo').value = 0;
                        document.getElementById('inputPhiPhat').value = 0;
                        document.getElementById('inputHoanTraCoc').value = 0;
                        document.getElementById('inputTongCong').value = 0;
                    } else {
                        thongTinCongNo.classList.remove('d-none');
                        capNhatTongCong();
                    }
                });
            });
        });


        function inNoiDungHopDong() {
            const noiDung = document.getElementById("noiDungHopDong").innerHTML;
            $('#modalChiTietHopDong').modal('hide');

            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                <head>
                    <title>Hợp đồng</title>
                    <style>
                        @page {
                            size: A4;
                            margin: 2cm 2cm 2cm 2.5cm;
                        }
                        body {
                            font-family: 'Times New Roman', Times, serif;
                            font-size: 13pt;
                            line-height: 1.5;
                            padding: 0;
                        }
                        p {
                            margin: 0 0 8pt 0;
                        }
                        ul {
                            margin: 0 0 8pt 20pt;
                            padding: 0;
                        }
                        li {
                            margin-bottom: 4pt;
                        }
                        .quoc-hieu {
                            text-align: center;
                            line-height: 1.5;
                        }
                        .quoc-hieu hr {
                            width: 40%;
                            border: 1px solid black;
                            margin: 5px auto;
                        }
                        .tieu-de {
                            text-align: center;
                            margin-top: 20px;
                        }
                        .chu-ky {
                            display: flex;
                            justify-content: space-between;
                            margin-top: 60px;
                            text-align: center;
                        }
                    </style>
                </head>
                <body>
                    ${noiDung}
                </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.onload = function() {
                printWindow.document.activeElement?.blur();

                setTimeout(function() {
                    printWindow.print();
                    printWindow.close();
                }, 200);
            };
        }

        function inNoiDungBienBan() {
            const noiDung = document.getElementById("modalContent").innerHTML;
            $('#modalBienBanThanhLy').modal('hide');

            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                <head>
                    <title>Biên bản thanh lý</title>
                    <style>
                        @page {
                            size: A4;
                            margin: 2cm 2cm 2cm 2.5cm;
                        }
                        body {
                            font-family: 'Times New Roman', Times, serif;
                            font-size: 13pt;
                            line-height: 1.5;
                            padding: 0;
                        }
                        p {
                            margin: 0 0 8pt 0;
                        }
                        ul {
                            margin: 0 0 8pt 20pt;
                            padding: 0;
                        }
                        li {
                            margin-bottom: 4pt;
                        }
                            .quoc-hieu {
                            text-align: center;
                            line-height: 1.5;
                        }
                        .quoc-hieu hr {
                            width: 40%;
                            border: 1px solid black;
                            margin: 5px auto;
                        }
                        .tieu-de {
                            text-align: center;
                            margin-top: 20px;
                        }
                        .chu-ky {
                            display: flex;
                            justify-content: space-between;
                            margin-top: 60px;
                            text-align: center;
                        }
                    </style>
                </head>
                <body>
                    ${noiDung}
                </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.onload = function() {
                printWindow.document.activeElement?.blur();

                setTimeout(function() {
                    printWindow.print();
                    printWindow.close();
                }, 200);
            };
        }
    </script>
@endpush

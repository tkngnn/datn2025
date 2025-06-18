@extends('admin.layouts.kt-app')
@section('title', 'Dashboard')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center mb-3">
                    <div class="col-sm">
                        <h1 class="page-header-title">Danh Sách Hóa Đơn <span
                                class="badge badge-soft-dark ml-2">{{ $hoaDons->count() }}</span></h1>
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
                            <a class="nav-link active" href="#">Tất cả hóa đơn</a>
                        </li>
                    </ul>
                    <!-- End Nav -->
                </div>
                <!-- End Nav Scroller -->
            </div>

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
                                {{-- <div class="hs-unfold mr-2">
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
                                            <img class="avatar avatar-xss avatar-4by3 mr-2" src="assets\svg\brands\pdf.svg"
                                                alt="Image Description">
                                            PDF
                                        </a>
                                    </div>
                                </div> --}}
                                <!-- End Unfold -->
                            </div>
                        </div>
                    </div>
                    <!-- End Row -->
                </div>
                <!-- End Header -->

                <!-- Table -->
                <!-- Table -->
                <div class="table-responsive datatable-custom">
                    <table id="datatable"
                        class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                        style="width: 100%"
                        data-hs-datatables-options='{
                            "columnDefs": [{
                                "targets": [-1,4],
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
                            "isShowPaging": true,
                            "pagination": "datatablePagination"
                        }'>
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Mã hóa đơn</th>
                                <th>Tháng năm</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($hoaDons as $hoaDon)
                                <tr>
                                    <td>#{{ $hoaDon->ma_hoa_don }}
                                        {{-- <span
                                            class="badge badge-soft-dark ml-2">{{ $hoaDon->hopDong->ma_hop_dong ?? 'Không có' }}</span> --}}
                                    </td>
                                    <td>{{ $hoaDon->thang_nam }}</td>
                                    <td>{{ number_format($hoaDon->tong_tien, 0, ',', '.') }} đ</td>
                                    <td>
                                        @if ($hoaDon->trang_thai === 'da thanh toan')
                                            <span class="badge badge-soft-success"> Đã thanh toán
                                            </span>
                                        @else
                                            <span class="badge badge-soft-danger"> Chưa thanh toán
                                            </span>
                                        @endif
                                        
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" style="gap: 0.5rem;">
                                            <!-- Nút Xem luôn hiện -->
                                            <a class="btn btn-sm btn-primary btn-xem-hoadon" href="javascript:;"
                                                data-hoadon='@json($hoaDon)'
                                                data-id="{{ $hoaDon->ma_hoa_don }}"
                                                data-export-url="{{ route('kt.hoadon', $hoaDon->ma_hoa_don) }}"
                                                data-toggle="tooltip" data-placement="top" title="Xem">
                                                <i class="tio-visible-outlined"></i>
                                            </a>

                                            <!-- Nút Thanh toán chỉ hiện khi trạng thái chưa thanh toán -->
                                            @if ($hoaDon->trang_thai !== 'da thanh toan')
                                                <a class="btn btn-sm btn-success btn-thanh-toan"
                                                    href="{{ route('kt.hoadon.thanh_toan', $hoaDon->ma_hoa_don) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Thanh toán">
                                                    <i class="tio-checkmark-circle"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Table -->

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

        <!-- HoaDon Modal Popup -->
      <div class="modal fade" id="hoadonModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Chi tiết hóa đơn</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body" id="modalBodyContent">
              <!-- Nội dung ở đây -->
              <div class="text-center">Đang tải...</div>
            </div>
          </div>
        </div>
      </div>
    <!-- End HoaDon Modal Popup -->

        <!-- Thanh Ly Modal -->
        {{-- <div class="modal fade" id="thanhLyModal" tabindex="-1" aria-labelledby="thanhLyModalLabel"
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
        </div> --}}

        <!-- End Thanh Ly Modal -->

        <!-- Biên Ban Thanh Ly Modal -->

        {{-- <div id="modalBienBanThanhLy" class="modal"
            style="display:none; position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5);">
            <div style="background: white; max-width: 800px; margin: 50px auto; padding: 20px; position: relative;">
                <button id="closeModal" style="position: absolute; top: 10px; right: 10px;">&times;</button>
                <div id="modalContent">
                    <!-- Nội dung biên bản thanh lý sẽ được load vào đây -->
                    Đang tải...
                </div>
            </div>
        </div> --}}


        <!-- End Biên Ban Thanh Ly Modal -->
    </main>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).on('click', '.btn-xem-hoadon', function () {
            const id = $(this).data('id');
            $('#modalBodyContent').html('<div class="text-center">Đang tải...</div>');
            $('#hoadonModal').modal('show');
        
            $('#modalBodyContent').load(`/kt/hoadon/preview/${id}`, function (response, status, xhr) {
                if (status === "error") {
                    $('#modalBodyContent').html('<div class="text-danger">Lỗi tải dữ liệu</div>');
                }
            });
        });
        </script>
@endpush

@extends('admin.layouts.app')
@section('title', 'Ghi chỉ số')
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-sm mb-2 mb-sm-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-no-gutter">
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Trang chủ</a></li>
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Ghi chỉ số</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Tổng quan</li>
                            </ol>
                        </nav>

                        <h1 class="page-header-title">Ghi chỉ số</h1>
                    </div>

                    <div class="col-sm-auto">
                        <a class="btn btn-primary" href="{{ route('admin.chiso.create') }}">
                            <i class="tio-user-add mr-1"></i> Ghi chỉ số
                        </a>
                    </div>
                </div>
                <!-- End Row -->
            </div>
            <!-- End Page Header -->
            @if ($chuaNhap > 0)
                <div class="alert alert-danger">
                    ⚠️ Có <strong>{{ $chuaNhap }}</strong> hóa đơn chưa nhập chỉ số điện, nước.
                </div>
            @else
                <div class="alert alert-success">
                    Đã nhập đủ hóa đơn
                </div>
            @endif
            <!-- Card -->
            <div class="card">
                <!-- Header -->
                <div class="card-header">
                    <div class="row justify-content-between align-items-center flex-grow-1">
                        <div class="col-sm-6 col-md-4 mb-3 mb-sm-0">
                            <form>
                                <!-- Search -->
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tio-search"></i>
                                        </div>
                                    </div>
                                    <input id="datatableSearch" type="search" class="form-control"
                                        placeholder="Tìm kiếm chỉ số" aria-label="Tìm kiếm chỉ số">
                                </div>
                                <!-- End Search -->
                            </form>
                        </div>

                        <div class="col-sm-6">
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
                                            <img class="avatar avatar-xss avatar-4by3 mr-2" src="assets\svg\brands\pdf.svg"
                                                alt="Image Description">
                                            PDF
                                        </a>
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
                                    {{-- <div class="custom-control custom-checkbox">
                    <input id="datatableCheckAll" type="checkbox" class="custom-control-input">
                    <label class="custom-control-label" for="datatableCheckAll"></label>
                  </div> --}}
                                </th>
                                <th class="table-column-pl-0">Mã yêu cầu</th>
                                <th>Văn phòng</th>
                                <th>Tên khách/Hợp đồng</th>
                                <th>Tháng</th>
                                <th>Số điện/nước cũ</th>
                                <th>Số điện mới</th>
                                <th>Số nước mới</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($hoadons as $hoadon)
                                @foreach ($hoadon->hopdong->chiTietHopDongs as $cthd)
                                    <tr>
                                        <td class="table-column-pr-0">
                                            {{-- <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="usersDataCheck1">
                        <label class="custom-control-label" for="usersDataCheck1"></label>
                      </div> --}}
                                        </td>
                                        <td>
                                            <a href="#">#{{ $hoadon->ma_hoa_don }}</a>
                                        </td>
                                        <td>{{ $cthd->vanphong->ten_van_phong }}
                                            <span
                                                class="d-block font-size-sm">{{ $cthd->vanphong->toanha->ten_toa_nha }}</span>
                                        </td>
                                        <td class="text-break px-3">{{ $hoadon->hopdong->user->name }}
                                            <span class="d-block font-size-sm">Mã hợp đồng:
                                                {{ $hoadon->hopdong->ma_hop_dong }}</span>
                                        </td>
                                        <td class="text-break px-3">{{ $hoadon->thang_nam }}</td>
                                        <td class="text-break px-3">{{ $hoadon->chi_so_dien_cu }} -
                                            {{ $hoadon->chi_so_nuoc_cu }}</td>
                                        <td class="text-break px-3">{{ $hoadon->so_dien }}</td>
                                        <td class="text-break px-3">{{ $hoadon->so_nuoc }}</td>
                                        <td class="text-break px-3">
                                            @if ($hoadon->so_dien && $hoadon->so_nuoc)
                                                <span class="legend-indicator bg-success"></span> Đã nhập
                                            @else
                                                <span class="legend-indicator bg-danger"></span> Chưa nhập
                                            @endif
                                        </td>
                                        <td class="text-break px-3">
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
                                    <option value="10">10</option>
                                    <option value="15" selected="">15</option>
                                    <option value="20">20</option>
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

    </main>
@endsection

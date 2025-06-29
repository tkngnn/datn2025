@extends('admin.layouts.app')
@section('title', 'Ghi chỉ số')
@section('content')
    <main id="content" role="main" class="main">
        @php
      $dangLoc = request()->has('ma_toa_nha') ||
        request()->has('thang_nam') ||
        request()->has('trang_thai');
    @endphp
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-sm mb-2 mb-sm-0">
                        <h1 class="page-header-title">Ghi điện nước</h1>
                    </div>

                    <div class="col-sm-auto">
                        <a class="btn btn-primary" href="{{ route('admin.chiso.create') }}" title="Ghi chỉ số điện nước">
                            <i class="tio-add"></i>
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

                        {{-- Tag nội dung đang lọc --}}
                        @if ($dangLoc)
                        <div class="hs-unfold mr-2">
                        <div class="d-flex flex-wrap gap-2">
                            <label class="font-weight-bold mr-1 mt-2">Bộ lọc: </label>
                            @if(request('ma_toa_nha'))
                            <span class="badge badge-soft-primary" style="padding: .8rem .8rem;">
                                {{ $dsToaNha->firstWhere('ma_toa_nha', request('ma_toa_nha'))?->ten_toa_nha ?? 'Không rõ' }}
                            </span>
                            @endif

                            @if(request('thang_nam'))
                            <span class="badge badge-soft-secondary" style="padding: .8rem .8rem;">
                                {{ \Carbon\Carbon::parse(request('thang_nam'))->format('m/Y') }}
                            </span>
                            @endif

                            @if(request('trang_thai'))
                            <span class="badge badge-soft-warning" style="padding: .8rem .8rem;">
                                {{ request('trang_thai') == 'da nhap' ? 'Đã nhập' : 'Chưa nhập' }}
                            </span>
                            @endif
                        </div>
                        </div>
                    @endif
                    <div class="col-auto">
                    <!-- Unfold -->
                    <div class="hs-unfold mr-2">
                        <a class="js-hs-unfold-invoker btn btn-soft-primary" href="javascript:;"
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
                    @if ($dangLoc)
                        <div class="hs-unfold mr-2">
                            <a href="{{ url()->current() }}" class="btn btn-outline-secondary ml-2">
                                <i class="tio-clear"></i> Đặt lại bộ lọc
                            </a>
                        </div>
                        @endif
                    <!-- End Unfold -->
                    </div>

                    <!-- Sidebar filter -->
                    <div id="datatableFilterSidebar" class="hs-unfold-content sidebar sidebar-bordered sidebar-box-shadow">
                    <div class="card mb-5">
                        <div class="card-header">
                        <h5 class="mb-0">Bộ lọc</h5>
                        </div>
                        <div class="card-body">
                        <form method="GET" action="{{ route('admin.chiso.index') }}">
                            {{-- Tòa nhà --}}
                            <div class="form-group">
                            <label for="ma_toa_nha">Tòa nhà</label>
                            <select name="ma_toa_nha" id="ma_toa_nha" class="form-control selectpicker" data-live-search="true" title="Chọn tòa nhà">
                                <option value="">-- Tất cả --</option>
                                @foreach($dsToaNha as $toaNha)
                                <option value="{{ $toaNha->ma_toa_nha }}" {{ request('ma_toa_nha') == $toaNha->ma_toa_nha ? 'selected' : '' }}>
                                    {{ $toaNha->ten_toa_nha }}
                                </option>
                                @endforeach
                            </select>
                            </div>

                            {{-- Tháng năm --}}
                            <div class="form-group">
                            <label for="thang_nam">Tháng năm</label>
                            <input type="month" name="thang_nam" id="thang_nam" class="form-control"
                                    value="{{ request('thang_nam') }}">
                            </div>

                            {{-- Trạng thái --}}
                            <div class="form-group">
                            <label for="trang_thai">Trạng thái</label>
                            <select name="trang_thai" id="trang_thai" class="form-control selectpicker" data-live-search="true" title="Chọn trạng thái">
                                <option value="">-- Tất cả --</option>
                                <option value="da nhap" {{ request('trang_thai') == 'da nhap' ? 'selected' : '' }}>Đã nhập</option>
                                <option value="chua nhap" {{ request('trang_thai') == 'chua nhap' ? 'selected' : '' }}>Chưa nhập</option>
                            </select>
                            </div>
                    
                            <button type="submit" class="btn btn-primary btn-block mt-3">Lọc</button>
                        </form>
                        </div>
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
                                <th class="table-column-pl-0">Mã hóa đơn</th>
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
                                            <a href="#">{{ $hoadon->ma_hoa_don }}</a>
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
                                        <td class="text-break px-3 text-center">{{ $hoadon->chi_so_dien_cu }} -
                                            {{ $hoadon->chi_so_nuoc_cu }}</td>
                                        <td class="text-break px-3 text-center">{{ $hoadon->so_dien }}</td>
                                        <td class="text-break px-3 text-center">{{ $hoadon->so_nuoc }}</td>
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

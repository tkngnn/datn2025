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
                    <div class="col-sm mb-2 mb-sm-0">
                        <h1 class="page-header-title">Tòa nhà <span
                                class="badge badge-soft-dark ml-2">{{ $dsToaNha->count() }}</span></h1>
                    </div>

                    <div class="col-sm-auto">
                        <a class="btn btn-primary" href="{{ route('admin.toanha.create') }}">Tạo tòa nhà</a>
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
                    <ul class="nav nav-tabs page-header-tabs" id="pageHeaderTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Tất cả tòa nhà</a>
                        </li>
                    </ul>
                    <!-- End Nav -->
                </div>
                <!-- End Nav Scroller -->
            </div>
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
                // Sau 5 giây (5000ms), tự động ẩn các alert có class `.alert`
                setTimeout(function() {
                    const alerts = document.querySelectorAll('.alert');
                    alerts.forEach(alert => {
                        // Sử dụng Bootstrap class để fade out
                        alert.classList.remove('show');
                        alert.classList.add('fade');
                        setTimeout(() => alert.remove(), 300); // Xóa khỏi DOM sau khi fade xong
                    });
                }, 5000);
            </script>

            <div class="row justify-content-end mb-3">
                <div class="col-lg">
                    <!-- Datatable Info -->
                    <div id="datatableCounterInfo" style="display: none;">
                        <div class="d-sm-flex justify-content-lg-end align-items-sm-center">
                            <span class="d-block d-sm-inline-block font-size-sm mr-3 mb-2 mb-sm-0">
                                <span id="datatableCounter">0</span>
                                Selected
                            </span>
                            <a class="btn btn-sm btn-outline-danger mb-2 mb-sm-0 mr-2" href="javascript:;">
                                <i class="tio-delete-outlined"></i> Delete
                            </a>
                            <a class="btn btn-sm btn-white mb-2 mb-sm-0 mr-2" href="javascript:;">
                                <i class="tio-archive"></i> Archive
                            </a>
                            <a class="btn btn-sm btn-white mb-2 mb-sm-0 mr-2" href="javascript:;">
                                <i class="tio-publish"></i> Publish
                            </a>
                            <a class="btn btn-sm btn-white mb-2 mb-sm-0" href="javascript:;">
                                <i class="tio-clear"></i> Unpublish
                            </a>
                        </div>
                    </div>
                    <!-- End Datatable Info -->
                </div>
            </div>
            <!-- End Row -->

            <!-- Card -->
            <div class="card">
                <!-- Header -->
                <div class="card-header">
                    <div class="row justify-content-between align-items-center flex-grow-1">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <form>
                                <!-- Search -->
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tio-search"></i>
                                        </div>
                                    </div>
                                    <input id="datatableSearch" type="search" class="form-control"
                                        placeholder="Tìm kiếm toà nhà" aria-label="Tìm kiếm toà nhà"
                                        aria-describedby="datatableSearch"
                                        data-hs-datatables-options='{
                                         "isSearchable": true,
                                         "smartPositionOff": true
                                        }'>
                                </div>
                                <!-- End Search -->
                            </form>
                        </div>

                        <div class="col-auto">
                            <!-- Unfold -->
                            <div class="hs-unfold mr-2">
                                <a class="js-hs-unfold-invoker btn btn-white" href="javascript:;" title="Lọc"
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
                                <a href="{{ url()->current() }}" class="btn btn-outline-secondary ml-2">
                                    <i class="tio-clear"></i> Đặt lại bộ lọc
                                </a>
                            </div>
                            <!-- End Unfold -->
                        </div>


                        <!-- Sidebar filter -->
                        <div id="datatableFilterSidebar"
                            class="hs-unfold-content sidebar sidebar-bordered sidebar-box-shadow">
                            <div class="card mb-5">
                                <div class="card-header">
                                    <h5 class="mb-0">Lọc theo trạng thái</h5>
                                </div>
                                <div class="card-body">
                                    <form method="GET" action="{{ route('admin.toanha.index') }}">
                                        <div class="form-group">
                                            <label for="filterStatus">Trạng thái</label>
                                            <select name="trang_thai" id="filterStatus" class="form-control selectpicker"
                                                data-live-search="true" title="Chọn trạng thái">
                                                <option value="">-- Tất cả --</option>
                                                <option value="hoat dong"
                                                    {{ request('trang_thai') == 'hoat dong' ? 'selected' : '' }}>Hoạt động
                                                </option>
                                                <option value="khong hoat dong"
                                                    {{ request('trang_thai') == 'khong hoat dong' ? 'selected' : '' }}>Tạm
                                                    ngưng
                                                </option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">Lọc</button>
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
                        class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                        data-hs-datatables-options='{
                           "columnDefs": [{"targets": [0, 7], "width": "5%", "orderable": false}],
                           "order": [],
                           "info": {"totalQty": "#datatableWithPaginationInfoTotalQty"},
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
                                    {{-- <div class="custom-control custom-checkbox">
                                        <input id="datatableCheckAll" type="checkbox" class="custom-control-input">
                                        <label class="custom-control-label" for="datatableCheckAll"></label>
                                    </div> --}}
                                </th>
                                <th class="table-column-pl-0">Mã tòa nhà</th>
                                <th>Tên Tòa Nhà</th>
                                <th>Địa Chỉ</th>
                                <th>Số Tầng</th>
                                <th>Số Văn Phòng</th>
                                <th>Trạng Thái</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($dsToaNha as $item)
                                <tr>
                                    <td class="table-column-pr-0">
                                        {{-- <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                id="check-{{ $item->ma_toa_nha }}">
                                            <label class="custom-control-label"
                                                for="check-{{ $item->ma_toa_nha }}"></label>
                                        </div> --}}
                                    </td>
                                    <td class="table-column-pl-0">
                                        <a href="javascript:;" 
                                           class="btn-xem-toanha"
                                           data-id="{{ $item->ma_toa_nha }}">
                                            {{ $item->ma_toa_nha }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:;" 
                                           class="btn-xem-toanha text-body"
                                           data-id="{{ $item->ma_toa_nha }}">
                                            {{ $item->ten_toa_nha }}
                                        </a>
                                    </td>                                                                       
                                    <td style="max-width: 300px; white-space: normal; word-break: break-word;">{{ $item->dia_chi }}</td>
                                    <td >{{ $item->so_tang }}</td>
                                    <td><a href="{{ route('admin.vanphong.index', ['ma_toa_nha' => $item->ma_toa_nha]) }}" title="Xem danh sách văn phòng của tòa nhà" class="text-body">{{ $item->van_phongs_count }}</a></td>
                                    <td>
                                        @if ($item->trang_thai === 'hoat dong')
                                            <span class="badge badge-success">Hoạt động</span>
                                        @else
                                            <span class="badge badge-warning">Không hoạt động</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-break px-3">
                                            <a class="btn btn-sm btn-white"
                                                href="{{ route('admin.toanha.edit', $item->ma_toa_nha) }}">
                                                <i class="tio-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.vanphong.index', ['ma_toa_nha' => $item->ma_toa_nha]) }}" class="btn btn-sm btn-primary" title="Xem danh sách văn phòng của tòa nhà">
                                                <i class="tio-visible-outlined"></i>
                                              </a>
                                            {{-- <form action="{{ route('admin.toanha.destroy', $item->ma_toa_nha) }}"
                                                method="POST" onsubmit="return confirm('Xác nhận ẩn tòa nhà này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-white">
                                                    <i class="tio-delete-outlined"></i>
                                                </button>
                                            </form> --}}
                                        </div>
                                    </td>
                                </tr>
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
        <!-- ToaNha Modal Popup -->
        <div class="modal fade" id="toaNhaModal" tabindex="-1" aria-labelledby="toaNhaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"></h5>
                  <button type="button" class="btn btn-close btn-sm btn-ghost-secondary" data-bs-dismiss="modal" aria-label="Đóng">
                    <i class="tio-clear tio-lg"></i>
                  </button>
                </div>
                <div class="modal-body" id="toaNhaModalContent">
                  <div class="text-center">Đang tải...</div>
                </div>
              </div>
            </div>
          </div>          
        <!-- End ToaNha Modal Popup --> 
    </main>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Bootstrap Select
            $('.selectpicker').selectpicker();
        });

        $(document).on('click', '.btn-xem-toanha', function () {
            const id = $(this).data('id');
            $('#toaNhaModalContent').html('<div class="text-center">Đang tải...</div>');
            $('#toaNhaModal').modal('show');

            $('#toaNhaModalContent').load(`/admin/toanha/preview/${id}`, function (response, status, xhr) {
                if (status === "error") {
                    $('#toaNhaModalContent').html('<div class="text-danger">Không thể tải thông tin tòa nhà.</div>');
                }
            });
        });
    </script>
@endpush

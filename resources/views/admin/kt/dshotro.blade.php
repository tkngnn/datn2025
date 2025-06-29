@extends('admin.layouts.kt-app')
@section('title', 'Yêu cầu hỗ trợ')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        @php
      $dangLoc = request()->has('trang_thai');
    @endphp
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center mb-3">
                    <div class="col-sm">
                        <h1 class="page-header-title">Danh Sách Yêu Cầu Hỗ Trợ <span
                                class="badge badge-soft-dark ml-2">{{ $hoTros->count() }}</span></h1>
                    </div>

                    <div class="col-sm-auto">
                        <a class="btn btn-primary" href="{{ route('kt.hotro.create') }}">
                            <i class="tio-message-add mr-1"></i> Gửi yêu cầu hỗ trợ
                        </a>
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
                            <a class="nav-link active" href="#">Tất cả yêu cầu</a>
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
                                        placeholder="Tìm kiếm yêu cầu hỗ trợ" aria-label="Tìm kiếm yêu cầu hỗ trợ">
                                </div>
                                <!-- End Search -->
                            </form>
                        </div>

                        {{-- Tag nội dung đang lọc --}}
                        @if ($dangLoc)
                        <div class="hs-unfold mr-2">
                            <div class="d-flex flex-wrap gap-2">
                            <label class="font-weight-bold mr-1 mt-2">Bộ lọc: </label>

                            @if(request('trang_thai'))
                                <span class="badge badge-soft-warning" style="padding: .8rem .8rem;">
                                {{ request('trang_thai') == 'da xu ly' ? 'Đã xử lý' : 'Chưa xử lý' }}
                                </span>
                            @endif
                            </div>
                        </div>
                        @endif

                        <div class="col-auto">
                            <!-- Unfold -->
                            <div class="hs-unfold mr-2">
                                <a class="js-hs-unfold-invoker btn btn-soft-primary" href="javascript:;"title="Lọc"
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
                                <form method="GET" action="{{ route('kt.hotro') }}">
                                    {{-- Trạng thái --}}
                                    <div class="form-group">
                                    <label for="trang_thai">Trạng thái</label>
                                    <select name="trang_thai" id="trang_thai" class="form-control selectpicker" data-live-search="true" title="Chọn trạng thái">
                                        <option value="">-- Tất cả --</option>
                                        <option value="da xu ly" {{ request('trang_thai') == 'da xu ly' ? 'selected' : '' }}>Đã xử lý</option>
                                        <option value="chua xu ly" {{ request('trang_thai') == 'chua xu ly' ? 'selected' : '' }}>Chưa xử lý</option>
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
                <!-- Table -->
                <div class="table-responsive datatable-custom">
                    <table id="datatable"
                        class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                        style="width: 100%"
                        data-hs-datatables-options='{
                            "columnDefs": [{
                                "targets": [-1,5],
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
                                <th scope="col">Mã yêu cầu</th>
                                <th>Tiêu đề</th>
                                <th>Nội dung</th>
                                <th>Ngày gửi</th>
                                <th>Trạng thái</th>
                                <th>Ghi chú</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($hoTros as $hoTro)
                                <tr>
                                    <td>
                                        <a href="#">{{ $hoTro->ma_yeu_cau }}</a>
                                    </td>
                                    <td style="max-width: 300px; white-space: normal; word-break: break-word;">
                                        {{ $hoTro->tieu_de }}</td>
                                    <td style="max-width: 300px; white-space: normal; word-break: break-word;">
                                        {{ $hoTro->noi_dung }}</td>
                                    <td>{{ \Carbon\Carbon::parse($hoTro->thoi_gian_gui)->format('d-m-Y') }}</td>
                                    <td>
                                        @if ($hoTro->trang_thai_xu_ly === 'da xu ly')
                                            <span class="badge badge-soft-success"> Đã xử lý
                                            </span>
                                        @else
                                            <span class="badge badge-soft-danger"> Chưa xử lý
                                            </span>
                                        @endif

                                    </td>
                                    <td style="max-width: 300px; white-space: normal; word-break: break-word;">
                                        {{ $hoTro->ghi_chu_xu_ly ?? 'Không có' }}</td>
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

        <!-- hoTro Modal Popup -->
        <div class="modal fade" id="hoTroModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Chi tiết hợp đồng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body" id="modalBodyContent">
                        <!-- Nội dung ở đây -->
                        <div class="text-center">Đang tải...</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End hoTro Modal Popup -->

    </main>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).on('click', '.btn-xem-hoTro', function() {
            const id = $(this).data('id');
            $('#modalBodyContent').html('<div class="text-center">Đang tải...</div>');
            $('#hoTroModal').modal('show');

            $('#modalBodyContent').load(`/kt/hoTro/preview/${id}`, function(response, status, xhr) {
                if (status === "error") {
                    $('#modalBodyContent').html('<div class="text-danger">Lỗi tải dữ liệu</div>');
                }
            });
        });
    </script>
@endpush

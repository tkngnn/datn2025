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
                <h1 class="page-header-title">Hỗ trợ</h1>

                <!-- Nav -->
                <ul class="nav nav-tabs page-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            Danh sách yêu cầu
                            <span class="badge badge-soft-dark badge-pill ml-1">Chưa xử lý
                                {{ $yeuCaus->where('trang_thai_xu_ly', 'chua xu ly')->count() }} /
                                {{ $yeuCaus->count() }}</span>
                        </a>
                    </li>
                </ul>
                <!-- End Nav -->
            </div>
            <!-- End Page Header -->

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
                                        placeholder="Tìm kiếm hỗ trợ" aria-label="Tìm kiếm hỗ trợ">
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
                                        <a class="btn btn-sm btn-outline-danger mr-2" href="javascript:;">
                                            <i class="tio-delete-outlined"></i> Delete
                                        </a>
                                        <a class="btn btn-sm btn-primary" href="javascript:;">
                                            <i class="tio-publish"></i> Publish
                                        </a>
                                    </div>
                                </div>
                                <!-- End Datatable Info -->

                                <!-- Select -->
                                <select class="js-select2-custom js-datatable-filter custom-select-sm dropdown-menu-lg-left"
                                    size="1" style="opacity: 0;" data-target-column-index="5"
                                    data-hs-select2-options='{
                          "minimumResultsForSearch": "Infinity",
                          "customClass": "custom-select custom-select-lg btn-ghost-primary btn-outline-primary",
                          "dropdownAutoWidth": true,
                          "width": true,
                          "placeholder": "Lọc trạng thái"
                        }'>
                                    <option value="">All</option>
                                    <option value="đã xử lý">Đã xử lý</option>
                                    <option value="chưa xử lý">Chưa xử lý</option>
                                </select>
                                <!-- End Select -->
                            </div>
                        </div>
                    </div>
                    <!-- End Row -->
                </div>
                <!-- End Header -->

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
                            if (alert.id !== 'noDebtMessage') {
                                alert.classList.remove('show');
                                alert.classList.add('fade');
                                setTimeout(() => alert.remove(), 300);
                            }
                        });
                    }, 5000);
                </script>

                <!-- Table -->
                <div class="table-responsive datatable-custom">
                    <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap card-table"
                        data-hs-datatables-options='{
                   "columnDefs": [{
                      "targets": [0, 3, 6],
                      "orderable": false
                    }],
                   "order": [],
                   "info": {
                     "totalQty": "#datatableWithPaginationInfoTotalQty"
                   },
                   "search": "#datatableSearch",
                   "entries": "#datatableEntries",
                   "pageLength": 5,
                   "isResponsive": false,
                   "isShowPaging": true,
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
                                <th>Mã</th>
                                <th>Khách hàng</th>
                                <th>Yêu cầu</th>
                                <th>Thời gian gửi</th>
                                <th>Trạng thái</th>
                                <th>Ghi chú</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($yeuCaus as $yeuCau)
                                <tr>
                                    <td class="table-column-pr-0">
                                        {{-- <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                id="yeuCauCheck{{ $yeuCau->ma_yeu_cau }}">
                                            <label class="custom-control-label"
                                                for="yeuCauCheck{{ $yeuCau->ma_yeu_cau }}"></label>
                                        </div> --}}
                                    </td>
                                    <td>
                                        <a href="#">#{{ $yeuCau->ma_yeu_cau }}</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-soft-primary avatar-circle">
                                                <span class="avatar-initials">
                                                    {{ strtoupper(substr($yeuCau->user->name ?? 'N/A', 0, 1)) }}
                                                </span>
                                            </div>
                                            <div class="ml-3">
                                                <span class="d-block h5 text-hover-primary mb-0">
                                                    {{ $yeuCau->user->name ?? 'Không rõ' }}
                                                </span>
                                                <span class="d-block font-size-sm text-body">
                                                    {{ $yeuCau->user->email ?? '-' }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-break">
                                        {{-- Hiển thị tiêu đề và nội dung yêu cầu --}}
                                        <strong class="text-wrap">{{ $yeuCau->tieu_de }}</strong><br>
                                        <span
                                            class="text-muted text-truncate">{{ \Illuminate\Support\Str::limit($yeuCau->noi_dung, 30) }}</span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($yeuCau->thoi_gian_gui)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @if ($yeuCau->trang_thai_xu_ly === 'da xu ly')
                                            <span class="badge badge-soft-success">Đã xử lý</span>
                                        @elseif ($yeuCau->trang_thai_xu_ly === 'chua xu ly')
                                            <span class="badge badge-soft-warning">Chưa xử lý</span>
                                        @else
                                            <span class="badge badge-soft-secondary">{{ $yeuCau->trang_thai_xu_ly }}</span>
                                        @endif
                                    </td>
                                    <td class="text-truncate" style="max-width: 150px;">{{ $yeuCau->ghi_chu_xu_ly ?? '-' }}</td>
                                    <td>
                                        <div class="hs-unfold">
                                            <a class="js-hs-unfold-invoker btn btn-icon btn-sm btn-ghost-secondary rounded-circle"
                                                href="javascript:;"
                                                data-hs-unfold-options='{
                                                    "target": "#actionDropdown{{ $yeuCau->ma_yeu_cau }}",
                                                    "type": "css-animation"
                                                }'>
                                                <i class="tio-more-horizontal"></i>
                                            </a>

                                            <div id="actionDropdown{{ $yeuCau->ma_yeu_cau }}"
                                                class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right mt-1">
                                                <a href="javascript:;" class="dropdown-item btn-view-detail"
                                                    data-id="{{ $yeuCau->ma_yeu_cau }}">
                                                    <i class="tio-visible dropdown-item-icon"></i> Xem chi tiết
                                                </a>
                                                @if ($yeuCau->trang_thai_xu_ly === 'chua xu ly')
                                                    {{-- Chỉ hiện nếu chưa xử lý --}}
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        onclick="openEditModal({{ $yeuCau->ma_yeu_cau }})">
                                                        <i class="tio-edit dropdown-item-icon"></i> Sửa (popup)
                                                    </a>
                                                @endif
                                                <form action="{{ route('admin.hotro.destroy', $yeuCau->ma_yeu_cau) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa yêu cầu này không?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" type="submit">
                                                        <i class="tio-delete-outlined dropdown-item-icon"></i> Xóa
                                                    </button>
                                                </form>
                                            </div>
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
                                    <option value="5" selected="">5</option>
                                    <option value="7">7</option>
                                    <option value="12">12</option>
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

        <!-- Modal Xem chi tiết -->
        <!-- Modal Chi tiết Yêu cầu -->
        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Chi tiết</h5>
                        <button type="button" class="btn btn-icon btn-xs btn-ghost-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="tio-clear tio-lg"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- Nội dung chi tiết sẽ load vào đây -->
                        <div id="detailContent">Đang tải...</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Chi tiết Yêu cầu -->

        <!-- Model chỉnh sửa -->
        <!-- Modal Chỉnh sửa Yêu cầu -->
        {{-- <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Chỉnh sửa yêu cầu</h5>
                        <button type="button" class="btn btn-icon btn-xs btn-ghost-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="tio-clear tio-lg"></i>
                        </button>
                    </div>

                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body" id="editContent">
                            
                            Đang tải form chỉnh sửa...
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        </div>
                    </form>

                </div>
            </div>
        </div> --}}
        <!-- End Modal Chỉnh sửa -->
        <!-- Modal Chỉnh sửa Yêu cầu -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Chỉnh sửa yêu cầu</h5>
                        <button type="button" class="btn btn-icon btn-xs btn-ghost-dark" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="tio-clear tio-lg"></i>
                        </button>
                    </div>

                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body" id="editContent">
                            <!-- Nội dung form chỉnh sửa sẽ được load ở đây bằng JS/AJAX -->
                            Đang tải form chỉnh sửa...
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- End Modal Chỉnh sửa -->

    </main>
    <!-- ========== END MAIN CONTENT ========== -->

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.selectpicker').selectpicker();

        });

        document.addEventListener('DOMContentLoaded', function() {
            const detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
            const detailContent = document.getElementById('detailContent');

            document.querySelectorAll('.btn-view-detail').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    detailContent.innerHTML = 'Đang tải...';

                    fetch(`/admin/hotro/${id}`)
                        .then(response => {
                            if (!response.ok) throw new Error('Network response was not ok');
                            return response.text();
                        })
                        .then(html => {
                            detailContent.innerHTML = html;
                            detailModal.show();
                        })
                        .catch(err => {
                            detailContent.innerHTML =
                                '<p class="text-danger">Không tải được chi tiết. Vui lòng thử lại.</p>';
                            console.error(err);
                        });
                });
            });
        });

        function openEditModal(id) {
            // $('#editModal').modal('show');
            const modalElement = document.getElementById('editModal');
            const bsModal = new bootstrap.Modal(modalElement);
            bsModal.show();
            $('#editContent').html('Đang tải...');

            $.ajax({
                url: `/admin/hotro/${id}/edit`, // route trả về view partial form
                type: 'GET',
                success: function(response) {
                    $('#editContent').html(response); // đổ form vào modal
                    $('#editForm').attr('action', `/admin/hotro/${id}`); // cập nhật action của form
                },
                error: function() {
                    $('#editContent').html('<p class="text-danger">Không thể tải dữ liệu.</p>');
                }
            });

        }
    </script>
@endpush

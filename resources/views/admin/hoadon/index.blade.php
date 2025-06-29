@extends('admin.layouts.app')
@section('title', 'Hóa đơn')
@section('content')
<main id="content" role="main" class="main">
  @php
      $dangLoc = request()->has('ma_toa_nha') ||
        request()->has('thang_nam') ||
        request()->has('gia_thue_min') ||
        request()->has('gia_thue_max') ||
        request()->has('trang_thai');
    @endphp
    <!-- Content -->
    <div class="content container-fluid">

      @if (session('success'))
            <div id="toastSuccess" class="alert alert-success alert-dismissible fade show"
                role="alert"
                style="position: fixed; top: 20px; right: 20px; z-index: 1050; min-width: 300px;">
              <strong>{{ session('success') }}</strong>
              <button type="button" class="close" aria-label="Close" onclick="$('#toastSuccess').hide()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <script>
              setTimeout(function() {
                $('#toastSuccess').fadeOut();
              }, 7000);
            </script>
        @endif

      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Hóa đơn</h1>
          </div>
        </div>
        <!-- End Row -->
      </div>
      <!-- End Page Header -->
      @if ($chuaThanhToan > 0)
        <div class="alert alert-danger">
            ⚠️ Có <strong>{{ $chuaThanhToan }}</strong> hóa đơn chưa thanh toán.
        </div>
    @else
        <div class="alert alert-success">
            Không có hóa đơn nào chưa thanh toán
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
                  <input id="datatableSearch" type="search" class="form-control" placeholder="Tìm kiếm hóa đơn" aria-label="Tìm kiếm hóa đơn">
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

                  @if(request('gia_thue_min') || request('gia_thue_max'))
                    <span class="badge badge-soft-success" style="padding: .8rem .8rem;">
                      Giá thuê:
                      {{ request('gia_thue_min') ?? '...' }} - {{ request('gia_thue_max') ?? '...' }} VND/m²
                    </span>
                  @endif

                  @if(request('thang_nam'))
                    <span class="badge badge-soft-secondary" style="padding: .8rem .8rem;">
                      {{ \Carbon\Carbon::parse(request('thang_nam'))->format('m/Y') }}
                    </span>
                  @endif

                  @if(request('trang_thai'))
                    <span class="badge badge-soft-warning" style="padding: .8rem .8rem;">
                      {{ request('trang_thai') == 'da thanh toan' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
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
                      <i class="tio-refresh"></i>
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
                <form method="GET" action="{{ route('admin.hoadon.index') }}">

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
          
                  <div class="form-group">
                    <label>Tiền</label>
                    <div class="input-group">
                      <input type="text" name="gia_thue_min" class="form-control format-money" placeholder="Từ" value="{{ request('gia_thue_min') }}">
                      <input type="text" name="gia_thue_max" class="form-control format-money" placeholder="Đến" value="{{ request('gia_thue_max') }}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="thang_nam">Tháng năm</label>
                    <input type="month" name="thang_nam" id="thang_nam" class="form-control"
                          value="{{ request('thang_nam') }}">
                  </div>

                  <div class="form-group">
                    <label for="trang_thai">Trạng thái</label>
                    <select name="trang_thai" id="trang_thai" class="form-control selectpicker" data-live-search="true" title="Chọn trạng thái">
                      <option value="">-- Tất cả --</option>
                      <option value="da thanh toan" {{ request('trang_thai') == 'da thanh toan' ? 'selected' : '' }}>Đã thanh toán</option>
                      <option value="chua thanh toan" {{ request('trang_thai') == 'chua thanh toan' ? 'selected' : '' }}>Chưa thanh toán</option>
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
          <table id="datatable" class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table" data-hs-datatables-options='{
                   "columnDefs": [{
                      "targets": [0, 7],
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
                <th class="table-column-pl-0">Mã hóa đơn</th>
                <th>Tên khách/Hợp đồng</th>
                <th>Văn phòng</th>
                <th>Tháng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($hoadons as $hoadon)
                @foreach ($hoadon->hopdong->chiTietHopDongs as $cthd)
                  <tr>
                    <td class="table-column-pr-0">
                    </td>
                    <td>
                      <a href="javascript:;" class="btn-xem-hoadon" title="Xem" data-ma_hoa_don="{{ $hoadon->ma_hoa_don }}">{{ $hoadon->ma_hoa_don }}</a>
                    </td>
                    <td class="text-break px-3">{{ $hoadon->hopdong->user->name }}
                      <span class="d-block font-size-sm">Mã hợp đồng: {{ $hoadon->hopdong->ma_hop_dong }}</span>
                    </td>
                    <td>{{ $cthd->vanphong->ten_van_phong }}
                      <span class="d-block font-size-sm">{{ $cthd->vanphong->toanha->ten_toa_nha }}</span>
                    </td>
                    <td class="text-break px-3">{{ $hoadon->thang_nam}}</td>
                    <td>{{ number_format($hoadon->tong_tien, 0, ',', '.') }}</td>
                    <td class="text-break px-3">
                      <div>
                        @if ($hoadon->trang_thai === 'da thanh toan')
                            <span class="badge badge-success">Đã thanh toán</span> 
                        @else
                            <span class="badge badge-danger">Chưa thanh toán</span> 
                        @endif
                      </div>
                      <div>
                        @if ($hoadon->so_ngay_qua_han > 0)
                          <small class="text-muted">Số ngày quá hạn: {{ $hoadon->so_ngay_qua_han }} ngày</small>
                        @endif
                      </div>
                    </td>
                    <td class="text-break px-3">
                      <div>
                        <a class="btn btn-sm btn-soft-primary btn-xem-hoadon" title="Xem" data-ma_hoa_don="{{ $hoadon->ma_hoa_don }}">
                          <i class="tio-visible-outlined"></i>
                        </a>
                        @if ($hoadon->so_ngay_qua_han > 0)
                          <form action="{{ route('admin.hoadon.guimail') }}" method="POST" style="display: inline-block;">
                              @csrf
                              <input type="hidden" name="ma_hoa_don" value="{{ $hoadon->ma_hoa_don }}">
                              <button type="submit" class="btn btn-sm btn-soft-success" title="Gửi mail">
                                <i class="tio-email"></i>
                              </button>
                            </form>
                        @endif
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
                <select id="datatableEntries" class="js-select2-custom" data-hs-select2-options='{
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

    <!-- HopDong Modal Popup -->
      <div class="modal fade" id="hoadonModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"></h5>
              <button type="button" class="btn btn-close btn-sm btn-ghost-secondary" data-bs-dismiss="modal" aria-label="Đóng">
                <i class="tio-clear tio-lg"></i>
              </button>
            </div>
            <div class="modal-body" id="modalBodyContent">
              <div class="text-center">Đang tải...</div>
            </div>
          </div>
        </div>
      </div>
    <!-- End HopDong Modal Popup -->
  </main>
  
@endsection
@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).on('click', '.btn-xem-hoadon', function () {
        const id = $(this).data('ma_hoa_don');
        $('#modalBodyContent').html('<div class="text-center">Đang tải...</div>');
        $('#hoadonModal').modal('show');
    
        $('#modalBodyContent').load(`/admin/hoadon/preview/${id}`, function (response, status, xhr) {
            if (status === "error") {
                $('#modalBodyContent').html('<div class="text-danger">Lỗi tải dữ liệu</div>');
            }
        });
    });
    </script>
@endpush
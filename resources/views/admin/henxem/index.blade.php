@extends('admin.layouts.app')
@section('title', 'Hẹn xem')
@section('content')
<main id="content" role="main" class="main">
  @php
      $dangLoc = request()->has('trang_thai');
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
            <h1 class="page-header-title">Hẹn xem</h1>
          </div>
        </div>
        <!-- End Row -->
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
                  <input id="datatableSearch" type="search" class="form-control" placeholder="Tìm kiếm yêu cầu hẹn xem" aria-label="Tìm kiếm yêu cầu hẹn xem">
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
                  @if (request('trang_thai') == 'chua xu ly')
                    <span class="badge badge-soft-secondary" style="padding: .8rem .8rem;">
                    Chưa xử lý
                    </span>
                  @elseif (request('trang_thai') == 'da xu ly')
                    <span class="badge badge-soft-success" style="padding: .8rem .8rem;">
                      Đã xử lý
                    </span>
                    @elseif (request('trang_thai') == 'dang xu ly')
                    <span class="badge badge-soft-warning" style="padding: .8rem .8rem;">
                      Đang xử lý
                    </span>
                  @else
                    <span class="badge badge-soft-danger" style="padding: .8rem .8rem;">
                      Đã hủy
                    </span>
                  @endif
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
                    <form method="GET" action="{{ route('admin.henxem.index') }}">
                        <div class="form-group">
                        <label for="trang_thai">Trạng thái</label>
                        <select name="trang_thai" id="trang_thai" class="form-control selectpicker" data-live-search="true" title="Chọn trạng thái">
                            <option value="">-- Tất cả --</option>
                            <option value="da xu ly" {{ request('trang_thai') == 'da xu ly' ? 'selected' : '' }}>Đã xử lý</option>
                            <option value="dang xu ly" {{ request('trang_thai') == 'dang xu ly' ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="chua xu ly" {{ request('trang_thai') == 'chua xu ly' ? 'selected' : '' }}>Chưa xử lý</option>
                            <option value="da huy" {{ request('trang_thai') == 'da huy' ? 'selected' : '' }}>Đã hủy</option>
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
                      "targets": [0, 8],
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
                <th class="table-column-pl-0">Mã hẹn</th>
                <th>Tên khách/Email</th>
                <th>Số điện thoại</th>
                <th>Tên văn phòng</th>
                <th>Ngày hẹn</th>
                <th>Ghi chú</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($henxems as $henxem)
                <tr>
                  <td >
                  </td>
                  <td class="table-column-pr-0">
                    <a href="#">{{ $henxem->ma_hen_xem }}</a>
                  </td>
                  <td class="text-break px-3">{{ $henxem->ho_ten }}
                    <div>
                      <span class="d-block font-size-sm">{{ $henxem->email}}</span>
                    </div>
                    <div>
                      @if ($henxem->thongbao)
                      <small class="badge badge-success">{{ $henxem->thongbao }}</small>
                    @endif
                    </div> 
                  </td>
                  <td class="text-break px-3">{{ $henxem->sdt }}</td>
                  <td>
                    <a href="javascript:;" 
                    class="btn-xem-vanphong text-body"
                    data-idvanphong="{{ $henxem->vanphong->ma_van_phong }}">
                    {{ $henxem->vanphong->ten_van_phong }}</a>
                    <a href="javascript:;" class="d-block btn-xem-toanha font-size-sm text-body" data-idtoanha="{{ $henxem->vanphong->toanha->ma_toa_nha }}">
                      Tòa nhà: {{ $henxem->vanphong->toanha->ten_toa_nha }}</a>
                  </td>
                  <td class="text-break px-3">
                    {{ \Carbon\Carbon::parse($henxem->ngay_hen)->format('d-m-Y H:i') }}
                  </td>
                  <td style="max-width: 300px; white-space: normal; word-break: break-word;">{{ $henxem->ghi_chu }}</td>
                  <td class="text-break px-3">
                      @if ($henxem->trang_thai === "da xu ly")
                          <span class="legend-indicator bg-success"></span> Đã xử lý
                      @elseif($henxem->trang_thai === "dang xu ly")
                          <span class="legend-indicator bg-warning"></span> Đang xử lý
                      @elseif($henxem->trang_thai === "da huy")
                          <span class="legend-indicator bg-danger"></span> Đã hủy
                      @else
                          <span class="legend-indicator bg-secondary"></span> Chưa xử lý
                      @endif
                  </td>
                  <td>
                    <div class="d-flex gap-1">
                      <form action="{{ route('admin.henxem.update', $henxem->ma_hen_xem) }}" method="POST" onsubmit="return confirm('Bạn có chắc đang xử lý lịch hẹn này?');">
                        @csrf
                        @method('PUT')
                        @if ($henxem->trang_thai === "chua xu ly")
                          <button class="btn btn-sm btn-soft-dark mr-1" type="submit" title="Xác nhận đang xử lý">
                            <i class="tio-edit"></i>
                          </button>
                        @endif
                      </form>
                  
                      @if ($henxem->trang_thai !== "da huy" && $henxem->trang_thai !== "da xu ly" && $henxem->trang_thai !== "chua xu ly")
                        <a class="btn btn-sm btn-soft-success" 
                        @if ($henxem->thongbao)
                          href="{{ route('admin.henxem.khachdadangki',$henxem->ma_hen_xem) }}" title="Tạo hợp đồng với khách hàng">
                          <i class="tio-file-text"></i>
                          @else
                          href="{{ route('admin.khachhang.create.henxem', $henxem->ma_hen_xem) }}" title="Tạo tài khoản khách hàng">
                          <i class="tio-add"></i>
                          @endif
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
<!-- VanPhong Modal Popup -->
<div class="modal fade" id="vanPhongModal" tabindex="-1" aria-labelledby="vanPhongModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="btn btn-close btn-sm btn-ghost-secondary" data-bs-dismiss="modal" aria-label="Đóng">
          <i class="tio-clear tio-lg"></i>
        </button>
      </div>
      <div class="modal-body" id="vanPhongModalContent">
        <div class="text-center">Đang tải...</div>
      </div>
    </div>
  </div>
</div>          
<!-- End VanPhong Modal Popup --> 
<!-- ToaNha Modal Popup -->
<div class="modal fade" id="toaNhaModal" tabindex="-1" aria-labelledby="toaNhaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title"></h5>
              <button type="button" class="btn btn-close btn-sm btn-ghost-secondary" data-bs-dismiss="modal"
                  aria-label="Đóng">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).on('click', '.btn-xem-vanphong', function () {
  const idvanphong = $(this).data('idvanphong');
  $('#vanPhongModalContent').html('<div class="text-center">Đang tải...</div>');
  $('#vanPhongModal').modal('show');

  $('#vanPhongModalContent').load(`/admin/vanphong/preview/${idvanphong}`, function (response, status, xhr) {
    if (status === "error") {
      $('#vanPhongModalContent').html('<div class="text-danger">Không thể tải thông tin văn phòng.</div>');
    }
  });
});

$(document).on('click', '.btn-xem-toanha', function() {
            const idtoanha = $(this).data('idtoanha');
            $('#toaNhaModalContent').html('<div class="text-center">Đang tải...</div>');
            $('#toaNhaModal').modal('show');

            $('#toaNhaModalContent').load(`/admin/toanha/preview/${idtoanha}`, function(response, status, xhr) {
                if (status === "error") {
                    $('#toaNhaModalContent').html(
                        '<div class="text-danger">Không thể tải thông tin tòa nhà.</div>');
                }
            });
        });
</script>
@endpush
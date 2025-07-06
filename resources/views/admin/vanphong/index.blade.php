@extends('admin.layouts.app')
@section('title', 'Văn phòng')
@section('content')
<main id="content" role="main" class="main">
    <!-- Content -->
    @php
      $dangLoc = request()->has('ma_toa_nha') ||
        request()->has('dien_tich_min') ||
        request()->has('dien_tich_max') ||
        request()->has('gia_thue_min') ||
        request()->has('gia_thue_max') ||
        request()->has('trang_thai');
    @endphp

    <div class="content container-fluid">
      <div id="success" class="alert alert-success alert-dismissible fade show" role="alert"
                style="display:none; position: fixed; top: 20px; right: 20px; z-index: 1050; min-width: 250px;">
                <strong>Thêm khách hàng thành công từ danh sách hẹn xem</span></strong>
                <button type="button" class="close" aria-label="Close" onclick="$('#success').hide()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Văn phòng {{ $title }}</h1>
          </div>

          <div class="col-sm-auto">
            <a class="btn btn-primary" href="{{ route('admin.vanphong.create') }}" title="Thêm văn phòng">
              <i class="tio-add"></i>
            </a>
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
                  <input id="datatableSearch" type="search" value="{{ request('khachhang') }}" class="form-control" placeholder="Tìm kiếm văn phòng" aria-label="Tìm kiếm văn phòng">
                </div>
                <!-- End Search -->
              </form>
            </div>
              @if ($dangLoc)
                <div class="hs-unfold mr-2">
                  <div class="d-flex flex-wrap gap-2">
                    <label class="font-weight-bold mr-1 mt-2">Bộ lọc: </label>
                    @if(request('ma_toa_nha'))
                      <span class="badge badge-soft-primary" style="padding: .8rem .8rem;">
                        {{ $dsToaNha->firstWhere('ma_toa_nha', request('ma_toa_nha'))?->ten_toa_nha ?? 'Không rõ' }}
                      </span>
                    @endif

                    @if(request('dien_tich_min') || request('dien_tich_max'))
                      <span class="badge badge-soft-info" style="padding: .8rem .8rem;">
                        Diện tích:
                        {{ request('dien_tich_min') ?? '...' }} - {{ request('dien_tich_max') ?? '...' }} m²
                      </span>
                    @endif

                    @if(request('gia_thue_min') || request('gia_thue_max'))
                      <span class="badge badge-soft-success" style="padding: .8rem .8rem;">
                        Giá thuê:
                        {{ request('gia_thue_min') ?? '...' }} - {{ request('gia_thue_max') ?? '...' }} VND/m²
                      </span>
                    @endif

                    @if(request('trang_thai'))
                      <span class="badge badge-soft-warning" style="padding: .8rem .8rem;">
                          @if (request('trang_thai') == 'dang trong')
                          Đang trống
                          @elseif (request('trang_thai') == 'dang xem')
                          Đang xem
                          @elseif (request('trang_thai') == 'het han hop dong')
                          Hết hạn
                          @elseif (request('trang_thai') == 'cho ban giao')
                          Chờ bàn giao
                          @else
                            Đang thuê
                          @endif
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
                <form method="GET" action="{{ route('admin.vanphong.' .$page) }}">
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
                    <label>Diện tích (m²)</label>
                    <div class="input-group">
                      <input type="text" name="dien_tich_min" class="form-control format-number" placeholder="Từ" value="{{ request('dien_tich_min') }}">
                      <input type="text" name="dien_tich_max" class="form-control format-number" placeholder="Đến" value="{{ request('dien_tich_max') }}">
                    </div>
                  </div>
          
                  <div class="form-group">
                    <label>Giá thuê (VND/m²)</label>
                    <div class="input-group">
                      <input type="text" name="gia_thue_min" class="form-control format-money" placeholder="Từ" value="{{ request('gia_thue_min') }}">
                      <input type="text" name="gia_thue_max" class="form-control format-money" placeholder="Đến" value="{{ request('gia_thue_max') }}">
                    </div>
                  </div>
                  @if(!$title)
                    <div class="form-group">
                      <label for="trang_thai">Trạng thái</label>
                      <select name="trang_thai" id="trang_thai" class="form-control selectpicker" data-live-search="true" title="Chọn trạng thái">
                        <option value="">-- Tất cả --</option>
                        <option value="dang trong" {{ request('trang_thai') == 'dang trong' ? 'selected' : '' }}>Đang trống</option>
                        <option value="cho ban giao" {{ request('trang_thai') == 'cho ban giao' ? 'selected' : '' }}>Chờ bàn giao</option>
                        <option value="da thue" {{ request('trang_thai') == 'da thue' ? 'selected' : '' }}>Đã thuê</option>
                        <option value="dang xem" {{ request('trang_thai') == 'dang xem' ? 'selected' : '' }}>Đang xem</option>
                        <option value="het han hop dong" {{ request('trang_thai') == 'het han hop dong' ? 'selected' : '' }}>Hết hạn hợp đồng</option>
                      </select>
                    </div>
                  @endif
                  <button type="submit" class="btn btn-primary btn-block mt-3">Lọc</button>
                </form>
              </div>
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
          <table id="datatable" class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table" data-hs-datatables-options='{
                   "columnDefs": [{
                      "targets": [0, @if ($page =='index' || $page =='dangtrong'||$page =='khonghoatdong')
                      6
                    @else
                      7
                    @endif],
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
                <th class="table-column-pl-0">Mã văn phòng</th>
                <th>Tên văn phòng</th>
                @if ($page=='dathue' || $page=='dangxem' || $page=='hethan')
                  <th>Tên khách/Email</th>
                @endif
                <th>Diện tích</th>
                <th>Giá thuê</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
              </tr>
            </thead>

            <tbody>
              @if ($page=='dangxem')
                @foreach ($henxems as $henxem)
                  <tr>
                      <td class="table-column-pr-0">
                      </td>
                      <td>
                          <a href="javascript:;" class="btn-xem-vanphong"
                              data-id="{{ $henxem->vanphong->ma_van_phong }}">
                              {{ $henxem->vanphong->ma_van_phong }}
                          </a>
                      </td>
                      <td>
                          <a href="javascript:;" class="btn-xem-vanphong text-body"
                              data-id="{{ $henxem->vanphong->ma_van_phong }}">
                              {{ $henxem->vanphong->ten_van_phong }}
                          </a>
                          <a href="javascript:;" class="d-block btn-xem-toanha font-size-sm text-body"
                              data-idtoanha="{{ $henxem->vanphong->toanha->ma_toa_nha }}">
                              {{ $henxem->vanphong->toanha->ten_toa_nha ?? 'Chưa có' }}</a>
                      </td>
                      <td class="text-break px-3">{{ $henxem->ho_ten }}
                          <span class="d-block font-size-sm">{{ $henxem->email }}</span>
                          <small class="badge badge-danger">{{ $henxem->thongbao }}</small>
                      </td>
                      <td>{{ $henxem->vanphong->dien_tich }} m²</td>
                      <td>{{ number_format($henxem->vanphong->gia_thue, 0, ',', '.') }}</td>
                      <td>
                          @if ($henxem->vanphong->trang_thai === 'da thue')
                              <span class="legend-indicator bg-success"></span> Đã thuê
                          @elseif ($henxem->vanphong->trang_thai === 'dang xem')
                              <span class="legend-indicator bg-secondary"></span> Đang xem
                          @elseif ($henxem->vanphong->trang_thai === 'het han hop dong')
                              <span class="legend-indicator bg-warning"></span> Đã thuê
                          @elseif ($henxem->vanphong->trang_thai === 'dang trong')
                              <span class="legend-indicator bg-danger"></span> Đang trống
                          @elseif ($henxem->vanphong->trang_thai === 'cho ban giao')
                              <span class="legend-indicator bg-info"></span> Chờ bàn giao
                          @else
                              <span class="legend-indicator bg-dark"></span> Không hoạt động
                          @endif
                      </td>
                      <td>
                          <div>
                              @if (!$henxem->thongbao)
                                  <a class="btn btn-sm btn-soft-success"
                                      href="{{ route('admin.hopdong.create', [
                                          'user_id' => $henxem->user_id,
                                          'vanphong_id' => $henxem->vanphong->ma_van_phong,
                                      ]) }}"
                                      title="Tạo hợp đồng">
                                      <i class="tio-file-text"></i>
                                  </a>
                              @else
                                  <a class="btn btn-sm btn-soft-success"
                                      href="{{ route('admin.khachhang.create.henxem', $henxem->ma_hen_xem) }}"
                                      title="Tạo tài khoản">
                                      <i class="tio-add"></i>
                                  </a>
                              @endif
                          </div>
                      </td>
                  </tr>
                @endforeach    
              @else
                @foreach ($vanphongs as $vanphong)
                  <tr>
                    
                    <td class="table-column-pr-0">
                    </td>
                    <td>
                      <a href="javascript:;" 
                          class="btn-xem-vanphong"
                          data-id="{{ $vanphong->ma_van_phong }}">
                        {{ $vanphong->ma_van_phong }}
                      </a>
                    </td>
                    <td>
                      <a href="javascript:;" 
                        class="btn-xem-vanphong text-body"
                        data-id="{{ $vanphong->ma_van_phong }}">
                        {{ $vanphong->ten_van_phong }}
                      </a>
                      <a href="javascript:;" class="d-block btn-xem-toanha font-size-sm text-body" data-idtoanha="{{ $vanphong->toanha->ma_toa_nha }}">
                        {{ $vanphong->toanha->ten_toa_nha ?? 'Chưa có' }}</a>
                    </td>
                    @if ($page=='dathue' || $page=='dangxem' || $page=='hethan')
                      <td>{{ $vanphong->chiTietHopDongs->first()->hopdong->user->name }}
                        <span class="d-block font-size-sm">{{ $vanphong->chiTietHopDongs->first()->hopdong->user->email }}</span>
                      </td>
                    @endif
                    
                    <td>{{ $vanphong->dien_tich }} m²</td>
                    <td>{{ number_format($vanphong->gia_thue, 0, ',', '.') }}</td>
                    <td>
                      @if ($vanphong->trang_thai === 'da thue')
                              <span class="legend-indicator bg-success"></span> Đã thuê
                          @elseif ($vanphong->trang_thai === 'dang xem')
                              <span class="legend-indicator bg-secondary"></span> Đang xem
                          @elseif ($vanphong->trang_thai === 'het han hop dong')
                              <span class="legend-indicator bg-warning"></span> Đã thuê
                          @elseif ($vanphong->trang_thai === 'dang trong')
                          <span class="legend-indicator bg-danger"></span> Đang trống
                          @elseif ($vanphong->trang_thai === 'cho ban giao')
                              <span class="legend-indicator bg-info"></span> Chờ bàn giao
                          @else
                              <span class="legend-indicator bg-dark"></span> Không hoạt động
                          @endif
                    </td>
                    <td>
                      @if ($vanphong->trang_thai === 'het han hop dong' || $vanphong->trang_thai === 'dang trong' || $vanphong->trang_thai === 'khong hoat dong')
                      <a class="btn btn-sm btn-soft-dark" href="{{ route('admin.vanphong.edit', $vanphong->ma_van_phong) }}" title="Sửa">
                          <i class="tio-edit"></i>
                        </a>
                      @endif
                      @if ($page=='hethan')
                        <a class="btn btn-sm btn-soft-success"
                          href="{{ route('admin.hopdong.create', [
                              'user_id' => $vanphong->chiTietHopDongs->first()->hopdong->user->id,
                              'vanphong_id' => $vanphong->ma_van_phong,
                          ]) }}"
                          title="Tạo hợp đồng">
                          <i class="tio-file-text"></i>
                        </a>
                      @endif
                    </td>
                  </tr>
                @endforeach    
              @endif
              
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
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.format-money').forEach(function (input) {
      input.addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
        e.target.dataset.value = value;
        e.target.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
      });
    });

    document.querySelectorAll('.format-number').forEach(function (input) {
      input.addEventListener('input', function (e) {
        let value = e.target.value.replace(/[^0-9.]/g, '');
        const parts = value.split('.');
        if (parts.length > 2) {
          value = parts[0] + '.' + parts.slice(1).join('');
        }
        e.target.value = value;
      });
    });
});

document.addEventListener('DOMContentLoaded', function() {
            const params = new URLSearchParams(window.location.search);
            const message = params.get('success');

            if (message) {
                const msgBox = document.getElementById('success');
                msgBox.querySelector('strong').textContent = message;
                msgBox.style.display = 'block';

                setTimeout(() => {
                    msgBox.style.display = 'none';
                }, 5000);
            }
        });

$(document).on('click', '.btn-xem-vanphong', function () {
  const id = $(this).data('id');
  $('#vanPhongModalContent').html('<div class="text-center">Đang tải...</div>');
  $('#vanPhongModal').modal('show');

  $('#vanPhongModalContent').load(`/admin/vanphong/preview/${id}`, function (response, status, xhr) {
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

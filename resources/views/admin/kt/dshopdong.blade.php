@extends('admin.layouts.kt-app')
@section('title', 'hợp đồng')
@push('styles')
@endpush
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
                <div class="row align-items-center mb-3">
                    <div class="col-sm">
                        <h1 class="page-header-title">Danh Sách Hợp đồng <span
                                class="badge badge-soft-dark ml-2">{{ $hopDongs->count() }}</span></h1>
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
                                        placeholder="Tìm kiếm hợp đồng" aria-label="Tìm kiếm hợp đòng">
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
                                @if(request('trang_thai'))
                                  <span class="badge badge-soft-warning" style="padding: .8rem .8rem;">
                                    {{ request('trang_thai') == 'dang thue' ? 'Đang thuê' : 'Đã thanh lý' }}
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
                                <form method="GET" action="{{ route('kt.hopdong') }}">
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

                                {{-- Trạng thái --}}
                                <div class="form-group">
                                    <label for="trang_thai">Trạng thái</label>
                                    <select name="trang_thai" id="trang_thai" class="form-control selectpicker" data-live-search="true" title="Chọn trạng thái">
                                    <option value="">-- Tất cả --</option>
                                    <option value="dang thue" {{ request('trang_thai') == 'dang thue' ? 'selected' : '' }}>Đang thuê</option>
                                    <option value="da thanh ly" {{ request('trang_thai') == 'da thanh ly' ? 'selected' : '' }}>Đã thanh lý</option>
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
                                <th scope="col">Mã hợp đồng</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Tổng tiền cọc</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($hopDongs as $hopDong)
                                <tr>
                                    <td>
                                        <a class="btn-xem-hopdong" href="javascript:;"
                                                data-hoadon='@json($hopDong)'
                                                data-id="{{ $hopDong->ma_hop_dong }}"
                                                data-export-url="{{ route('kt.hopdong', $hopDong->ma_hop_dong) }}"
                                                data-toggle="tooltip" data-placement="top">{{ $hopDong->ma_hop_dong }}</a>
                                        </td>
                                    <td>{{ \Carbon\Carbon::parse($hopDong->ngay_bat_dau)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($hopDong->ngay_ket_thuc)->format('d-m-Y') }}</td>
                                    <td>{{ number_format($hopDong->tong_tien_coc, 0, ',', '.') }} đ</td>
                                    <td>
                                        @if ($hopDong->tinh_trang === 'dang thue')
                                            <span class="badge badge-soft-success"> Đang thuê
                                            </span>
                                        @else
                                            <span class="badge badge-soft-danger"> Đã thanh lý
                                            </span>
                                        @endif
                                        
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" style="gap: 0.5rem;">
                                            <!-- Nút Xem luôn hiện -->
                                            <a class="btn btn-sm btn-primary btn-xem-hopdong" href="javascript:;"
                                                data-hoadon='@json($hopDong)'
                                                data-id="{{ $hopDong->ma_hop_dong }}"
                                                data-export-url="{{ route('kt.hopdong', $hopDong->ma_hop_dong) }}"
                                                data-toggle="tooltip" data-placement="top" title="Xem">
                                                <i class="tio-visible-outlined"></i>
                                            </a>
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
      <div class="modal fade" id="hopdongModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn btn-close btn-sm btn-ghost-secondary" data-bs-dismiss="modal" aria-label="Đóng">
                  <i class="tio-clear tio-lg"></i>
                </button>
              </div>
            <div class="modal-body" id="modalBodyContent">
              <!-- Nội dung ở đây -->
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
        $(document).on('click', '.btn-xem-hopdong', function () {
            const id = $(this).data('id');
            $('#modalBodyContent').html('<div class="text-center">Đang tải...</div>');
            $('#hopdongModal').modal('show');
        
            $('#modalBodyContent').load(`/kt/hopdong/preview/${id}`, function (response, status, xhr) {
                if (status === "error") {
                    $('#modalBodyContent').html('<div class="text-danger">Lỗi tải dữ liệu</div>');
                }
            });
        });
        </script>
@endpush

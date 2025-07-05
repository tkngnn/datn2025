@extends('admin.layouts.app')
@section('title', 'Khách hàng')
@section('content')
<main id="content" role="main" class="main">
  @php
    $dangLoc = request()->has('vai_tro') || request()->has('trang_thai');
  @endphp
    <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Khách hàng</h1>
          </div>

          <div class="col-sm-auto">
            <a class="btn btn-primary" href="{{ route('admin.khachhang.create') }}" title="Thêm khách hàng">
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
                  <input id="datatableSearch" type="search" class="form-control" placeholder="Tìm kiếm khách hàng" aria-label="Tìm kiếm khách hàng">
                </div>
                <!-- End Search -->
              </form>
            </div>   

            @if ($dangLoc)
            <div class="hs-unfold mr-2">
              <div class="d-flex flex-wrap gap-2">
                <label class="font-weight-bold mr-1 mt-2">Bộ lọc: </label>

                @if(request('vai_tro'))
                  <span class="badge badge-soft-info" style="padding: .8rem .8rem;">
                    @if (request('vai_tro')==='admin')
                      Admin
                    @else
                      Khách thuê
                    @endif
                  </span>
                @endif

                @if(request('trang_thai') !== null)
                  @if (request('trang_thai') == '1')
                    <span class="badge badge-soft-success" style="padding: .8rem .8rem;">
                      Đang hoạt động
                    </span>
                  @else
                    <span class="badge badge-soft-danger" style="padding: .8rem .8rem;">
                      Ngừng hoạt động
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
          

      <div id="datatableFilterSidebar" class="hs-unfold-content sidebar sidebar-bordered sidebar-box-shadow">
        <div class="card mb-5">
          <div class="card-header">
            <h5 class="mb-0">Bộ lọc</h5>
          </div>
          <div class="card-body">
            <form method="GET" action="{{ route('admin.khachhang.index') }}">
              {{-- Vai trò --}}
              <div class="form-group">
                <label for="vai_tro">Vai trò</label>
                <select name="vai_tro" id="vai_tro" class="form-control selectpicker" data-live-search="true" title="Chọn vai trò">
                  <option value="">-- Tất cả --</option>
                  <option value="admin" {{ request('vai_tro') == 'admin' ? 'selected' : '' }}>Admin</option>
                  <option value="KT" {{ request('vai_tro') == 'KT' ? 'selected' : '' }}>Khách thuê</option>
                </select>
              </div>
      
              {{-- Trạng thái --}}
              <div class="form-group">
                <label for="trang_thai">Trạng thái</label>
                <select name="trang_thai" id="trang_thai" class="form-control selectpicker" data-live-search="true" title="Chọn trạng thái">
                  <option value="">-- Tất cả --</option>
                  <option value="1" {{ request('trang_thai') === '1' ? 'selected' : '' }}>Đang hoạt động</option>
                  <option value="0" {{ request('trang_thai') === '0' ? 'selected' : '' }}>Ngừng hoạt động</option>
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
                <th class="table-column-pl-0">Mã khách</th>
                <th>Tên khách/Email</th>
                <th>CCCD</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Vai trò</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($khachhangs as $khachhang)
                <tr>
                  <td class="table-column-pr-0">
                  </td>
                  <td>
                    <a href="#">{{ $khachhang->id }}</a>
                  </td>
                  <td class="text-break px-3">{{ $khachhang->name }}
                    <span class="d-block font-size-sm">{{ $khachhang->email}}</span>
                  </td>
                  <td class="text-break px-3">{{ $khachhang->cccd }}</td>
                  <td class="text-break px-3">{{ $khachhang->so_dien_thoai }}</td>
                  <td style="max-width: 300px; white-space: normal; word-break: break-word;">
                    {{ $khachhang->dia_chi }}
                  </td>                  
                  <td class="text-break px-3">
                    @if ($khachhang->vai_tro === 'admin')
                        Admin
                    @else
                        Khách thuê
                    @endif
                  </td>
                  <td class="text-break px-3">
                    @if ($khachhang->trang_thai === 1)
                        <span class="legend-indicator bg-success"></span> Đang hoạt dộng
                    @else
                        <span class="legend-indicator bg-danger"></span> Ngừng hoạt động
                    @endif
                  </td>
                  <td>
                    <div>
                      <a class="btn btn-sm btn-soft-dark" href="{{ route('admin.khachhang.edit',$khachhang->id) }}" title="Sửa">
                        <i class="tio-edit"></i>
                      </a>
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
  </main>
@endsection
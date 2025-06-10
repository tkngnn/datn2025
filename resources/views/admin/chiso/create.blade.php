@extends('admin.layouts.app')
@section('title', 'Dashboard')

@section('content')
    <main id="content" role="main" class="main">
            <!-- Content -->
        <div class="content container-fluid">
                <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm mb-2 mb-sm-0">
                        <nav aria-label="breadcrumb"></nav>
                        <h1 class="page-header-title">Nhập chỉ số</h1>
                    </div>
                </div>
                    <!-- End Row -->
            </div>
                <!-- End Page Header -->

                <div class="row">
                    <div class="col-lg-12">
                        <!-- Card -->
                        <div class="card mb-3 mb-lg-5">
                            <!-- Header -->
                            <div class="card-header">
                                <h4 class="card-header-title">Lọc</h4>
                            </div>
                            <!-- End Header -->

                            <!-- Body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <label for="addressLabel" class="input-label">Tên văn phòng</label>
                                            <input type="text" class="form-control" name="name" id="name" aria-label="Nhập địa chỉ">
                                        </div>
                                        <!-- End Form Group -->
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <label for="floorLabel" class="input-label">Tòa nhà</label>
                                            <select class="js-select2-custom custom-select" name="toa_nha" id="statusLabel">
                                                @foreach ($toanhas as $toanha)
                                                    <option value="{{ $toanha->ma_toa_nha }}">{{ $toanha->ten_toa_nha }}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                        <!-- End Form Group -->
                                    </div>
                                </div>
                                <!-- End Row -->


                            </div>
                            <!-- Body -->
                        </div>
                        <!-- End Card -->
                        <!-- Card -->
                        <div class="card mb-3 mb-lg-5">
                            <!-- Header -->
                            <div class="card-header">
                                <h4 class="card-header-title">Nhập chỉ số</h4>
                            </div>
                            <!-- End Header -->

                            <!-- Body -->
                            <div class="card-body">
                                <div class="card">
                                    <!-- Table -->
                                    <div class="table-responsive datatable-custom">
                                      <form method="POST" action="{{ route('admin.chiso.store') }}">
                                        @csrf
                                        <table id="datatable" class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table" data-hs-datatables-options='{
                                                "columnDefs": [{
                                                    "targets": [-1, 3],
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
                                              <th class="table-column-pr-0">Văn phòng</th>
                                              <th>Tòa nhà</th>
                                              <th>Tháng</th>
                                              <th>Số điện mới</th>
                                              <th>Số nước mới</th>
                                            </tr>
                                          </thead>
                              
                                          <tbody>
                                            @foreach ($hoadons as $hoadon)
                                              @php
                                                $cthd = $hoadon->hopdong->chiTietHopDongs->first();
                                                $vanphong = $cthd ? $cthd->vanphong : null;
                                              @endphp
                                          
                                              @if ($vanphong)
                                                <tr>
                                                  <td>{{ $vanphong->ten_van_phong }}</td>
                                                  <td class="text-break px-3">{{ $vanphong->toanha->ten_toa_nha }}</td>
                                                  <td class="text-break px-3">{{ $hoadon->thang_nam }}</td>
                                                  <td>
                                                    <input type="number" class="form-control" name="so_dien[{{ $hoadon->ma_hoa_don }}]" id="chiso" step="0.01" min="0" value="{{ old('chi_so_dien_moi.'.$hoadon->id) }}" inputmode="numeric" pattern="[0-9]*" placeholder="Nhập số điện" />
                                                  </td>
                                                  <td>
                                                    <input type="number" class="form-control" name="so_nuoc[{{ $hoadon->ma_hoa_don }}]" id="chiso" step="0.01" min="0" value="{{ old('chi_so_nuoc_moi.'.$hoadon->id) }}" inputmode="numeric" pattern="[0-9]*" placeholder="Nhập số nước" />
                                                  </td>
                                                </tr>
                                              @endif
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
                                              <span class="mr-2">Showing:</span>
                              
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
                              
                                              <span class="text-secondary mr-2">of</span>
                              
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
                                  <!-- End Row -->


                              </div>
                              <!-- Body -->
                          </div>
                          <!-- End Card -->
                      </div>
                  </div>
                  <!-- End Row -->

                  <div class="position-fixed bottom-0 content-centered-x w-100 z-index-99 mb-3" style="max-width: 40rem;">
                      <!-- Card -->
                      <div class="card card-sm bg-dark border-dark mx-2">
                          <div class="card-body">
                              <div class="row justify-content-center justify-content-sm-between">
                                  <div class="col">
                                  </div>
                                  <div class="col-auto">
                                    <a href="{{ route('admin.chiso.index') }}" class="btn btn-danger mr-2">
                                      <i class="tio-chevron-left"></i> Trở về
                                    </a>
                                      <button type="submit" class="btn btn-primary">Lưu</button>
                                  </div>
                              </div>
                              <!-- End Row -->
                          </div>
                      </div>
                    </form>
                    <!-- End Card -->
                </div>
            </div>
            <!-- End Content -->

            <!-- Footer -->
            <!-- End Footer -->
        </main>
    </form>
@endsection

    <script>
       document.getElementById('chiso').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
            e.target.dataset.value = value;
            e.target.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        });
    </script>

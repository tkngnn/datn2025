@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')
    {{-- <x-admin-layout> --}}
    <main id="content" role="main" class="main pointer-event">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm mb-2 mb-sm-0">
                        <h1 class="page-header-title">Trang thống kê</h1>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->

            <!-- Stats -->
            <div class="row gx-2 gx-lg-3">
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <div class="card text-left card-hover-shadow h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-1">
                                <h2 class="mb-0 mr-2">{{ $totalToaNha }}</h2>
                                {{-- <span class="badge badge-soft-primary">1 tòa nhà</span> --}}
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <span class="text-dark">Tòa nhà</span>
                            </div>
                            <div class="d-flex gap-2">
                                <div class="border rounded py-2 text-center flex-fill">
                                    <div class="h5 mb-0">{{ $totalPhongDangThue }}</div>
                                    <small class="text-dark">Phòng đang thuê</small>
                                </div>
                                <div class="border rounded py-2 text-center flex-fill">
                                    <div class="h5 mb-0">{{ $totalPhongConTrong }}</div>
                                    <small class="text-dark">Phòng còn trống</small>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <div class="card text-left card-hover-shadow h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-1">
                                <h2 class="mb-0 mr-2">{{ $totalKhachThue }}</h2>
                                {{-- <span class="badge badge-soft-primary">1 khách mới</span> --}}
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <span class="text-dark">Khách thuê</span>

                            </div>
                            <div class="d-flex gap-2">
                                <div class="border rounded py-2 text-center flex-fill">
                                    <div class="h5 mb-0">{{ $userActive }}</div>
                                    <small class="text-dark">Tài khoản đang hoạt động</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <div class="card text-left card-hover-shadow h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-1">
                                <h2 class="mb-0 mr-2">{{ $totalHopDong }}</h2>
                                <span class="badge badge-soft-primary">{{ $hopDongMoi }} hợp đồng mới</span>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <span class="text-dark">Hợp đồng</span>
                            </div>
                            <div class="d-flex gap-2">
                                <div class="border rounded py-2 text-center flex-fill">
                                    <div class="h5 mb-0">{{ $hopDongHieuLuc }}</div>
                                    <small class="text-dark">Còn hiệu lực</small>
                                </div>
                                <div class="border rounded py-2 text-center flex-fill">
                                    <div class="h5 mb-0">{{ $hopDongDaThanhLy }}</div>
                                    <small class="text-dark">Đã thanh lý</small>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <div class="card text-left card-hover-shadow h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-1">
                                <h2 class="mb-0 mr-2">{{ $totalHoaDon }}</h2>
                                <span class="badge badge-soft-primary">{{ $hoaDonMoi }} hóa đơn mới</span>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <span class="text-dark">Hóa đơn</span>
                            </div>
                            <div class="d-flex gap-2">
                                <div class="border rounded py-2 text-center flex-fill">
                                    <div class="h5 mb-0">{{ $hoaDonChuaTT }}</div>
                                    <small class="text-dark">Chưa thanh toán</small>
                                </div>
                                <div class="border rounded py-2 text-center flex-fill">
                                    <div class="h5 mb-0">{{ $hoaDonDaTT }}</div>
                                    <small class="text-dark">Đã thanh toán</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End Stats -->
        </div>
        <!-- End Content -->

        <!-- Footer -->

        <div class="footer">
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    <p class="font-size-sm mb-0">&copy; Front. <span class="d-none d-sm-inline-block">2020
                            Htmlstream.</span></p>
                </div>
                <div class="col-auto">
                    <div class="d-flex justify-content-end">
                        <!-- List Dot -->
                        <ul class="list-inline list-separator">
                            <li class="list-inline-item">
                                <a class="list-separator-link" href="#">FAQ</a>
                            </li>

                            <li class="list-inline-item">
                                <a class="list-separator-link" href="#">License</a>
                            </li>

                            <li class="list-inline-item">
                                <!-- Keyboard Shortcuts Toggle -->
                                <div class="hs-unfold">
                                    <a class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                                        href="javascript:;"
                                        data-hs-unfold-options='{
                          "target": "#keyboardShortcutsSidebar",
                          "type": "css-animation",
                          "animationIn": "fadeInRight",
                          "animationOut": "fadeOutRight",
                          "hasOverlay": true,
                          "smartPositionOff": true
                         }'>
                                        <i class="tio-command-key"></i>
                                    </a>
                                </div>
                                <!-- End Keyboard Shortcuts Toggle -->
                            </li>
                        </ul>
                        <!-- End List Dot -->
                    </div>
                </div>
            </div>
        </div>



        <!-- End Footer -->
    </main>
    {{-- </x-admin-layout> --}}
@endsection

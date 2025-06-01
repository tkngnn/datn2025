@extends('admin.layouts.app')
@section('title', 'Dashboard')

@push('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm">
                        <h1 class="page-header-title">Tạo Hợp Đồng</h1>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.hopdong.store') }}" method="POST">
                @csrf
                <!-- PHẦN 1: THÔNG TIN CHUNG -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">1. Thông Tin Chung</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="toa_nha_id">Tòa nhà</label>
                                    <select class="form-control" name="toa_nha_id" id="toa_nha_id">
                                        <option value="">-- Chọn tòa nhà --</option>
                                        @foreach ($toaNhas as $toaNha)
                                            <option value="{{ $toaNha->ma_toa_nha }}">{{ $toaNha->ten_toa_nha }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vanphong_id">Phòng</label>
                                    <select class="form-control" name="vanphong_id" id="vanphong_id">
                                        <option value="">-- Chọn phòng --</option>
                                        {{-- Văn phòng sẽ được load bằng JavaScript --}}
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ngay_ky">Ngày ký</label>
                                    <input type="date" class="form-control" name="ngay_ky" id="ngay_ky"
                                        onchange="validateDates()">
                                    <small class="text-danger" id="error_ngay_ky"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ngay_bat_dau">Ngày bắt đầu</label>
                                    <input type="date" class="form-control" name="ngay_bat_dau" id="ngay_bat_dau"
                                        onchange="validateDates(); updateNgayBatDauTinhTien()">
                                    <small class="text-danger" id="error_ngay_bat_dau"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="han_hop_dong">Hạn hợp đồng</label>
                                    <input type="date" class="form-control" name="han_hop_dong" id="han_hop_dong"
                                        onchange="validateDates()">
                                    <small class="text-danger" id="error_han_hop_dong"></small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ghi_chu">Ghi chú</label>
                            <textarea class="form-control" name="ghi_chu" id="ghi_chu" rows="3" placeholder="Thông tin thêm nếu có..."></textarea>
                        </div>
                    </div>
                </div>

                <!-- PHẦN 2: KHÁCH THUÊ -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">2. Khách Thuê</h4>
                        <a class="btn btn-sm btn-primary" href="#">
                            <i class="tio-user-add"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="ten_khach_thue">Tên khách thuê</label>
                                    <select class="form-control" name="khach_thue_id" id="khach_thue_id">
                                        <option value="">-- Chọn khách thuê --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}
                                                ({{ $user->so_dien_thoai }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sdt_khach_thue">Số điện thoại</label>
                                    <input type="text" class="form-control" name="sdt_khach_thue" id="sdt_khach_thue">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="dai_dien">Người đại diện</label>
                                    <input type="text" class="form-control" name="dai_dien" id="dai_dien">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PHẦN 3: TIỀN THUÊ & CỌC -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">3. Tiền Thuê & Cọc</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tien_thue">Tiền thuê (VNĐ)</label>
                                    <input type="number" class="form-control" name="tien_thue" id="tien_thue"
                                        placeholder="Ví dụ: 12000000">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="chu_ky">Chu kỳ thanh toán</label>
                                    <select name="chu_ky" id="chu_ky" class="form-control">
                                        <option value="1">Hàng tháng</option>
                                        <option value="3">3 tháng</option>
                                        <option value="6">6 tháng</option>
                                        <option value="12">12 tháng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ngay_bat_dau_tinh_tien">Ngày bắt đầu tính tiền</label>
                                    <input type="date" class="form-control" name="ngay_bat_dau_tinh_tien"
                                        id="ngay_bat_dau_tinh_tien">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tien_coc">Tiền cọc (VNĐ)</label>
                            <input type="number" class="form-control" name="tien_coc" id="tien_coc"
                                placeholder="Ví dụ: 24000000">
                        </div>
                    </div>
                </div>

                <!-- PHẦN 4: CHI TIẾT -->
                <div class="card mb-5">
                    <div class="card-header">
                        <h4 class="text-primary">4. Chi Tiết</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gia_dien">Giá điện (VNĐ/kWh)</label>
                                    <input type="number" class="form-control" name="gia_dien" id="gia_dien"
                                        placeholder="Ví dụ: 3500">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gia_nuoc">Giá nước (VNĐ/m³)</label>
                                    <input type="number" class="form-control" name="gia_nuoc" id="gia_nuoc"
                                        placeholder="Ví dụ: 18000">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dich_vu_khac">Dịch vụ khác</label>
                                    <input type="number" class="form-control" name="dich_vu_khac" id="dich_vu_khac"
                                        placeholder="Ví dụ: 18000">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="note">Chi tiết dịch vụ</label>
                            <textarea class="form-control" name="note" id="note" rows="6"
                                placeholder="Ghi rõ loại dịch vụ, giá...">Phí dịch vụ bao gồm:
                        » Dịch vụ vệ sinh khu vực công cộng
                        » Tổng vệ sinh định kỳ mặt tiền tòa nhà.
                        » Thu gom và xử lý nước/rác thải sinh hoạt.
                        » Phun thuốc diệt côn trùng định kỳ.
                        » Bảo trì, bảo dưỡng hệ thống thang máy</textarea>
                        </div>

                    </div>
                </div>

                <!-- Nút lưu -->
                <div class="text-center mb-5">
                    <button type="submit" class="btn btn-primary">Lưu Hợp Đồng</button>
                    <a href="{{ route('admin.hopdong.index') }}" class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </main>


@endsection

@push('scripts')
    <script>
        flatpickr("#ngay_ky", {
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                validateDates();
            }
        });
        flatpickr("#ngay_bat_dau", {
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                validateDates();
                updateNgayBatDauTinhTien();
            }
        });
        flatpickr("#han_hop_dong", {
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                validateDates();
            }
        });
        flatpickr("#ngay_bat_dau_tinh_tien", {
            dateFormat: "Y-m-d"
        });

        document.addEventListener('DOMContentLoaded', function() {
            const toaNhaSelect = document.getElementById('toa_nha_id');
            const vanPhongSelect = document.getElementById('vanphong_id');

            const giaThueInput = document.getElementById('tien_thue');
            const tienCocInput = document.getElementById('tien_coc');
            const giaDienInput = document.getElementById('gia_dien');
            const giaNuocInput = document.getElementById('gia_nuoc');
            const dichVuKhacTextarea = document.getElementById('dich_vu_khac');

            toaNhaSelect.addEventListener('change', function() {
                const toaNhaId = this.value;
                vanPhongSelect.innerHTML = '<option value="">-- Chọn phòng --</option>';

                if (toaNhaId) {
                    fetch(`/admin/ajax/vanphong/${toaNhaId}`)
                        .then(res => res.json())
                        .then(data => {
                            console.log('Danh sách văn phòng:', data);
                            data.forEach(vp => {
                                const option = document.createElement('option');
                                option.value = vp.ma_van_phong;
                                option.textContent =
                                    `Văn phòng ${vp.ma_van_phong} - ${vp.dien_tich} m²`;
                                vanPhongSelect.appendChild(option);
                            });
                        })
                        .catch(err => console.error('Lỗi khi fetch văn phòng:', err));
                }
            });

            vanPhongSelect.addEventListener('change', function() {
                const vanPhongId = this.value;

                if (vanPhongId) {
                    fetch(`/admin/ajax/vanphong-detail/${vanPhongId}`)
                        .then(res => res.json())
                        .then(data => {
                            console.log('Chi tiết văn phòng:', data);
                            giaThueInput.value = data.gia_thue;
                            tienCocInput.value = data.gia_thue * data.dien_tich * 3; 
                            giaDienInput.value = data.gia_dien;
                            giaNuocInput.value = data.gia_nuoc;
                            dichVuKhacTextarea.value = data.dich_vu_khac;
                        })
                        .catch(err => console.error('Lỗi khi fetch chi tiết VP:', err));
                }
            });

            const userSelect = document.getElementById('khach_thue_id');
            const phoneInput = document.getElementById('sdt_khach_thue');
            const daiDienInput = document.getElementById('dai_dien');

            userSelect.addEventListener('change', function() {
                const userId = this.value;
                if (userId) {
                    fetch(`/admin/ajax/user/${userId}`)
                        .then(res => res.json())
                        .then(data => {
                            phoneInput.value = data.phone || '';
                            daiDienInput.value = data.name || '';
                        });
                } else {
                    phoneInput.value = '';
                    daiDienInput.value = '';
                }
            });

            document.getElementById('ngay_ky').addEventListener('change', validateDates);
            document.getElementById('ngay_bat_dau').addEventListener('change', validateDates);
            document.getElementById('han_hop_dong').addEventListener('change', validateDates);
            validateDates();

        });

        function validateDates() {
            const ngayKy = document.getElementById('ngay_ky').value;
            const ngayBatDau = document.getElementById('ngay_bat_dau').value;
            const hanHopDong = document.getElementById('han_hop_dong').value;

            document.getElementById('error_ngay_bat_dau').innerText = '';
            document.getElementById('error_han_hop_dong').innerText = '';

            if (ngayKy && ngayBatDau) {
                if (ngayBatDau < ngayKy) {
                    document.getElementById('error_ngay_bat_dau').innerText = 'Ngày bắt đầu phải bằng hoặc sau ngày ký';
                }
            }

            if (ngayBatDau && hanHopDong) {
                if (hanHopDong <= ngayBatDau) {
                    document.getElementById('error_han_hop_dong').innerText = 'Hạn hợp đồng phải sau ngày bắt đầu';
                }
            }
        }

        function updateNgayBatDauTinhTien() {
            const ngayBatDau = document.getElementById('ngay_bat_dau').value;
            document.getElementById('ngay_bat_dau_tinh_tien').value = ngayBatDau;
        }
    </script>
@endpush

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
                        <h1 class="page-header-title">Chỉnh Sửa Hợp Đồng {{ $hopDong->ma_hop_dong }}</h1>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Thành công!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Lỗi!</strong> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <script>
                    setTimeout(function() {
                        const alerts = document.querySelectorAll('.alert');
                        alerts.forEach(alert => {
                            alert.classList.remove('show');
                            alert.classList.add('fade');
                            setTimeout(() => alert.remove(), 300); 
                        });
                    }, 5000);
                </script>
            </div>
            <form action="{{ route('admin.hopdong.update', $hopDong->ma_hop_dong) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">1. Thông Tin Chung</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="toa_nha_id">Tòa nhà</label>
                                <select class="form-control" name="toa_nha_id" id="toa_nha_id">
                                    <option value="{{ $vanPhong->toaNha->ma_toa_nha }}" selected>
                                        {{ $vanPhong->toaNha->ten_toa_nha }}</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="vanphong_id">Phòng</label>
                                <select class="form-control" name="vanphong_id" id="vanphong_id">
                                    <option value="{{ $vanPhong->ma_van_phong }}" selected>{{ $vanPhong->ma_van_phong }} -
                                        {{ $vanPhong->dien_tich }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="ngay_ky">Ngày ký</label>
                                <input type="date" class="form-control" name="ngay_ky" id="ngay_ky"
                                    value="{{ \Carbon\Carbon::parse($hopDong->ngay_ky)->format('Y-m-d') }}">
                            </div>

                            <div class="col-md-4">
                                <label for="ngay_bat_dau">Ngày bắt đầu</label>
                                <input type="date" class="form-control" name="ngay_bat_dau" id="ngay_bat_dau"
                                    value="{{ \Carbon\Carbon::parse($hopDong->ngay_bat_dau)->format('Y-m-d') }}">
                                <small class="text-danger" id="error_ngay_bat_dau"></small>
                            </div>

                            <div class="col-md-4">
                                <label for="han_hop_dong">Hạn hợp đồng</label>
                                <input type="date" class="form-control" name="han_hop_dong" id="han_hop_dong"
                                    value="{{ \Carbon\Carbon::parse($hopDong->ngay_ket_thuc)->format('Y-m-d') }}">
                                <small class="text-danger" id="error_han_hop_dong"></small>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="trang_thai">Trạng thái</label>
                                <select class="form-control" name="tinh_trang" id="tinh_trang">
                                    <option value="">Chọn trạng thái</option>
                                    <option value="dang thue" {{ $hopDong->tinh_trang == 'dang thue' ? 'selected' : '' }}>
                                        Đang thuê</option>
                                    <option value="da thanh ly"
                                        {{ $hopDong->tinh_trang == 'da thanh ly' ? 'selected' : '' }}>Đã thanh lý</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label for="ghi_chu">Ghi chú</label>
                                <textarea class="form-control" name="ghi_chu" id="ghi_chu">{{ $hopDong->ghi_chu_thanh_ly }}</textarea>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">2. Khách Thuê</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="khach_thue_id">Tên khách thuê</label>
                                <select class="form-control" name="khach_thue_id" id="khach_thue_id">
                                    <option value="{{ $hopDong->user->id }}">{{ $hopDong->user->name }}
                                        ({{ $hopDong->user->so_dien_thoai }})</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="sdt_khach_thue">Số điện thoại</label>
                                <input type="text" id="sdt_khach_thue" class="form-control" name="sdt_khach_thue"
                                    value="{{ $hopDong->user->so_dien_thoai }}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="dai_dien">Người đại diện</label>
                                <input type="text" class="form-control" name="dai_dien" id="dai_dien"
                                    value="{{ $hopDong->user->name }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">3. Tiền Thuê & Cọc</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="tien_thue">Tiền thuê</label>
                                <input type="number" class="form-control" name="tien_thue" id="tien_thue"
                                    value="{{ $chiTiet->gia_thue }}">
                            </div>
                            <div class="col-md-4">
                                <label for="chu_ky">Chu kỳ thanh toán</label>
                                <select name="chu_ky" class="form-control" id="chu_ky">
                                    <option value="1" {{ $hopDong->chu_ky == 1 ? 'selected' : '' }}>Hàng tháng
                                    </option>
                                    <option value="3" {{ $hopDong->chu_ky == 3 ? 'selected' : '' }}>3 tháng</option>
                                    <option value="6" {{ $hopDong->chu_ky == 6 ? 'selected' : '' }}>6 tháng</option>
                                    <option value="12" {{ $hopDong->chu_ky == 12 ? 'selected' : '' }}>12 tháng
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="ngay_bat_dau_tinh_tien">Ngày bắt đầu tính tiền</label>
                                <input type="date" class="form-control" name="ngay_bat_dau_tinh_tien"
                                    value="{{ \Carbon\Carbon::parse($hopDong->ngay_bat_dau)->format('Y-m-d') }}"
                                    id="ngay_bat_dau_tinh_tien">
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label for="tien_coc">Tiền cọc</label>
                            <input type="number" class="form-control" name="tien_coc" id="tien_coc"
                                value="{{ $hopDong->tong_tien_coc }}">
                        </div>
                    </div>
                </div>

                <div class="card mb-5">
                    <div class="card-header">
                        <h4 class="text-primary">4. Chi Tiết</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="gia_dien">Giá điện</label>
                                <input type="number" class="form-control" name="gia_dien" id="gia_dien"
                                    value="{{ $chiTiet->gia_dien }}">
                            </div>
                            <div class="col-md-4">
                                <label for="gia_nuoc">Giá nước</label>
                                <input type="number" class="form-control" name="gia_nuoc" id="gia_nuoc"
                                    value="{{ $chiTiet->gia_nuoc }}">
                            </div>
                            <div class="col-md-4">
                                <label for="dich_vu_khac">Dịch vụ khác</label>
                                <input type="number" class="form-control" name="dich_vu_khac" id="dich_vu_khac"
                                    value="{{ $chiTiet->dich_vu_khac }}">
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label for="note">Chi tiết dịch vụ</label>
                            <textarea class="form-control" name="note" id="note" rows="6">{{ $chiTiet->ghi_chu }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="text-center mb-5">
                    <a href="{{ route('admin.hopdong.index') }}" class="btn btn-danger">Hủy</a>
                    <button type="submit" class="btn btn-primary">Lưu</button>
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

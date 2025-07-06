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
                    @if ($errors->has('error'))
                        <div class="alert alert-danger">
                            {{ $errors->first('error') }}
                        </div>
                    @endif
                </div>
            </div>
            <form action="{{ route('admin.hopdong.store') }}" method="POST">
                @csrf
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">1. Thông Tin Chung</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="toa_nha_id">Tòa nhà</label>
                                    @if (isset($selectedVanPhongId) && isset($selectedToaNhaId))
                                        @php
                                            $toaNhaSelected = $toaNhas->firstWhere(
                                                'ma_toa_nha',
                                                (int) $selectedToaNhaId,
                                            );
                                        @endphp
                                        <input type="hidden" name="toa_nha_id" value="{{ $selectedToaNhaId }}">
                                        <input type="text" class="form-control"
                                            value="{{ $toaNhaSelected->ten_toa_nha }}" readonly>
                                    @else
                                        <select class="form-control" name="toa_nha_id" id="toa_nha_id">
                                            <option value="">-- Chọn tòa nhà --</option>
                                            @foreach ($toaNhas as $toaNha)
                                                <option value="{{ $toaNha->ma_toa_nha }}"
                                                    {{ old('toa_nha_id', $selectedToaNhaId ?? '') == $toaNha->ma_toa_nha ? 'selected' : '' }}>
                                                    {{ $toaNha->ten_toa_nha }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vanphong_id">Phòng</label>
                                    <select name="vanphong_id" class="form-control" id="vanphong_id"
                                        {{ isset($selectedVanPhongId) ? 'readonly disabled' : '' }}>
                                        <option value="">-- Chọn văn phòng --</option>
                                        @foreach ($vanPhongs as $vp)
                                            <option value="{{ $vp->ma_van_phong }}"
                                                {{ old('vanphong_id', $selectedVanPhongId ?? '') == $vp->ma_van_phong ? 'selected' : '' }}>
                                                {{ $vp->ten_van_phong }} - {{ $vp->toaNha->ten_toa_nha }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if (isset($selectedVanPhongId))
                                        <input type="hidden" name="vanphong_id" value="{{ $selectedVanPhongId }}">
                                    @endif
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

                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">2. Khách Thuê</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="ten_khach_thue">Tên khách thuê</label>
                                    <select name="khach_thue_id" class="form-control" id="khach_thue_id"
                                        {{ isset($selectedUserId) ? 'readonly disabled' : '' }}>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ old('khach_thue_id', $selectedUserId ?? '') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} - {{ $user->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if (isset($selectedUserId))
                                        <input type="hidden" name="khach_thue_id" value="{{ $selectedUserId }}">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sdt_khach_thue">Số điện thoại</label>
                                    <input type="number" class="form-control" name="sdt_khach_thue" id="sdt_khach_thue"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="dai_dien">Người đại diện</label>
                                    <input type="text" class="form-control" name="dai_dien" id="dai_dien" readonly>
                                </div>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tien_thue">Giá thuê (VNĐ/m²)</label>
                                    <input type="number" class="form-control" name="tien_thue" id="tien_thue"
                                        placeholder="Ví dụ: 12000000">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ngay_bat_dau_tinh_tien">Ngày bắt đầu tính tiền</label>
                                    <input type="date" class="form-control" name="ngay_bat_dau_tinh_tien"
                                        id="ngay_bat_dau_tinh_tien">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tien_coc">Tiền cọc (VNĐ) <small class="text-muted"> 3 tháng tiền nhà </small></label>
                            <input type="number" class="form-control" name="tien_coc" id="tien_coc"
                                placeholder="Ví dụ: 24000000">
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
                                    <label for="dich_vu_khac">Dịch vụ khác (VNĐ)</label>
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

        // document.addEventListener('DOMContentLoaded', function() {
        //     const toaNhaSelect = document.getElementById('toa_nha_id');
        //     const vanPhongSelect = document.getElementById('vanphong_id');

        //     const giaThueInput = document.getElementById('tien_thue');
        //     const tienCocInput = document.getElementById('tien_coc');
        //     const giaDienInput = document.getElementById('gia_dien');
        //     const giaNuocInput = document.getElementById('gia_nuoc');
        //     const dichVuKhacTextarea = document.getElementById('dich_vu_khac');

        //     toaNhaSelect.addEventListener('change', function() {
        //         const toaNhaId = this.value;
        //         vanPhongSelect.innerHTML = '<option value="">-- Chọn phòng --</option>';

        //         if (toaNhaId) {
        //             fetch(`/admin/ajax/vanphong/${toaNhaId}`)
        //                 .then(res => res.json())
        //                 .then(data => {
        //                     console.log('Danh sách văn phòng:', data);
        //                     data.forEach(vp => {
        //                         const option = document.createElement('option');
        //                         option.value = vp.ma_van_phong;
        //                         option.textContent =
        //                             `Văn phòng ${vp.ma_van_phong} - ${vp.dien_tich} m²`;
        //                         vanPhongSelect.appendChild(option);
        //                     });
        //                 })
        //                 .catch(err => console.error('Lỗi khi fetch văn phòng:', err));
        //         }
        //     });

        //     vanPhongSelect.addEventListener('change', function() {
        //         const vanPhongId = this.value;

        //         if (vanPhongId) {
        //             fetch(`/admin/ajax/vanphong-detail/${vanPhongId}`)
        //                 .then(res => res.json())
        //                 .then(data => {
        //                     console.log('Chi tiết văn phòng:', data);
        //                     giaThueInput.value = data.gia_thue;
        //                     tienCocInput.value = data.gia_thue * data.dien_tich * 3;
        //                     giaDienInput.value = data.gia_dien;
        //                     giaNuocInput.value = data.gia_nuoc;
        //                     dichVuKhacTextarea.value = data.dich_vu_khac;
        //                 })
        //                 .catch(err => console.error('Lỗi khi fetch chi tiết VP:', err));
        //         }
        //     });

        //     const userSelect = document.getElementById('khach_thue_id');
        //     const phoneInput = document.getElementById('sdt_khach_thue');
        //     const daiDienInput = document.getElementById('dai_dien');

        //     userSelect.addEventListener('change', function() {
        //         const userId = this.value;
        //         if (userId) {
        //             fetch(`/admin/ajax/user/${userId}`)
        //                 .then(res => res.json())
        //                 .then(data => {
        //                     phoneInput.value = data.phone || '';
        //                     daiDienInput.value = data.name || '';
        //                 });
        //         } else {
        //             phoneInput.value = '';
        //             daiDienInput.value = '';
        //         }
        //     });

        //     document.getElementById('ngay_ky').addEventListener('change', validateDates);
        //     document.getElementById('ngay_bat_dau').addEventListener('change', validateDates);
        //     document.getElementById('han_hop_dong').addEventListener('change', validateDates);
        //     validateDates();

        // });

        document.addEventListener('DOMContentLoaded', function() {
            const toaNhaSelect = document.getElementById('toa_nha_id');
            const vanPhongSelect = document.getElementById('vanphong_id');
            const userSelect = document.getElementById('khach_thue_id');
            const phoneInput = document.getElementById('sdt_khach_thue');
            const daiDienInput = document.getElementById('dai_dien');
            const tienThueInput = document.getElementById('tien_thue');
            const tienCocInput = document.getElementById('tien_coc');
            const giaDienInput = document.getElementById('gia_dien');
            const giaNuocInput = document.getElementById('gia_nuoc');
            const dichVuKhacInput = document.getElementById('dich_vu_khac');

            console.log('[AUTO] User preset:', userSelect);
            const selectedVanPhongId = '{{ $selectedVanPhongId ?? '' }}';
            const selectedUserId = '{{ $selectedUserId ?? '' }}';

            if (selectedVanPhongId) {
                fetch(`/admin/ajax/vanphong-detail/${selectedVanPhongId}`)
                    .then(res => res.json())
                    .then(data => {
                        console.log('[AUTO] Văn phòng preset:', data);
                        tienThueInput.value = data.gia_thue || '';
                        tienCocInput.value = data.gia_thue * data.dien_tich * 3 || '';
                        giaDienInput.value = data.gia_dien || '';
                        giaNuocInput.value = data.gia_nuoc || '';
                        dichVuKhacInput.value = data.dich_vu_khac || '';
                    })
                    .catch(err => console.error('Lỗi fetch văn phòng preset:', err));
            }

            // if (selectedUserId) {
            //     fetch(`/admin/ajax/user/${selectedUserId}`)
            //         .then(res => res.json())
            //         .then(data => {
            //             console.log('[AUTO] User preset:', data);
            //             phoneInput.value = data.so_dien_thoai || '';
            //             daiDienInput.value = data.name || '';
            //         })
            //         .catch(err => console.error('Lỗi fetch user preset:', err));
            // }
            if (selectedUserId) {
                fetch(`/admin/ajax/user/${selectedUserId}`)
                    .then(res => res.json())
                    .then(data => {
                        setTimeout(() => {
                            console.log('[AUTO] User preset:', data);
                            const phoneInput = document.getElementById('sdt_khach_thue');
                            const daiDienInput = document.getElementById('dai_dien');
                            if (phoneInput && daiDienInput) {
                                phoneInput.value = data.phone || '';
                                daiDienInput.value = data.name || '';
                            }
                        }, 100); // đợi DOM render hoàn tất
                    })
                    .catch(err => console.error('Lỗi fetch user preset:', err));
            }

            toaNhaSelect?.addEventListener('change', function() {
                const toaNhaId = this.value;
                vanPhongSelect.innerHTML = '<option value="">-- Chọn phòng --</option>';

                if (toaNhaId) {
                    fetch(`/admin/ajax/vanphong/${toaNhaId}`)
                        .then(res => res.json())
                        .then(data => {
                            console.log('[DYNAMIC] Văn phòng theo tòa nhà:', data);
                            data.forEach(vp => {
                                const option = document.createElement('option');
                                option.value = vp.ma_van_phong;
                                option.textContent =
                                    `VP ${vp.ten_van_phong} - ${vp.dien_tich} m²`;
                                vanPhongSelect.appendChild(option);
                            });
                        })
                        .catch(err => console.error('Lỗi fetch văn phòng theo tòa:', err));
                }
            });

            vanPhongSelect?.addEventListener('change', function() {
                const vanPhongId = this.value;
                console.log('văn phòng:', vanPhongId);

                if (vanPhongId) {
                    fetch(`/admin/ajax/vanphong-detail/${vanPhongId}`)
                        .then(res => res.json())
                        .then(data => {
                            console.log('[DYNAMIC] Chi tiết văn phòng:', data);
                            tienThueInput.value = data.gia_thue || '';
                            tienCocInput.value = data.gia_thue * data.dien_tich * 3 || '';
                            giaDienInput.value = data.gia_dien || '';
                            giaNuocInput.value = data.gia_nuoc || '';
                            dichVuKhacInput.value = data.dich_vu_khac || '';
                        })
                        .catch(err => console.error('Lỗi fetch detail VP:', err));
                }
            });

            userSelect.addEventListener('change', function() {
                const userId = this.value;

                if (userId) {
                    fetch(`/admin/ajax/user/${userId}`)
                        .then(res => res.json())
                        .then(data => {
                            console.log('[DYNAMIC] Thông tin user:', data);
                            phoneInput.value = data.phone || '';
                            daiDienInput.value = data.name || '';
                        })
                        .catch(err => console.error('Lỗi fetch user:', err));
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

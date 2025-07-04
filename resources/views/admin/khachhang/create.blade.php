@extends('admin.layouts.app')
@section('title', 'Thêm khách hàng')
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert"
                style="display:none; position: fixed; top: 20px; right: 20px; z-index: 1050; min-width: 250px;">
                <strong>Thêm khách hàng thành công</span></strong>
                <button type="button" class="close" aria-label="Close" onclick="$('#successMessage').hide()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Step Form -->
            <form action="{{ route('admin.khachhang.store') }}" method="POST" id="formkhachhang"
                class="js-step-form py-md-5"
                data-hs-step-form-options='{
                    "progressSelector": "#addUserStepFormProgress",
                    "stepsSelector": "#addUserStepFormContent",
                    "endSelector": "#addUserFinishBtn",
                    "isValidate": false
                    }'>
                @csrf
                <div class="row justify-content-lg-center">
                    <div class="col-lg-8">
                        <!-- Step -->
                        <!-- End Step -->

                        <!-- Content Step Form -->
                        <div id="addUserStepFormContent">
                            <!-- Card -->
                            <div id="addUserStepProfile" class="card card-lg active">
                                <!-- Body -->
                                <div class="card-body">

                                    <!-- Form Group -->
                                    <div class="row form-group">
                                        <label class="col-sm-3 col-form-label input-label">Mã khách hàng</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="id"
                                                value="{{ $nextId }}" disabled>
                                            @if(isset($henxem))
                                                <input type="hidden" name="henxem_id" value="{{ $henxem }}">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <label class="col-sm-3 col-form-label input-label">Tên khách hàng</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Nhập tên khách hàng" value="{{ old('name',$khachhang->ho_ten) }}">
                                            <span class="text-danger" id="error-name"></span>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <label class="col-sm-3 col-form-label input-label">Email</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="email" class="form-control" name="email" id="email"
                                                    placeholder="Nhập email" value="{{ old('email',$khachhang->email) }}">
                                            </div>
                                            <span class="text-danger" id="error-email"></span>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <label class="col-sm-3 col-form-label input-label">CCCD</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="cccd" id="cccd"
                                                    placeholder="Nhập cccd" value="{{ old('cccd') }}">
                                            </div>
                                            <span class="text-danger" id="error-cccd"></span>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <label class="col-sm-3 col-form-label input-label">Password</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <span><strong>Password mặc định là số căn cước</strong></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <label class="col-sm-3 col-form-label input-label">Số điện thoại</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="so_dien_thoai"
                                                    placeholder="Nhập số điện thoại" value="{{ old('so_dien_thoai',$khachhang->sdt) }}">
                                            </div>
                                            <span class="text-danger" id="error-so_dien_thoai"></span>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <label class="col-sm-3 col-form-label input-label">Địa chỉ</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="dia_chi"
                                                    placeholder="Nhập địa chỉ" value="{{ old('dia_chi') }}">
                                            </div>
                                            <span class="text-danger" id="error-dia_chi"></span>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <label class="col-sm-3 col-form-label input-label">Vai trò</label>
                                        <div class="col-sm-9">
                                            <div class="select2-custom">
                                                <select class="custom-select" name="vai_tro">
                                                    <option value="KT">Khách hàng</option>
                                                    <option value="Admin">Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <label class="col-sm-3 col-form-label input-label">Trạng thái</label>
                                        <div class="col-sm-9">
                                            <div class="select2-custom">
                                                <select class="custom-select" name="trang_thai">
                                                    <option value="1">Đang sử dụng</option>
                                                    <option value="0">Ngừng hoạt động</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                                <!-- End Body -->

                                <!-- Footer -->
                                <div class="card-footer d-flex justify-content-end align-items-center">
                                    <a href="{{ route('admin.khachhang.index') }}" class="btn btn-danger mr-2">
                                        Hủy
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        Lưu
                                    </button>
                                </div>
                                <!-- End Footer -->
                            </div>
                            <!-- End Card -->
                        </div>
                    </div>
                </div>
            </form>

            {{-- </div> --}}
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('cccd').addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.length > 12) value = value.slice(0, 12);
                    e.target.value = value;
                });

                const emailInput = document.getElementById('email');
                const emailError = document.getElementById('error-email');
                const emailRegex = /^[a-z0-9](\.?[a-z0-9_\-+]){5,}@gmail\.com$/;

                emailInput.addEventListener('input', function() {
                    const value = emailInput.value.trim();

                    if (!value) {
                        emailError.innerText = '';
                        emailInput.classList.remove('is-invalid');
                        return;
                    }

                    if (!emailRegex.test(value)) {
                        emailError.innerText =
                            'Email phải hợp lệ theo định dạng Gmail (ít nhất 6 ký tự trước @gmail.com)';
                        emailInput.classList.add('is-invalid');
                    } else {
                        emailError.innerText = '';
                        emailInput.classList.remove('is-invalid');
                    }
                });

                function translateError(message) {
                    if (message.includes("The name field is required")) return "Vui lòng nhập tên khách hàng";
                    if (message.includes("The email field is required")) return "Vui lòng nhập email";
                    if (message.includes("The cccd field is required")) return "Vui lòng nhập số căn cước";
                    if (message.includes("The email has already been taken.")) return "Email đã được đăng kí";
                    return message;
                }

                $('#formkhachhang').on('submit', function(e) {
                    e.preventDefault();
                    $('.text-danger').html('');

                    const emailValue = emailInput.value.trim();

                    if (!emailRegex.test(emailValue)) {
                        emailError.innerText =
                            'Email phải hợp lệ theo định dạng Gmail (ít nhất 6 ký tự trước @gmail.com)';
                        emailInput.classList.add('is-invalid');
                        return;
                    }

                    $.ajax({
                        url: "{{ route('admin.khachhang.store') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        success: function(response) {
                            if (response.redirect_url) {
                                const params = new URLSearchParams({
                                    vanphong: response.vanphong || '',
                                    success: response.message || ''
                                });
                                window.location.href = response.redirect_url + '?' + params.toString();
                                return;
                            }
                            $('#formkhachhang')[0].reset();
                            $('#successMessage').fadeIn();
                            $('#id').val(response.nextId);

                            setTimeout(function() {
                                $('#successMessage').fadeOut();
                            }, 10000);
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                const errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    $('#error-' + key).text(translateError(value[0]));
                                });
                            }
                        }
                    });
                });
            });
        </script>


    </main>
@endsection

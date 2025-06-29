@extends('admin.layouts.app')
@section('title', 'Thêm văn phòng')

@push('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .ql-picker.ql-align .ql-picker-label svg,
        .ql-picker.ql-align .ql-picker-item svg {
            display: inline-block !important;
            width: 18px !important;
            height: 18px !important;
        }
    </style>
@endpush

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .preview-image {
        position: relative;
        width: 100px;
        height: 100px;
    }

    .preview-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 1px solid #ccc;
    }

    .remove-btn {
        position: absolute;
        top: -10px;
        right: -10px;
        background: red;
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

@section('content')
    <main id="content" role="main" class="main">
        <form action="{{ route('admin.vanphong.store') }}" method="POST" enctype="multipart/form-data" id="formVanPhong"
            class="js-step-form py-md-5"
            data-hs-step-form-options='{
            "progressSelector": "#addUserStepFormProgress",
            "stepsSelector": "#addUserStepFormContent",
            "endSelector": "#addUserFinishBtn",
            "isValidate": false
          }'>
            @csrf
            <!-- Content -->
            <div class="content container-fluid">
                <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert"
                    style="display:none; position: fixed; top: 20px; right: 20px; z-index: 1050; min-width: 250px;">
                    <strong><span id="successText"></span></strong>
                    <button type="button" class="close" aria-label="Close" onclick="$('#successMessage').hide()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col-sm mb-2 mb-sm-0">
                            <nav aria-label="breadcrumb"></nav>
                            <h1 class="page-header-title">Tạo văn phòng</h1>
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
                                <h4 class="card-header-title">Thông tin văn phòng</h4>
                            </div>
                            <!-- End Header -->

                            <!-- Body -->
                            <div class="card-body">

                                <!-- Form Group -->
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="input-label">Mã văn phòng</label>
                                            <input type="text" id="maVanPhong" class="form-control"
                                                value="{{ $nextId }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label class="input-label">Tên văn phòng</label>
                                            <input type="text" class="form-control" name="ten_van_phong"
                                                placeholder="Nhập tên văn phòng" value="{{ old('ten_van_phong') }}">
                                            <span class="text-danger" id="error-ten_van_phong"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label class="input-label">Tòa nhà</label>
                                            <div class="select2-custom">
                                                <select class="js-select2-custom custom-select" name="ma_toa_nha"
                                                    style="opacity: 0;">
                                                    @foreach ($toanhas as $toanha)
                                                        <option value="{{ $toanha->ma_toa_nha }}">{{ $toanha->ten_toa_nha }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="input-label">Diện tích</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="dien_tich" id="dien_tich"
                                                    placeholder="Nhập diện tích" value="{{ old('dien_tich') }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">m²</span>
                                                </div>
                                            </div>
                                            <span class="text-danger" id="error-dien_tich"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="input-label">Giá thuê</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="gia_thue" id="gia_thue"
                                                    placeholder="Nhập giá thuê" value="{{ old('gia_thue') }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">VND</span>
                                                </div>
                                            </div>
                                            <span class="text-danger" id="error-gia_thue"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label class="input-label">Trạng thái</label>
                                            <div class="select2-custom">
                                                <select class="custom-select" name="trang_thai">
                                                    <option value="Dang trong">Đang trống</option>
                                                    <option value="Da thue">Đã thuê</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 col-form-label input-label">Tiện ích</label>
                                    <textarea class="form-control" name="tien_ich" rows="3" value="{{ old('tien_ich') }}"
                                        placeholder="Thông tin tiện ích nếu có..."></textarea>
                                    <span class="text-danger" id="error-tien_ich"></span>
                                </div>

                                <div class="card mb-3 mb-lg-5">
                                    <!-- Header -->
                                    <div class="card-header">
                                        <h4 class="card-header-title">Hình ảnh</h4>
                                    </div>
                                    <!-- End Header -->
                                    <!-- Body -->
                                    <div class="card-body">
                                        <input type="file" name="images[]" id="imageInput" multiple accept="image/*">
                                        <div id="previewContainer" class="preview-container"></div>
                                    </div>
                                    <!-- Body -->
                                </div>

                                <!-- Mô tả -->
                                <div class="form-group">
                                    <label class="col-sm-3 col-form-label input-label">Mô tả</label>
                                    <input type="hidden" name="mo_ta" value="{{ old('mo_ta') }}"
                                        id="hiddenDescription">

                                    <!-- Quill -->
                                    <div class="quill-custom">
                                        <div class="js-quill" style="min-height: 25rem;"
                                            data-hs-quill-options='{
                                            "placeholder": "Nhập mô tả chi tiết...",
                                            "modules": {
                                                "toolbar": [
                                                    ["bold", "italic", "underline"],
                                                    [{"header": [1, 2, 3, false]}],
                                                    [{"align": []}],  
        
                                                    [{"list": "ordered"}, {"list": "bullet"}],
                                                    ["clean"]
                                                ]
                                            }
                                        }'>
                                        </div>
                                    </div>
                                    <span class="text-danger" id="error-mo_ta"></span>
                                </div>

                            </div>
                            <!-- Body -->
                        </div>
                        <!-- End Card -->
                    </div>
                    <!-- End Row -->

                    <div class="position-fixed bottom-0 content-centered-x w-100 z-index-99 mb-3"
                        style="max-width: 40rem;">
                        <!-- Card -->
                        <div class="card card-sm bg-dark border-dark mx-2">
                            <div class="card-body">
                                <div class="row justify-content-center justify-content-sm-between">
                                    <div class="col">
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('admin.vanphong.index') }}" class="btn btn-danger mr-2">
                                            Hủy
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
        <script>
            const imageInput = document.getElementById('imageInput');
            const previewContainer = document.getElementById('previewContainer');
            let selectedFiles = [];

            imageInput.addEventListener('change', function(e) {
                const files = Array.from(e.target.files);
                files.forEach(file => {
                    if (file.type.startsWith('image/')) {
                        selectedFiles.push(file);
                        displayImage(file);
                    }
                });
                updateInputFiles();
            });

            function displayImage(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'preview-image';
                    div.innerHTML = `
                              <img src="${e.target.result}" alt="Preview">
                              <button type="button" class="remove-btn" onclick="removeImage(this, '${file.name}')">X</button>
                          `;
                    previewContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            }

            function removeImage(button, fileName) {
                selectedFiles = selectedFiles.filter(file => file.name !== fileName);
                button.parentElement.remove();
                updateInputFiles();
            }

            function updateInputFiles() {
                const dataTransfer = new DataTransfer();
                selectedFiles.forEach(file => dataTransfer.items.add(file));
                imageInput.files = dataTransfer.files;
            }

            document.getElementById('gia_thue').addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                e.target.dataset.value = value;
                e.target.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            });

            document.getElementById('dien_tich').addEventListener('input', function(e) {
                let value = e.target.value;
                value = value.replace(/[^0-9.]/g, '');

                const parts = value.split('.');
                if (parts.length > 2) {
                    value = parts[0] + '.' + parts.slice(1).join('');
                }
                e.target.dataset.value = value;
                e.target.value = value;
            });

            function translateError(message) {
                if (message.includes("The ten van phong field is required")) return "Vui lòng nhập tên văn phòng";
                if (message.includes("The dien tich field is required")) return "Vui lòng nhập diện tích";
                if (message.includes("The dien tich field must be a number.")) return "Diện tích phải là số";
                if (message.includes("The gia thue field is required")) return "Vui lòng nhập giá thuê";
                if (message.includes("The gia thue must be a number")) return "Giá thuê phải là số";
                if (message.includes("The mo ta field is required")) return "Vui lòng nhập mô tả";
                if (message.includes("The tien ich field is required")) return "Vui lòng nhập tiện ích";
                if (message.includes("The images.* must be an image"))
                    return "Hình ảnh phải là định dạng jpeg, png, jpg, hoặc gif";
                if (message.includes("The images.* may not be greater than 2048 kilobytes"))
                    return "Hình ảnh không được lớn hơn 2MB";
                return message;
            }

            $('#formVanPhong').on('submit', function(e) {
                e.preventDefault();
                $('.text-danger').html('');

                let giaThueThuc = $('#gia_thue').data('value') || '';
                $('#gia_thue').val(giaThueThuc);

                const quillEditor = document.querySelector('.js-quill .ql-editor');
                const content = quillEditor ? quillEditor.innerHTML : '';
                $('#hiddenDescription').val(content);

                const formData = new FormData(this);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: "{{ route('admin.vanphong.store') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#formVanPhong')[0].reset();
                        document.querySelector('.js-quill .ql-editor').innerHTML = '';
                        previewContainer.innerHTML = '';
                        selectedFiles = [];
                        document.getElementById('imageInput').value = '';
                        $('#maVanPhong').val(response.next_id);
                        $('#successText').text('Thêm văn phòng thành công!');
                        $('#successMessage').fadeIn();

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
        </script>
        </form>
    </main>
@endsection

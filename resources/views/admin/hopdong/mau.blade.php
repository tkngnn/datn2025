@extends('admin.layouts.app')
@section('title', 'Sửa mẫu')

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
        <form action="{{ route('admin.hopdong.taomau',$tenmau) }}" method="POST" enctype="multipart/form-data" id="formMau"
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
                <div id="success" class="alert alert-success alert-dismissible fade show" role="alert"
                    style="display:none; position: fixed; top: 20px; right: 20px; z-index: 1050; min-width: 250px;">
                    <strong>Thêm khách hàng thành công từ danh sách hẹn xem</span></strong>
                    <button type="button" class="close" aria-label="Close" onclick="$('#success').hide()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col-sm mb-2 mb-sm-0">
                            <nav aria-label="breadcrumb"></nav>
                            <h1 class="page-header-title">Sửa mẫu</h1>
                        </div>
                    </div>
                    <!-- End Row -->
                </div>
                <!-- End Page Header -->

                <div class="row">
                    <div class="col-lg-12">
                        <!-- Card -->
                        <div class="card mb-3 mb-lg-5">
                            
                            <!-- Body -->
                            <div class="card-body">

                                <!-- Form Group -->
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="input-label">Tên mẫu</label>
                                            <input type="text" class="form-control"
                                                value="{{ $tenmau }}" disabled>
                                            <input type="hidden" name="ten_mau" value="{{ $tenmau }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label class="input-label">Phiên bản hiện tại</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="phien_ban" name="phien_ban"
                                                placeholder="Nhập tên văn phòng" value="{{ $mau->phien_ban }}"disabled>
                                            </div>
                                            <span class="text-danger" id="error-ten_van_phong"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Nội dung -->
                                <div class="form-group">
                                    <label class="col-sm-3 col-form-label input-label">Nội dung</label>
                                    <input type="hidden" name="noi_dung" value="{{ $mau->noi_dung }}"
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
                                        <a href="{{ route('admin.hopdong.index') }}" class="btn btn-danger mr-2">
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
            document.addEventListener('DOMContentLoaded', function() {
                // Hiện thông báo từ sessionStorage nếu có
                const message = sessionStorage.getItem('mauUpdateSuccess');
                if (message) {
                    const msgBox = document.getElementById('success');
                    msgBox.querySelector('strong').textContent = message;
                    msgBox.style.display = 'block';

                    setTimeout(() => {
                        msgBox.style.display = 'none';
                    }, 5000);

                    sessionStorage.removeItem('mauUpdateSuccess');
                }

                // Gán nội dung vào Quill sau khi DOM sẵn sàng
                setTimeout(() => {
                    const editor = document.querySelector('.js-quill .ql-editor');
                    if (editor) {
                        editor.innerHTML = {!! json_encode($mau->noi_dung) !!};
                    }
                }, 100);
            });

            $('#formMau').on('submit', function(e) {
                e.preventDefault();
                $('.text-danger').html('');

                const quillEditor = document.querySelector('.js-quill').__quill;
                const htmlContent = quillEditor.root.innerHTML;
                document.getElementById('hiddenDescription').value = htmlContent;

                const formData = new FormData(this);
                $('.text-danger').html('');

                $.ajax({
                    url: "{{ route('admin.hopdong.taomau',$tenmau) }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        sessionStorage.setItem('mauUpdateSuccess', 'Cập nhật mẫu thành công!');
                        location.reload();
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

@extends('admin.layouts.app')
@section('title', 'Dashboard')

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

@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm mb-2 mb-sm-0">
                        <h1 class="page-header-title">Tạo Tòa Nhà</h1>
                    </div>
                </div>
                <!-- End Row -->
            </div>
            <!-- End Page Header -->
            <form action="{{ route('admin.toanha.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Card -->
                        <div class="card mb-3 mb-lg-5">
                            <!-- Header -->
                            <div class="card-header">
                                <h4 class="card-header-title">Thông tin Tòa Nhà</h4>
                            </div>
                            <!-- End Header -->

                            <!-- Body -->
                            <div class="card-body">
                                <!-- Form Group -->
                                <div class="form-group">
                                    <label for="buildingNameLabel" class="input-label">
                                        Tên Tòa Nhà
                                        <i class="tio-help-outlined text-body ml-1" data-toggle="tooltip"
                                            data-placement="top"
                                            title="Nhập tên đầy đủ của tòa nhà theo giấy phép xây dựng hoặc đăng ký kinh doanh"></i>
                                    </label>

                                    <input type="text" class="form-control" name="building_name" id="buildingNameLabel"
                                        placeholder="Ví dụ: Pax Sky Ung Văn Khiêm" aria-label="Nhập tên tòa nhà">
                                </div>
                                <!-- End Form Group -->

                                <div class="row">
                                    <div class="col-sm-8">
                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <label for="addressLabel" class="input-label">Địa chỉ</label>
                                            <input type="text" class="form-control" name="address" id="addressLabel"
                                                placeholder="Ví dụ: 26 Ung Văn Khiêm, Bình Thạnh" aria-label="Nhập địa chỉ">
                                        </div>
                                        <!-- End Form Group -->
                                    </div>

                                    <div class="col-sm-4">
                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <label for="floorLabel" class="input-label">Số tầng</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="floor_count"
                                                    id="floorLabel" placeholder="Ví dụ: 10" aria-label="Nhập số tầng"
                                                    min="1">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">tầng</span>
                                                </div>
                                            </div>
                                            <small class="form-text">Tổng số tầng của tòa nhà (bao gồm cả tầng hầm nếu
                                                có)</small>
                                        </div>
                                        <!-- End Form Group -->
                                    </div>
                                </div>
                                <!-- End Row -->

                                <div class="row">
                                    <div class="col-sm-8">
                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <label for="statusLabel" class="input-label">Trạng thái</label>
                                            <select class="form-control" name="trang_thai" id="statusLabel">
                                                <option value="hoat dong" selected>Hoạt động</option>
                                                <option value="khong hoat dong">Không hoạt động</option>
                                            </select>
                                        </div>
                                        <!-- End Form Group -->
                                    </div>
                                </div>
                                <!-- End Row -->

                                <label class="input-label">Mô tả<span class="input-label-secondary">(chi
                                        tiết)</span></label>
                                <!-- Hidden input to store Quill HTML -->
                                <input type="hidden" name="mo_ta" id="hiddenDescription">

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
                                <!-- End Quill -->
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
                                    <button type="button" class="btn btn-danger" id="btnCancel">Hủy</button>
                                    <button type="button" class="btn btn-primary" id="btnSave">Lưu</button>
                                </div>
                            </div>
                            <!-- End Row -->
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
        </div>
        <!-- End Content -->

        <!-- Footer -->
        <!-- End Footer -->
    </main>
    </form>
@endsection

@push('scripts')
    <script>
        document.querySelector('.btn-primary').addEventListener('click', function() {
            var quillContent = document.querySelector('.js-quill').children[0].innerHTML;
            document.getElementById('hiddenDescription').value = quillContent;
            this.closest('form').submit();
        });

        document.getElementById('btnSave').addEventListener('click', function() {
            const quillEditor = document.querySelector('.js-quill .ql-editor');
            const content = quillEditor ? quillEditor.innerHTML : '';
            document.getElementById('hiddenDescription').value = content;
            this.closest('form').submit();
        });
        document.getElementById('btnCancel').addEventListener('click', function() {
            window.location.href = "{{ route('admin.toanha.index') }}";
        });
    </script>
@endpush

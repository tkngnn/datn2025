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
    <form action="{{ route('admin.toanha.update', $toaNha->ma_toa_nha) }}" method="POST">
        @csrf
        @method('PUT')
        <main id="content" role="main" class="main">
            <!-- Content -->
            <div class="content container-fluid">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col-sm mb-2 mb-sm-0">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-no-gutter">
                                    <li class="breadcrumb-item"><a class="breadcrumb-link"
                                            href="ecommerce-products.html">Tòa
                                            Nhà</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Cập Nhật Tòa Nhà</li>
                                </ol>
                            </nav>

                            <h1 class="page-header-title">Cập Nhật Tòa Nhà</h1>
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
                                <h4 class="card-header-title">Thông tin Tòa Nhà <span
                                        class="badge badge-soft-dark ml-1">{{ $toaNha->ma_toa_nha }}</span></h4>
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
                                        placeholder="Ví dụ: Pax Sky Ung Văn Khiêm" aria-label="Nhập tên tòa nhà"
                                        value ="{{ old('building_name', $toaNha->ten_toa_nha) }}">
                                </div>
                                <!-- End Form Group -->

                                <div class="row">
                                    <div class="col-sm-8">
                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <label for="addressLabel" class="input-label">Địa chỉ</label>
                                            <input type="text" class="form-control" name="address" id="addressLabel"
                                                placeholder="Ví dụ: 26 Ung Văn Khiêm, Bình Thạnh" aria-label="Nhập địa chỉ"
                                                value ="{{ old('address', $toaNha->dia_chi) }}">
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
                                                    min="1" value="{{ old('floor_count', $toaNha->so_tang) }}">
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
                                                <option value="hoat_dong"
                                                    {{ old('trang_thai', $toaNha->trang_thai) == 'hoat_dong' ? 'selected' : '' }}>
                                                    Hoạt động</option>
                                                <option value="tam_ngung"
                                                    {{ old('trang_thai', $toaNha->trang_thai) == 'tam_ngung' ? 'selected' : '' }}>
                                                    Tạm ngưng</option>
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


                                <!-- Quill -->
                                {{-- <div class="quill-custom">
                                    <div class="js-quill" style="min-height: 15rem;"
                                        data-hs-quill-options='{
                        "placeholder": "Type your description..."
                       }'>
                                    </div>
                                </div> --}}

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
                                    <button type="button" class="btn btn-ghost-danger">Delete</button>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-ghost-light mr-2">Hủy</button>
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
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(() => {
                const editor = document.querySelector('.js-quill .ql-editor');
                if (editor) {
                    editor.innerHTML = {!! json_encode($toaNha->mo_ta) !!};
                }
            }, 100);
        });

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
    </script>
@endpush

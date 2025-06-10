@extends('admin.layouts.app')
@section('title', 'Thêm văn phòng')

@section('content')
    <main id="content" role="main" class="main">
        <form action="{{ route('admin.vanphong.update',$vanphong->ma_van_phong) }}" method="POST" id="formVanPhong" class="js-step-form py-md-5" data-hs-step-form-options='{
            "progressSelector": "#addUserStepFormProgress",
            "stepsSelector": "#addUserStepFormContent",
            "endSelector": "#addUserFinishBtn",
            "isValidate": false
          }'>
          @csrf
          @method('PUT')
            <!-- Content -->
            <div class="content container-fluid">
                <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none; position: fixed; top: 20px; right: 20px; z-index: 1050; min-width: 250px;">
                    <strong><span id="successText"></span></strong> 
                    <button type="button" class="close" aria-label="Close" onclick="$('#successMessage').hide()">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{-- @if ($errors->any())
  <div class="alert alert-danger">
    <strong>Đã có lỗi xảy ra:</strong>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif --}}

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
                                    <!-- Mã văn phòng (không cho nhập) -->
                                            <div class="form-group">
                                            <label class="input-label">Mã văn phòng</label>
                                                <input type="text" id="maVanPhong" class="form-control" value="{{ $vanphong->ma_van_phong }}" disabled>
                                            </div>
                                        </div>
                
                                    <!-- Tên văn phòng -->
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                            <label class="input-label">Tên văn phòng</label>
                                                <input type="text" class="form-control" name="ten_van_phong" placeholder="Nhập tên văn phòng" value="{{ old('ten_van_phong',$vanphong->ten_van_phong) }}">
                                                <span class="text-danger" id="error-ten_van_phong"></span>
                                            </div>
                                        </div>
                                    </div>
                
                                    <!-- Tòa nhà -->
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                            <label class="input-label">Tòa nhà</label>
                                                <div class="select2-custom">
                                                <select class="js-select2-custom custom-select" name="ma_toa_nha" style="opacity: 0;">
                                                    @foreach ($toanhas as $toanha)
                                                        <option value="{{ $toanha->ma_toa_nha }}" {{ $vanphong->ma_toa_nha == $toanha->ma_toa_nha ? 'selected' : '' }} >{{ $toanha->ten_toa_nha }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                
                                    <!-- Diện tích -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            <label class="input-label">Diện tích</label>
                                                <div class="input-group">
                                                <input type="text" class="form-control" name="dien_tich" id="dien_tich" placeholder="Nhập diện tích" value="{{ old('dien_tich',$vanphong->dien_tich) }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">m²</span>
                                                </div>
                                            </div>
                                            <span class="text-danger" id="error-dien_tich"></span>
                                            </div>
                                        </div>
                        
                                            <!-- Giá thuê -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            <label class="input-label">Giá thuê</label>
                                                <div class="input-group">
                                                <input type="text" class="form-control" name="gia_thue" id="gia_thue" placeholder="Nhập giá thuê" value="{{ number_format(old('gia_thue', $vanphong->gia_thue), 0, ',', '.') }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">VND</span>
                                                </div>
                                            </div>
                                            <span class="text-danger" id="error-gia_thue"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Trạng thái -->
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label class="input-label">Trạng thái</label>
                                                <div class="select2-custom">
                                                    <select class="custom-select" name="trang_thai">
                                                        <option value="Dang su dung"{{ $vanphong->trang_thai == 'Dang su dung' ? 'selected' : '' }}>Đang sử dụng</option>
                                                        <option value="Dang bao tri"{{ $vanphong->trang_thai == 'Dang bao tri' ? 'selected' : '' }}>Đang bảo trì</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->

                                    <!-- Tiện ích -->
                                    <div class="form-group">
                                    <label class="col-sm-3 col-form-label input-label">Tiện ích</label>
                                        <textarea class="form-control" name="tien_ich" rows="3" placeholder="Thông tin tiện ích nếu có...">{{ old('tien_ich', $vanphong->tien_ich) }}</textarea>
                                        <span class="text-danger" id="error-tien_ich"></span>
                                    </div>    

                                    <!-- Mô tả -->
                                    <div class="form-group">
                                    <label class="col-sm-3 col-form-label input-label">Mô tả</label>
                                        <input type="hidden" name="mo_ta" value="{{ old('mo_ta',$vanphong->mo_ta) }}" id="hiddenDescription">

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

                    <div class="position-fixed bottom-0 content-centered-x w-100 z-index-99 mb-3" style="max-width: 40rem;">
                        <!-- Card -->
                        <div class="card card-sm bg-dark border-dark mx-2">
                            <div class="card-body">
                                <div class="row justify-content-center justify-content-sm-between">
                                    <div class="col">
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('admin.vanphong.index') }}" class="btn btn-danger mr-2">
                                        <i class="tio-chevron-left"></i> Trở về
                                        </a>
                                        <button type="submit" class="btn btn-primary" >Lưu</button>
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
                    document.addEventListener("DOMContentLoaded", function() {
                        setTimeout(() => {
                            const editor = document.querySelector('.js-quill .ql-editor');
                            if (editor) {
                                editor.innerHTML = {!! json_encode($vanphong->mo_ta) !!};
                            }
                        }, 100);
                    });

                    document.getElementById('gia_thue').addEventListener('input', function (e) {
                        let value = e.target.value.replace(/\D/g, '');
                        e.target.dataset.value = value;
                        e.target.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    });

                    document.getElementById('dien_tich').addEventListener('input', function (e) {
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
                      if(message.includes("The ten van phong field is required")) return "Vui lòng nhập tên văn phòng";
                      if(message.includes("The dien tich field is required")) return "Vui lòng nhập diện tích";
                      if(message.includes("The dien tich field must be a number.")) return "Diện tích phải là số";
                      if(message.includes("The gia thue field is required")) return "Vui lòng nhập giá thuê";
                      if(message.includes("The gia thue must be a number")) return "Giá thuê phải là số";
                      if(message.includes("The mo ta field is required")) return "Vui lòng nhập mô tả";
                      if(message.includes("The tien ich field is required")) return "Vui lòng nhập tiện ích";
                      return message;
                    }
            
                    $('#formVanPhong').on('submit', function(e) {
                      e.preventDefault();
                      $('.text-danger').html('');

                      const quillEditor = document.querySelector('.js-quill .ql-editor');
                    const content = quillEditor ? quillEditor.innerHTML : '';
                    $('#hiddenDescription').val(content);
            
                      $.ajax({
                        url: "{{ route('admin.vanphong.update', $vanphong->ma_van_phong) }}",
                        method: "POST",
                        data: $(this).serialize(),
                        success: function(response) {
                            $('#successText').text('Cập nhật văn phòng thành công!');
                          $('#successMessage').fadeIn();
            
                          setTimeout(function() {
                            $('#successMessage').fadeOut();
                          }, 5000);
                        },
                        error: function(xhr) {
                          if(xhr.status === 422) {
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

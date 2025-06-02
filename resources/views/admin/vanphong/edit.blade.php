@extends('admin.layouts.app')
@section('title', 'Sửa văn phòng')
@section('content')
  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
        <!-- Hiện thông báo -->
        <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none; position: fixed; top: 20px; right: 20px; z-index: 1050; min-width: 250px;">
          <strong>Cập nhật văn phòng thành công</span></strong> 
          <button type="button" class="close" aria-label="Close" onclick="$('#successMessage').hide()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      
      <!-- Step Form -->
      <form action="{{ route('admin.vanphong.update',$vanphong->id) }}" method="POST" id="formVanPhong" class="js-step-form py-md-5" data-hs-step-form-options='{
              "progressSelector": "#addUserStepFormProgress",
              "stepsSelector": "#addUserStepFormContent",
              "endSelector": "#addUserFinishBtn",
              "isValidate": false
            }'>
            @csrf
            @method('PUT')
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
                  <!-- Mã văn phòng (không cho nhập) -->
                  <div class="row form-group">
                    <label class="col-sm-3 col-form-label input-label">Mã văn phòng</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" value="{{ $vanphong->ma_van_phong }}" disabled>
                    </div>
                  </div>

                  <!-- Tên văn phòng -->
                  <div class="row form-group">
                    <label class="col-sm-3 col-form-label input-label">Tên văn phòng</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="ten_van_phong" placeholder="Nhập tên văn phòng" value="{{ old('ten_van_phong',$vanphong->ten_van_phong) }}">
                      <span class="text-danger" id="error-ten_van_phong"></span>
                    </div>
                  </div>

                  <!-- Tòa nhà -->
                  <div class="row form-group">
                    <label class="col-sm-3 col-form-label input-label">Tòa nhà</label>
                    <div class="col-sm-9">
                      <div class="select2-custom">
                        <select class="custom-select" name="ma_toa_nha">
                          @foreach ($toanhas as $toanha)
                            <option value="{{ $toanha->ma_toa_nha }}" {{ $vanphong->ma_toa_nha == $toanha->ma_toa_nha ? 'selected' : '' }} >{{ $toanha->ten_toa_nha }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- Diện tích -->
                  <div class="row form-group">
                    <label class="col-sm-3 col-form-label input-label">Diện tích</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <input type="text" class="form-control" name="dien_tich" placeholder="Nhập diện tích" value="{{ old('dien_tich',$vanphong->dien_tich) }}">
                        <div class="input-group-append">
                          <span class="input-group-text">m²</span>
                        </div>
                      </div>
                      <span class="text-danger" id="error-dien_tich"></span>
                    </div>
                  </div>

                  <!-- Giá thuê -->
                  <div class="row form-group">
                    <label class="col-sm-3 col-form-label input-label">Giá thuê</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <input type="text" class="form-control" name="gia_thue" id="gia_thue" placeholder="Nhập giá thuê" value="{{ number_format(old('gia_thue', $vanphong->gia_thue), 0, ',', '.') }}">
                        <div class="input-group-append">
                          <span class="input-group-text">VND</span>
                        </div>
                      </div>
                      <span class="text-danger" id="error-gia_thue"></span>
                    </div>
                  </div>

                  <!-- Mô tả -->
                  <div class="row form-group">
                    <label class="col-sm-3 col-form-label input-label">Mô tả</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="mo_ta" placeholder="Nhập mô tả" value="{{ old('mo_ta',$vanphong->mo_ta) }}">
                      <span class="text-danger" id="error-mo_ta"></span>
                    </div>
                  </div>

                  <!-- Tiện ích -->
                  <div class="row form-group">
                    <label class="col-sm-3 col-form-label input-label">Tiện ích</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="tien_ich" placeholder="Nhập tiện ích" value="{{ old('tien_ich',$vanphong->tien_ich) }}">
                      <span class="text-danger" id="error-tien_ich"></span>
                    </div>
                  </div>

                  <!-- Trạng thái -->
                  <div class="row form-group">
                    <label class="col-sm-3 col-form-label input-label">Trạng thái</label>
                    <div class="col-sm-9">
                      <div class="select2-custom">
                        <select class="custom-select" name="trang_thai">
                          <option value="Dang su dung"{{ $vanphong->trang_thai == 'Dang su dung' ? 'selected' : '' }}>Đang sử dụng</option>
                          <option value="Dang bao tri"{{ $vanphong->trang_thai == 'Dang bao tri' ? 'selected' : '' }}>Đang bảo trì</option>
                        </select>
                      </div>  
                    </div>
                  </div>
                  <!-- End Form Group -->
                </div>
                <!-- End Body -->

                <!-- Footer -->
                <div class="card-footer d-flex justify-content-end align-items-center">
                  <a href="{{ route('admin.vanphong.index') }}" class="btn btn-danger mr-2">
                    <i class="tio-chevron-left"></i> Trở về
                  </a>
                  <button type="submit" class="btn btn-primary">
                    Cập nhật <i class="tio-chevron-right"></i>
                  </button>                  
                </div>
                <!-- End Footer -->
              </div>
              <!-- End Card -->
            </div>
          </div>
        </div>
    </div>
      <script>
        document.getElementById('gia_thue').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            e.target.dataset.value = value;
            e.target.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
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

          $.ajax({
            url: "{{ route('admin.vanphong.update', $vanphong->ma_van_phong) }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
              $('#successMessage').fadeIn();

              setTimeout(function() {
                $('#successMessage').fadeOut();
              }, 5000);
              const data = response.data;
              $('input[name="name"]').val(data.name);
              $('input[name="email"]').val(data.email);
              $('input[name="so_dien_thoai"]').val(data.so_dien_thoai);
              $('input[name="dia_chi"]').val(data.dia_chi);
              $('input[name="cccd"]').val(data.cccd);
              $('select[name="vai_tro"]').val(data.vai_tro);
              $('select[name="trang_thai"]').val(data.trang_thai);
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
    
    <!-- End Footer -->
  </main>
@endsection
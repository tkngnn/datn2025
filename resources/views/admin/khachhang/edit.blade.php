@extends('admin.layouts.app')
@section('title', 'Cập nhật khách hàng')
@section('content')
  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">

      <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none; position: fixed; top: 20px; right: 20px; z-index: 1050; min-width: 250px;">
        <strong>Cập nhật khách hàng thành công</span></strong> 
        <button type="button" class="close" aria-label="Close" onclick="$('#successMessage').hide()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <!-- Step Form -->
      <form action="{{ route('admin.khachhang.update',$khachhang->id) }}" method="POST" id="formkhachhang" class="js-step-form py-md-5" data-hs-step-form-options='{
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
                  <div class="row form-group">
                    <label class="col-sm-3 col-form-label input-label">Mã khách hàng</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="id" value="{{ $khachhang->id }}" disabled>
                    </div>
                  </div>

                  <div class="row form-group">
                    <label class="col-sm-3 col-form-label input-label">Tên khách hàng</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="name" placeholder="Nhập tên khách hàng" value="{{ old('name',$khachhang->name) }}" @if ($hopdongs > 0) disabled @endif>
                      <input type="hidden" name="name" value="{{ $khachhang->name }}">
                      <span class="text-danger" id="error-name"></span>
                    </div>
                  </div>

                  <div class="row form-group">
                    <label class="col-sm-3 col-form-label input-label">Email</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <input type="email" class="form-control" name="email" placeholder="Nhập email" value="{{ old('email',$khachhang->email) }} " @if ($hopdongs > 0) disabled @endif>
                        <input type="hidden" name="email" value="{{ $khachhang->email }}">
                      </div>
                      <span class="text-danger" id="error-email"></span>
                    </div>
                  </div>

                  <div class="row form-group">
                    <label class="col-sm-3 col-form-label input-label">CCCD</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <input type="text" class="form-control" name="cccd" id="cccd" placeholder="Nhập cccd" value="{{ old('cccd',$khachhang->cccd) }}" @if ($hopdongs > 0) disabled @endif>
                        <input type="hidden" name="cccd" value="{{ $khachhang->cccd }}">
                      </div>
                      <span class="text-danger" id="error-cccd"></span>
                    </div>
                  </div>

                  <div class="row form-group">
                    <label class="col-sm-3 col-form-label input-label">Mật khẩu</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu mới (nếu muốn đổi)">
                      <span class="text-danger" id="error-password"></span>
                    </div>
                  </div>
                  
                  <div class="row form-group">
                    <label class="col-sm-3 col-form-label input-label">Xác nhận mật khẩu</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu">
                      <span class="text-danger" id="error-password_confirmation"></span>
                    </div>
                  </div>

                  <div class="row form-group">
                    <label class="col-sm-3 col-form-label input-label">Số điện thoại</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <input type="text" class="form-control" name="so_dien_thoai" placeholder="Nhập số điện thoại" value="{{ old('so_dien_thoai',$khachhang->so_dien_thoai) }}">
                      </div>
                      <span class="text-danger" id="error-so_dien_thoai"></span>
                    </div>
                  </div>

                  <div class="row form-group">
                    <label class="col-sm-3 col-form-label input-label">Địa chỉ</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <input type="text" class="form-control" name="dia_chi" placeholder="Nhập địa chỉ" value="{{ old('dia_chi',$khachhang->dia_chi) }}">
                      </div>
                      <span class="text-danger" id="error-dia_chi"></span>
                    </div>
                  </div>

                  <div class="row form-group">
                    <label class="col-sm-3 col-form-label input-label">Vai trò</label>
                    <div class="col-sm-9">
                      <div class="select2-custom">
                        <select class="custom-select" name="vai_tro">
                          <option value="KH"{{ $khachhang->vai_tro == 'KH' ? 'selected' : '' }}>Khách hàng</option>
                          <option value="Admin"{{ $khachhang->vai_tro == 'Admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                      </div>  
                    </div>
                  </div>

                  <div class="row form-group">
                    <label class="col-sm-3 col-form-label input-label">Trạng thái</label>
                    <div class="col-sm-9">
                      <div class="select2-custom">
                        <select class="custom-select" name="trang_thai">
                          <option value="1"{{ $khachhang->trang_thai == '1' ? 'selected' : '' }}>Đang sử dụng</option>
                          @if (!$hopdongs > 0)
                            <option value="0"{{ $khachhang->trang_thai == '0' ? 'selected' : '' }}>Ngừng hoạt động</option>          
                          @endif
                        </select>
                        @if ($hopdongs > 0)
                          <span><strong>Chú ý: </strong>Đang có hợp đồng đang thuê/ đã ký không thể thay đổi trạng thái!</span>
                        @endif
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
    </div>
      <script>
        document.getElementById('cccd').addEventListener('input', function (e) {
          let value = e.target.value.replace(/\D/g, '');

          if (value.length > 12) {
              value = value.slice(0, 12);
          }

          e.target.value = value;
        });

        function translateError(message) {
          if(message.includes("The name field is required")) return "Vui lòng nhập tên khách hàng";
          if(message.includes("The email field is required")) return "Vui lòng nhập email";
          if(message.includes("The cccd field is required")) return "Vui lòng nhập số căn cước";
          if(message.includes("The email has already been taken.")) return "Email đã được đăng kí";
          return message;
        }

        $('#formkhachhang').on('submit', function(e) {
          e.preventDefault();
          $('.text-danger').html('');

          const password = $('input[name="password"]').val();
          const passwordConfirm = $('input[name="password_confirmation"]').val();
          
          if (password !== '' && password !== passwordConfirm) {
            e.preventDefault();
            $('#error-password_confirmation').text('Mật khẩu xác nhận không khớp');
            return false;
          }

          $.ajax({
            url: "{{ route('admin.khachhang.update',$khachhang->id) }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
              $('#successMessage').fadeIn();

              setTimeout(function() {
                $('#successMessage').fadeOut();
              }, 10000);
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
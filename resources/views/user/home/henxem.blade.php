@extends('user.layouts.app')
@section('title', 'Trang hẹn xem')
@section('content')

<div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none; position: fixed; top: 20px; right: 20px; z-index: 1050; min-width: 250px;">
    <strong>Gửi yêu cầu thành công</span></strong> 
    <button type="button" class="btn-close btn-sm" aria-label="Close" onclick="$('#successMessage').hide()">
    </button>
  </div>
    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Hẹn xem</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('user.home') }}">Trang chủ</a></li>
            <li class="active"><a href="#">Trang hẹn xem</a></li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Contact 2 Section -->
    <section id="contact-2" class="contact-2 section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 mt-1">
          <div class="col-lg-5" data-aos="fade-up" data-aos-delay="300">
            <iframe
                width="100%"
                height="400"
                frameborder="0"
                style="border:0"
                referrerpolicy="no-referrer-when-downgrade"
                loading="lazy"
                allowfullscreen
                src="https://www.google.com/maps?q={{ urlencode($vanphong->toaNha->dia_chi) }}&output=embed">
            </iframe>          
        </div><!-- End Google Maps -->

          <div class="col-lg-7">
            <form action="{{ route('user.vanphong.guiyeucau') }}" method="POST" id="formhenxem" class="php-email-form" data-aos="fade-up" data-aos-delay="400">
              @csrf
                <div class="row gy-4">

                <div class="col-md-6">
                    <label class="input-label">Mã văn phòng</label>
                    <input type="text" class="form-control" value="{{ $vanphong->ma_van_phong }}" disabled>
                    <input type="hidden" name="ma_van_phong" value="{{ $vanphong->ma_van_phong }}">
                  </div>
  
                  <div class="col-md-6 ">
                    <label class="input-label">Tên văn phòng</label>
                    <input type="email" class="form-control" value="{{ $vanphong->ten_van_phong }}" disabled>
                    <input type="hidden" name="ten_van_phong" value="{{ $vanphong->ten_van_phong }}">
                  </div>

                <div class="col-md-6">
                    <label class="input-label">Họ tên</label>
                    @if (auth()->check())
                    <input type="text" name="ho_ten" class="form-control" value="{{ auth()->user()->name }}" disabled>
                    <input type="hidden" name="ho_ten" value="{{ auth()->user()->name }}" >
                    @else
                    <input type="text" name="ho_ten" class="form-control" placeholder="Nhập họ tên của bạn">
                    @endif
                    <span class="text-danger" id="error-ho_ten"></span>
                </div>

                <div class="col-md-6 ">
                    <label class="input-label">Email</label>
                    @if (auth()->check())
                    <input type="email" id="email" class="form-control" name="email" value="{{ auth()->user()->email }}" disabled>
                    <input type="hidden" id="email" name="email" value="{{ auth()->user()->email }}" >
                    @else
                    <input type="email" id="email" class="form-control" name="email" placeholder="Nhập email">
                    @endif
                    <span class="text-danger" id="error-email"></span>
                </div>

                <div class="col-md-6 ">
                    <label class="input-label">Số điện thoại</label>
                    @if (auth()->check())
                    <input type="text" class="form-control" name="sdt" value="{{ auth()->user()->so_dien_thoai }}" disabled>
                    <input type="hidden" name="sdt" value="{{ auth()->user()->so_dien_thoai }}" >
                    @else
                    <input type="text" class="form-control" name="sdt" placeholder="Nhập số điện thoại">
                    @endif
                    <span class="text-danger" id="error-sdt"></span>
                </div>

                <div class="col-md-6">
                    <label class="input-label">Thời gian</label>
                    <input type="datetime-local" class="form-control" name="ngay_hen">
                    <span class="text-danger" id="error-ngay_hen"></span>
                </div>                

                <div class="col-md-12">
                    <label class="input-label">Ghi chú</label>
                    <textarea class="form-control" name="ghi_chu" rows="6" placeholder="Message"></textarea>
                    <span class="text-danger" id="error-ghi_chu"></span>
                </div>

                <div class="col-md-12 text-center">
                  <button type="submit">Gửi yêu cầu</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact 2 Section -->

@endsection
@push('scripts')

<script>
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
    if (message.includes("The ho ten field is required.")) return "Vui lòng nhập họ tên";
    if (message.includes("The email field is required")) return "Vui lòng nhập email";
    if (message.includes("The sdt field is required")) return "Vui lòng nhập số điện thoại";
    if (message.includes("The ngay hen field is required")) return "Vui lòng chọn thời gian";
    return message;
    }

    $('#formhenxem').on('submit', function(e) {
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
        url: "{{ route('user.vanphong.guiyeucau') }}",
        method: "POST",
        data: $(this).serialize(),
        success: function(response) {
          $('#formhenxem')[0].reset();
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

@endpush
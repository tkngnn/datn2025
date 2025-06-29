@extends('user.layouts.app')
@section('title', 'Dashboard')
@push('styles')
@endpush
@section('content')
<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Liên hệ</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Trang chủ</a></li>
            <li class="current">Liên hệ</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Contact 2 Section -->
    <section id="contact-2" class="contact-2 section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4 align-items-stretch">
          <!-- Cột trái: Google Map -->
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <iframe src="https://www.google.com/maps?q=65+Huỳnh+Thúc+Kháng,+Bến+Nghé,+Quận+1,+Hồ+Chí+Minh+700000&output=embed" 
                    frameborder="0" 
                    style="border:0; width: 100%; height: 100%;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
      
          <!-- Cột phải: Thông tin liên hệ -->
          <div class="col-lg-6">
            <div class="row gy-4 h-100">
      
              <div class="col-12">
                <div class="info-item d-flex flex-column justify-content-center align-items-center h-100" data-aos="fade-up" data-aos-delay="200">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Địa chỉ</h3>
                  <p>65 Huỳnh Thúc Kháng, Bến Nghé, Quận 1, Hồ Chí Minh 700000</p>
                </div>
              </div>
      
              <div class="col-6">
                <a href="tel:02838212360">
                  <div class="info-item d-flex flex-column justify-content-center align-items-center h-100" data-aos="fade-up" data-aos-delay="300">
                    <i class="bi bi-telephone"></i>
                    <h3>Điện thoại</h3>
                    <p style="color: black">028 3821 2360</p>
                  </div>
                </a>
              </div>
      
              <div class="col-6">
                <a href="mailto:info@niceoffice.com.vn">
                  <div class="info-item d-flex flex-column justify-content-center align-items-center h-100" data-aos="fade-up" data-aos-delay="400">
                    <i class="bi bi-envelope"></i>
                    <h3>Email</h3>
                    <p style="color: black">info@bgroup.com.vn</p>
                  </div>
                </a>
              </div>
      
            </div>
          </div>
        </div>
      </div>      
    </section><!-- /Contact 2 Section -->

  </main>
@endsection
@push('scripts')
@endpush
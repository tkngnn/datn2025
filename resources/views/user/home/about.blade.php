@extends('user.layouts.app')
@section('title', 'Dashboard')
@push('styles')
@endpush
@section('content')
<main class="main">
    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Giới thiệu về BGROUP</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Giới thiệu về chúng tôi</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- About 2 Section -->
    <section id="about-2" class="about-2 section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-6">
            <h2 class="about-title">Về BGROUP</h2>
            <p class="about-description"><p><strong>Thành lập từ năm 2013</strong>, với nhiều năm nỗ lực không ngừng nghỉ từ đội ngũ lãnh đạo đến toàn thể nhân viên, <strong>Bgroup</strong> đã từng bước khẳng định vị thế là một trong những đơn vị tiên phong trong lĩnh vực <strong>cho thuê văn phòng và cung cấp dịch vụ hỗ trợ pháp lý dành cho doanh nghiệp</strong>.</p>
            
            </p>
          </div>
          <div class="col-lg-6">
            <p class="about-text"><p>Tại Bgroup, <strong>chúng tôi xem mỗi khách hàng như một người bạn đồng hành</strong>. Sứ mệnh của chúng tôi là được sát cánh cùng bạn vượt qua những thách thức, hỗ trợ giải quyết các thủ tục pháp lý, địa chỉ kinh doanh và nhiều vấn đề phát sinh trong quá trình vận hành doanh nghiệp.</p></p>
            <p class="about-text"><p>Chúng tôi hướng đến mục tiêu xây dựng <strong>Công ty Cổ phần Bgroup</strong> trở thành <strong>thương hiệu hàng đầu về dịch vụ văn phòng và hỗ trợ kinh doanh tại Việt Nam</strong>, đồng thời không ngừng mở rộng, <strong>vươn tầm ra thị trường khu vực ASEAN</strong>.</p></p>
          </div>
        </div>

        <div class="row features-boxes gy-4 mt-3">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
              <div class="feature-box">
                <div class="icon-box">
                  <i class="bi bi-bullseye"></i>
                </div>
                <h3><a href="#" class="stretched-link">Sứ mệnh rõ ràng</a></h3>
                <p>Đồng hành cùng doanh nghiệp vượt qua mọi thủ tục pháp lý và hành chính, mang lại giải pháp toàn diện cho địa chỉ kinh doanh.</p>
              </div>
            </div>
          
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
              <div class="feature-box">
                <div class="icon-box">
                  <i class="bi bi-person-check"></i>
                </div>
                <h3><a href="#" class="stretched-link">Uy tín và tận tâm</a></h3>
                <p>Chúng tôi xem khách hàng như người thân, luôn lắng nghe và phục vụ bằng sự chuyên nghiệp, tận tâm và trách nhiệm.</p>
              </div>
            </div>
          
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
              <div class="feature-box">
                <div class="icon-box">
                  <i class="bi bi-clipboard-data"></i>
                </div>
                <h3><a href="#" class="stretched-link">Tầm nhìn rộng mở</a></h3>
                <p>Hướng đến trở thành thương hiệu hàng đầu tại Việt Nam và vươn tầm ra khu vực ASEAN trong lĩnh vực văn phòng và dịch vụ hỗ trợ doanh nghiệp.</p>
              </div>
            </div>
          </div>          

        {{-- <div class="row mt-5">
          <div class="col-lg-12" data-aos="zoom-in" data-aos-delay="200">
            <div class="video-box">
              <img src="assets/img/about/about-wide-1.webp" class="img-fluid" alt="Video Thumbnail">
              <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
            </div>
          </div>
        </div> --}}

      </div>

    </section><!-- /About 2 Section -->

    <section id="stats" class="stats section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row align-items-center">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
              <div class="avatars d-flex align-items-center">
                <img src="assets/img/person/person-m-2.webp" alt="Avatar 1" class="rounded-circle" loading="lazy">
                <img src="assets/img/person/person-m-3.webp" alt="Avatar 2" class="rounded-circle" loading="lazy">
                <img src="assets/img/person/person-f-5.webp" alt="Avatar 3" class="rounded-circle" loading="lazy">
                <img src="assets/img/person/person-m-5.webp" alt="Avatar 4" class="rounded-circle" loading="lazy">
              </div>
            </div>
      
            <div class="col-lg-8">
              <div class="row counters">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <h2><span data-purecounter-start="0" data-purecounter-end="100" data-purecounter-duration="1" class="purecounter"></span>+</h2>
                    <p>Văn phòng cho thuê tại TP.HCM</p>
                </div>
      
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                  <h2><span data-purecounter-start="0" data-purecounter-end="50" data-purecounter-duration="1" class="purecounter"></span>+</h2>
                  <p>Văn phòng đã được cho thuê</p>
                </div>
      
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                  <h2><span data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="1" class="purecounter"></span>+</h2>
                  <p>Năm kinh nghiệm hỗ trợ pháp lý</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>      

      <section id="testimonials" class="testimonials section">
        <div class="container">
          <div class="testimonial-masonry">
      
            <div class="testimonial-item" data-aos="fade-up">
              <div class="testimonial-content">
                <div class="quote-pattern">
                  <i class="bi bi-quote"></i>
                </div>
                <p>Bgroup đã giúp chúng tôi hoàn tất thủ tục pháp lý mở công ty nhanh chóng và đúng quy định. Dịch vụ tận tâm, hỗ trợ chuyên nghiệp.</p>
                <div class="client-info">
                  <div class="client-image">
                    <img src="assets/img/person/person-f-7.webp" alt="Client">
                  </div>
                  <div class="client-details">
                    <h3>Nguyễn Thị Mai</h3>
                    <span class="position">CEO Công ty TNHH MaiTech</span>
                  </div>
                </div>
              </div>
            </div>
      
            <div class="testimonial-item highlight" data-aos="fade-up" data-aos-delay="100">
              <div class="testimonial-content">
                <div class="quote-pattern">
                  <i class="bi bi-quote"></i>
                </div>
                <p>Không gian văn phòng tại Bgroup rất chuyên nghiệp, đầy đủ tiện nghi, giúp chúng tôi xây dựng hình ảnh uy tín trong mắt đối tác.</p>
                <div class="client-info">
                  <div class="client-image">
                    <img src="assets/img/person/person-m-7.webp" alt="Client">
                  </div>
                  <div class="client-details">
                    <h3>Trần Văn Hùng</h3>
                    <span class="position">Giám đốc VinaGreen</span>
                  </div>
                </div>
              </div>
            </div>
      
            <div class="testimonial-item" data-aos="fade-up" data-aos-delay="200">
              <div class="testimonial-content">
                <div class="quote-pattern">
                  <i class="bi bi-quote"></i>
                </div>
                <p>Nhờ sự hỗ trợ pháp lý từ Bgroup, doanh nghiệp của chúng tôi đã tiết kiệm được nhiều thời gian và chi phí trong quá trình hoạt động.</p>
                <div class="client-info">
                  <div class="client-image">
                    <img src="assets/img/person/person-f-8.webp" alt="Client">
                  </div>
                  <div class="client-details">
                    <h3>Phạm Hồng Ánh</h3>
                    <span class="position">Founder StartUp GoBiz</span>
                  </div>
                </div>
              </div>
            </div>
      
            <div class="testimonial-item" data-aos="fade-up" data-aos-delay="300">
              <div class="testimonial-content">
                <div class="quote-pattern">
                  <i class="bi bi-quote"></i>
                </div>
                <p>Chúng tôi chọn Bgroup vì sự chuyên nghiệp và minh bạch trong dịch vụ. Từ tư vấn, hợp đồng đến hậu mãi đều rất hài lòng.</p>
                <div class="client-info">
                  <div class="client-image">
                    <img src="assets/img/person/person-m-8.webp" alt="Client">
                  </div>
                  <div class="client-details">
                    <h3>Lê Minh Tuấn</h3>
                    <span class="position">Quản lý Công ty M&A Solutions</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="testimonial-item highlight" data-aos="fade-up" data-aos-delay="100">
                <div class="testimonial-content">
                  <div class="quote-pattern">
                    <i class="bi bi-quote"></i>
                  </div>
                  <p>Không gian văn phòng tại Bgroup rất chuyên nghiệp, đầy đủ tiện nghi, giúp chúng tôi xây dựng hình ảnh uy tín trong mắt đối tác.</p>
                  <div class="client-info">
                    <div class="client-image">
                      <img src="assets/img/person/person-m-7.webp" alt="Client">
                    </div>
                    <div class="client-details">
                      <h3>Trần Văn Hùng</h3>
                      <span class="position">Giám đốc điều hành GLO Consulting</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="testimonial-item " data-aos="fade-up" data-aos-delay="100">
                <div class="testimonial-content">
                  <div class="quote-pattern">
                    <i class="bi bi-quote"></i>
                  </div>
                  <p>Không gian văn phòng tại Bgroup rất chuyên nghiệp, đầy đủ tiện nghi, giúp chúng tôi xây dựng hình ảnh uy tín trong mắt đối tác.</p>
                  <div class="client-info">
                    <div class="client-image">
                      <img src="assets/img/person/person-m-7.webp" alt="Client">
                    </div>
                    <div class="client-details">
                      <h3>Trần Văn Hùng</h3>
                      <span class="position">CEO AlphaTech Việt Nam</span>
                    </div>
                  </div>
                </div>
              </div>
      
          </div>
        </div>
      </section>
      

  </main>
@endsection
@push('scripts')
@endpush
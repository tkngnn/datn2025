@extends('user.layouts.app')
@section('title', 'Dashboard')
@push('styles')
@endpush
@section('content')
    <main class="main">
        <div class="page-title light-background">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Giới thiệu về BGROUP</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ route('user.home') }}">Trang chủ</a></li>
                        <li class="active"><a href="#">Giới thiệu về chúng tôi</a></li>
                    </ol>
                </nav>
            </div>
        </div>

        <section id="about-2" class="about-2 section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="about-title">Về BGROUP</h2>
                        <p class="about-description">
                        <p><strong>Thành lập từ năm 2013</strong>, với nhiều năm nỗ lực không ngừng nghỉ từ đội ngũ lãnh đạo
                            đến toàn thể nhân viên, <strong>Bgroup</strong> đã từng bước khẳng định vị thế là một trong
                            những đơn vị tiên phong trong lĩnh vực <strong>cho thuê văn phòng và cung cấp dịch vụ hỗ trợ
                                pháp lý dành cho doanh nghiệp</strong>.</p>

                        </p>
                    </div>
                    <div class="col-lg-6">
                        <p class="about-text">
                        <p>Tại Bgroup, <strong>chúng tôi xem mỗi khách hàng như một người bạn đồng hành</strong>. Sứ mệnh
                            của chúng tôi là được sát cánh cùng bạn vượt qua những thách thức, hỗ trợ giải quyết các thủ tục
                            pháp lý, địa chỉ kinh doanh và nhiều vấn đề phát sinh trong quá trình vận hành doanh nghiệp.</p>
                        </p>
                        <p class="about-text">
                        <p>Chúng tôi hướng đến mục tiêu xây dựng <strong>Công ty Cổ phần Bgroup</strong> trở thành
                            <strong>thương hiệu hàng đầu về dịch vụ văn phòng và hỗ trợ kinh doanh tại Việt Nam</strong>,
                            đồng thời không ngừng mở rộng, <strong>vươn tầm ra thị trường khu vực ASEAN</strong>.
                        </p>
                        </p>
                    </div>
                </div>

                <div class="row features-boxes gy-4 mt-3">
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="feature-box">
                            <div class="icon-box">
                                <i class="bi bi-bullseye"></i>
                            </div>
                            <h3><a href="#" class="stretched-link">Sứ mệnh rõ ràng</a></h3>
                            <p>Đồng hành cùng doanh nghiệp vượt qua mọi thủ tục pháp lý và hành chính, mang lại giải pháp
                                toàn diện cho địa chỉ kinh doanh.</p>
                        </div>
                    </div>

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature-box">
                            <div class="icon-box">
                                <i class="bi bi-person-check"></i>
                            </div>
                            <h3><a href="#" class="stretched-link">Uy tín và tận tâm</a></h3>
                            <p>Chúng tôi xem khách hàng như người thân, luôn lắng nghe và phục vụ bằng sự chuyên nghiệp, tận
                                tâm và trách nhiệm.</p>
                        </div>
                    </div>

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
                        <div class="feature-box">
                            <div class="icon-box">
                                <i class="bi bi-clipboard-data"></i>
                            </div>
                            <h3><a href="#" class="stretched-link">Tầm nhìn rộng mở</a></h3>
                            <p>Hướng đến trở thành thương hiệu hàng đầu tại Việt Nam và vươn tầm ra khu vực ASEAN trong lĩnh
                                vực văn phòng và dịch vụ hỗ trợ doanh nghiệp.</p>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section id="stats" class="stats section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-center">
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="avatars d-flex align-items-center">
                            <img src="{{ asset('user/assets/img/about/user3.jpg') }}" alt="Avatar 1" class="rounded-circle"
                                loading="lazy">
                            <img src="{{ asset('user/assets/img/about/user4.jpg') }}" alt="Avatar 1" class="rounded-circle"
                                loading="lazy">
                            <img src="{{ asset('user/assets/img/about/user3.jpg') }}" alt="Avatar 1" class="rounded-circle"
                                loading="lazy">
                            <img src="{{ asset('user/assets/img/about/user4.jpg') }}" alt="Avatar 1" class="rounded-circle"
                                loading="lazy">
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="row counters">
                            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                                <h2><span data-purecounter-start="0" data-purecounter-end="{{ $tongVanPhong }}"
                                        data-purecounter-duration="1" class="purecounter">
                                    </span></h2>
                                <p>Văn phòng cho thuê tại TP.HCM</p>
                            </div>

                            <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                                <h2><span data-purecounter-start="0" data-purecounter-end="{{ $vanPhongDaChoThue }}"
                                        data-purecounter-duration="1" class="purecounter">
                                    </span></h2>
                                <p>Văn phòng đã được cho thuê</p>
                            </div>

                            <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                                <h2><span data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="1"
                                        class="purecounter"></span>+</h2>
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
                            <p>Quy trình đăng ký địa chỉ kinh doanh và hỗ trợ pháp lý tại Bgroup thật sự nhanh gọn và rõ
                                ràng. Tôi cảm thấy rất an tâm khi đồng hành cùng họ.</p>
                            <div class="client-info">
                                <div class="client-image">
                                    <img src="{{ asset('user/assets/img/about/user2.jpg') }}" alt="Client">
                                </div>
                                <div class="client-details">
                                    <h3>Hoàng Thị Ngọc</h3>
                                    <span class="position">Giám đốc Công ty Luật HN Legal</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="testimonial-item highlight" data-aos="fade-up" data-aos-delay="100">
                        <div class="testimonial-content">
                            <div class="quote-pattern">
                                <i class="bi bi-quote"></i>
                            </div>
                            <p>Chúng tôi rất hài lòng với môi trường làm việc tại Bgroup – không gian yên tĩnh, hiện đại và
                                dịch vụ hỗ trợ kịp thời mọi lúc.</p>
                            <div class="client-info">
                                <div class="client-image">
                                    <img src="{{ asset('user/assets/img/about/user1.jpg') }}" alt="Client">
                                </div>
                                <div class="client-details">
                                    <h3>Nguyễn Văn Long</h3>
                                    <span class="position">Trưởng phòng R&D - NextStep Labs</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="testimonial-item" data-aos="fade-up" data-aos-delay="200">
                        <div class="testimonial-content">
                            <div class="quote-pattern">
                                <i class="bi bi-quote"></i>
                            </div>
                            <p>Việc thuê văn phòng tại Bgroup đã góp phần nâng tầm hình ảnh thương hiệu của chúng tôi. Đội
                                ngũ hỗ trợ luôn chuyên nghiệp và thân thiện.</p>
                            <div class="client-info">
                                <div class="client-image">
                                    <img src="{{ asset('user/assets/img/about/user2.jpg') }}" alt="Client">
                                </div>
                                <div class="client-details">
                                    <h3>Phạm Tuấn Kiệt</h3>
                                    <span class="position">Giám đốc điều hành CodaHub</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="testimonial-item" data-aos="fade-up" data-aos-delay="300">
                        <div class="testimonial-content">
                            <div class="quote-pattern">
                                <i class="bi bi-quote"></i>
                            </div>
                            <p>Tôi đánh giá cao phong cách làm việc minh bạch, chi tiết trong hợp đồng và sự hỗ trợ tận tâm
                                từ đội ngũ Bgroup ngay từ ngày đầu làm việc.</p>
                            <div class="client-info">
                                <div class="client-image">
                                    <img src="{{ asset('user/assets/img/about/user1.jpg') }}" alt="Client">
                                </div>
                                <div class="client-details">
                                    <h3>Trịnh Lê Phương</h3>
                                    <span class="position">Quản lý Nhân sự - Orion Studio</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="testimonial-item highlight" data-aos="fade-up" data-aos-delay="400">
                        <div class="testimonial-content">
                            <div class="quote-pattern">
                                <i class="bi bi-quote"></i>
                            </div>
                            <p>Từ không gian đến dịch vụ đều vượt kỳ vọng. Bgroup là lựa chọn lý tưởng cho các startup cần
                                sự chuyên nghiệp nhưng linh hoạt.</p>
                            <div class="client-info">
                                <div class="client-image">
                                    <img src="{{ asset('user/assets/img/about/user1.jpg') }}" alt="Client">
                                </div>
                                <div class="client-details">
                                    <h3>Lưu Thảo Nhi</h3>
                                    <span class="position">Founder AhaCommerce</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="testimonial-item" data-aos="fade-up" data-aos-delay="500">
                        <div class="testimonial-content">
                            <div class="quote-pattern">
                                <i class="bi bi-quote"></i>
                            </div>
                            <p>Sau hơn 6 tháng hoạt động tại đây, chúng tôi hoàn toàn hài lòng với chất lượng dịch vụ, hệ
                                thống an ninh và sự hỗ trợ kỹ thuật của tòa nhà.</p>
                            <div class="client-info">
                                <div class="client-image">
                                    <img src="{{ asset('user/assets/img/about/user2.jpg') }}" alt="Client">
                                </div>
                                <div class="client-details">
                                    <h3>Đặng Quốc Dũng</h3>
                                    <span class="position">COO Công ty TNHH DevFlex</span>
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

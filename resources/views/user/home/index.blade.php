@extends('user.layouts.app')
@section('title', 'Dashboard')
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
@endpush
@section('content')
    <section class="office-hero hero section" id="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 content-col" data-aos="fade-right" data-aos-delay="100">
                    <div class="content">
                        <span class="promo-badge">Dịch vụ chuyên nghiệp</span>
                        <h1>BGroup - Giải pháp <span>Quản lý & Cho thuê văn phòng</span> hiện đại.</h1>
                        <p>BGroup Office là hệ thống quản lý cho thuê văn phòng chuyên nghiệp, hỗ trợ khách hàng dễ dàng tìm
                            kiếm, đặt lịch hẹn và theo dõi hợp đồng tại các tòa nhà thuộc BGroup. Hệ thống tích hợp thanh
                            toán trực tuyến, báo cáo doanh thu và hỗ trợ quản lý toàn diện cho nhân viên quản trị tòa nhà.
                        </p>


                        <div class="hero-cta">
                            <a href="{{ route('user.danhsach') }}" class="btn btn-primary">Tìm kiếm <i
                                    class="bi bi-search"></i></a>
                            <a href="#" class="btn btn-outline-secondary">Liên hệ ngay</a>
                        </div>

                        <div class="hero-features">
                            <div class="feature-item">
                                <i class="bi bi-geo-alt"></i>
                                <span>Đa dạng địa điểm</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-building"></i>
                                <span>Nhiều loại văn phòng</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-headset"></i>
                                <span>Tư vấn 24/7</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 image-col" data-aos="fade-left" data-aos-delay="200">
                    <div class="hero-image">
                        <img src="{{ asset('user/assets/img/index/buildsilder.jpg') }}" alt="Văn phòng cho thuê"
                            class="img-fluid rounded" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="about-content">
                        <h2 class="section-title">Về BGroup Office</h2>
                        <p>
                            BGroup Office là hệ thống hỗ trợ quản lý và cho thuê văn phòng hiện đại tại TP.HCM. Chúng tôi
                            cung cấp nền tảng giúp khách hàng dễ dàng tìm kiếm văn phòng, đặt lịch hẹn, ký hợp đồng và thanh
                            toán trực tuyến – tất cả trong một hệ thống duy nhất.
                        </p>

                        <h3 class="sub-title">Tại sao chọn BGroup Office?</h3>
                        <ul class="feature-list">
                            <li><i class="bi bi-check-circle-fill"></i> Tìm kiếm văn phòng phù hợp chỉ với vài thao tác</li>
                            <li><i class="bi bi-check-circle-fill"></i> Quản lý hợp đồng, lịch hẹn và thanh toán dễ dàng
                            </li>
                            <li><i class="bi bi-check-circle-fill"></i> Gửi yêu cầu hỗ trợ và theo dõi tiến độ xử lý</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="end-grid">
                        <div class="row">
                            <div class="col-6 mb-4">
                                <div class="stat-item text-center">
                                    <div class="stat-number">10+</div>
                                    <div class="stat-text">Tòa nhà văn phòng đang được quản lý</div>
                                </div>
                            </div>
                            <div class="col-6 mb-4">
                                <div class="stat-item text-center">
                                    <div class="stat-number">50+</div>
                                    <div class="stat-text">Văn phòng đã được cho thuê</div>
                                </div>
                            </div>
                            <div class="col-6 mb-4">
                                <div class="stat-item text-center">
                                    <div class="stat-number">100+</div>
                                    <div class="stat-text">Khách hàng đã sử dụng dịch vụ</div>
                                </div>
                            </div>
                            <div class="col-6 mb-4">
                                <div class="stat-item text-center">
                                    <div class="stat-number">24/7</div>
                                    <div class="stat-text">Hỗ trợ tư vấn và xử lý yêu cầu khách thuê</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="districts-slider py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Văn phòng tại TP.HCM</h2>
            <div class="swiper districtsSwiperHCM">
                <div class="swiper-wrapper">
                    @foreach (array_chunk($thongKeHCM, 2) as $group)
                        <div class="swiper-slide">
                            @foreach ($group as $item)
                                <a href="{{ route('user.danhsach') }}?ten_toa_nha={{ urlencode($item['quan']) }}"
                                    class="text-decoration-none text-dark">
                                    <div class="district-card text-center p-3">
                                        <img src="{{ $item['hinh_anh'] }}" alt="{{ $item['quan'] }}"
                                            class="mb-2 rounded shadow"
                                            style="width: 100%; height: 150px; object-fit: cover;">
                                        <h3 class="district-name">{{ $item['quan'] }}</h3>
                                        <div class="district-count">{{ $item['so_toa_nha'] }}+ tòa nhà</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next districtsSwiperHCM-next"></div>
                <div class="swiper-button-prev districtsSwiperHCM-prev"></div>
                <div class="swiper-scrollbar districtsSwiperHCM-scrollbar"></div>
            </div>

        </div>
    </section>

    <section class="districts-slider py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Văn phòng tại Hà Nội</h2>
            <div class="swiper districtsSwiperHN">
                <div class="swiper-wrapper">
                    @foreach ($thongKeHN as $item)
                        <div class="swiper-slide">
                            <a href="{{ route('user.danhsach') }}?ten_toa_nha={{ urlencode($item['quan']) }}">
                                <div class="district-card text-center p-3">
                                    <img src="{{ $item['hinh_anh'] }}" alt="{{ $item['quan'] }}"
                                        class="mb-2 rounded shadow" style="width: 100%; height: 150px; object-fit: cover;">
                                    <h3 class="district-name">{{ $item['quan'] }}</h3>
                                    <div class="district-count">{{ $item['so_toa_nha'] }}+ tòa nhà</div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
                <div class="swiper-button-next districtsSwiperHN-next"></div>
                <div class="swiper-button-prev districtsSwiperHN-prev"></div>
                <div class="swiper-scrollbar districtsSwiperHN-scrollbar"></div>
            </div>

        </div>
    </section>
    <style>
        .office-hero {
            padding: 80px 0;
            background-color: #f8f9fa;
        }

        .office-hero .promo-badge {
            background: #0d6efd;
            color: white;
            padding: 5px 15px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 15px;
        }

        .office-hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .office-hero h1 span {
            color: #0d6efd;
        }

        .office-hero p {
            font-size: 1.1rem;
            color: #6c757d;
            margin-bottom: 30px;
        }

        .hero-cta .btn {
            padding: 10px 20px;
            margin-right: 10px;
            font-weight: 500;
        }

        .hero-features {
            display: flex;
            margin-top: 30px;
            gap: 20px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .feature-item i {
            color: #0d6efd;
            font-size: 1.2rem;
        }

        .hero-image img {
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
    </style>

    <style>
        .about-section {
            background-color: white;
            padding: 80px 0;
        }

        .section-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 0px
        }

        .section-title:after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: #0d6efd;
            margin: 15px 0 25px;
        }

        .sub-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 30px 0 15px;
        }

        .feature-list {
            list-style: none;
            padding-left: 0;
        }

        .feature-list li {
            margin-bottom: 12px;
            padding-left: 30px;
            position: relative;
        }

        .feature-list i {
            color: #0d6efd;
            position: absolute;
            left: 0;
            top: 3px;
            font-size: 1.2rem;
        }

        .stat-item {
            background: white;
            padding: 25px 15px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            height: 100%;
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #0d6efd;
            margin-bottom: 10px;
        }

        .stat-text {
            font-size: 0.95rem;
            color: #6c757d;
        }

        @media (max-width: 767.98px) {
            .stat-item {
                margin-bottom: 15px;
            }
        }
    </style>

    <style>
        .districts-section {
            background-color: #fff;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title:after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: #0d6efd;
            margin: 15px auto 0;
        }

        .district-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .district-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .district-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .district-count {
            font-size: 1rem;
            color: #0d6efd;
            font-weight: 500;
        }

        @media (max-width: 767.98px) {
            .district-card {
                padding: 15px 10px;
            }

            .district-name {
                font-size: 1rem;
            }

            .district-count {
                font-size: 0.9rem;
            }
        }
    </style>
    <style>
        .districts-slider {
            background-color: #fff;
            position: relative;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
        }

        .district-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.05);
            margin: 0 10px;
        }

        .district-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .district-count {
            font-size: 1rem;
            color: #0d6efd;
            font-weight: 500;
        }

        /* Swiper custom styles */
        .swiper {
            padding: 20px 0;
        }

        .swiper-slide {
            width: auto !important;
            /* Cho phép slide co giãn theo nội dung */
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #0d6efd;
            background: rgba(255, 255, 255, 0.8);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 1.2rem;
        }

        .swiper-scrollbar {
            background: rgba(0, 0, 0, 0.05);
            height: 4px;
            bottom: 0;
        }

        .swiper-scrollbar-drag {
            background: #0d6efd;
        }

        /* Fix khoảng trắng cho cả hai swiper */
        .districtsSwiperHCM,
        .districtsSwiperHN {
            overflow: hidden;
            padding: 20px 0 30px;
            /* Thêm padding dưới cho scrollbar */
            position: relative;
        }

        /* Sửa scrollbar */
        .districtsSwiperHCM .swiper-scrollbar,
        .districtsSwiperHN .swiper-scrollbar {
            position: absolute;
            left: 0;
            bottom: 10px;
            width: 100%;
            height: 4px;
            background: rgba(0, 0, 0, 0.05);
        }

        .districtsSwiperHCM .swiper-scrollbar-drag,
        .districtsSwiperHN .swiper-scrollbar-drag {
            background: #0d6efd;
            height: 100%;
            position: relative;
            border-radius: 4px;
        }

        /* Điều chỉnh slide */
        .swiper-slide {
            width: auto;
            margin-right: 15px;
            /* Thay thế spaceBetween bằng margin */
        }

        /* Container không padding ngang */
        .districts-slider .container {
            padding-left: 0;
            padding-right: 0;
        }
    </style>
@endsection
@push('scripts')
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiperHCM = new Swiper('.districtsSwiperHCM', {
                
                freeMode: true,
                grabCursor: true,
                navigation: {
                    nextEl: '.districtsSwiperHCM-next',
                    prevEl: '.districtsSwiperHCM-prev',
                },
                scrollbar: {
                    el: '.districtsSwiperHCM-scrollbar',
                    draggable: true,
                    snapOnRelease: true,
                    dragSize: 'auto'
                },
                breakpoints: {
                    0: {
                        slidesPerView: 'auto'
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                    1280: {
                        slidesPerView: 4,
                    }
                }
            });

            const swiperHN = new Swiper('.districtsSwiperHN', {
                freeMode: true,
                grabCursor: true,
                navigation: {
                    nextEl: '.districtsSwiperHN-next',
                    prevEl: '.districtsSwiperHN-prev',
                },
                scrollbar: {
                    el: '.districtsSwiperHN-scrollbar',
                    draggable: true,
                    dragSize: 'auto',
                    snapOnRelease: true
                },
                breakpoints: {
                    0: {
                        slidesPerView: 'auto'
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                    1280: {
                        slidesPerView: 4,
                    }
                }
            });
        });
    </script>
@endpush

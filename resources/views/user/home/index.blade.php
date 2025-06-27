@extends('user.layouts.app')
@section('title', 'Dashboard')
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
@endpush
@section('content')
    {{-- <section class="ecommerce-hero-1 hero section" id="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 content-col" data-aos="fade-right" data-aos-delay="100">
                    <div class="content">
                        <span class="promo-badge">New Collection 2025</span>
                        <h1>Discover Stylish <span>Fashion</span> For Every Season</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper
                            mattis, pulvinar dapibus leo. Vestibulum ante ipsum primis in faucibus.</p>
                        <div class="hero-cta">
                            <a href="#" class="btn btn-shop">Shop Now <i class="bi bi-arrow-right"></i></a>
                            <a href="#" class="btn btn-collection">View Collection</a>
                        </div>
                        <div class="hero-features">
                            <div class="feature-item">
                                <i class="bi bi-truck"></i>
                                <span>Free Shipping</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-shield-check"></i>
                                <span>Secure Payment</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-arrow-repeat"></i>
                                <span>Easy Returns</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 image-col" data-aos="fade-left" data-aos-delay="200">
                    <div class="hero-image">
                        <img src="{{ asset('user/assets/img/index/buildsilder.jpg') }}" alt="Fashion Product"
                            class="main-product" loading="lazy">
                        <div class="floating-product product-1" data-aos="fade-up" data-aos-delay="300">
                            <img src="assets/img/product/product-4.webp" alt="Product 2">
                            <div class="product-info">
                                <h4>Summer Collection</h4>
                                <span class="price">$89.99</span>
                            </div>
                        </div>
                        <div class="floating-product product-2" data-aos="fade-up" data-aos-delay="400">
                            <img src="assets/img/product/product-3.webp" alt="Product 3">
                            <div class="product-info">
                                <h4>Casual Wear</h4>
                                <span class="price">$59.99</span>
                            </div>
                        </div>
                        <div class="discount-badge" data-aos="zoom-in" data-aos-delay="500">
                            <span class="percent">30%</span>
                            <span class="text">OFF</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="office-hero hero section" id="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 content-col" data-aos="fade-right" data-aos-delay="100">
                    <div class="content">
                        <span class="promo-badge">Dịch vụ chuyên nghiệp</span>
                        <h1>Công ty tư vấn <span>Thuê văn phòng</span> tại TP.HCM & Hà Nội</h1>
                        <p>Bảng Office trợ giúp khách hàng doanh nghiệp tại TP.HCM và Hà Nội tham chọng tìm kiếm & xây dựng
                            được không gian văn phòng như ý.</p>

                        <div class="hero-cta">
                            <a href="#" class="btn btn-primary">Tìm kiếm <i class="bi bi-search"></i></a>
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
                        <h2 class="section-title">Về Maison Office</h2>
                        <p class="lead">Maison Office là công ty cung cấp dịch vụ thuê văn phòng chuyên nghiệp tại Hà Nội
                            và TP. Hồ Chí Minh. Chúng tôi trợ giúp khách hàng doanh nghiệp tìm thuê văn phòng tại các tòa
                            nhà hạng A,B,C nhanh chóng, tối ưu chi phí và phù hợp mục đích sử dụng!</p>

                        <h3 class="sub-title">Dịch vụ tư vấn hoàn toàn miễn phí, nhận ngay:</h3>
                        <ul class="feature-list">
                            <li><i class="bi bi-check-circle-fill"></i> Bản đề xuất văn phòng nhiều lựa chọn nhất chỉ sau
                                một cuộc gọi</li>
                            <li><i class="bi bi-check-circle-fill"></i> Báo cáo so sánh chi tiết tất cả thông tin giá, phí
                                và chính sách thuê</li>
                            <li><i class="bi bi-check-circle-fill"></i> Thông tin Ưu & Nhược điểm của từng khu vực, từng tòa
                                nhà</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="end-grid">
                        <div class="row">
                            <div class="col-6 mb-4">
                                <div class="stat-item text-center">
                                    <div class="stat-number">2</div>
                                    <div class="stat-text">Văn phòng hoạt động tại thị trường chính TP.HCM & Hà Nội</div>
                                </div>
                            </div>
                            <div class="col-6 mb-4">
                                <div class="stat-item text-center">
                                    <div class="stat-number">50+</div>
                                    <div class="stat-text">Đội ngũ nhân sự am hiểu sâu về thị trường</div>
                                </div>
                            </div>
                            <div class="col-6 mb-4">
                                <div class="stat-item text-center">
                                    <div class="stat-number">350+</div>
                                    <div class="stat-text">Khách hàng doanh nghiệp tư vấn mỗi tháng</div>
                                </div>
                            </div>
                            <div class="col-6 mb-4">
                                <div class="stat-item text-center">
                                    <div class="stat-number">2000+</div>
                                    <div class="stat-text">Tòa nhà văn phòng được cập nhật định kỳ</div>
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
                    @foreach (array_chunk($thongKeHN, 2) as $group)
                        <div class="swiper-slide">
                            @foreach ($group as $item)
                             <a href="{{ route('user.danhsach') }}?ten_toa_nha={{ urlencode($item['quan']) }}">
                                <div class="district-card text-center p-3">
                                    <img src="{{ $item['hinh_anh'] }}" alt="{{ $item['quan'] }}" class="mb-2 rounded shadow"
                                        style="width: 100%; height: 150px; object-fit: cover;">
                                    <h3 class="district-name">{{ $item['quan'] }}</h3>
                                    <div class="district-count">{{ $item['so_toa_nha'] }}+ tòa nhà</div>
                                </div>
                            </a>
                            @endforeach
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
    </style>
@endsection
@push('scripts')
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    {{-- <script>
        // Thêm vào cuối file HTML hoặc trong file JS riêng
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.districtsSwiper', {
                slidesPerView: 'auto',
                spaceBetween: 10,
                freeMode: true,
                grabCursor: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                scrollbar: {
                    el: '.swiper-scrollbar',
                    draggable: true,
                },
                breakpoints: {
                    768: {
                        spaceBetween: 20
                    }
                }
            });
        });
    </script> --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.districtsSwiperHCM', {
                slidesPerView: 4,
                spaceBetween: 20,
                loop: true,
                grabCursor: true,
                navigation: {
                    nextEl: '.districtsSwiperHCM-next',
                    prevEl: '.districtsSwiperHCM-prev',
                },
                scrollbar: {
                    el: '.districtsSwiperHCM-scrollbar',
                    draggable: true,
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1.2
                    },
                    768: {
                        slidesPerView: 2
                    },
                    1024: {
                        slidesPerView: 3
                    },
                    1280: {
                        slidesPerView: 4
                    },
                },
            });

            new Swiper('.districtsSwiperHN', {
                slidesPerView: 4,
                spaceBetween: 20,
                loop: true,
                grabCursor: true,
                navigation: {
                    nextEl: '.districtsSwiperHN-next',
                    prevEl: '.districtsSwiperHN-prev',
                },
                scrollbar: {
                    el: '.districtsSwiperHN-scrollbar',
                    draggable: true,
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1.2
                    },
                    768: {
                        slidesPerView: 2
                    },
                    1024: {
                        slidesPerView: 3
                    },
                    1280: {
                        slidesPerView: 4
                    },
                },
            });
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiperHCM = new Swiper('.districtsSwiperHCM', {
                slidesPerView: 2,
                spaceBetween: 20,
                freeMode: true,
                grabCursor: true,
                navigation: {
                    nextEl: '.districtsSwiperHCM-next',
                    prevEl: '.districtsSwiperHCM-prev',
                },
                scrollbar: {
                    el: '.districtsSwiperHCM-scrollbar',
                    draggable: true,
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 15
                    },
                    1024: {
                        slidesPerView: 2,
                    },
                    1280: {
                        slidesPerView: 2.5,
                    }
                }
            });

            const swiperHN = new Swiper('.districtsSwiperHN', {
                slidesPerView: 'auto',
                spaceBetween: 10,
                freeMode: true,
                grabCursor: true,
                navigation: {
                    nextEl: '.districtsSwiperHN-next',
                    prevEl: '.districtsSwiperHN-prev',
                },
                scrollbar: {
                    el: '.swiper-scrollbar',
                    draggable: true,
                },
                breakpoints: {
                    768: {
                        spaceBetween: 20,
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

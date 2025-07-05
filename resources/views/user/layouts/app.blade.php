<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>BGROUP</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('user/assets/img/bGROUP_white.png') }}" rel="icon">
    <link href="{{ asset('user/assets/img/bGROUP.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('user/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/vendor/drift-zoom/drift-basic.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('user/assets/css/main.css') }}" rel="stylesheet">

    @stack('styles')
    <style>
        .sitename {
            font-size: 1.5rem;
            font-weight: bold;
            margin-left: 10px;
        }

        .logo-img-footer {
            width: 100px;
            height: auto;
        }
    </style>

    <!-- =======================================================
  * Template Name: eStore
  * Template URL: https://bootstrapmade.com/estore-bootstrap-ecommerce-template/
  * Updated: Apr 26 2025 with Bootstrap v5.3.5
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header position-relative">
        <!-- Main Header -->
        <div class="main-header">
            <div class="container-fluid container-xl">
                <div class="d-flex py-3 align-items-center justify-content-between">
                    <!-- Logo -->
                    <a href="{{ route('user.home') }}" class="logo d-flex align-items-center">
                        <!-- Uncomment the line below if you also wish to use an image logo -->
                        <img src="{{ asset('user/assets/img/bGROUP_white.png') }}" alt="" loading="lazy"
                            class="logo-img">
                        <h1 class="sitename">BGROUP</h1>
                    </a>
                    <!-- Actions -->
                    <div class="header-actions d-flex align-items-center justify-content-end">
                        <style>
                            .contact-box {
                                display: flex;
                                align-items: center;
                                gap: 16px;
                                font-family: Arial, sans-serif;
                            }

                            .hotline-btn {
                                background-color: #0a4db8;
                                color: white;
                                padding: 10px 20px;
                                border-radius: 50px;
                                text-decoration: none;
                                font-weight: bold;
                                font-size: 14px;
                                display: inline-block;
                                transition: background 0.2s ease;
                                border: 2px solid transparent;
                            }

                            .hotline-btn:hover {
                                background-color: #ffffff;
                                color: #0a4db8;
                                border: 2px solid #0a4db8;
                            }


                            .email-link {
                                display: inline-flex;
                                align-items: center;
                                gap: 6px;
                                color: #666;
                                text-decoration: none;
                                font-size: 14px;
                                text-transform: uppercase;
                            }

                            .email-link:hover {
                                color: #0a4db8;
                            }
                        </style>

                        {{-- <div class="dropdown account-dropdown">
                            <button class="header-action-btn" data-bs-toggle="dropdown">
                                <i class="bi bi-person"></i>
                            </button>
                            <div class="dropdown-menu">
                                <div class="dropdown-header">
                                    <h6>Chào mừng đến với <span class="sitename">BGROUP</span></h6>
                                    <p class="mb-0">Dành cho khách thuê: Truy cập tài khoản &amp; quản lý thuê</p>
                                </div>
                                <div class="dropdown-footer">
                                    <a href="{{ route('login') }}" class="btn btn-primary w-100 mb-2">Đăng Nhập</a>
                                </div>
                            </div>
                        </div> --}}
                        <div class="dropdown account-dropdown">
                            <button class="header-action-btn" data-bs-toggle="dropdown">
                                <i class="bi bi-person"></i>
                            </button>
                            <div class="dropdown-menu">
                                <div class="dropdown-header">
                                    <h6>Chào mừng đến với <span class="sitename">BGROUP</span></h6>
                                    <p class="mb-0">Dành cho khách thuê: Truy cập tài khoản &amp; quản lý thuê</p>
                                </div>
                        
                                <div class="dropdown-footer">
                                    @guest
                                        <a href="{{ route('login') }}" class="btn btn-primary w-100 mb-2">Đăng nhập</a>
                                    @endguest
                        
                                    @auth
                                        @if(Auth::user()->vai_tro === 'admin')
                                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary w-100 mb-2">Trang quản lý</a>
                                        @elseif(Auth::user()->vai_tro === 'KT')
                                            <a href="{{ route('kt.dashboard') }}" class="btn btn-secondary w-100 mb-2">Trang quản lý</a>
                                        @endif
                        
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger w-100">Đăng xuất 1</button>
                                        </form>
                                    @endauth
                                </div>
                            </div>
                        </div>
                        
                        <i class="mobile-nav-toggle d-xl-none bi bi-list me-0"></i>

                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="header-nav">
            <div class="container-fluid container-xl">
                <div class="position-relative">
                    <nav id="navmenu" class="navmenu">
                        <ul>
                            <li><a href="{{ route('user.home') }}"
                                    class="{{ Request::is('user/trang-chu') ? 'active' : '' }}">TRANG CHỦ</a></li>
                            <li class="dropdown"><a href="{{ route('user.danhsach') }}"
                                    class="{{ Request::is('user/danh-sach') ? 'active' : '' }}"><span>VĂN PHÒNG</span>
                                </a>
                            </li>
                            <li><a href="{{ route('user.lienhe') }}"
                                    class="{{ Request::is('user/lienhe') ? 'active' : '' }}">LIÊN HỆ</a></li>
                            <li><a href="{{ route('user.about') }}"
                                    class="{{ Request::is('user/about') ? 'active' : '' }}">GIỚI THIỆU VỀ BGROUP</a>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Mobile Search Form -->
        <div class="collapse" id="mobileSearch">
            <div class="container">
                <form class="search-form">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Tìm kiếm...">
                        <button class="btn" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </header>

    <main class="main">
        @yield('content')
        <!-- Main Content -->
    </main>

    <footer id="footer" class="footer">
        <div class="footer-main" style="background-color:color-mix(in srgb, var(--accent-color), transparent 95%)">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="footer-widget footer-about">
                            <a href="{{ route('user.home') }}" class="logo">
                                <img src="{{ asset('assets/img/login_logo.png') }}" alt="Logo"
                                    class="logo-img-footer" loading="lazy">
                                <span class="sitename">BGROUP</span>
                            </a>
                            <p style="font-size: 120%; color:#1d3b6f" data-text-color="primary">Không gian lý tưởng –
                                Khởi đầu thành công!</p>
                            <span><i class="bi bi-geo-alt"></i> 65 Huỳnh Thúc Kháng, Bến Nghé, Quận 1, Hồ Chí Minh
                                700000</span>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-widget">
                            <h4>THÔNG TIN LIÊN HỆ</h4>
                            <div class="footer-contact mt-4">
                                <ul class="footer-links">
                                    <li>
                                        <a href="tel:02838212360">
                                            <i class="bi bi-telephone"></i>
                                            <span>028 3821 2360</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="mailto:info@bgroup.com.vn">
                                            <i class="bi bi-envelope"></i>
                                            <span>info@bgroup.com.vn</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-widget">
                            <h4>HỖ TRỢ KHÁCH HÀNG</h4>
                            <ul class="footer-links">
                                <li><a href="{{ route('user.about') }}">Giới thiệu về BGROUP</a></li>
                                <li><a href="{{ route('user.lienhe') }}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom" style="background-color:#ffff">
            <div class="container">
                <div class="copyright text-center">
                    <p>©<strong class="sitename">BGROUP</strong> Copyright 2025</p>
                </div>
            </div>

        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('user/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('user/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('user/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('user/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('user/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('user/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('user/assets/vendor/drift-zoom/Drift.min.js') }}"></script>
    <script src="{{ asset('user/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Main JS File -->
    <script src="{{ asset('user/assets/js/main.js') }}"></script>

    @stack('scripts')

</body>

</html>

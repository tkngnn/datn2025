<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - eStore Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('user/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('user/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

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
                    <a href="index.html" class="logo d-flex align-items-center">
                        <!-- Uncomment the line below if you also wish to use an image logo -->
                        <!-- <img src="user/assets/img/logo.webp" alt=""> -->
                        <h1 class="sitename">BGROUP</h1>
                    </a>

                    <!-- Search -->
                    <form class="search-form desktop-search-form">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Tìm kiếm...">
                            <button class="btn" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>

                    <!-- Actions -->
                    <div class="header-actions d-flex align-items-center justify-content-end">

                        <!-- Mobile Search Toggle -->
                        <button class="header-action-btn mobile-search-toggle d-xl-none" type="button"
                            data-bs-toggle="collapse" data-bs-target="#mobileSearch" aria-expanded="false"
                            aria-controls="mobileSearch">
                            <i class="bi bi-search"></i>
                        </button>

                        <!-- Account -->
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
                                    <a href="login-register.html" class="btn btn-primary w-100 mb-2">Đăng Nhập</a>
                                    <a href="login-register.html" class="btn btn-outline-primary w-100">Đăng Ký</a>
                                </div>
                            </div>
                        </div>


                        <!-- Mobile Navigation Toggle -->
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
                            <li><a href="index.html" class="active">TRANG CHỦ</a></li>
                            <li><a href="about.html">GIỚI THIỆU</a></li>
                            <li class="dropdown"><a href="#"><span>VĂN PHÒNG</span> <i
                                        class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    <li><a href="#">Hà Nội</a></li>
                                    <li class="dropdown"><a href="#"><span>TP. Hồ Chí Minh</span> <i
                                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                                        <ul>
                                            <li><a href="#">Quận 1</a></li>
                                            <li><a href="#">Quận 2</a></li>
                                            <li><a href="#">Quận 3</a></li>
                                            <li><a href="#">Quận 4</a></li>
                                            <li><a href="#">Quận 5</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Đà Nẵng</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Liên Hệ</a></li>

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
        <div class="footer-main">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="footer-widget footer-about">
                            <a href="index.html" class="logo">
                                <span class="sitename">BGROUP</span>
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in nibh vehicula,
                                facilisis magna ut, consectetur lorem.</p>
                            <div class="footer-contact mt-4">
                                <div class="contact-item">
                                    <i class="bi bi-geo-alt"></i>
                                    <span>123 Fashion Street, New York, NY 10001</span>
                                </div>
                                <div class="contact-item">
                                    <i class="bi bi-telephone"></i>
                                    <span>+1 (555) 123-4567</span>
                                </div>
                                <div class="contact-item">
                                    <i class="bi bi-envelope"></i>
                                    <span>hello@example.com</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="footer-widget">
                            <h4>Shop</h4>
                            <ul class="footer-links">
                                <li><a href="category.html">New Arrivals</a></li>
                                <li><a href="category.html">Bestsellers</a></li>
                                <li><a href="category.html">Women's Clothing</a></li>
                                <li><a href="category.html">Men's Clothing</a></li>
                                <li><a href="category.html">Accessories</a></li>
                                <li><a href="category.html">Sale</a></li>
                            </ul>
                        </div>
                    </div>

                    {{-- <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="footer-widget">
                            <h4>Support</h4>
                            <ul class="footer-links">
                                <li><a href="support.html">Help Center</a></li>
                                <li><a href="account.html">Order Status</a></li>
                                <li><a href="shiping-info.html">Shipping Info</a></li>
                                <li><a href="return-policy.html">Returns &amp; Exchanges</a></li>
                                <li><a href="#">Size Guide</a></li>
                                <li><a href="contact.html">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="footer-widget">
                            <h4>Company</h4>
                            <ul class="footer-links">
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="about.html">Careers</a></li>
                                <li><a href="about.html">Press</a></li>
                                <li><a href="about.html">Affiliates</a></li>
                                <li><a href="about.html">Responsibility</a></li>
                                <li><a href="about.html">Investors</a></li>
                            </ul>
                        </div>
                    </div> --}}

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="footer-widget">
                            <h4>Download Our App</h4>
                            <p>Shop on the go with our mobile app</p>
                            <div class="app-buttons">
                                <a href="#" class="app-btn">
                                    <i class="bi bi-apple"></i>
                                    <span>App Store</span>
                                </a>
                                <a href="#" class="app-btn">
                                    <i class="bi bi-google-play"></i>
                                    <span>Google Play</span>
                                </a>
                            </div>
                            <div class="social-links mt-4">
                                <h5>Follow Us</h5>
                                <div class="social-icons">
                                    <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                                    <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                                    <a href="#" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
                                    <a href="#" aria-label="Pinterest"><i class="bi bi-pinterest"></i></a>
                                    <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="legal-links">
                    <a href="tos.html">Terms of Service</a>
                    <a href="privacy.html">Privacy Policy</a>
                    <a href="tos.html">Cookies Settings</a>
                </div>
                <div class="copyright text-center">
                    <p>© <span>Copyright</span> <strong class="sitename">eStore</strong>. All Rights Reserved.</p>
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

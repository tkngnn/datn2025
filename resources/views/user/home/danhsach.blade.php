@extends('user.layouts.app')
@section('title', 'Dashboard')
@push('styles')
@endpush
@section('content')

    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Văn Phòng</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li class="current">Category</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <div class="container">
        <div class="row">

            {{-- <div class="col-lg-4 sidebar">

                <div class="widgets-container">

                    <!-- Product Categories Widget -->
                    <div class="product-categories-widget widget-item">

                        <h3 class="widget-title">Categories</h3>

                        <ul class="category-tree list-unstyled mb-0">
                            <!-- Clothing Category -->
                            <li class="category-item">
                                <div class="d-flex justify-content-between align-items-center category-header collapsed"
                                    data-bs-toggle="collapse" data-bs-target="#categories-1-clothing-subcategories"
                                    aria-expanded="false" aria-controls="categories-1-clothing-subcategories">
                                    <a href="javascript:void(0)" class="category-link">Clothing</a>
                                    <span class="category-toggle">
                                        <i class="bi bi-chevron-down"></i>
                                        <i class="bi bi-chevron-up"></i>
                                    </span>
                                </div>
                                <ul id="categories-1-clothing-subcategories"
                                    class="subcategory-list list-unstyled collapse ps-3 mt-2">
                                    <li><a href="#" class="subcategory-link">Men's Wear</a></li>
                                    <li><a href="#" class="subcategory-link">Women's Wear</a></li>
                                    <li><a href="#" class="subcategory-link">Kids' Clothing</a></li>
                                    <li><a href="#" class="subcategory-link">Accessories</a></li>
                                </ul>
                            </li>

                            <!-- Electronics Category -->
                            <li class="category-item">
                                <div class="d-flex justify-content-between align-items-center category-header collapsed"
                                    data-bs-toggle="collapse" data-bs-target="#categories-1-electronics-subcategories"
                                    aria-expanded="false" aria-controls="categories-1-electronics-subcategories">
                                    <a href="javascript:void(0)" class="category-link">Electronics</a>
                                    <span class="category-toggle">
                                        <i class="bi bi-chevron-down"></i>
                                        <i class="bi bi-chevron-up"></i>
                                    </span>
                                </div>
                                <ul id="categories-1-electronics-subcategories"
                                    class="subcategory-list list-unstyled collapse ps-3 mt-2">
                                    <li><a href="#" class="subcategory-link">Smartphones</a></li>
                                    <li><a href="#" class="subcategory-link">Laptops</a></li>
                                    <li><a href="#" class="subcategory-link">Tablets</a></li>
                                    <li><a href="#" class="subcategory-link">Accessories</a></li>
                                </ul>
                            </li>

                            <!-- Home & Kitchen Category -->
                            <li class="category-item">
                                <div class="d-flex justify-content-between align-items-center category-header collapsed"
                                    data-bs-toggle="collapse" data-bs-target="#categories-1-home-subcategories"
                                    aria-expanded="false" aria-controls="categories-1-home-subcategories">
                                    <a href="javascript:void(0)" class="category-link">Home &amp; Kitchen</a>
                                    <span class="category-toggle">
                                        <i class="bi bi-chevron-down"></i>
                                        <i class="bi bi-chevron-up"></i>
                                    </span>
                                </div>
                                <ul id="categories-1-home-subcategories"
                                    class="subcategory-list list-unstyled collapse ps-3 mt-2">
                                    <li><a href="#" class="subcategory-link">Furniture</a></li>
                                    <li><a href="#" class="subcategory-link">Kitchen Appliances</a></li>
                                    <li><a href="#" class="subcategory-link">Home Decor</a></li>
                                    <li><a href="#" class="subcategory-link">Bedding</a></li>
                                </ul>
                            </li>

                            <!-- Beauty & Personal Care Category -->
                            <li class="category-item">
                                <div class="d-flex justify-content-between align-items-center category-header collapsed"
                                    data-bs-toggle="collapse" data-bs-target="#categories-1-beauty-subcategories"
                                    aria-expanded="false" aria-controls="categories-1-beauty-subcategories">
                                    <a href="javascript:void(0)" class="category-link">Beauty &amp; Personal Care</a>
                                    <span class="category-toggle">
                                        <i class="bi bi-chevron-down"></i>
                                        <i class="bi bi-chevron-up"></i>
                                    </span>
                                </div>
                                <ul id="categories-1-beauty-subcategories"
                                    class="subcategory-list list-unstyled collapse ps-3 mt-2">
                                    <li><a href="#" class="subcategory-link">Skincare</a></li>
                                    <li><a href="#" class="subcategory-link">Makeup</a></li>
                                    <li><a href="#" class="subcategory-link">Hair Care</a></li>
                                    <li><a href="#" class="subcategory-link">Fragrances</a></li>
                                </ul>
                            </li>

                            <!-- Sports & Outdoors Category -->
                            <li class="category-item">
                                <div class="d-flex justify-content-between align-items-center category-header collapsed"
                                    data-bs-toggle="collapse" data-bs-target="#categories-1-sports-subcategories"
                                    aria-expanded="false" aria-controls="categories-1-sports-subcategories">
                                    <a href="javascript:void(0)" class="category-link">Sports &amp; Outdoors</a>
                                    <span class="category-toggle">
                                        <i class="bi bi-chevron-down"></i>
                                        <i class="bi bi-chevron-up"></i>
                                    </span>
                                </div>
                                <ul id="categories-1-sports-subcategories"
                                    class="subcategory-list list-unstyled collapse ps-3 mt-2">
                                    <li><a href="#" class="subcategory-link">Fitness Equipment</a></li>
                                    <li><a href="#" class="subcategory-link">Outdoor Gear</a></li>
                                    <li><a href="#" class="subcategory-link">Sports Apparel</a></li>
                                    <li><a href="#" class="subcategory-link">Team Sports</a></li>
                                </ul>
                            </li>

                            <!-- Books Category (no subcategories) -->
                            <li class="category-item">
                                <div class="d-flex justify-content-between align-items-center category-header">
                                    <a href="#" class="category-link">Books</a>
                                </div>
                            </li>

                            <!-- Toys & Games Category -->
                            <li class="category-item">
                                <div class="d-flex justify-content-between align-items-center category-header collapsed"
                                    data-bs-toggle="collapse" data-bs-target="#categories-1-toys-subcategories"
                                    aria-expanded="false" aria-controls="categories-1-toys-subcategories">
                                    <a href="javascript:void(0)" class="category-link">Toys &amp; Games</a>
                                    <span class="category-toggle">
                                        <i class="bi bi-chevron-down"></i>
                                        <i class="bi bi-chevron-up"></i>
                                    </span>
                                </div>
                                <ul id="categories-1-toys-subcategories"
                                    class="subcategory-list list-unstyled collapse ps-3 mt-2">
                                    <li><a href="#" class="subcategory-link">Board Games</a></li>
                                    <li><a href="#" class="subcategory-link">Puzzles</a></li>
                                    <li><a href="#" class="subcategory-link">Action Figures</a></li>
                                    <li><a href="#" class="subcategory-link">Educational Toys</a></li>
                                </ul>
                            </li>
                        </ul>

                    </div><!--/Product Categories Widget -->

                    <!-- Pricing Range Widget -->
                    <div class="pricing-range-widget widget-item">

                        <h3 class="widget-title">Price Range</h3>

                        <div class="price-range-container">
                            <div class="current-range mb-3">
                                <span class="min-price">$0</span>
                                <span class="max-price float-end">$1000</span>
                            </div>

                            <div class="range-slider">
                                <div class="slider-track"></div>
                                <div class="slider-progress"></div>
                                <input type="range" class="min-range" min="0" max="1000" value="0"
                                    step="10">
                                <input type="range" class="max-range" min="0" max="1000" value="500"
                                    step="10">
                            </div>

                            <div class="price-inputs mt-3">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control min-price-input" placeholder="Min"
                                                min="0" max="1000" value="0" step="10">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control max-price-input" placeholder="Max"
                                                min="0" max="1000" value="500" step="10">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="filter-actions mt-3">
                                <button type="button" class="btn btn-sm btn-primary w-100">Apply Filter</button>
                            </div>
                        </div>

                    </div><!--/Pricing Range Widget -->

                    <!-- Brand Filter Widget -->
                    <h3 class="brand-filter-widget widget-item">Filter by Brand</h3><!--/Brand Filter Widget -->

                    <!-- Color Filter Widget -->
                    <div class="color-filter-widget widget-item">

                        <h3 class="widget-title">Filter by Color</h3>

                        <div class="color-filter-content">
                            <div class="color-options">
                                <div class="form-check color-option">
                                    <input class="form-check-input" type="checkbox" value="black" id="color-black">
                                    <label class="form-check-label" for="color-black">
                                        <span class="color-swatch" style="background-color: #000000;"
                                            title="Black"></span>
                                    </label>
                                </div>

                                <div class="form-check color-option">
                                    <input class="form-check-input" type="checkbox" value="white" id="color-white">
                                    <label class="form-check-label" for="color-white">
                                        <span class="color-swatch" style="background-color: #ffffff;"
                                            title="White"></span>
                                    </label>
                                </div>

                                <div class="form-check color-option">
                                    <input class="form-check-input" type="checkbox" value="red" id="color-red">
                                    <label class="form-check-label" for="color-red">
                                        <span class="color-swatch" style="background-color: #e74c3c;"
                                            title="Red"></span>
                                    </label>
                                </div>

                                <div class="form-check color-option">
                                    <input class="form-check-input" type="checkbox" value="blue" id="color-blue">
                                    <label class="form-check-label" for="color-blue">
                                        <span class="color-swatch" style="background-color: #3498db;"
                                            title="Blue"></span>
                                    </label>
                                </div>

                                <div class="form-check color-option">
                                    <input class="form-check-input" type="checkbox" value="green" id="color-green">
                                    <label class="form-check-label" for="color-green">
                                        <span class="color-swatch" style="background-color: #2ecc71;"
                                            title="Green"></span>
                                    </label>
                                </div>

                                <div class="form-check color-option">
                                    <input class="form-check-input" type="checkbox" value="yellow" id="color-yellow">
                                    <label class="form-check-label" for="color-yellow">
                                        <span class="color-swatch" style="background-color: #f1c40f;"
                                            title="Yellow"></span>
                                    </label>
                                </div>

                                <div class="form-check color-option">
                                    <input class="form-check-input" type="checkbox" value="purple" id="color-purple">
                                    <label class="form-check-label" for="color-purple">
                                        <span class="color-swatch" style="background-color: #9b59b6;"
                                            title="Purple"></span>
                                    </label>
                                </div>

                                <div class="form-check color-option">
                                    <input class="form-check-input" type="checkbox" value="orange" id="color-orange">
                                    <label class="form-check-label" for="color-orange">
                                        <span class="color-swatch" style="background-color: #e67e22;"
                                            title="Orange"></span>
                                    </label>
                                </div>

                                <div class="form-check color-option">
                                    <input class="form-check-input" type="checkbox" value="pink" id="color-pink">
                                    <label class="form-check-label" for="color-pink">
                                        <span class="color-swatch" style="background-color: #fd79a8;"
                                            title="Pink"></span>
                                    </label>
                                </div>

                                <div class="form-check color-option">
                                    <input class="form-check-input" type="checkbox" value="brown" id="color-brown">
                                    <label class="form-check-label" for="color-brown">
                                        <span class="color-swatch" style="background-color: #795548;"
                                            title="Brown"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="filter-actions mt-3">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Clear All</button>
                                <button type="button" class="btn btn-sm btn-primary">Apply Filter</button>
                            </div>
                        </div>

                    </div><!--/Color Filter Widget -->

                    <!-- Brand Filter Widget -->
                    <div class="brand-filter-widget widget-item">

                        <h3 class="widget-title">Filter by Brand</h3>

                        <div class="brand-filter-content">
                            <div class="brand-search">
                                <input type="text" class="form-control" placeholder="Search brands...">
                                <i class="bi bi-search"></i>
                            </div>

                            <div class="brand-list">
                                <div class="brand-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="brand1">
                                        <label class="form-check-label" for="brand1">
                                            Nike
                                            <span class="brand-count">(24)</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="brand-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="brand2">
                                        <label class="form-check-label" for="brand2">
                                            Adidas
                                            <span class="brand-count">(18)</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="brand-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="brand3">
                                        <label class="form-check-label" for="brand3">
                                            Puma
                                            <span class="brand-count">(12)</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="brand-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="brand4">
                                        <label class="form-check-label" for="brand4">
                                            Reebok
                                            <span class="brand-count">(9)</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="brand-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="brand5">
                                        <label class="form-check-label" for="brand5">
                                            Under Armour
                                            <span class="brand-count">(7)</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="brand-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="brand6">
                                        <label class="form-check-label" for="brand6">
                                            New Balance
                                            <span class="brand-count">(6)</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="brand-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="brand7">
                                        <label class="form-check-label" for="brand7">
                                            Converse
                                            <span class="brand-count">(5)</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="brand-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="brand8">
                                        <label class="form-check-label" for="brand8">
                                            Vans
                                            <span class="brand-count">(4)</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="brand-actions">
                                <button class="btn btn-sm btn-outline-primary">Apply Filter</button>
                                <button class="btn btn-sm btn-link">Clear All</button>
                            </div>
                        </div>

                    </div><!--/Brand Filter Widget -->

                </div>

            </div> --}}

            <div class="col-lg-12">

                <!-- Category Header Section -->
                <section id="category-header" class="category-header section">

                    <div class="container" data-aos="fade-up">

                        <!-- Filter and Sort Options -->
                        <div class="filter-container mb-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="row g-3">
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="filter-item search-form">
                                        <label for="productSearch" class="form-label">Tòa Nhà</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="productSearch"
                                                placeholder="Tìm kiếm tòa nhà..." aria-label="Tìm kiếm tòa nhà">
                                            <button class="btn search-btn" type="button">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-lg-2">
                                    <div class="filter-item">
                                        <label for="areaRange" class="form-label">Diện tích</label>
                                        <select class="form-select" id="areaRange">
                                            <option selected="">Tất cả diện tích</option>
                                            <option>50m² - 100m²</option>
                                            <option>100m² đến 200m²</option>
                                            <option>200m² đến 300m²</option>
                                            <option>300m² đến 500m²</option>
                                            <option>500m² đến 1000m²</option>
                                            <option>Trên 1000m²</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-2">
                                    <div class="filter-item">
                                        <label for="priceRange" class="form-label">Giá</label>
                                        <select class="form-select" id="priceRange">
                                            <option selected="">Tất cả giá</option>
                                            <option>$1000 - $2000 /tháng</option>
                                            <option>$2000 - $3000 /tháng</option>
                                            <option>$3000 - $5000 /tháng</option>
                                            <option>$5000 - $7000 /tháng</option>
                                            <option>$7000 - $10,000 /tháng</option>
                                            <option>Trên $10,000 /tháng</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-lg-2">
                                    <div class="filter-item">
                                        <label for="sortBy" class="form-label">Sắp xếp</label>
                                        <select class="form-select" id="sortBy">
                                            <option selected="">Nổi bật</option>
                                            <option>Giá: Thấp đến Cao</option>
                                            <option>Giá: Cao đến Thấp</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-lg-2">
                                    <div class="filter-item">
                                        <label class="form-label">View</label>
                                        <div class="d-flex align-items-center">
                                            <div class="view-options me-3">
                                                <button type="button" class="btn view-btn active" data-view="grid"
                                                    aria-label="Grid view">
                                                    <i class="bi bi-grid-3x3-gap-fill"></i>
                                                </button>
                                                <button type="button" class="btn view-btn" data-view="list"
                                                    aria-label="List view">
                                                    <i class="bi bi-list-ul"></i>
                                                </button>
                                            </div>
                                            {{-- <div class="items-per-page">
                                                <select class="form-select" id="itemsPerPage"
                                                    aria-label="Items per page">
                                                    <option value="12">12 per page</option>
                                                    <option value="24">24 per page</option>
                                                    <option value="48">48 per page</option>
                                                    <option value="96">96 per page</option>
                                                </select>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12" data-aos="fade-up" data-aos-delay="200">
                                    <div class="active-filters">
                                        <span class="active-filter-label">Active Filters:</span>
                                        <div class="filter-tags">
                                            <span class="filter-tag">
                                                Electronics <button class="filter-remove"><i class="bi bi-x"></i></button>
                                            </span>
                                            <span class="filter-tag">
                                                $50 to $100 <button class="filter-remove"><i class="bi bi-x"></i></button>
                                            </span>
                                            <button class="clear-all-btn">Clear All</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </section><!-- /Category Header Section -->

                <!-- Category Product List Section -->
                <section id="category-product-list" class="category-product-list section">

                    <div class="container" data-aos="fade-up" data-aos-delay="100">

                        <div class="row gy-4">
                            <!-- Product 1 -->
                            <div class="col-lg-3">
                                <div class="product-box">
                                    <div class="product-thumb">
                                        <span class="product-label">New Season</span>
                                        <img src="assets/img/product/product-3.webp" alt="Product Image" class="main-img"
                                            loading="lazy">
                                        <div class="product-overlay">
                                            <div class="product-quick-actions">
                                                {{-- <button type="button" class="quick-action-btn">
                                                    <i class="bi bi-heart"></i>
                                                </button>
                                                <button type="button" class="quick-action-btn">
                                                    <i class="bi bi-arrow-repeat"></i>
                                                </button>
                                                <button type="button" class="quick-action-btn">
                                                    <i class="bi bi-eye"></i>
                                                </button> --}}
                                            </div>
                                            <div class="add-to-cart-container">
                                                <button type="button" class="add-to-cart-btn">Hẹn Xem</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-details">
                                            <h3 class="product-title"><a href="product-details.html">Tên tòa nhà Aliquam
                                                    tincidunt
                                                    mauris eu risus</a></h3>
                                            <div class="product-rating-container">
                                                <span class="text-muted">Địa chỉ tòa nhà Aliquam tincidunt
                                                    mauris eu risus</span>
                                            </div>
                                            <div class="product-price">
                                                <span>$50 -$55 /m²</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Product 1 -->

                            <!-- Product 2 -->
                            <div class="col-lg-3">
                                <div class="product-box">
                                    <div class="product-thumb">
                                        <span class="product-label product-label-sale">-30%</span>
                                        <img src="assets/img/product/product-6.webp" alt="Product Image" class="main-img"
                                            loading="lazy">
                                        <div class="product-overlay">
                                            <div class="product-quick-actions">
                                                <button type="button" class="quick-action-btn">
                                                    <i class="bi bi-heart"></i>
                                                </button>
                                                <button type="button" class="quick-action-btn">
                                                    <i class="bi bi-arrow-repeat"></i>
                                                </button>
                                                <button type="button" class="quick-action-btn">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </div>
                                            <div class="add-to-cart-container">
                                                <button type="button" class="add-to-cart-btn">Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-details">
                                            <a href="product-details.html" class="fs-5 text-break">Tên tòa nhà Aliquam
                                                tincidunt
                                                mauris eu risus</a>
                                            <div class="product-price">
                                                <span class="original">$199.99</span>
                                                <span class="sale">$139.99</span>
                                            </div>
                                        </div>
                                        <div class="product-rating-container">
                                            <div class="rating-stars">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                            </div>
                                            <span class="rating-number">4.5</span>
                                        </div>
                                        <div class="product-color-options">
                                            <span class="color-option" style="background-color: #0ea5e9;"></span>
                                            <span class="color-option active" style="background-color: #111827;"></span>
                                            <span class="color-option" style="background-color: #a855f7;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Product 2 -->

                            <!-- Product 3 -->
                            <div class="col-lg-3">
                                <div class="product-box">
                                    <div class="product-thumb">
                                        <img src="assets/img/product/product-9.webp" alt="Product Image" class="main-img"
                                            loading="lazy">
                                        <div class="product-overlay">
                                            <div class="product-quick-actions">
                                                <button type="button" class="quick-action-btn">
                                                    <i class="bi bi-heart"></i>
                                                </button>
                                                <button type="button" class="quick-action-btn">
                                                    <i class="bi bi-arrow-repeat"></i>
                                                </button>
                                                <button type="button" class="quick-action-btn">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </div>
                                            <div class="add-to-cart-container">
                                                <button type="button" class="add-to-cart-btn">Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-details">
                                            <h3 class="product-title"><a href="product-details.html">Cras ornare tristique
                                                    elit</a></h3>
                                            <div class="product-price">
                                                <span>$89.50</span>
                                            </div>
                                        </div>
                                        <div class="product-rating-container">
                                            <div class="rating-stars">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star"></i>
                                                <i class="bi bi-star"></i>
                                            </div>
                                            <span class="rating-number">3.0</span>
                                        </div>
                                        <div class="product-color-options">
                                            <span class="color-option active" style="background-color: #ef4444;"></span>
                                            <span class="color-option" style="background-color: #64748b;"></span>
                                            <span class="color-option" style="background-color: #eab308;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Product 3 -->

                            <!-- Product 4 -->
                            <div class="col-lg-3">
                                <div class="product-box">
                                    <div class="product-thumb">
                                        <img src="assets/img/product/product-11.webp" alt="Product Image"
                                            class="main-img" loading="lazy">
                                        <div class="product-overlay">
                                            <div class="product-quick-actions">
                                                <button type="button" class="quick-action-btn">
                                                    <i class="bi bi-heart"></i>
                                                </button>
                                                <button type="button" class="quick-action-btn">
                                                    <i class="bi bi-arrow-repeat"></i>
                                                </button>
                                                <button type="button" class="quick-action-btn">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </div>
                                            <div class="add-to-cart-container">
                                                <button type="button" class="add-to-cart-btn">Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-details">
                                            <h3 class="product-title"><a href="product-details.html">Integer vitae libero
                                                    ac risus</a></h3>
                                            <div class="product-price">
                                                <span>$119.00</span>
                                            </div>
                                        </div>
                                        <div class="product-rating-container">
                                            <div class="rating-stars">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                            </div>
                                            <span class="rating-number">5.0</span>
                                        </div>
                                        <div class="product-color-options">
                                            <span class="color-option" style="background-color: #10b981;"></span>
                                            <span class="color-option active" style="background-color: #8b5cf6;"></span>
                                            <span class="color-option" style="background-color: #ec4899;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Product 4 -->

                            <!-- Product 5 -->
                            <div class="col-lg-3">
                                <div class="product-box">
                                    <div class="product-thumb">
                                        <span class="product-label product-label-sold">Sold Out</span>
                                        <img src="assets/img/product/product-2.webp" alt="Product Image" class="main-img"
                                            loading="lazy">
                                        <div class="product-overlay">
                                            <div class="product-quick-actions">
                                                <button type="button" class="quick-action-btn">
                                                    <i class="bi bi-heart"></i>
                                                </button>
                                                <button type="button" class="quick-action-btn">
                                                    <i class="bi bi-arrow-repeat"></i>
                                                </button>
                                                <button type="button" class="quick-action-btn">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </div>
                                            <div class="add-to-cart-container">
                                                <button type="button" class="add-to-cart-btn disabled">Sold Out</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-details">
                                            <h3 class="product-title"><a href="product-details.html">Donec eu libero sit
                                                    amet quam</a></h3>
                                            <div class="product-price">
                                                <span>$75.00</span>
                                            </div>
                                        </div>
                                        <div class="product-rating-container">
                                            <div class="rating-stars">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                            </div>
                                            <span class="rating-number">4.7</span>
                                        </div>
                                        <div class="product-color-options">
                                            <span class="color-option active" style="background-color: #4b5563;"></span>
                                            <span class="color-option" style="background-color: #e11d48;"></span>
                                            <span class="color-option" style="background-color: #4f46e5;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Product 5 -->

                            <!-- Product 6 -->
                            <div class="col-lg-3">
                                <div class="product-box">
                                    <div class="product-thumb">
                                        <span class="product-label product-label-hot">Hot</span>
                                        <img src="assets/img/product/product-12.webp" alt="Product Image"
                                            class="main-img" loading="lazy">
                                        <div class="product-overlay">
                                            <div class="product-quick-actions">
                                                <button type="button" class="quick-action-btn">
                                                    <i class="bi bi-heart"></i>
                                                </button>
                                                <button type="button" class="quick-action-btn">
                                                    <i class="bi bi-arrow-repeat"></i>
                                                </button>
                                                <button type="button" class="quick-action-btn">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </div>
                                            <div class="add-to-cart-container">
                                                <button type="button" class="add-to-cart-btn">Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-details">
                                            <h3 class="product-title"><a href="product-details.html">Pellentesque habitant
                                                    morbi tristique</a></h3>
                                            <div class="product-price">
                                                <span>$64.95</span>
                                            </div>
                                        </div>
                                        <div class="product-rating-container">
                                            <div class="rating-stars">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                                <i class="bi bi-star"></i>
                                            </div>
                                            <span class="rating-number">3.6</span>
                                        </div>
                                        <div class="product-color-options">
                                            <span class="color-option" style="background-color: #eab308;"></span>
                                            <span class="color-option" style="background-color: #14b8a6;"></span>
                                            <span class="color-option active" style="background-color: #facc15;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Product 6 -->
                        </div>

                    </div>

                </section><!-- /Category Product List Section -->

                <!-- Category Pagination Section -->
                <section id="category-pagination" class="category-pagination section">

                    <div class="container">
                        <nav class="d-flex justify-content-center" aria-label="Page navigation">
                            <ul>
                                <li>
                                    <a href="#" aria-label="Previous page">
                                        <i class="bi bi-arrow-left"></i>
                                        <span class="d-none d-sm-inline">Previous</span>
                                    </a>
                                </li>

                                <li><a href="#" class="active">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li class="ellipsis">...</li>
                                <li><a href="#">8</a></li>
                                <li><a href="#">9</a></li>
                                <li><a href="#">10</a></li>

                                <li>
                                    <a href="#" aria-label="Next page">
                                        <span class="d-none d-sm-inline">Next</span>
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </section><!-- /Category Pagination Section -->

            </div>

        </div>
    </div>
@endsection
@push('scripts')
@endpush

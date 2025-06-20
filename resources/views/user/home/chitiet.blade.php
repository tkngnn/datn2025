@extends('user.layouts.app')
@section('title', 'Trang chi tiết')
@push('styles')
<style>
  .custom-attributes {
    list-style: none;
    padding-left: 0;
    margin: 0;
  }

  .custom-attributes li {
    margin-bottom: 8px;
    display: flex;
    align-items: center;
  }

  .custom-attributes li i {
    margin-right: 8px;
    color: #2d465e;
  }

  .custom-attributes li strong {
    margin-right: 8px;
  }
</style>
@endpush
@section('content')

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Trang chi tiết</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Trang chủ</a></li>
            <li class="current">Trang chi tiết</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Product Details Section -->
    <section id="product-details" class="product-details section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <!-- Product Images -->
          <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right" data-aos-delay="200">
            <div class="product-images">
              <div class="main-image-container mb-3">
                <div class="image-zoom-container">
                  <img src="{{ $vanphong->getFirstMediaUrl('anh_van_phong') }}" alt="Product Image" class="img-fluid main-image drift-zoom" id="main-product-image" data-zoom="{{ $vanphong->getFirstMediaUrl('anh_van_phong') }}">
                </div>
              </div>

              <div class="product-thumbnails">
                <div class="swiper product-thumbnails-slider init-swiper">
                  <script type="application/json" class="swiper-config">
                    {
                      "loop": false,
                      "speed": 400,
                      "slidesPerView": 4,
                      "spaceBetween": 10,
                      "navigation": {
                        "nextEl": ".swiper-button-next",
                        "prevEl": ".swiper-button-prev"
                      },
                      "breakpoints": {
                        "320": {
                          "slidesPerView": 3
                        },
                        "576": {
                          "slidesPerView": 4
                        }
                      }
                    }
                  </script>
                  <div class="swiper-wrapper">
                    @foreach ($vanphong->getMedia('anh_van_phong') as $media)
                        <div class="swiper-slide thumbnail-item {{ $loop->first ? 'active' : '' }}" data-image="{{ $media->getUrl() }}">
                        <img src="{{ $media->getUrl() }}" alt="Product Thumbnail" class="img-fluid">
                        </div>
                    @endforeach
                    
                  </div>
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
                </div>
              </div>
            </div>
          </div>

          <!-- Product Info -->
          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
            <div class="product-info">
              {{-- <div class="product-meta mb-2">
                <span class="product-category">Headphones</span>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i>
                  <span class="rating-count">(42)</span>
                </div>
              </div> --}}

              <h1 class="product-title">Văn phòng {{ $vanphong->ten_van_phong }}</h1>

              <div class="product-price-container mb-2">
                <span class="current-price">{{ number_format($vanphong->gia_thue, 0, ',', '.') }} VND</span>
                {{-- <span class="original-price">$299.99</span>
                <span class="discount-badge">-17%</span> --}}
                
              </div>
              <hr>
      
              <ul class="custom-attributes">
                <li>
                    <i class="bi bi-building"></i><strong style="color: #777;"> Tên tòa nhà: </strong>
                    {{ $vanphong->toaNha->ten_toa_nha ?? 'Không rõ tòa nhà' }}
                </li>
                <li>
                    <i class="bi bi-geo-alt-fill"></i><strong style="color: #777;"> Địa chỉ: </strong>
                    {{ $vanphong->toaNha->dia_chi ?? 'Không rõ địa chỉ' }}
                </li>
                <li>
                    <i class="bi bi-aspect-ratio"></i><strong style="color: #777;"> Diện tích: </strong>
                    {{ $vanphong->dien_tich }} m²
                </li>
            </ul>
                   

              <!-- Action Buttons -->
              <div class="product-actions">
                <a class="btn btn-outline-primary buy-now-btn" href="{{ route('user.vanphong.henxem', $vanphong->slug) }}">
                  Hẹn xem
                </a>                
              </div>

            </div>
          </div>
        </div>

        <!-- Product Details Tabs -->
        <div class="row mt-5" data-aos="fade-up">
          <div class="col-12">
            <div class="product-details-tabs">
              <ul class="nav nav-tabs" id="productTabs" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Mô tả</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="specifications-tab" data-bs-toggle="tab" data-bs-target="#specifications" type="button" role="tab" aria-controls="specifications" aria-selected="false">Thông tin chi tiết</button>
                </li>
              </ul>
              <div class="tab-content" id="productTabsContent">
                <!-- Description Tab -->
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                  <div class="product-description">
                    <h4>Product Overview</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum at lacus congue, suscipit elit nec, tincidunt orci. Phasellus egestas nisi vitae lectus imperdiet venenatis. Suspendisse vulputate quam diam, et consectetur augue condimentum in. Aenean dapibus urna eget nisi pharetra, in iaculis nulla blandit. Praesent at consectetur sem, sed sollicitudin nibh. Ut interdum risus ac nulla placerat aliquet.</p>

                    <h4>Key Features</h4>
                    <ul>
                      <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit</li>
                      <li>Vestibulum at lacus congue, suscipit elit nec, tincidunt orci</li>
                      <li>Phasellus egestas nisi vitae lectus imperdiet venenatis</li>
                      <li>Suspendisse vulputate quam diam, et consectetur augue condimentum in</li>
                      <li>Aenean dapibus urna eget nisi pharetra, in iaculis nulla blandit</li>
                    </ul>

                    <h4>What's in the Box</h4>
                    <ul>
                      <li>Lorem Ipsum Wireless Headphones</li>
                      <li>Carrying Case</li>
                      <li>USB-C Charging Cable</li>
                      <li>3.5mm Audio Cable</li>
                      <li>User Manual</li>
                    </ul>
                  </div>
                </div>

                <!-- Specifications Tab -->
                <div class="tab-pane fade" id="specifications" role="tabpanel" aria-labelledby="specifications-tab">
                  <div class="product-specifications">
                    <div class="specs-group">
                      <h4>Thông tin văn phòng</h4>
                      <div class="specs-table">
                        <div class="specs-row">
                          <div class="specs-label">Tên tòa nhà</div>
                          <div class="specs-value">{{ $vanphong->toaNha->ten_toa_nha ?? 'Không rõ tòa nhà' }}</div>
                        </div>
                        <div class="specs-row">
                          <div class="specs-label">Địa chỉ</div>
                          <div class="specs-value">{{ $vanphong->toaNha->dia_chi ?? 'Không rõ địa chỉ' }}</div>
                        </div>
                        
                        <div class="specs-row">
                          <div class="specs-label">Tổng số tầng</div>
                          <div class="specs-value">{{ $vanphong->toaNha->so_tang ?? 'Không rõ tòa nhà' }} tầng</div>
                        </div>
                        <div class="specs-row">
                          <div class="specs-label">Driver Size</div>
                          <div class="specs-value">40mm</div>
                        </div>
                        <div class="specs-row">
                          <div class="specs-label">Frequency Response</div>
                          <div class="specs-value">20Hz - 20kHz</div>
                        </div>
                        <div class="specs-row">
                          <div class="specs-label">Impedance</div>
                          <div class="specs-value">32 Ohm</div>
                        </div>
                        <div class="specs-row">
                          <div class="specs-label">Weight</div>
                          <div class="specs-value">250g</div>
                        </div>
                      </div>
                    </div>

                    <div class="specs-group">
                      <h4>Features</h4>
                      <div class="specs-table">
                        <div class="specs-row">
                          <div class="specs-label">Noise Cancellation</div>
                          <div class="specs-value">Active Noise Cancellation (ANC)</div>
                        </div>
                        <div class="specs-row">
                          <div class="specs-label">Controls</div>
                          <div class="specs-value">Touch controls, Voice assistant</div>
                        </div>
                        <div class="specs-row">
                          <div class="specs-label">Microphone</div>
                          <div class="specs-value">Dual beamforming microphones</div>
                        </div>
                        <div class="specs-row">
                          <div class="specs-label">Water Resistance</div>
                          <div class="specs-value">IPX4 (splash resistant)</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Product Details Section -->
@endsection
@push('scripts')
@endpush
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
            <li><a href="{{ route('user.home') }}">Trang chủ</a></li>
            <li><a href="{{ route('user.danhsach') }}">Văn phòng</a></li>
            <li class="active"><a href="#">{{ $vanphong->ten_van_phong }}</a></li>
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

              <h1 class="product-title">{{ $vanphong->ten_van_phong }}</h1>

              <div class="product-price-container mb-2">
                <span class="current-price" style="color: red">{{ number_format($vanphong->gia_thue, 0, ',', '.') }}<span style="font-size: 0.75em;"> VNĐ/m²</span></span>
                
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

            @if ($vanphong->mo_ta)
              <hr>
              <div class="vanphong-description">
                {!! $vanphong->mo_ta !!}
              </div>
            @endif
                   

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
              </ul>
              <div class="tab-content" id="productTabsContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                    {!! $vanphong->toaNha->mo_ta !!}
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
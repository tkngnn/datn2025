@push('styles')
<link href="{{ asset('user/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
@endpush

<style>
.invoice-box {
    max-width: none;
    width: 100%;
    margin: auto;
    padding: 30px;
    color: #555;
    border: 1px solid #eee;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    font-family: "Nunito", sans-serif;
}
.swiper-button-next::after, .swiper-button-prev::after {
    font-size: 14px;
}
.swiper-button-next, .swiper-button-prev {
    color: #0a4db8;
    background-color: #ffffff;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
.img-fluid {
    max-width: 100%;
    height: auto;
}
.swiper-slide {
  flex-shrink: 0;
  width: auto; /* hoặc fixed size nếu muốn */
  max-width: 80px;
  height: auto;
  padding: 4px;
  box-sizing: border-box;
}
.thumbnail-item img {
  max-height: 70px;
  object-fit: cover;
  border-radius: 5px;
}

</style>

<div class="invoice-box">
  <div class="row">
    <!-- Hình ảnh -->
    <div class="col-lg-6 mb-5 mb-lg-0">
      <div class="product-images">
        <!-- Ảnh chính -->
        <div class="main-image-container mb-3 text-center">
          <img src="{{ $vanphong->getFirstMediaUrl('anh_van_phong') }}"
               alt="Ảnh chính"
               id="main-product-image"
               class="img-fluid"
               style="max-height: 300px; object-fit: contain;">
        </div>

        <!-- Thumbnails -->
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
                  "320": { "slidesPerView": 3 },
                  "576": { "slidesPerView": 4 }
                }
              }
            </script>
            <div class="swiper-wrapper">
              @foreach ($vanphong->getMedia('anh_van_phong') as $media)
                <div class="swiper-slide thumbnail-item {{ $loop->first ? 'active' : '' }}"
                  data-image="{{ $media->getUrl() }}"
                  style="cursor: pointer;">
                  <img src="{{ $media->getUrl() }}" class="img-fluid" style="max-height: 70px;">
                </div>
           
              @endforeach
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Thông tin -->
    <div class="col-lg-6">
      <h1 style="color: #2d465e">Văn phòng: {{ $vanphong->ten_van_phong }}</h1>
      <p style="font-size: x-large; color:red">
        {{ number_format($vanphong->gia_thue, 0, ',', '.') }} VND/m²
      </p>
      <hr>
      <p><i class="bi bi-building"></i> <strong> Tên tòa nhà:</strong> {{ $vanphong->toaNha->ten_toa_nha ?? 'Không rõ' }}</p>
      <p><i class="bi bi-geo-alt-fill"></i> <strong> Địa chỉ:</strong> {{ $vanphong->toaNha->dia_chi ?? 'Không rõ' }}</p>
      <p><i class="bi bi-aspect-ratio"></i> <strong> Diện tích:</strong> {{ $vanphong->dien_tich }} m²</p>
      <hr>
      <div>{!! $vanphong->mo_ta !!}</div>
    </div>
  </div>
</div>
@forelse ($danhSachVanPhong as $vp)
    <div class="col-lg-3">
        <div class="product-box">
            <div class="product-thumb">
                @if ($vp->getFirstMediaUrl('anh_van_phong'))
                    <img src="{{ $vp->getFirstMediaUrl('anh_van_phong') }}" alt="Ảnh văn phòng" class="main-img"
                        loading="lazy">
                @else
                    <img src="{{ asset('assets/img/160x160/img2.jpg') }}" alt="Không có ảnh" class="main-img"
                        loading="lazy">
                @endif
                <div class="product-overlay">
                    <div class="product-quick-actions">
                    </div>
                    <div class="add-to-cart-container">
                        @if ($vp->slug)
                            <a class="add-to-cart-btn text-center" type="button"
                                href="{{ route('user.vanphong.henxem', $vp->slug) }}">
                                Hẹn xem
                            </a>
                        @endif

                    </div>
                </div>
            </div>
            @if ($vp->slug)
                <div class="product-content">
                    <a href="{{ route('user.vanphong.chitiet', $vp->slug) }}">
                        <div class="product-details">
                            <h3 class="product-title">{{ $vp->toaNha->ten_toa_nha }}
                                - {{ $vp->ten_van_phong }} - {{ $vp->ma_van_phong }}</h3>
                            <div class="product-rating-container">
                                <span class="text-muted">{{ $vp->toaNha->dia_chi }}</span>
                            </div>
                            <div class="product-price">
                                <span>Diện tích: {{ $vp->dien_tich }} m²</span>
                            </div>
                            <div class="product-price">
                                <span>Giá thuê: {{ number_format($vp->gia_thue) }} /m²</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        </div>
    </div>
@empty
    <div class="col-12 text-center py-5">
        <h4>Không tìm thấy văn phòng phù hợp</h4>
        <p>Vui lòng thử lại với bộ lọc khác.</p>
    </div>
@endforelse

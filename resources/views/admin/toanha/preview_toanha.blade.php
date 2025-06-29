<style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        font-size: 16px;
        line-height: 24px;
        font-family: 'Arial', sans-serif;
        color: #333;
        border: 1px solid #eee;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .invoice-box h1 {
        font-size: 26px;
        color: #0d6efd;
        margin-bottom: 15px;
    }

    .invoice-box .product-price-container {
        font-size: 18px;
        margin-bottom: 10px;
        color: #6c757d;
    }

    .custom-attributes {
        list-style: none;
        padding: 0;
    }

    .custom-attributes li {
        margin-bottom: 10px;
        font-size: 16px;
    }

    .custom-attributes i {
        margin-right: 8px;
        font-size: 18px;
        vertical-align: middle;
    }

    .custom-attributes i.bi-hash {
        color: #dc3545; /* đỏ */
    }

    .custom-attributes i.bi-geo-alt-fill {
        color: #0d6efd; /* xanh dương */
    }

    .custom-attributes i.bi-building {
        color: #198754; /* xanh lá */
    }

    .custom-attributes i.bi-layers {
        color: #fd7e14; /* cam */
    }

    .vanphong-description {
        background-color: #f8f9fa;
        border-left: 4px solid #0d6efd;
        padding: 10px 15px;
        border-radius: 5px;
        margin-top: 15px;
    }
</style>

<div class="invoice-box">
    <div class="product-info">

        <h1 class="product-title">🏢 Tòa nhà {{ $toaNha->ten_toa_nha }}</h1>

        <div class="product-price-container">
            <i class="bi bi-layers"></i> {{ $toaNha->so_tang ?? '—' }} tầng
        </div>

        <hr>

        <ul class="custom-attributes">
            <li>
                <i class="bi bi-hash"></i>
                <strong>Mã tòa nhà:</strong> {{ $toaNha->ma_toa_nha }}
            </li>
            <li>
                <i class="bi bi-geo-alt-fill"></i>
                <strong>Địa chỉ:</strong> {{ $toaNha->dia_chi ?? 'Chưa cập nhật' }}
            </li>
            <li>
                <i class="bi bi-building"></i>
                <strong>Số tầng:</strong> {{ $toaNha->so_tang ?? '—' }}
            </li>
        </ul>

        @if ($toaNha->mo_ta)
            <hr>
            <div class="vanphong-description">
                {!! $toaNha->mo_ta !!}
            </div>
        @endif

    </div>
</div>

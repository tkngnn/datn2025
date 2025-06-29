<style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        /* padding: 30px; */
        font-size: 14px;
        line-height: 22px;
        font-family: 'DejaVu Sans', sans-serif;
        color: #000;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
    }

    .invoice-box table {
        width: 100%;
        border-collapse: collapse;
    }

    .invoice-box table td,
    .invoice-box table th {
        border: 1px solid #000;
        padding: 6px;
        vertical-align: top;
    }

    .no-border td {
        border: none;
        padding: 4px 0;
    }

    .center {
        text-align: center;
    }

    .right {
        text-align: right;
    }

    .header-box {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 10px;
    }

    .header-left {
        width: 35%;
        text-align: left;
    }

    .header-left img {
        height: 80px;
    }

    .header-center {
        width: 65%;
        /* text-align: center; */
    }

    .header-center p {
        margin: 0;
        /* font-style: italic; */
    }

    h2.invoice-title {
        text-align: center;
        margin: 12px 0;
        text-transform: uppercase;
        font-size: 20px;
    }

    .invoice-month {
        text-align: center;
        margin-bottom: 10px;
    }
    @media print {
        .btn, .btn * {
            display: none !important;
        }
        .invoice-box {
            width: auto;
            height: auto;
            margin: auto;
            page-break-after: avoid;
        }
    }
    
</style>

<div class="invoice-box">
    <!-- Header -->
    {{-- <div class="header-box">
        <div class="header-left">
            <img src="{{ public_path('/assets/img/bGROUP_logo.png') }}" alt="Logo Công ty">
        </div>
        <div class="header-center">
            <p>Địa chỉ: 65 Huỳnh Thúc Kháng, Bến Nghé, Quận 1, Hồ Chí Minh 700000</p>
            <p>Điện thoại: 028 3821 2360</p>
            <p>Email: info@bgroup.com.vn</p>
        </div>
    </div> --}}
    <table class="no-border" style="width: 100%;">
        <tr>
            <td style="width: 35%; border:#fff">
                <img src="{{ public_path('/assets/img/bGROUP_logo.png') }}" alt="Logo Công ty" style="height: 80px;">
            </td>
            <td style="width: 65%; text-align: left; border:#fff">
                <p style="margin: 0; line-height: 1.4;">
                    Địa chỉ: 65 Huỳnh Thúc Kháng, Bến Nghé, Quận 1, Hồ Chí Minh 700000<br>
                    Điện thoại: 028 3821 2360<br>
                    Email: info@bgroup.com.vn
                </p>
            </td>
        </tr>
    </table>
    
    <hr>
    <h2 class="invoice-title">HÓA ĐƠN THANH TOÁN</h2>
    <p class="invoice-month"><strong>Tháng {{ \Carbon\Carbon::parse($hoadon->thang_nam)->format('m/Y') }}</strong></p>

    <table class="no-border">
        <tr>
            <td><strong>Mã hóa đơn:</strong> {{ $hoadon->ma_hoa_don }}</td>
            <td><strong>Ngày lập:</strong> {{ \Carbon\Carbon::parse($hoadon->created_at)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Khách hàng:</strong> {{ $hoadon->hopdong->user->name }}</td>
        </tr>
        <tr>
            <td><strong>Văn phòng:</strong> {{ $hoadon->hopdong->chiTietHopDongs->first()->vanphong->ten_van_phong }}</td>
            <td><strong>Mã VP:</strong> {{ $hoadon->hopdong->chiTietHopDongs->first()->ma_van_phong }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Tòa nhà:</strong> {{ $hoadon->hopdong->chiTietHopDongs->first()->vanphong->toanha->ten_toa_nha }}</td>
        </tr>
    </table>

    <br>

    <table>
        <tr class="heading center">
            <th>Dịch vụ</th>
            <th>Chỉ số cũ</th>
            <th>Chỉ số mới</th>
            <th>Tiêu thụ</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>

        <tr>
            <td>Điện (kWh)</td>
            <td class="center">{{ $hoadon->chi_so_dien_cu }}</td>
            <td class="center">{{ $hoadon->so_dien }}</td>
            <td class="center">
                {{ $hoadon->so_dien ? $hoadon->so_dien - $hoadon->chi_so_dien_cu : '' }}
            </td>
            <td class="right">{{ number_format($hoadon->hopdong->chiTietHopDongs->first()->gia_dien) }}</td>
            <td class="right">{{ number_format($hoadon->tien_dien) }}</td>
        </tr>

        <tr>
            <td>Nước (m³)</td>
            <td class="center">{{ $hoadon->chi_so_nuoc_cu }}</td>
            <td class="center">{{ $hoadon->so_nuoc }}</td>
            <td class="center">
                {{ $hoadon->so_nuoc ? $hoadon->so_nuoc - $hoadon->chi_so_nuoc_cu : '' }}
            </td>
            <td class="right">{{ number_format($hoadon->hopdong->chiTietHopDongs->first()->gia_nuoc) }}</td>
            <td class="right">{{ number_format($hoadon->tien_nuoc) }}</td>
        </tr>

        <tr>
            <td>Tiền thuê văn phòng</td>
            <td colspan="4"></td>
            <td class="right">{{ number_format($hoadon->tien_thue) }}</td>
        </tr>
        
        <tr>
            <td colspan="5" class="right">Thuế VAT (10%)</td>
            <td class="right">
                    {{ number_format($hoadon->tong_tien * 0.10) }}
            </td>
        </tr>
        
        <tr class="total">
            <td colspan="5" class="right"><strong>TỔNG THANH TOÁN</strong></td>
            <td class="right">
                <strong>
                    {{ number_format($hoadon->tong_tien) }} VNĐ
                </strong>
            </td>
        </tr>
        
    </table>


    <p><strong>Trạng thái:</strong>
        {{ $hoadon->trang_thai === 'da thanh toan' ? 'ĐÃ THANH TOÁN' : 'CHƯA THANH TOÁN' }}
    </p>

    <br><br>
    <table class="no-border">
        <tr>
            <td class="center" style="border:#fff"><strong>Người lập</strong><br>(Ký, ghi rõ họ tên)</td>
            <td class="center" style="border:#fff"><strong>Khách hàng</strong><br>(Ký, ghi rõ họ tên)</td>
        </tr>
    </table>
</div>

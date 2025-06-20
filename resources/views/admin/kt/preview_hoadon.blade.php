<style>
    body {
        font-family: 'DejaVu Sans', sans-serif !important;
    }

    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        font-size: 16px;
        line-height: 24px;
        color: #555;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
        border-collapse: collapse;
        font-family: 'DejaVu Sans', sans-serif !important;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        font-weight: bold;
    }

    .invoice-box table tr.total td {
        font-weight: bold;
    }
</style>

<div class="invoice-box">
    <h2 style="text-align: center;">HÓA ĐƠN THANH TOÁN</h2>

    <table>
        <tr>
            <td><strong>Mã hóa đơn: </strong> {{ $hoadon->ma_hoa_don }}</td>
            <td><strong>Ngày lập: </strong> {{ $hoadon->created_at }}</td>
        </tr>
        <tr>
            <td><strong>Khách hàng: </strong> {{ $hoadon->hopdong->user->name }}</td>
        </tr>
        <tr>
            <td><strong>Mã văn phòng: </strong> {{ $hoadon->hopdong->chiTietHopDongs->first()->ma_van_phong }}</td>
            <td><strong>Tên văn phòng: </strong> {{ $hoadon->hopdong->chiTietHopDongs->first()->vanphong->ten_van_phong }}</td>
        </tr>
        <tr>
            <td><strong>Tên tòa nhà: </strong> {{ $hoadon->hopdong->chiTietHopDongs->first()->vanphong->toanha->ten_toa_nha }}</td>
        </tr>
    </table>

    <br>

    <table border="1">
        <tr class="heading">
            <td>Dịch vụ</td>
            <td>Chỉ số cũ</td>
            <td>Chỉ số mới</td>
            <td>Tổng tiêu</td>
            <td>Đơn giá</td>
            <td>Thành tiền</td>
        </tr>

        <tr>
            <td>Điện(kWh)</td>
            <td>{{ $hoadon->chi_so_dien_cu }}</td>
            <td>{{ $hoadon->so_dien }}</td>
            @if (!$hoadon->so_dien)
               <td></td>
            @else
            <td>{{ $hoadon->so_dien - $hoadon->chi_so_dien_cu }}</td>
            @endif
            <td>{{ number_format($hoadon->hopdong->chiTietHopDongs->first()->gia_dien) }}</td>
            <td>{{ number_format($hoadon->tien_dien) }}</td>
        </tr>

        <tr>
            <td>Nước(m³)</td>
            <td>{{ $hoadon->chi_so_nuoc_cu }}</td>
            <td>{{ $hoadon->so_nuoc }}</td>
            @if (!$hoadon->so_nuoc)
               <td></td>
            @else
            <td>{{ $hoadon->so_nuoc - $hoadon->chi_so_nuoc_cu}}</td>
            @endif
            <td>{{ number_format($hoadon->hopdong->chiTietHopDongs->first()->gia_nuoc) }}</td>
            <td>{{ number_format($hoadon->tien_nuoc) }}</td>
        </tr>

        <tr>
            <td>Tiền thuê</td>
            <td colspan="4"></td>
            <td>{{ number_format($hoadon->tien_thue) }}</td>
        </tr>

        <tr class="total">
            <td colspan="5" style="text-align: right;">Tổng cộng:</td>
            <td>{{ number_format($hoadon->tong_tien) }} VNĐ</td>
        </tr>
    </table>

    <br><br>
    <p>Trạng thái:<strong> 
        @if($hoadon->trang_thai === "da thanh toan")
            ĐÃ THANH TOÁN
        @else
            CHƯA THANH TOÁN
        @endif
        </strong>
    </p>
</div>
@if(empty($is_pdf))
    <div class="d-flex justify-content-end mt-2">
        <a href="{{ route('kt.hoadon.export_pdf', $hoadon->ma_hoa_don) }}"
            class="btn btn-success mb-2" target="_blank">
            <i class="tio-download-to"></i> Tải file PDF
        </a>
    </div>
@endif


<style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        font-size: 16px;
        line-height: 24px;
        font-family: 'Arial', sans-serif;
        color: #555;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    }
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
        border-collapse: collapse;
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
<h2>Hóa đơn tháng {{ $hoadon->thang_nam }}</h2>

<p>Kính gửi khách hàng {{ $hoadon->hopdong->user->name}}!</p>
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
            <td>{{ $soDienCu }}</td>
            <td>{{ $hoadon->so_dien }}</td>
            <td>{{ $hoadon->so_dien - $soDienCu }}</td>
            <td>{{ number_format($hoadon->hopdong->chiTietHopDongs->first()->gia_dien) }}</td>
            <td>{{ number_format($hoadon->tien_dien) }}</td>
        </tr>

        <tr>
            <td>Nước(m³)</td>
            <td>{{ $soNuocCu }}</td>
            <td>{{ $hoadon->so_nuoc }}</td>
            <td>{{ $hoadon->so_nuoc - $soNuocCu}}</td>
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
</div>


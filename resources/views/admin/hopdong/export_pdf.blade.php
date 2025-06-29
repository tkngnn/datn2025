<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Hợp đồng {{ $hopdong->ma_hop_dong }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            line-height: 1.6;
        }

        .contract-container {
            padding: 30px;
        }

        .text-center {
            text-align: center;
        }

        .signature-section {
            margin-top: 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        ul {
            padding-left: 20px;
        }
    </style>
</head>

<body>
    <div class="contract">
        <div class="contract-container">
            <div class="text-center">
                <strong>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong><br>
                <em>Độc lập - Tự do - Hạnh phúc</em><br>
                <strong>HỢP ĐỒNG CHO THUÊ VĂN PHÒNG</strong><br>
                No/ Số: {{ $hopdong->ma_hop_dong }}/HĐTVP
            </div>
        </div>
        <br>
        <p>
            <em>- Căn cứ Bộ luật Dân sự số 33/2005/QH11 và Luật Nhà ở số 56/2005/QH11 của nước Cộng hòa xã hội chủ nghĩa
                Việt
                Nam ban hành năm 2005;</em><br>
            <em> - Căn cứ các văn bản pháp luật có liên quan;</em><br>
            <em>- Căn cứ vào khả năng và nhu cầu của hai bên trong hợp đồng này.</em>
        </p>
        <p><strong>Hôm nay, ngày {{ \Carbon\Carbon::parse($hopdong->ngay_ky)->format('d') }} tháng
                {{ \Carbon\Carbon::parse($hopdong->ngay_ky)->format('m') }} năm
                {{ \Carbon\Carbon::parse($hopdong->ngay_ky)->format('Y') }}, tại TP.Hồ Chí Minh, chúng tôi gồm:</strong>
        </p>

        <p><strong>BÊN CHO THUÊ (Bên A):</strong></p>
        <p>Họ tên / Công ty: Công ty BGROUP</p>
        <p>Địa chỉ: 123 Nguyễn Văn Cừ, Quận 5, TP.HCM</p>
        <p>Điện thoại: 0909 999 999</p>
        <p>Đại diện: Nguyễn Văn Anh</p>
        <p>Chức vụ: Giám đốc</p>

        <br>
        <p><strong>BÊN THUÊ (Bên B):</strong></p>
        <p>Họ tên / Công ty: {{ $hopdong->user->name ?? 'Không có' }}</p>
        <p>Địa chỉ: {{ $hopdong->user->dia_chi ?? 'Không rõ' }}</p>
        <p>Điện thoại: {{ $hopdong->user->so_dien_thoai ?? 'Không rõ' }}</p>
        <p>Đại diện: {{ $hopdong->user->name ?? 'Không có' }}</p>
        <p>Email: {{ $hopdong->user->email ?? 'Không rõ' }}</p>
        <p>CCCD: {{ $hopdong->user->cccd ?? 'Không rõ' }}</p>

        <br>
        <p><strong>Điều 1: Đối tượng hợp đồng</strong></p>
        <p>
            Bên A đồng ý cho thuê và Bên B đồng ý thuê văn phòng tại địa chỉ:
            {{ $toaNha->dia_chi ?? '[Địa chỉ tòa nhà]' }}, thuộc tòa nhà
            {{ $toaNha->ten_toa_nha ?? '[Tên tòa nhà]' }}, phòng số {{ $vanPhong->ma_van_phong ?? '[Mã văn phòng]' }},
            với
            diện tích sử dụng {{ $chiTiet->dien_tich }} m².
        </p>

        <br>
        <p><strong>Điều 2: Thời hạn thuê</strong></p>
        <p>
            Thời hạn thuê: Từ ngày {{ \Carbon\Carbon::parse($hopdong->ngay_bat_dau)->format('d/m/Y') }} đến ngày
            {{ \Carbon\Carbon::parse($hopdong->ngay_ket_thuc)->format('d/m/Y') }}.
        </p>
        <p>Gia hạn: Có thể gia hạn thêm khi hai bên thỏa thuận.</p>

        <br>
        <p><strong>Điều 3: Giá thuê và phương thức thanh toán</strong></p>
        <p>Giá thuê: {{ number_format($chiTiet->gia_thue, 0, ',', '.') }} VNĐ/tháng (đã bao gồm VAT).</p>
        <p>Phí dịch vụ (nếu có): {{ number_format($chiTiet->dich_vu_khac, 0, ',', '.') }} VNĐ.</p>
        <p>Giá điện: {{ number_format($chiTiet->gia_dien ?? 0, 0, ',', '.') }} VNĐ/kWh.</p>
        <p>Giá nước: {{ number_format($chiTiet->gia_nuoc ?? 0, 0, ',', '.') }} VNĐ/m³.</p>
        <p>Hình thức thanh toán: [Chuyển khoản/Tiền mặt], thanh toán theo tháng.</p>
        <p>Tiền đặt cọc: {{ number_format($hopdong->tong_tien_coc, 0, ',', '.') }} VNĐ, sẽ hoàn trả sau khi kết thúc
            hợp
            đồng.</p>

        <br>
        <p><strong>Điều 4: Quyền và nghĩa vụ của các bên</strong></p>
        <p><u>Bên A có quyền và nghĩa vụ:</u></p>
        <ul>
            <li>Bàn giao văn phòng đúng thời hạn.</li>
            <li>Đảm bảo quyền sử dụng hợp pháp của Bên B.</li>
            <li>Không làm ảnh hưởng đến hoạt động của Bên B trong thời gian thuê.</li>
        </ul>

        <p><u>Bên B có quyền và nghĩa vụ:</u></p>
        <ul>
            <li>Sử dụng văn phòng đúng mục đích.</li>
            <li>Thanh toán đúng hạn.</li>
            <li>Không sửa chữa, thay đổi kết cấu mà chưa có sự đồng ý của Bên A.</li>
        </ul>

        <br>
        <p><strong>Điều 5: Chấm dứt hợp đồng</strong></p>
        <p>Hai bên có quyền chấm dứt hợp đồng trước thời hạn khi có thông báo bằng văn bản trước 30 ngày.</p>
        <p>Vi phạm điều khoản sẽ bị xử lý theo thỏa thuận và pháp luật hiện hành.</p>

        <br>
        <p><strong>Điều 6: Điều khoản chung</strong></p>
        <p>Hợp đồng được lập thành 02 bản, mỗi bên giữ 01 bản có giá trị pháp lý như nhau.</p>
        <p>Các phụ lục và tài liệu đính kèm là một phần không tách rời của hợp đồng.</p>

        <br><br>

        <div class="signature-section">
            <div style="float: left; width: 40%; text-align: center;">
                <strong>ĐẠI DIỆN BÊN A</strong><br>
                (Ký và ghi rõ họ tên)
            </div>
            <div style="float: right; width: 40%; text-align: center;">
                <strong>ĐẠI DIỆN BÊN B</strong><br>
                (Ký và ghi rõ họ tên)
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>

    </div>
</body>

</html>

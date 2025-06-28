<div class="container" style="font-family: 'Times New Roman', serif; font-size: 13pt; padding: 30px; line-height: 1.5;">
    <style>
        @page {
            size: A4;
            margin: 2.5cm 2cm 2cm 3cm;
            /* Trên, phải, dưới, trái */
        }

        p {
            margin: 0 0 8pt 0;
        }

        .quoc-hieu {
            text-align: center;
            line-height: 1.5;
        }

        .quoc-hieu hr {
            width: 40%;
            border: 1px solid black;
            margin: 5px auto;
        }

        .tieu-de {
            text-align: center;
            margin-top: 20px;
        }

        .chu-ky {
            display: flex;
            justify-content: space-between;
            margin-top: 60px;
            text-align: center;
        }
    </style>
    <div style="text-align: center;" class="quoc-hieu">
        <strong>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong><br>
        <em>Độc lập - Tự do - Hạnh phúc</em>
        <hr>
    </div>
    <div class="tieu-de">
        <strong style="font-size: 16pt;">BIÊN BẢN THANH LÝ HỢP ĐỒNG</strong><br>
        Số: {{ $hopdong->ma_hop_dong }}/BBTL
    </div>
    <br><br>
    <p><strong>Hôm nay, ngày {{ \Carbon\Carbon::parse($thanhLy->ngay_thanh_ly)->format('d') }} tháng
            {{ \Carbon\Carbon::parse($thanhLy->ngay_thanh_ly)->format('m') }} năm
            {{ \Carbon\Carbon::parse($thanhLy->ngay_thanh_ly)->format('Y') }}, tại TP.Hồ Chí Minh, chúng tôi
            gồm:</strong>
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
    <p>Chức vụ: [Chức vụ]</p>

    <br>
    <p><strong>Điều 1: Thông tin hợp đồng</strong></p>
    <p>
        Hợp đồng cho thuê văn phòng số: {{ $hopdong->ma_hop_dong }} ký ngày
        {{ \Carbon\Carbon::parse($hopdong->ngay_bat_dau)->format('d/m/Y') }},
        thời hạn từ {{ \Carbon\Carbon::parse($hopdong->ngay_bat_dau)->format('d/m/Y') }} đến
        {{ \Carbon\Carbon::parse($hopdong->ngay_ket_thuc)->format('d/m/Y') }}.
    </p>

    <br>
    <p><strong>Điều 2: Lý do thanh lý hợp đồng</strong></p>
    <p>
        {{ $thanhLy->ly_do_thanh_ly == 'roi_phong'
            ? 'Rời phòng'
            : ($thanhLy->ly_do_thanh_ly == 'bo_coc'
                ? 'Bỏ cọc'
                : $thanhLy->ly_do_thanh_ly) }}
    </p>

    <br>
    <p><strong>Điều 3: Thông tin thanh lý</strong></p>
    <ul>
        <li>Ngày chuyển đi: {{ \Carbon\Carbon::parse($thanhLy->ngay_chuyen_di)->format('d/m/Y') }}</li>
        <li>Công nợ: {{ number_format($thanhLy->cong_no, 0, ',', '.') }} VNĐ</li>
        <li>Hoàn trả tiền cọc: {{ number_format($thanhLy->hoan_tra_tien_coc, 0, ',', '.') }} VNĐ</li>
        <li>Phí phạt (nếu có): {{ number_format($thanhLy->phi_phat, 0, ',', '.') }} VNĐ</li>
        <li>Tổng số tiền thanh toán: {{ number_format($thanhLy->tong_thanh_toan, 0, ',', '.') }} VNĐ</li>
    </ul>

    @if ($thanhLy->tong_thanh_toan < 0)
        <p><strong>Ghi chú:</strong> Bên A có trách nhiệm hoàn trả lại số tiền
            {{ number_format(abs($thanhLy->tong_thanh_toan), 0, ',', '.') }} VNĐ cho Bên B.</p>
    @elseif ($thanhLy->tong_thanh_toan > 0)
        <p><strong>Ghi chú:</strong> Bên B có nghĩa vụ thanh toán số tiền
            {{ number_format($thanhLy->tong_thanh_toan, 0, ',', '.') }} VNĐ để hoàn tất các công nợ với Bên A.</p>
    @else
        <p><strong>Ghi chú:</strong> Hai bên không còn khoản công nợ nào phải thanh toán.</p>
    @endif


    <br>
    <p><strong>Điều 4: Cam kết của các bên</strong></p>
    <p>
        Hai bên cam kết thực hiện đúng các thỏa thuận trong biên bản thanh lý này và không có tranh chấp phát sinh liên
        quan đến hợp đồng đã thanh lý.
    </p>

    <div class="chu-ky">
        <div>
            <strong>ĐẠI DIỆN BÊN A</strong><br>
            (Ký, ghi rõ họ tên)<br><br><br><br><br><br><br>
        </div>
        <div>
            <strong>ĐẠI DIỆN BÊN B</strong><br>
            (Ký, ghi rõ họ tên)<br><br><br><br><br><br><br>
        </div>
    </div>
</div>

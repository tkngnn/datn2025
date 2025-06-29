<div class="container" style="font-family: 'Times New Roman', serif; font-size: 13pt; padding: 30px; line-height: 1.5;">
    <style>
        @page {
            size: A4;
            margin: 2.5cm 2cm 2cm 3cm;
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

    <div class="quoc-hieu">
        <strong>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong><br>
        <em>Độc lập - Tự do - Hạnh phúc</em>
        <hr>
    </div>
    <br>
    <div class="tieu-de">
        <strong style="font-size: 16pt;">HỢP ĐỒNG CHO THUÊ VĂN PHÒNG</strong><br>
        Số: {{ $hopdong->ma_hop_dong }}/HĐTVP
    </div>
    <br>
    <p>
        <em>- Căn cứ Bộ luật Dân sự số 33/2005/QH11 và Luật Nhà ở số 56/2005/QH11 ban hành năm 2005;</em><br>
        <em>- Căn cứ các văn bản pháp luật có liên quan;</em><br>
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
        {{ $toaNha->ten_toa_nha ?? '[Tên tòa nhà]' }}, phòng số {{ $vanPhong->ma_van_phong ?? '[Mã văn phòng]' }}, với
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
    <p>Tiền đặt cọc: {{ number_format($hopdong->tong_tien_coc, 0, ',', '.') }} VNĐ, sẽ hoàn trả sau khi kết thúc hợp
        đồng.</p>

    <br>
    <p><strong>Điều 4: Quyền và nghĩa vụ của các bên</strong></p>
    <p><u>Bên A:</u></p>
    <ul>
        <li>Bàn giao văn phòng đúng thời hạn.</li>
        <li>Đảm bảo quyền sử dụng hợp pháp của Bên B.</li>
        <li>Không làm ảnh hưởng đến hoạt động của Bên B trong thời gian thuê.</li>
    </ul>

    <p><u>Bên B:</u></p>
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
@if(empty($is_pdf))
    <div class="d-flex justify-content-end mt-2">
        <a href="{{ route('kt.hopdong.export_pdf', $hopdong->ma_hop_dong) }}"
            class="btn btn-danger mb-2" target="_blank">
            <i class="tio-download-to"></i> Tải file PDF
        </a>
    </div>
@endif

<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('maus')->insert([
            [
                'ten_mau' => 'Hợp đồng',
                'phien_ban' => 1,
                'noi_dung' => '<br>
    <div class="tieu-de">
        <strong style="font-size: 16pt;">HỢP ĐỒNG CHO THUÊ VĂN PHÒNG</strong><br>
        Số: {{ MA_HOP_DONG }}/HĐTVP
    </div>
    <br>
    <p>
        <em>- Căn cứ Bộ luật Dân sự số 33/2005/QH11 và Luật Nhà ở số 56/2005/QH11 ban hành năm 2005;</em><br>
        <em>- Căn cứ các văn bản pháp luật có liên quan;</em><br>
        <em>- Căn cứ vào khả năng và nhu cầu của hai bên trong hợp đồng này.</em>
    </p>

    <p><strong>Hôm nay, ngày {{ NGAY_KY_D }} tháng
            {{ NGAY_KY_M }} năm
            {{ NGAY_KY_Y }}, tại TP.Hồ Chí Minh, chúng tôi gồm:</strong>
    </p>

    <p><strong>BÊN CHO THUÊ (Bên A):</strong></p>
    <p>Họ tên / Công ty: Công ty BGROUP</p>
    <p>Địa chỉ: 123 Nguyễn Văn Cừ, Quận 5, TP.HCM</p>
    <p>Điện thoại: 0909 999 999</p>
    <p>Đại diện: Nguyễn Văn Anh</p>
    <p>Chức vụ: Giám đốc</p>

    <br>
    <p><strong>BÊN THUÊ (Bên B):</strong></p>
    <p>Họ tên / Công ty: {{ TEN_KHACH_HANG }}</p>
    <p>Địa chỉ: {{ DIA_CHI_KHACH_HANG }}</p>
    <p>Điện thoại: {{ SDT_KHACH_HANG }}</p>
    <p>Đại diện: {{ DAI_DIEN_KHACH_HANG }}</p>
    <p>Email: {{ EMAIL_KHACH_HANG }}</p>
    <p>CCCD: {{ CCCD_KHACH_HANG }}</p>

    <br>
    <p><strong>Điều 1: Đối tượng hợp đồng</strong></p>
    <p>
        Bên A đồng ý cho thuê và Bên B đồng ý thuê văn phòng tại địa chỉ:
        {{ DIA_CHI_TOA_NHA }}, thuộc tòa nhà
        {{ TEN_TOA_NHA }}, phòng số {{ MA_VAN_PHONG }}, với
        diện tích sử dụng {{ DIEN_TICH_VAN_PHONG }} m².
    </p>

    <br>
    <p><strong>Điều 2: Thời hạn thuê</strong></p>
    <p>
        Thời hạn thuê: Từ ngày {{ NGAY_BAT_DAU }} đến ngày
        {{ NGAY_KET_THUC }}.
    </p>
    <p>Gia hạn: Có thể gia hạn thêm khi hai bên thỏa thuận.</p>

    <br>
    <p><strong>Điều 3: Giá thuê và phương thức thanh toán</strong></p>
    <p>Giá thuê: {{ GIA_THUE }} VNĐ/tháng (đã bao gồm VAT).</p>
    <p>Phí dịch vụ (nếu có): {{ PHI_DICH_VU }} VNĐ.</p>
    <p>Giá điện: {{ GIA_DIEN }} VNĐ/kWh.</p>
    <p>Giá nước: {{ GIA_NUOC }} VNĐ/m³.</p>
    <p>Hình thức thanh toán: [Chuyển khoản/Tiền mặt], thanh toán theo tháng.</p>
    <p>Tiền đặt cọc: {{ TIEN_COC }} VNĐ, sẽ hoàn trả sau khi kết thúc hợp
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
    <p>Các phụ lục và tài liệu đính kèm là một phần không tách rời của hợp đồng.</p>',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'ten_mau' => 'Thanh lý',
                'phien_ban' => 2,
                'noi_dung' => '<br>
    <div class="tieu-de">
        <strong style="font-size: 16pt;">BIÊN BẢN THANH LÝ HỢP ĐỒNG</strong><br>
        Số: {{ MA_HOP_DONG }}/HĐTVP
    </div>
    <br>
<p>
        <em>- Căn cứ Bộ luật Dân sự số 33/2005/QH11 và Luật Nhà ở số 56/2005/QH11 ban hành năm 2005;</em>
        <em>- Căn cứ các văn bản pháp luật có liên quan;</em>
        <em>- Căn cứ vào khả năng và nhu cầu của hai bên trong hợp đồng này.</em>
    
    </p><p><strong>Hôm nay, ngày {{ NGAY_THANH_LY_D }} tháng
            {{ NGAY_THANH_LY_M }} năm
            {{ NGAY_THANH_LY_Y }}, tại TP.Hồ Chí Minh, chúng tôi gồm:</strong>
    
    </p><p><strong>BÊN CHO THUÊ (Bên A):</strong></p><p>Họ tên / Công ty: Công ty BGROUP</p><p>Địa chỉ: 123 Nguyễn Văn Cừ, Quận 5, TP.HCM</p><p>Điện thoại: 0909 999 999</p><p>Đại diện: Nguyễn Văn Anh</p><p>Chức vụ: Giám đốc</p><p>
</p><p><strong>BÊN THUÊ (Bên B):</strong></p><p>
    </p><p>Họ tên / Công ty: {{ TEN_KHACH_HANG }}</p><p>
    </p><p>Địa chỉ: {{ DIA_CHI_KHACH_HANG }}</p><p>
    </p><p>Điện thoại: {{ SDT_KHACH_HANG }}</p><p>
    </p><p>Đại diện: {{ DAI_DIEN_KHACH_HANG }}</p><p>
    </p><p>Email: {{ EMAIL_KHACH_HANG }}</p><p>
    </p><p>CCCD: {{ CCCD_KHACH_HANG }}</p><p>

    </p><p><br>
    <p><strong>Điều 1: Thông tin hợp đồng</strong></p>
    <p>
        Hợp đồng cho thuê văn phòng số: {{ MA_HOP_DONG }} ký ngày
        {{ NGAY_KY }},
        thời hạn từ {{ NGAY_BAT_DAU }} đến
        {{ NGAY_KET_THUC }}.
    </p>

    <br>
    <p><strong>Điều 2: Lý do thanh lý hợp đồng</strong></p>
    <p>
        {{ LY_DO }}
    </p>

    <br>
    <p><strong>Điều 3: Thông tin thanh lý</strong></p>
    <ul>
        <li>Ngày chuyển đi: {{ NGAY_CHUYEN_DI }}</li>
        <li>Công nợ: {{ CONG_NO }} VNĐ</li>
        <li>Hoàn trả tiền cọc: {{ HOAN_COC }} VNĐ</li>
        <li>Phí phạt (nếu có): {{ PHI_PHAT }} VNĐ - (Nội dung phí phạt:
{{ NOI_DUNG_PHI_PHAT }})</li>
        <li>Tổng số tiền thanh toán: {{ TONG_THANH_TOAN }} VNĐ</li>
    </ul>

    <p><strong>Ghi chú:</strong> {{ TONG }}</p>

    <br>
    <p><strong>Điều 4: Cam kết của các bên</strong></p>
    <p>
        Hai bên cam kết thực hiện đúng các thỏa thuận trong biên bản thanh lý này và không có tranh chấp phát sinh liên
        quan đến hợp đồng đã thanh lý.
    </p>',
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);
    }
}
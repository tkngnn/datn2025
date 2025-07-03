<h2>Chào {{ $henxem->ho_ten }}</h2>
<p>Lịch hẹn xem văn phòng của bạn đã được xác nhận.</p>
<p><strong>Thời gian:</strong> {{ $henxem->ngay_hen }}</p>
<p><strong>Văn phòng:</strong> {{ $henxem->vanphong->ten_van_phong ?? 'Chưa rõ' }}</p>
<p>Trân trọng,</p>
<p>Đội ngũ quản lý</p>

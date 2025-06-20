<p>Chào {{ $user->name }},</p>

<p>Hợp đồng thuê văn phòng của bạn đã được tạo thành công từ ngày {{ $hopDong->ngay_bat_dau }} đến
    {{ $hopDong->ngay_ket_thuc }}.</p>

@if (isset($user))
    <p>Tài khoản của bạn: <br>
        Email: {{ $user->email }} <br>
        Mật khẩu: {{ $user->cccd }}</p>
@endif

<p>Trân trọng,<br>BQL Tòa nhà</p>

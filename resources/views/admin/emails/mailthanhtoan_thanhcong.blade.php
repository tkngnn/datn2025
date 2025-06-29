<x-mail::message>
    # Thanh toán hóa đơn thành công

    Chào {{ $hoaDon->hopDong->user->name ?? 'bạn' }},

    Hóa đơn mã: **{{ $hoaDon->ma_hoa_don }}** của bạn đã thanh toán thành công.
    Dưới đây là thông tin chi tiết về hóa đơn:
    - **Mã hợp đồng**: {{ $hoaDon->hopDong->ma_hop_dong }}
    - **Số tiền**: {{ number_format($hoaDon->tong_tien, 0, ',', '.') }} VNĐ
    - **Ngày thanh toán**: {{ $thanhToan->thoi_gian->format('d/m/Y H:i') }}
    - **Trạng thái**: Thanh toán thành công

    Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.
    Trân trọng,
    BQL Tòa nhà
</x-mail::message>

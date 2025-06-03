
<div>
    <h5>CHI TIẾT YÊU CẦU HỖ TRỢ - Số {{ $yeuCau->ma_yeu_cau }}</h5>
    <br>
    <table class="table">
        <tbody>
            <tr>
                <th class="fw-bold text-cap text-dark">Khách hàng</th>
                <td class="form-group">
                    <p>{{ $yeuCau->user->name ?? 'Không rõ' }}</p>
                    <span class="text-muted">Email: {{ $yeuCau->user->email ?? 'Không rõ' }}</span>
                </td>
            </tr>
            <tr>
                <th class="fw-bold text-cap text-dark">Tiêu đề</th>
                <td>{{ $yeuCau->tieu_de }}</td>
            </tr>
            <tr>
                <th class="fw-bold text-cap text-dark">Nội dung</th>
                <td>{{ $yeuCau->noi_dung }}</td>
            </tr>
            <tr>
                <th class="fw-bold text-cap text-dark">Thời gian gửi</th>
                <td>{{ \Carbon\Carbon::parse($yeuCau->thoi_gian_gui)->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <th class="fw-bold text-cap text-dark">Trạng thái</th>
                <td>
                    @if ($yeuCau->trang_thai_xu_ly === 'chua xu ly')
                        Chưa xử lý
                    @elseif ($yeuCau->trang_thai_xu_ly === 'da xu ly')
                        Đã xử lý
                    @else
                        {{ $yeuCau->trang_thai_xu_ly }}
                    @endif
                </td>
            </tr>
            
            <tr>
                <th class="fw-bold text-cap text-dark">Ghi chú xử lý</th>
                <td>{{ $yeuCau->ghi_chu_xu_ly ?? '-------' }}</td>
            </tr>
        </tbody>
    </table>
</div>


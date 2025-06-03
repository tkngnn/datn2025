<h5>CHI TIẾT YÊU CẦU HỖ TRỢ - Số {{ $yeuCau->ma_yeu_cau }}</h5>

<br>
<h5>Thông tin khách hàng</h5>
<div class="form-group row align-items-center">
    <label for="khach_hang" class="col-sm-3 col-form-label">Khách hàng:</label>
    <div class="col-sm-9">
        <p class="mb-0 fw-bold">{{ $yeuCau->user->name ?? 'Không rõ' }}</p>
        <small class="text-muted">Email: {{ $yeuCau->user->email ?? 'Không rõ' }}</small>
    </div>

</div>
<hr>

<h5>Thông tin yêu cầu</h5>
<div class="form-group row align-items-center">
    <label for="ma_yeu_cau" class="col-sm-3 col-form-label">Mã yêu cầu: </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="ma_yeu_cau" name="ma_yeu_cau" value="{{ $yeuCau->ma_yeu_cau }}"
            readonly>
    </div>
</div>

<div class="form-group row align-items-center">
    <label for="tieu_de" class="col-sm-3 col-form-label">Tiêu đề: </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="tieu_de" name="tieu_de" value="{{ $yeuCau->tieu_de }}" required
            readonly>
    </div>
</div>
<div class="form-group row align-items-center">
    <label for="thoi_gian_gui" class="col-sm-3 col-form-label">Thời gian gửi: </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="thoi_gian_gui" name="thoi_gian_gui"
            value="{{ \Carbon\Carbon::parse($yeuCau->thoi_gian_gui)->format('d/m/Y H:i') }}" readonly>
    </div>
</div>
<div class="form-group row align-items-center">
    <label for="noi_dung" class="col-sm-3 col-form-label">Nội dung: </label>
    <div class="col-sm-8">
        <textarea class="form-control" id="noi_dung" name="noi_dung" rows="4" required readonly>{{ $yeuCau->noi_dung }}</textarea>
    </div>
</div>

<div class="form-group">
    <label for="trang_thai_xu_ly">Trạng thái xử lý</label>
    <select class="form-control" id="trang_thai_xu_ly" name="trang_thai_xu_ly">
        <option value="chua xu ly" {{ $yeuCau->trang_thai_xu_ly === 'chua xu ly' ? 'selected' : '' }}>Chưa xử lý
        </option>
        <option value="da xu ly" {{ $yeuCau->trang_thai_xu_ly === 'da xu ly' ? 'selected' : '' }}>Đã xử lý</option>
    </select>
</div>

<div class="form-group">
    <label for="ghi_chu_xu_ly">Ghi chú xử lý</label>
    <textarea class="form-control" id="ghi_chu_xu_ly" name="ghi_chu_xu_ly" rows="3">{{ $yeuCau->ghi_chu_xu_ly }}</textarea>
</div>

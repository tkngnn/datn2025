<section>
    @php
        $readonly = $user->vai_tro === 'KT' ? 'readonly' : '';
    @endphp

    <header class="mb-4">
        <h2 class="h4 text-dark">
            {{ __('Thông tin tài khoản') }}
        </h2>

        <p class="text-muted small mt-2">
            {{ __('Cập nhật thông tin hồ sơ và địa chỉ email.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="name" class="form-label">{{ __('Họ tên') }}</label>
                <input id="name" name="name" type="text" class="form-control"
                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" {{ $readonly }}>
                @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" name="email" type="email" class="form-control"
                    value="{{ old('email', $user->email) }}" required autocomplete="username" {{ $readonly }}>
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="so_dien_thoai" class="form-label">{{ __('Số điện thoại') }}</label>
                <input id="so_dien_thoai" name="so_dien_thoai" type="text" class="form-control"
                    value="{{ old('so_dien_thoai', $user->so_dien_thoai) }}" autocomplete="tel" {{ $readonly }}>
                @error('so_dien_thoai')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="dia_chi" class="form-label">{{ __('Địa chỉ') }}</label>
                <input id="dia_chi" name="dia_chi" type="text" class="form-control"
                    value="{{ old('dia_chi', $user->dia_chi) }}" autocomplete="address-line1" {{ $readonly }}>
                @error('dia_chi')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="cccd" class="form-label">{{ __('Số CCCD') }}</label>
                <input id="cccd" name="cccd" type="text" class="form-control"
                    value="{{ old('cccd', $user->cccd) }}" autocomplete="cccd" {{ $readonly }}>
                @error('cccd')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="vai_tro" class="form-label">{{ __('Vai trò') }}</label>
                <input id="vai_tro" name="vai_tro" type="text" class="form-control bg-light"
                    value="{{ old('vai_tro', $user->vai_tro) }}" readonly>
            </div>
        </div>

        <div class="mb-3">
            <label for="trang_thai" class="form-label">{{ __('Trạng thái') }}</label>
            <input id="trang_thai" type="text" class="form-control bg-light"
                value="{{ $user->trang_thai ? 'Đang hoạt động' : 'Bị khóa' }}" readonly>
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            @if (Auth::user()->vai_tro === 'admin')
                <button type="submit" class="btn btn-primary">{{ __('Lưu') }}</button>
            @endif

            @if (session('status') === 'profile-updated')
                <div class="text-success small">
                    {{ __('Đã lưu.') }}
                </div>
            @endif
        </div>
    </form>
</section>

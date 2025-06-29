<section>
    <header class="mb-4">
        <h2 class="h4 text-dark">
            {{ __('Cập nhật mật khẩu') }}
        </h2>

        <p class="text-muted small mt-2">
            {{ __('Hãy đảm bảo rằng tài khoản của bạn đang sử dụng một mật khẩu dài và ngẫu nhiên để giữ an toàn.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="col-md-6 mb-3">
            <label for="update_password_current_password" class="form-label">{{ __('Mật khẩu hiện tại') }}</label>
            <input type="password" class="form-control" id="update_password_current_password" name="current_password"
                autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="update_password_password" class="form-label">{{ __('Mật khẩu mới') }}</label>
            <input type="password" class="form-control" id="update_password_password" name="password"
                autocomplete="new-password">
            @error('password', 'updatePassword')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-4">
            <label for="update_password_password_confirmation" class="form-label">{{ __('Xác nhận mật khẩu') }}</label>
            <input type="password" class="form-control" id="update_password_password_confirmation"
                name="password_confirmation" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">{{ __('Lưu') }}</button>

            @if (session('status') === 'password-updated')
                <div class="text-success small" x-data="{ show: true }" x-show="show" x-transition
                    x-init="setTimeout(() => show = false, 2000)">
                    {{ __('Lưu.') }}
                </div>
            @endif
        </div>
    </form>
</section>

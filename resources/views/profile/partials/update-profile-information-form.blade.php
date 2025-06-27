{{-- <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Thông tin tài khoản') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Cập nhật thông tin hồ sơ và địa chỉ email.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Dòng 1: Họ tên và Email -->
        <div class="flex gap-6 w-full">
            <div class="w-1/2">
                <x-input-label for="name" :value="__('Họ tên')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                    required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="w-1/2">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                    required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
        </div>

        <!-- Dòng 2: Số điện thoại và Địa chỉ -->
        <div class="flex gap-6 w-full">
            <div class="w-1/2">
                <x-input-label for="so_dien_thoai" :value="__('Số điện thoại')" />
                <x-text-input id="so_dien_thoai" name="so_dien_thoai" type="text" class="mt-1 block w-full"
                    :value="old('so_dien_thoai', $user->so_dien_thoai)" autocomplete="tel" />
                <x-input-error class="mt-2" :messages="$errors->get('so_dien_thoai')" />
            </div>

            <div class="w-1/2">
                <x-input-label for="dia_chi" :value="__('Địa chỉ')" />
                <x-text-input id="dia_chi" name="dia_chi" type="text" class="mt-1 block w-full" :value="old('dia_chi', $user->dia_chi)"
                    autocomplete="address-line1" />
                <x-input-error class="mt-2" :messages="$errors->get('dia_chi')" />
            </div>
        </div>

        <!-- Dòng 3: CCCD và Vai trò -->
        <div class="flex gap-6 w-full">
            <div class="w-1/2">
                <x-input-label for="cccd" :value="__('Số CCCD')" />
                <x-text-input id="cccd" name="cccd" type="text" class="mt-1 block w-full" :value="old('cccd', $user->cccd)"
                    autocomplete="cccd" />
                <x-input-error class="mt-2" :messages="$errors->get('cccd')" />
            </div>

            <div class="w-1/2">
                <x-input-label for="vai_tro" :value="__('Vai trò')" />
                <x-text-input id="vai_tro" name="vai_tro" type="text"
                    class="mt-1 block w-full bg-gray-100 cursor-not-allowed" :value="old('vai_tro', $user->vai_tro)" readonly />
            </div>
        </div>

        <!-- Dòng 4: Trạng thái (full width) -->
        <div>
            <x-input-label for="trang_thai" :value="__('Trạng thái')" />
            <x-text-input id="trang_thai" type="text" class="mt-1 block w-full bg-gray-100 cursor-not-allowed"
                :value="$user->trang_thai ? 'Đang hoạt động' : 'Bị khóa'" readonly />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Lưu') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">
                    {{ __('Đã lưu.') }}
                </p>
            @endif
        </div>
    </form>
</section> --}}
<section>
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
            <!-- Họ tên -->
            <div class="col-md-6">
                <label for="name" class="form-label">{{ __('Họ tên') }}</label>
                <input id="name" name="name" type="text" class="form-control" 
                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Email -->
            <div class="col-md-6">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" name="email" type="email" class="form-control" 
                    value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="row mb-3">
            <!-- Số điện thoại -->
            <div class="col-md-6">
                <label for="so_dien_thoai" class="form-label">{{ __('Số điện thoại') }}</label>
                <input id="so_dien_thoai" name="so_dien_thoai" type="text" class="form-control" 
                    value="{{ old('so_dien_thoai', $user->so_dien_thoai) }}" autocomplete="tel">
                @error('so_dien_thoai')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Địa chỉ -->
            <div class="col-md-6">
                <label for="dia_chi" class="form-label">{{ __('Địa chỉ') }}</label>
                <input id="dia_chi" name="dia_chi" type="text" class="form-control" 
                    value="{{ old('dia_chi', $user->dia_chi) }}" autocomplete="address-line1">
                @error('dia_chi')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="row mb-3">
            <!-- CCCD -->
            <div class="col-md-6">
                <label for="cccd" class="form-label">{{ __('Số CCCD') }}</label>
                <input id="cccd" name="cccd" type="text" class="form-control" 
                    value="{{ old('cccd', $user->cccd) }}" autocomplete="cccd">
                @error('cccd')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Vai trò -->
            <div class="col-md-6">
                <label for="vai_tro" class="form-label">{{ __('Vai trò') }}</label>
                <input id="vai_tro" name="vai_tro" type="text" class="form-control bg-light" 
                    value="{{ old('vai_tro', $user->vai_tro) }}" readonly>
            </div>
        </div>
        
        <!-- Trạng thái -->
        <div class="mb-3">
            <label for="trang_thai" class="form-label">{{ __('Trạng thái') }}</label>
            <input id="trang_thai" type="text" class="form-control bg-light" 
                value="{{ $user->trang_thai ? 'Đang hoạt động' : 'Bị khóa' }}" readonly>
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-primary">{{ __('Lưu') }}</button>

            @if (session('status') === 'profile-updated')
                <div class="text-success small">
                    {{ __('Đã lưu.') }}
                </div>
            @endif
        </div>
    </form>
</section>
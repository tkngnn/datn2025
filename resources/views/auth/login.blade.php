<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />


    <main id="content" role="main" class="main">
        <div class="position-fixed top-0 right-0 left-0 bg-img-hero"
            style="height: 32rem; background-image: url(assets/svg/components/abstract-bg-4.svg);">
            <!-- SVG Bottom Shape -->
            <figure class="position-absolute right-0 bottom-0 left-0">
                <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1921 273">
                    <polygon fill="#fff" points="0,273 1921,273 1921,0 "></polygon>
                </svg>
            </figure>
            <!-- End SVG Bottom Shape -->
        </div>

        <div class="container py-5 py-sm-7">
            <a class="d-flex justify-content-center mb-5" href="{{ url('/') }}">
                <img class="z-index-2" src="{{ asset('assets/img/login_logo.png') }}" alt="Logo"
                    style="width: 8rem;">
            </a>

            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="card card-lg mb-5">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}" class="js-validate" novalidate>
                                @csrf

                                <div class="text-center mb-5">
                                    <h1 class="display-4">Đăng nhập</h1>
                                    <p>Đăng nhập tài khoản</p>
                                </div>

                                <!-- Email -->
                                <div class="js-form-message form-group">
                                    <label class="input-label" for="email">Email của bạn</label>
                                    <input type="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ old('email') }}" required autofocus
                                        autocomplete="username" placeholder="email@address.com"
                                        pattern="^[a-z0-9](\.?[a-z0-9_\-+]){5,}@gmail\.com$"
                                        title="Email phải hợp lệ theo định dạng Gmail, ít nhất 6 ký tự trước @gmail.com."
                                        aria-label="email@address.com" data-msg="Vui lòng nhập địa chỉ email hợp lệ.">

                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <small id="email-error" class="text-danger d-block"></small>
                                </div>

                                <!-- Password -->
                                <div class="js-form-message form-group">
                                    <label class="input-label" for="password">
                                        <span class="d-flex justify-content-between align-items-center">
                                            Mật khẩu
                                            @if (Route::has('password.request'))
                                                <a class="input-label-secondary"
                                                    href="{{ route('password.request') }}">Quên mật khẩu?</a>
                                            @endif
                                        </span>
                                    </label>

                                    <div class="input-group input-group-merge">
                                        <input type="password"
                                            class="js-toggle-password form-control form-control-lg @error('password') is-invalid @enderror"
                                            name="password" id="password" required autocomplete="current-password"
                                            placeholder="Mật khẩu ít nhất 8 ký tự"
                                            data-msg="Mật khẩu không hợp lệ. Vui lòng thử lại."
                                            data-hs-toggle-password-options='{
                                                 "target": "#changePassTarget",
                                                 "defaultClass": "tio-hidden-outlined",
                                                 "showClass": "tio-visible-outlined",
                                                 "classChangeTarget": "#changePassIcon"
                                               }'>

                                        <div id="changePassTarget" class="input-group-append">
                                            <a class="input-group-text" href="javascript:;">
                                                <i id="changePassIcon" class="tio-visible-outlined"></i>
                                            </a>
                                        </div>
                                    </div>

                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <small id="password-error" class="text-danger d-block"></small>
                                </div>

                                <!-- Remember Me -->
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="remember"
                                            name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label text-muted" for="remember"> Ghi nhớ</label>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <button type="submit" class="btn btn-lg btn-block btn-primary">Đăng nhập</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const emailInput = document.getElementById('email');
            const errorContainer = document.getElementById('email-error');
            const regex = /^[a-z0-9](\.?[a-z0-9_\-+]){5,}@gmail\.com$/;
    
            emailInput.addEventListener('input', function () {
                if (!emailInput.value) {
                    errorContainer.innerText = '';
                    emailInput.classList.remove('is-invalid');
                    return;
                }
    
                if (!regex.test(emailInput.value)) {
                    e.preventDefault();
                    errorContainer.innerText = 'Email phải là Gmail hợp lệ (ít nhất 6 ký tự trước @gmail.com)';
                    emailInput.classList.add('is-invalid');
                } else {
                    errorContainer.innerText = '';
                    emailInput.classList.remove('is-invalid');
                }
            });
        });
    </script>
</x-guest-layout>

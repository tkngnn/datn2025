<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form> --}}
    {{-- <main id="content" role="main" class="main">
        <div class="position-fixed top-0 right-0 left-0 bg-img-hero"
            style="height: 32rem; background-image: url(assets/svg/components/abstract-bg-4.svg);">
            <!-- SVG Bottom Shape -->
            <figure class="position-absolute right-0 bottom-0 left-0">
                <svg preserveaspectratio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewbox="0 0 1921 273">
                    <polygon fill="#fff" points="0,273 1921,273 1921,0 "></polygon>
                </svg>
            </figure>
            <!-- End SVG Bottom Shape -->
        </div>

        <!-- Content -->
        <div class="container py-5 py-sm-7">
            <a class="d-flex justify-content-center mb-5" href="index.html">
                <img class="z-index-2" src="assets\svg\logos\logo.svg" alt="Image Description" style="width: 8rem;">
            </a>

            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <!-- Card -->
                    <div class="card card-lg mb-5">
                        <div class="card-body">
                            <!-- Form -->
                            <form class="js-validate">
                                <div class="text-center">
                                    <div class="mb-5">
                                        <h1 class="display-4">Sign in</h1>
                                        <p>Don't have an account yet? <a href="authentication-signup-basic.html">Sign up
                                                here</a></p>
                                    </div>

                                    <a class="btn btn-lg btn-block btn-white mb-4" href="#">
                                        <span class="d-flex justify-content-center align-items-center">
                                            <img class="avatar avatar-xss mr-2" src="assets\svg\brands\google.svg"
                                                alt="Image Description">
                                            Sign in with Google
                                        </span>
                                    </a>

                                    <span class="divider text-muted mb-4">OR</span>
                                </div>

                                <!-- Form Group -->
                                <div class="js-form-message form-group">
                                    <label class="input-label" for="signinSrEmail">Your email</label>

                                    <input type="email" class="form-control form-control-lg" name="email"
                                        id="signinSrEmail" tabindex="1" placeholder="email@address.com"
                                        aria-label="email@address.com" required=""
                                        data-msg="Please enter a valid email address.">
                                </div>
                                <!-- End Form Group -->

                                <!-- Form Group -->
                                <div class="js-form-message form-group">
                                    <label class="input-label" for="signupSrPassword" tabindex="0">
                                        <span class="d-flex justify-content-between align-items-center">
                                            Password
                                            <a class="input-label-secondary"
                                                href="authentication-reset-password-basic.html">Forgot Password?</a>
                                        </span>
                                    </label>

                                    <div class="input-group input-group-merge">
                                        <input type="password" class="js-toggle-password form-control form-control-lg"
                                            name="password" id="signupSrPassword" placeholder="8+ characters required"
                                            aria-label="8+ characters required" required=""
                                            data-msg="Your password is invalid. Please try again."
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
                                </div>
                                <!-- End Form Group -->

                                <!-- Checkbox -->
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="termsCheckbox"
                                            name="termsCheckbox">
                                        <label class="custom-control-label text-muted" for="termsCheckbox"> Remember
                                            me</label>
                                    </div>
                                </div>
                                <!-- End Checkbox -->

                                <button type="submit" class="btn btn-lg btn-block btn-primary">Sign in</button>
                            </form>
                            <!-- End Form -->
                        </div>
                    </div>
                    <!-- End Card -->

                    <!-- Footer -->
                    <div class="text-center">
                        <small class="text-cap mb-4">Trusted by the world's best teams</small>

                        <div class="w-85 mx-auto">
                            <div class="row justify-content-between">
                                <div class="col">
                                    <img class="img-fluid" src="assets\svg\brands\gitlab-gray.svg"
                                        alt="Image Description">
                                </div>
                                <div class="col">
                                    <img class="img-fluid" src="assets\svg\brands\fitbit-gray.svg"
                                        alt="Image Description">
                                </div>
                                <div class="col">
                                    <img class="img-fluid" src="assets\svg\brands\flow-xo-gray.svg"
                                        alt="Image Description">
                                </div>
                                <div class="col">
                                    <img class="img-fluid" src="assets\svg\brands\layar-gray.svg"
                                        alt="Image Description">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Footer -->
                </div>
            </div>
        </div>
        <!-- End Content -->
    </main>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="text-center">
            <div class="mb-5">
                <h1 class="display-4">Sign in</h1>
                <p>Don't have an account yet? <a href="#">Sign up here</a></p>
            </div>
        </div>

        <!-- Email -->
        <div class="js-form-message form-group">
            <label class="input-label" for="signinSrEmail">Your email</label>
            <input type="email" class="form-control form-control-lg" name="email" id="signinSrEmail"
                value="{{ old('email') }}" required autofocus autocomplete="username"
                placeholder="email@address.com">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Password -->
        <div class="js-form-message form-group">
            <label class="input-label" for="signupSrPassword">
                <span class="d-flex justify-content-between align-items-center">
                    Password
                    <a class="input-label-secondary" href="{{ route('password.request') }}">Forgot Password?</a>
                </span>
            </label>

            <div class="input-group input-group-merge">
                <input type="password" class="js-toggle-password form-control form-control-lg" name="password"
                    id="signupSrPassword" required autocomplete="current-password"
                    placeholder="8+ characters required">
                <div id="changePassTarget" class="input-group-append">
                    <a class="input-group-text" href="javascript:;">
                        <i id="changePassIcon" class="tio-visible-outlined"></i>
                    </a>
                </div>
            </div>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                <label class="custom-control-label text-muted" for="remember"> Remember me</label>
            </div>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-lg btn-block btn-primary">Sign in</button>
    </form> --}}

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
                <img class="z-index-2" src="assets/svg/logos/logo.svg" alt="Logo" style="width: 8rem;">
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
                                        aria-label="email@address.com" data-msg="Please enter a valid email address.">

                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
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
                                            placeholder="8+ characters required"
                                            data-msg="Your password is invalid. Please try again."
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

</x-guest-layout>

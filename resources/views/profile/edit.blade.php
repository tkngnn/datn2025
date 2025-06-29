@extends($layout)
@section('title', 'Tài khoản')
@push('styles')
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header mb-4">
                <div class="row align-items-end">
                    <div class="col-sm-12">
                        <h1 class="page-header-title">Thông tin tài khoản</h1>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->
            
            <div class="py-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card mb-4 shadow">
                                <div class="card-body p-4">
                                    @include('profile.partials.update-profile-information-form')
                                </div>
                            </div>
                            
                            <div class="card shadow">
                                <div class="card-body p-4">
                                    @include('profile.partials.update-password-form')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Content -->
    </main>
@endsection

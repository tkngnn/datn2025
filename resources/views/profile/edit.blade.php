{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

@extends($layout)
@section('title', 'Tài khoản')
@push('styles')
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
@endpush
@section('content')
    {{-- <main id="content" role="main" class="main">


        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-sm mb-2 mb-sm-0">
                        <h1 class="page-header-title">Thông tin tài khoản</h1>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="w-full">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Content -->
    </main> --}}
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
                            <!-- Profile Information Form -->
                            <div class="card mb-4 shadow">
                                <div class="card-body p-4">
                                    @include('profile.partials.update-profile-information-form')
                                </div>
                            </div>
                            
                            <!-- Update Password Form -->
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

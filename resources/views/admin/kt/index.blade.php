@extends('admin.layouts.kt-app')
@section('title', 'Dashboard')
@push('styles')
@endpush
@section('content')
<main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
        <div class="alert alert-info">
            <h3>👋 Xin chào, <strong>{{ $user->name }}</strong>!</h3>
        </div>
        @if ($hoaDonChuaThanhToan)
            <div class="alert alert-danger">
            📄 Bạn còn <strong>{{ $hoaDonChuaThanhToan }}</strong> hóa đơn chưa thanh toán.
        </div>
        @endif
        
    </div>
</main>
@endsection
@push('scripts')
@endpush
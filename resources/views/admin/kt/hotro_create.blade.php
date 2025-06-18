@extends('admin.layouts.kt-app')
@section('title', 'TGửi yêu cầu hỗ trợ')

@push('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .ql-picker.ql-align .ql-picker-label svg,
        .ql-picker.ql-align .ql-picker-item svg {
            display: inline-block !important;
            width: 18px !important;
            height: 18px !important;
        }
    </style>
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <form action="{{ route('kt.hotro.store') }}" method="POST" enctype="multipart/form-data" id="formHoTro" class="js-step-form py-md-5" data-hs-step-form-options='{
            "progressSelector": "#addUserStepFormProgress",
            "stepsSelector": "#addUserStepFormContent",
            "endSelector": "#addUserFinishBtn",
            "isValidate": false
          }'>
          @csrf
            <!-- Content -->
            <div class="content container-fluid">
                <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none; position: fixed; top: 20px; right: 20px; z-index: 1050; min-width: 250px;">
                    <strong><span id="successText"></span></strong> 
                    <button type="button" class="close" aria-label="Close" onclick="$('#successMessage').hide()">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- @if ($errors->any())
  <div class="alert alert-danger">
    <strong>Đã có lỗi xảy ra:</strong>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif --}}

                    <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col-sm mb-2 mb-sm-0">
                            <nav aria-label="breadcrumb"></nav>
                            <h1 class="page-header-title">Gửi yêu cầu hỗ trợ</h1>
                        </div>
                    </div>
                        <!-- End Row -->
                </div>
                    <!-- End Page Header -->

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Card -->
                            <div class="card mb-3 mb-lg-5">
                                <!-- Header -->
                                <div class="card-header">
                                    <h4 class="card-header-title">Nội dung yêu cầu</h4>
                                </div>
                                <!-- End Header -->

                                <!-- Body -->
                                <div class="card-body">

                                    <!-- Form Group -->
                                    <!-- Tòa nhà -->
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                            <label class="input-label">Tiêu đề</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="tieu_de"placeholder="Nhập tiêu đề yêu cầu" value="{{ old('tieu_de') }}">
                                            </div>
                                            <span class="text-danger" id="error-tieu_de"></span>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="form-group">
                                        <label class="input-label">Nội dung</label>
                                            <textarea class="form-control" name="noi_dung" rows="3" value="{{ old('noi_dung') }}" placeholder="Nội dung yêu cầu"></textarea>
                                            <span class="text-danger" id="error-noi_dung"></span>
                                        </div>  
                                    <!-- End Form Group -->
                                </div>
                                <!-- Body -->
                            </div>
                            <!-- End Card -->
                    </div>
                    <!-- End Row -->

                    <div class="position-fixed bottom-0 content-centered-x w-100 z-index-99 mb-3" style="max-width: 40rem;">
                        <!-- Card -->
                        <div class="card card-sm bg-dark border-dark mx-2">
                            <div class="card-body">
                                <div class="row justify-content-center justify-content-sm-between">
                                    <div class="col">
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('kt.hotro') }}" class="btn btn-danger mr-2">
                                        <i class="tio-chevron-left"></i> Trở về
                                        </a>
                                        <button type="submit" class="btn btn-primary" >Lưu</button>
                                    </div>
                                </div>
                                <!-- End Row -->
                            </div>
                        </div>
                        </form>
                        <!-- End Card -->
                    </div>
                </div>
                <!-- End Content -->

                <!-- Footer -->
                <!-- End Footer -->
                <script>
                    function translateError(message) {
                    if(message.includes("The tieu de field is required.")) return "Vui lòng nhập tiêu đề";
                    if(message.includes("The noi dung field is required.")) return "Vui lòng nhập nội dung";
                    return message;
                    }
            
                    $('#formHoTro').on('submit', function(e) {
                    e.preventDefault();
                    $('.text-danger').html('');

                    var formData = $(this).serialize();

                    $.ajax({
                        url: "{{ route('kt.hotro.store') }}",
                        method: "POST",
                        data: formData,
                        success: function(response) {
                            $('#formHoTro')[0].reset();
                            $('#successText').text('Gửi yêu cầu thành công!');
                            $('#successMessage').fadeIn();
                
                            setTimeout(function() {
                                $('#successMessage').fadeOut();
                            }, 10000);
                        },
                        error: function(xhr) {
                        if(xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                            $('#error-' + key).text(translateError(value[0]));
                            });
                        }
                        }
                    });
                    });
                    </script>
      </form>  
    </main>
@endsection



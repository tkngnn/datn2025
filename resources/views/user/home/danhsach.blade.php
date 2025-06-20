@extends('user.layouts.app')
@section('title', 'Dashboard')
@push('styles')
@endpush
@section('content')

    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Văn Phòng</h1>
        </div>
    </div><!-- End Page Title -->

    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <!-- Category Header Section -->
                <section id="category-header" class="category-header section">

                    <div class="container" data-aos="fade-up">

                        <!-- Filter and Sort Options -->
                        <div class="filter-container mb-4" data-aos="fade-up" data-aos-delay="100">
                            <form id="filterForm">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="filter-item search-form">
                                            <label for="productSearch" class="form-label">Tòa Nhà</label>
                                            <div class="input-group">
                                                <input type="text" name="ten_toa_nha" class="form-control"
                                                    id="productSearch" placeholder="Tìm kiếm tòa nhà..."
                                                    aria-label="Tìm kiếm tòa nhà">
                                                <button class="btn search-btn" type="button" aria-label="Search">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-2">
                                        <div class="filter-item">
                                            <label for="areaRange" class="form-label">Diện tích</label>
                                            <select class="form-select" id="areaRange" name="dien_tich">
                                                <option selected="" value="">Tất cả diện tích</option>
                                                <option value="50-100">50m² - 100m²</option>
                                                <option value="100-200">100m² đến 200m²</option>
                                                <option value="200-300">200m² đến 300m²</option>
                                                <option value="300-500">300m² đến 500m²</option>
                                                <option value="500-1000">500m² đến 1000m²</option>
                                                <option value="1000+">Trên 1000m²</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-2">
                                        <div class="filter-item">
                                            <label for="priceRange" class="form-label">Giá</label>
                                            <select class="form-select" id="priceRange" name="gia_thue">
                                                <option selected="" value="">Tất cả giá</option>
                                                <option value="1000-2000">$1000 - $2000 /tháng</option>
                                                <option value="2000-3000">$2000 - $3000 /tháng</option>
                                                <option value="3000-5000">$3000 - $5000 /tháng</option>
                                                <option value="5000-7000">$5000 - $7000 /tháng</option>
                                                <option value="7000-10000">$7000 - $10,000 /tháng</option>
                                                <option value="10000+">Trên $10,000 /tháng</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-2">
                                        <div class="filter-item">
                                            <label for="sortBy" class="form-label">Sắp xếp</label>
                                            <select class="form-select" id="sortBy" name="sap_xep">
                                                <option selected="">Nổi bật</option>
                                                <option value="asc">Giá: Thấp đến Cao</option>
                                                <option value="desc">Giá: Cao đến Thấp</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-2">
                                        <div class="filter-item">
                                            <label class="form-label">View</label>
                                            <div class="d-flex align-items-center">
                                                <div class="view-options me-3">
                                                    <button type="button" class="btn view-btn active" data-view="grid"
                                                        aria-label="Grid view">
                                                        <i class="bi bi-grid-3x3-gap-fill"></i>
                                                    </button>
                                                    <button type="button" class="btn view-btn" data-view="list"
                                                        aria-label="List view">
                                                        <i class="bi bi-list-ul"></i>
                                                    </button>
                                                </div>
                                                {{-- <div class="items-per-page">
                                                <select class="form-select" id="itemsPerPage"
                                                    aria-label="Items per page">
                                                    <option value="12">12 per page</option>
                                                    <option value="24">24 per page</option>
                                                    <option value="48">48 per page</option>
                                                    <option value="96">96 per page</option>
                                                </select>
                                            </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row mt-3">
                                <div class="col-12" data-aos="fade-up" data-aos-delay="200">
                                    <div class="active-filters">
                                        <span class="active-filter-label">Bộ lọc:</span>
                                        <div class="filter-tags" id="active-filters-list">
                                            {{-- các filter sẽ được thêm bằng JS --}}
                                        </div>
                                    </div>

                                    {{-- <div class="active-filters">
                                        <span class="active-filter-label">Active Filters:</span>
                                        <div class="filter-tags">
                                            <span class="filter-tag">
                                                Electronics <button class="filter-remove"><i class="bi bi-x"></i></button>
                                            </span>
                                            <span class="filter-tag">
                                                $50 to $100 <button class="filter-remove"><i class="bi bi-x"></i></button>
                                            </span>
                                            <button class="clear-all-btn">Clear All</button>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>

                        </div>

                    </div>

                </section><!-- /Category Header Section -->

                <!-- Category Product List Section -->
                <section id="category-product-list" class="category-product-list section">

                    <div class="container" data-aos="fade-up" data-aos-delay="100">

                        <div class="row gy-4" id="vanphong-list">
                            <!-- Product 1 -->
                            @include('user.home.danhsach_table', ['danhSachVanPhong' => $danhSachVanPhong])
                            <!-- End Product 1 -->
                        </div>

                    </div>

                </section><!-- /Category Product List Section -->

                {{-- <div class="d-flex justify-content-center mt-4" id="pagination-container">
                    @include('user.home.danhsach_phantrang', ['paginator' => $danhSachVanPhong])
                </div> --}}

                <!-- Category Pagination Section -->
                <section id="category-pagination" class="category-pagination section">

                    <div class="container">
                        @include('user.home.danhsach_phantrang', ['paginator' => $danhSachVanPhong])
                    </div>

                </section><!-- /Category Pagination Section -->

            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <!-- Thêm thư viện jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {

            // Khi có thay đổi bất kỳ filter nào
            $('#filterForm').on('change', 'input, select', function() {
                filterVanPhong();
            });

            // Khi nhấn nút tìm kiếm (icon kính lúp)
            $('.search-btn').on('click', function(e) {
                e.preventDefault();
                filterVanPhong();
            });

            // Hàm gọi AJAX để lọc dữ liệu
            function filterVanPhong() {
                let formData = $('#filterForm').serialize();

                $.ajax({
                    url: "{{ route('user.danhsach') }}",
                    type: 'GET',
                    data: formData,
                    beforeSend: function() {
                        $('#vanphong-list').html('<div class="text-center">Đang tải dữ liệu...</div>');
                    },
                    success: function(res) {
                        $('#vanphong-list').html(res.html);
                        $('#category-pagination').html(res.pagination);
                        updateActiveFilters();
                    },
                    error: function() {
                        alert('Lỗi khi lọc danh sách.');
                    }
                });
            }

            // Cập nhật các filter đang dùng
            function updateActiveFilters() {
                let filters = [];
                let form = $('#filterForm');

                let tenToaNha = form.find('input[name="ten_toa_nha"]').val();
                if (tenToaNha) {
                    filters.push({
                        label: `Tòa nhà: ${tenToaNha}`,
                        name: 'ten_toa_nha'
                    });
                }

                let dtValue = form.find('select[name="dien_tich"]').val();
                if (dtValue) {
                    filters.push({
                        label: `Diện tích: ${dtValue} m²`,
                        name: 'dien_tich'
                    });
                }

                let giaValue = form.find('select[name="gia_thue"]').val();
                if (giaValue) {
                    filters.push({
                        label: `Giá: ${giaValue} $`,
                        name: 'gia_thue'
                    });
                }

                let sortValue = form.find('select[name="sap_xep"]').val();
                if (sortValue === 'asc' || sortValue === 'desc') {
                    filters.push({
                        label: `Sắp xếp: ${sortValue === 'asc' ? 'Thấp → Cao' : 'Cao → Thấp'}`,
                        name: 'sap_xep'
                    });
                }

                let html = '';
                filters.forEach(filter => {
                    html += `
                    <span class="filter-tag" data-name="${filter.name}">
                        ${filter.label}
                        <button class="filter-remove" type="button">
                            <i class="bi bi-x"></i>
                        </button>
                    </span>`;
                });

                if (filters.length > 0) {
                    html += `<button class="clear-all-btn" type="button">Clear All</button>`;
                }

                $('#active-filters-list').html(html);
            }

            // Xóa từng filter
            $(document).on('click', '.filter-remove', function() {
                let name = $(this).closest('.filter-tag').data('name');
                let el = $(`[name="${name}"]`);

                if (el.is('select') || el.is('input')) {
                    el.val('');
                }

                $('#filterForm').trigger('change');
                filterVanPhong();
            });

            // Xóa tất cả filter
            $(document).on('click', '.clear-all-btn', function() {
                $('#filterForm')[0].reset();
                $('#filterForm').trigger('change');
                filterVanPhong();
            });

        });
        $(document).on('click', '#category-pagination a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            if (url) {
                fetchVanPhongByUrl(url);
            }
        });

        function fetchVanPhongByUrl(url) {
            let formData = $('#filterForm').serialize();
            $.ajax({
                url: url,
                type: 'GET',
                data: formData,
                beforeSend: function() {
                    $('#vanphong-list').html('<div class="text-center">Đang tải dữ liệu...</div>');
                },
                success: function(res) {
                    $('#vanphong-list').html(res.html);
                    $('#category-pagination').html(res.pagination);
                    updateActiveFilters();

                    // Cuộn lên đầu trang sau khi load
                    $('html, body').animate({
                        scrollTop: $('#vanphong-list').offset().top - 100
                    }, 500);
                },
                error: function() {
                    alert('Lỗi khi phân trang.');
                }
            });
        }
    </script>
@endpush

@extends('admin.layouts.app')
@section('title', 'Dashboard')
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css" />
@endpush
@section('content')
    <main id="content" role="main" class="main pointer-event">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm mb-2 mb-sm-0">
                        <h1 class="page-header-title">Trang thống kê</h1>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <form method="GET" action="{{ route('admin.thongke.ty_le_lap_day') }}">
                    <div class="row">
                        <div class="col-sm-4 ">
                            <select name="toa_nha" id="toa_nha" class="form-control mr-3">
                                <option value="">-- Tòa Nhà --</option>
                                @foreach ($dsToaNha as $tn)
                                    <option value="{{ $tn->ma_toa_nha }}"
                                        {{ request('toa_nha') == $tn->ma_toa_nha ? 'selected' : '' }}>
                                        {{ $tn->ten_toa_nha }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <!-- Flatpickr -->
                            <input type="text" class="js-flatpickr form-control flatpickr-custom"
                                placeholder="Select dates" value="{{ request('thang_year', date('m/Y')) }}"
                                name="thang_year"
                                data-hs-flatpickr-options='{
                                    "dateFormat": "m/Y"
                                    }'>

                            <!-- End Flatpickr -->

                        </div>

                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary form-control mr-3" name ="filter">Lọc</button>
                        </div>
                    </div>
                </form>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tòa nhà</th>
                        <th>Tỷ lệ lắp đầy (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($result as $item)
                        <tr>
                            <td>{{ $item['toa_nha'] }}</td>
                            <td>{{ $item['ty_le_lap_day'] }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>



        </div>
    </main>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-flatpickr').each(function() {
                flatpickr(this, {
                    plugins: [new monthSelectPlugin({
                        shorthand: true,
                        dateFormat: "m/Y",
                        altFormat: "F Y",
                        theme: "light"
                    })],
                    allowInput: true,
                });
            });
        });
    </script>
@endpush

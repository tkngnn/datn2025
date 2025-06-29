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
                                @foreach ($dsToaNhaCB as $tn)
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
                            <button type="submit" class="btn btn-primary" name ="filter"><i
                                    class="tio-filter-outlined"></i>
                            </button>
                            <a href="{{ route('admin.thongke.ty_le_lap_day') }}" class="btn btn-white" title="Reset bộ lọc">
                                <i class="tio-refresh"></i>
                            </a>
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

            <div class="card mb-3 mb-lg-5">
                <div class="mt-5 card-header">
                    <h5 class="mb-3 card-header-title">
                        @if ($maToaNha)
                            Biểu đồ lắp đầy - {{ $result[0]['toa_nha'] }}
                        @else
                            Tỷ lệ lắp đầy giữa các tòa nhà
                        @endif
                    </h5>

                </div>
                <div class="card-body">
                    <canvas id="tyLeLapDayChart" class="chartjs-custom mx-auto" style="max-height: 200rem;"></canvas>
                </div>

            </div>

        </div>
    </main>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    <script>
        const ctx = document.getElementById('tyLeLapDayChart').getContext('2d');

        @if ($maToaNha)
            const chartType = 'pie';
            const data = {
                labels: ['Đã cho thuê', 'Còn trống'],
                datasets: [{
                    data: [{{ $result[0]['ty_le_lap_day'] }}, {{ 100 - $result[0]['ty_le_lap_day'] }}],
                    backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(255, 99, 132, 0.1)'],
                    borderColor: ['#004a7c', 'rgba(255, 99, 132, 1)'],
                    borderWidth: 1
                }]
            };
            const options = {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right'
                    },
                    tooltip: {
                        callbacks: {
                            label: context => context.label + ': ' + context.formattedValue + '%'
                        }
                    }
                }
            };
        @else
            const chartType = 'bar';
            const toaNhaLabels = {!! json_encode(array_column($result, 'toa_nha')) !!};
            const tyLeDay = {!! json_encode(array_column($result, 'ty_le_lap_day')) !!};
            const tyLeTrong = tyLeDay.map(val => 100 - val);

            const data = {
                labels: toaNhaLabels,
                datasets: [{
                        label: 'Đã cho thuê',
                        data: tyLeDay,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: '#004a7c',
                        borderWidth: 1
                    },
                    {
                        label: 'Còn trống',
                        data: tyLeTrong,
                        backgroundColor: 'rgba(255, 99, 132, 0.1)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            };

            const options = {
                responsive: true,
                indexAxis: 'y',
                scales: {
                    x: {
                        stacked: true,
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: value => value + '%'
                        }
                    },
                    y: {
                        stacked: true
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: context => context.dataset.label + ': ' + context.formattedValue + '%'
                        }
                    }
                }
            };
        @endif

        new Chart(ctx, {
            type: chartType,
            data: data,
            options: options
        });
    </script>
@endpush

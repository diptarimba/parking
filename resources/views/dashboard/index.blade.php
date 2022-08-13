@extends('layout.master')

@section('title', 'Dashboard')

@section('header-content')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/daterangepicker.css') }}" />
@endsection

@section('page-content')
    <div class="page-wrapper">
        <div class="page-content">

            @include('components.flash')

            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Jumlah Transaksi</p>
                                    <h4 class="my-1 text-info">{{ number_format($parkingHistoryTransaction, 0, ',', '.') }}
                                    </h4>
                                    {{-- <p class="mb-0 font-13">+2.5% from last week</p> --}}
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                        class='bx bxs-cart'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Jumlah Pendapatan</p>
                                    <h4 class="my-1 text-danger">Rp.
                                        {{ number_format($parkingHistoryRevenue, 0, ',', '.') }}</h4>
                                    {{-- <p class="mb-0 font-13">+5.4% from last week</p> --}}
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i
                                        class='bx bxs-wallet'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Lokasi</p>
                                    <h4 class="my-1 text-success">{{ number_format($parkingLocation, 0, ',', '.') }}</h4>
                                    {{-- <p class="mb-0 font-13">-4.5% from last week</p> --}}
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                                        class='bx bxs-bar-chart-alt-2'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-warning">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Admin</p>
                                    <h4 class="my-1 text-warning">{{ number_format($admin, 0, ',', '.') }}</h4>
                                    {{-- <p class="mb-0 font-13">+8.4% from last week</p> --}}
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i
                                        class='bx bxs-group'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->

            <div class="row">
                {{-- @if (Auth::guard('web')->check()) --}}
                    <div class="col-12">
                        <div class="card radius-10">
                            <div class="card-header">
                                Choose Location
                            </div>
                            <div class="card-body">
                                <select class="form-control" id="ParkingLocationList">
                                    <option selected>Pilih Lokasi</option>
                                    @foreach ($parkingLocationList as $each)
                                        <option value="{{ $each->id }}">{{ $each->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-body">
                                Data Lokasi Terkini : {{ $parkName ?? 'Semua Lokasi' }}
                            </div>
                        </div>
                    </div>
                {{-- @endif --}}
                <div class="col-12">
                    <div class="card radius-10 border-start border-0 border-3 border-secondary">
                        <div class="card-header">
                            Select Date Range
                        </div>
                        <div class="card-body">
                            <input type="text" name="daterange" class="form-control" aria-describedby="daterange"
                                value="{{$parseDate}}">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Sales Overview</h6>
                                </div>
                                {{-- <div class="dropdown ms-auto">
                                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                        data-bs-toggle="dropdown"><i
                                            class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="javascript:;">Action</a>
                                        </li>
                                        <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                        </li>
                                    </ul>
                                </div> --}}
                            </div>
                            <div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
                                <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                        style="color: #14abef"></i>Sales</span>
                                {{-- <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" style="color: #ffc107"></i>Visits</span> --}}
                            </div>
                            <div class="chart-container-1">
                                <canvas id="chart1"></canvas>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
                            <div class="col">
                                <div class="p-3">
                                    <h5 class="mb-0">{{ number_format($allParkingHistory, 0, ',', '.') }}</h5>
                                    <small class="mb-0">Overall Parking</small>
                                </div>
                            </div>
                            <div class="col">
                                <div class="p-3">
                                    <h5 class="mb-0">Rp. {{ number_format($allTurnOverParking, 0, ',', '.') }}</h5>
                                    <small class="mb-0">Revenue</small>
                                </div>
                            </div>
                            <div class="col">
                                <div class="p-3">
                                    <h5 class="mb-0">Rp.
                                        {{ number_format($allTurnOverParking == 0 ? 0 : $allTurnOverParking / $allParkingHistory) }}
                                    </h5>
                                    <small class="mb-0">Avg. Cost/Visit</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card radius-10">
                        <div class="card-header">
                            Parking List by Date
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tbody>
                                    @foreach ($parkingStatisticCount as $key => $each)
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>{{$each}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card radius-10">
                        <div class="card-header">
                            Parking List by Vehicle
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tbody>
                                    @foreach ($vehicleParking as $key => $each)
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>{{$each}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card radius-10">
                        <div class="card-header">
                            Parking List by Location
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tbody>
                                    @foreach ($locationParking as $key => $each)
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>{{$each}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card radius-10">
                        <div class="card-header">
                            Parking List by Hour
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tbody>
                                    @foreach ($hourParking as $key => $each)
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>{{$each}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->

            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Recent Transaction</h6>
                        </div>
                        {{-- <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
                                    class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Location</th>
                                    <th>Vehicle</th>
                                    <th>Amount</th>
                                    <th>DateTime</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parkingHistory as $each)
                                    <tr>
                                        <td>{{ $each->parking_location->name }}</td>
                                        <td>{{ $each->vehicle }}</td>
                                        <td>Rp. {{ number_format($each->amount, 0, '.', ',') }}</td>
                                        <td>{{ date('H:i:s', strtotime($each->created_at)) }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-content')
    <script>
        var LabelData = @json(array_keys($parkingStatistic->toArray()));
        var ValueDataAmount = @json(array_values($parkingStatistic->toArray()));
    </script>
    <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartjs/js/Chart.extension.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/daterangepicker.min.js') }}"></script>

    <script>
        $(document).ready(() => {
            $(function() {
                $('input[name="daterange"]').daterangepicker({
                    opens: 'left'
                }, function(start, end, label) {
                    const urlParams = new URLSearchParams(window.location.search);
                    urlParams.set('from', start.format('YYYY-MM-DD'));
                    urlParams.set('to', end.format('YYYY-MM-DD'));
                    var newUrl = updateQueryStringParameter(window.location.href, 'date_from', start.format('YYYY-MM-DD'))
                    newUrl = updateQueryStringParameter(newUrl, 'date_to', end.format('YYYY-MM-DD'))
                    window.location.href = newUrl;
                });
            });

            function updateQueryStringParameter(uri, key, value) {
                var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
                var separator = uri.indexOf('?') !== -1 ? "&" : "?";
                if (uri.match(re)) {
                    return uri.replace(re, '$1' + key + "=" + value + '$2');
                } else {
                    return uri + separator + key + "=" + value;
                }
            }
            //You can reload the url like so

            $('#ParkingLocationList').on('change', function() {
                $('#ParkingLocationList option').each(function() {
                    if ($(this).is(':selected')) {
                        var newUrl = updateQueryStringParameter(window.location.href, "location_id",
                            $(this).val());
                        window.location.href = newUrl
                    }
                })
            })
        })
    </script>
@endsection

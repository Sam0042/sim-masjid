@extends('admin.layouts.app')
@section('konten')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-1">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">


            {{-- UBUDIYAH --}}
            @if (Auth::check() && Auth::user()->role === 'ubudiyah')
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Data Khotib dan Muazin : {{ $khotibMuazin }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('khotibMuazin.index') }}">
                                View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Data Agenda : {{ $program }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('agenda.index') }}">
                                View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-info text-white mb-4">
                        <div class="card-body">Data Galeri : {{ $galeri }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('galeri.index') }}">
                                View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- KETUA --}}
            @if (Auth::check() && Auth::user()->role === 'ketua')
                {{-- <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Data Khotib Muazin : {{ $khotibMuazin }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('ketua-khotibMuazin') }}">
                                View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Data Agenda : {{ $program }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('ketua-agenda') }}">
                                View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Data Galeri : {{ $galeri }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('ketua-galeris') }}">
                                View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Data Kas Operasional : {{ $kas }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('ketua-kasOperasional') }}">
                                View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div> --}}

                <form method="GET" class="row g-3 align-items-end mb-3">

                    {{-- TAHUN --}}
                    <div class="col-md-3">
                        <select name="tahun" onchange="this.form.submit()" class="form-control">

                            <option value="" disabled {{ request('tahun') ? '' : 'selected' }}>
                                Pilih Tahun
                            </option>

                            @foreach ($listTahun as $tahun)
                                <option value="{{ $tahun }}" {{ $tahun == $tahunAktif ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- BULAN --}}
                    <div class="col-md-3">
                        <select name="bulan" onchange="this.form.submit()" class="form-control">

                            <option value="" disabled {{ request('bulan') ? '' : 'selected' }}>
                                Pilih Bulan
                            </option>

                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ $i == $bulanAktif ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>

                </form>

                <div class="row">

                    {{-- CHART BAR (KIRI) --}}
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                Saldo Bulanan {{ $tahunAktif }}
                            </div>
                            <div class="card-body">
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>
                    </div>

                    {{-- CHART AREA (KANAN + DROPDOWN BULAN) --}}
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span>Saldo Harian</span>



                            </div>
                            <div class="card-body">
                                <canvas id="areaChart"></canvas>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- DATA KE JS --}}
                <script>
                    var labels = {!! json_encode($labels) !!};
                    var dataBulanan = {!! json_encode($dataBulanan) !!};

                    var labelsHarian = {!! json_encode($labelsHarian) !!};
                    var dataHarian = {!! json_encode($dataHarian) !!};
                </script>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <script>
                    // =======================
                    // FORMAT BULAN
                    // =======================
                    const bulan = ["", "Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
                        "Jul", "Agu", "Sep", "Okt", "Nov", "Des"
                    ];

                    labels = labels.map(b => bulan[b]);

                    // =======================
                    // BAR CHART (KIRI)
                    // =======================
                    new Chart(document.getElementById("barChart"), {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Saldo Bulanan {{ $tahunAktif }}",
                                data: dataBulanan,
                                backgroundColor: dataBulanan.map(v => v >= 0 ? 'green' : 'red')
                            }]
                        }
                    });

                    // =======================
                    // AREA CHART (KANAN)
                    // =======================
                    new Chart(document.getElementById("areaChart"), {
                        type: 'line',
                        data: {
                            labels: labelsHarian,
                            datasets: [{
                                label: "Saldo Harian",
                                data: dataHarian,
                                fill: true,
                                backgroundColor: "rgba(2,117,216,0.2)",
                                borderColor: "rgba(2,117,216,1)",
                                tension: 0.3
                            }]
                        }
                    });
                </script>
            @endif



            {{-- BENDAHARA --}}
            @if (Auth::check() && Auth::user()->role === 'bendahara')
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Data Keterangan Kas : {{ $ketKas }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('keterangan_kas.index') }}">
                                View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Data Final : {{ $kas }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('kas_operasional.index') }}">
                                View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <form method="GET" class="row g-3 align-items-end mb-3">

                    {{-- TAHUN --}}
                    <div class="col-md-3">
                        <select name="tahun" onchange="this.form.submit()" class="form-control">

                            <option value="" disabled {{ request('tahun') ? '' : 'selected' }}>
                                Pilih Tahun
                            </option>

                            @foreach ($listTahun as $tahun)
                                <option value="{{ $tahun }}" {{ $tahun == $tahunAktif ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- BULAN --}}
                    <div class="col-md-3">
                        <select name="bulan" onchange="this.form.submit()" class="form-control">

                            <option value="" disabled {{ request('bulan') ? '' : 'selected' }}>
                                Pilih Bulan
                            </option>

                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ $i == $bulanAktif ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>

                </form>

                <div class="row">

                    {{-- CHART BAR (KIRI) --}}
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                Saldo Bulanan {{ $tahunAktif }}
                            </div>
                            <div class="card-body">
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>
                    </div>

                    {{-- CHART AREA (KANAN + DROPDOWN BULAN) --}}
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span>Saldo Harian</span>



                            </div>
                            <div class="card-body">
                                <canvas id="areaChart"></canvas>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- DATA KE JS --}}
                <script>
                    var labels = {!! json_encode($labels) !!};
                    var dataBulanan = {!! json_encode($dataBulanan) !!};

                    var labelsHarian = {!! json_encode($labelsHarian) !!};
                    var dataHarian = {!! json_encode($dataHarian) !!};
                </script>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <script>
                    // =======================
                    // FORMAT BULAN
                    // =======================
                    const bulan = ["", "Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
                        "Jul", "Agu", "Sep", "Okt", "Nov", "Des"
                    ];

                    labels = labels.map(b => bulan[b]);

                    // =======================
                    // BAR CHART (KIRI)
                    // =======================
                    new Chart(document.getElementById("barChart"), {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Saldo Bulanan {{ $tahunAktif }}",
                                data: dataBulanan,
                                backgroundColor: dataBulanan.map(v => v >= 0 ? 'green' : 'red')
                            }]
                        }
                    });

                    // =======================
                    // AREA CHART (KANAN)
                    // =======================
                    new Chart(document.getElementById("areaChart"), {
                        type: 'line',
                        data: {
                            labels: labelsHarian,
                            datasets: [{
                                label: "Saldo Harian",
                                data: dataHarian,
                                fill: true,
                                backgroundColor: "rgba(2,117,216,0.2)",
                                borderColor: "rgba(2,117,216,1)",
                                tension: 0.3
                            }]
                        }
                    });
                </script>
            @endif

            {{-- SEKRETARIS --}}
            @if (Auth::check() && Auth::user()->role === 'sekretaris')
                <h1>halloo</h1>
            @endif
        </div>

    </div>
@endsection

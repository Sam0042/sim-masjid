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
                <div class="row mb-3">
                    <!-- === BARIS 2: DATA OPERASIONAL & KEGIATAN === -->
                    <div class="row mb-4">
                        <!-- Card 4: Agenda Masjid -->
                        <div class="col-md-4 col-sm-6 col-12 mb-3">
                            <div class="card border-0 shadow-sm text-white"
                                style="border-radius: 12px; background: linear-gradient(135deg, #2e3033, #111111);">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-uppercase mb-2"
                                                style="font-size: 0.75rem; letter-spacing: 1px; opacity: 0.8;">Agenda Masjid
                                            </h6>
                                            <h3 class="font-weight-bold mb-0">{{ $program }} Kegiatan</h3>
                                        </div>
                                        <i class="fas fa-calendar-alt fa-2x" style="opacity: 0.3;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 5: Jadwal Petugas -->
                        <div class="col-md-4 col-sm-6 col-12 mb-3">
                            <div class="card border-0 shadow-sm text-white"
                                style="border-radius: 12px; background: linear-gradient(135deg, #654ea3, #eaafc8);">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-uppercase mb-2"
                                                style="font-size: 0.75rem; letter-spacing: 1px; opacity: 0.8;">Jadwal Khotib
                                                &
                                                Muazin</h6>
                                            <h3 class="font-weight-bold mb-0">{{ $khotibMuazin }} Data</h3>
                                        </div>
                                        <i class="fas fa-user-clock fa-2x" style="opacity: 0.3;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 6: Galeri Kegiatan -->
                        <div class="col-md-4 col-sm-6 col-12 mb-3">
                            <div class="card border-0 shadow-sm text-white"
                                style="border-radius: 12px; background: linear-gradient(135deg, #fd746c, #ff9068);">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-uppercase mb-2"
                                                style="font-size: 0.75rem; letter-spacing: 1px; opacity: 0.8;">Galeri
                                                Dokumentasi</h6>
                                            <h3 class="font-weight-bold mb-0">{{ $galeri }} Dokumentasi</h3>
                                        </div>
                                        <i class="fas fa-images fa-2x" style="opacity: 0.3;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- KETUA --}}
            @if (Auth::check() && Auth::user()->role === 'ketua')
                <!-- === BARIS 1: RINGKASAN KEUANGAN MASJID === -->
                <div class="row mb-3">
                    <!-- Card 1: Total Saldo Terakhir -->
                    <div class="col-md-4 col-sm-6 col-12 mb-3">
                        <div class="card border-0 shadow-sm text-white"
                            style="border-radius: 12px; background: linear-gradient(135deg, #00b4db, #0083b0);">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-uppercase mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 1px; opacity: 0.8;">Total Saldo
                                            Terakhir
                                        </h6>
                                        <h3 class="font-weight-bold mb-0">Rp
                                            {{ number_format($saldoTerakhir, 0, ',', '.') }}</h3>
                                    </div>
                                    <i class="fas fa-wallet fa-2x" style="opacity: 0.4;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Pemasukan Bulan Ini -->
                    <div class="col-md-4 col-sm-6 col-12 mb-3">
                        <div class="card border-0 shadow-sm text-white"
                            style="border-radius: 12px; background: linear-gradient(135deg, #11998e, #38ef7d);">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-uppercase mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 1px; opacity: 0.8;">Pemasukan Bulan
                                            Ini</h6>
                                        <h3 class="font-weight-bold mb-0">Rp
                                            {{ number_format($pemasukanBulanIni, 0, ',', '.') }}</h3>
                                    </div>
                                    <i class="fas fa-arrow-down fa-2x" style="opacity: 0.4;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Pengeluaran Bulan Ini -->
                    <div class="col-md-4 col-sm-6 col-12 mb-3">
                        <div class="card border-0 shadow-sm text-white"
                            style="border-radius: 12px; background: linear-gradient(135deg, #ff9966, #ff5e62);">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-uppercase mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 1px; opacity: 0.8;">Pengeluaran Bulan
                                            Ini</h6>
                                        <h3 class="font-weight-bold mb-0">Rp
                                            {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}</h3>
                                    </div>
                                    <i class="fas fa-arrow-up fa-2x" style="opacity: 0.4;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- === BARIS 2: DATA OPERASIONAL & KEGIATAN === -->
                <div class="row mb-4">
                    <!-- Card 4: Agenda Masjid -->
                    <div class="col-md-4 col-sm-6 col-12 mb-3">
                        <div class="card border-0 shadow-sm text-white"
                            style="border-radius: 12px; background: linear-gradient(135deg, #2e3033, #111111);">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-uppercase mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 1px; opacity: 0.8;">Agenda Masjid
                                        </h6>
                                        <h3 class="font-weight-bold mb-0">{{ $program }} Kegiatan</h3>
                                    </div>
                                    <i class="fas fa-calendar-alt fa-2x" style="opacity: 0.3;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 5: Jadwal Petugas -->
                    <div class="col-md-4 col-sm-6 col-12 mb-3">
                        <div class="card border-0 shadow-sm text-white"
                            style="border-radius: 12px; background: linear-gradient(135deg, #654ea3, #eaafc8);">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-uppercase mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 1px; opacity: 0.8;">Jadwal Khotib &
                                            Muazin</h6>
                                        <h3 class="font-weight-bold mb-0">{{ $khotibMuazin }} Data</h3>
                                    </div>
                                    <i class="fas fa-user-clock fa-2x" style="opacity: 0.3;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 6: Galeri Kegiatan -->
                    <div class="col-md-4 col-sm-6 col-12 mb-3">
                        <div class="card border-0 shadow-sm text-white"
                            style="border-radius: 12px; background: linear-gradient(135deg, #fd746c, #ff9068);">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-uppercase mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 1px; opacity: 0.8;">Galeri
                                            Dokumentasi</h6>
                                        <h3 class="font-weight-bold mb-0">{{ $galeri }} Dokumentasi</h3>
                                    </div>
                                    <i class="fas fa-images fa-2x" style="opacity: 0.3;"></i>
                                </div>
                            </div>
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



            {{-- BENDAHARA --}}
            @if (Auth::check() && Auth::user()->role === 'bendahara')
                <!-- Card 1: Saldo Terakhir -->
                <div class="row mb-4">
                    <!-- Card 1: Total Saldo Terakhir (Akumulasi Semua Waktu) -->
                    <div class="col-md-4 col-sm-6 col-12 mb-3">
                        <div class="card border-0 shadow-sm text-white"
                            style="border-radius: 12px; background: linear-gradient(135deg, #00b4db, #0083b0);">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-uppercase mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 1px; opacity: 0.8;">Total Saldo
                                            Terakhir
                                        </h6>
                                        <h3 class="font-weight-bold mb-0">Rp
                                            {{ number_format($saldoTerakhir, 0, ',', '.') }}</h3>
                                    </div>
                                    <i class="fas fa-wallet fa-2x" style="opacity: 0.4;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Pemasukan Bulan Ini -->
                    <div class="col-md-4 col-sm-6 col-12 mb-3">
                        <div class="card border-0 shadow-sm text-white"
                            style="border-radius: 12px; background: linear-gradient(135deg, #11998e, #38ef7d);">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-uppercase mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 1px; opacity: 0.8;">Pemasukan Bulan
                                            Ini</h6>
                                        <h3 class="font-weight-bold mb-0">Rp
                                            {{ number_format($pemasukanBulanIni, 0, ',', '.') }}</h3>
                                    </div>
                                    <i class="fas fa-arrow-down fa-2x" style="opacity: 0.4;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Pengeluaran Bulan Ini -->
                    <div class="col-md-4 col-sm-6 col-12 mb-3">
                        <div class="card border-0 shadow-sm text-white"
                            style="border-radius: 12px; background: linear-gradient(135deg, #ff9966, #ff5e62);">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-uppercase mb-2"
                                            style="font-size: 0.75rem; letter-spacing: 1px; opacity: 0.8;">Pengeluaran
                                            Bulan Ini</h6>
                                        <h3 class="font-weight-bold mb-0">Rp
                                            {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}</h3>
                                    </div>
                                    <i class="fas fa-arrow-up fa-2x" style="opacity: 0.4;"></i>
                                </div>
                            </div>
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

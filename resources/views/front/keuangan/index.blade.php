@extends('admin.layouts.app')
@section('konten')
    <section
        style="background-image: url('/admin/image/3.jpeg'); 
           background-size: cover; 
           background-position: 50% 30%; 
           height: 200px; 
           width: 100%; 
           position: relative;
           ">

        <!-- overlay hitam transparan -->
        <div
            style="position: absolute; top:0; left:0; width:100%; height:100%; 
                background-color: rgba(0,0,0,0.8);">
        </div>

        <!-- konten teks -->
        <div class="d-flex flex-column justify-content-center align-items-center h-100"
            style="position: relative; z-index: 1;">
            <h1 class="judul-header">
                KAS OPERASIONAL
            </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="/" class="text-white fw-semibold text-decoration-none">Beranda</a>
                </li>
                <li class="breadcrumb-item active fw-semibold" id="target-bcm">Kas Operasional</li>
            </ol>

        </div>
    </section>


    <style>
        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            background: white;
            border-radius: 14px;
            padding: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.20);
        }

        .judul-laporan {
            margin-bottom: 18px;
            line-height: 1.8;
            color: #111;
        }

        .judul-laporan b {
            display: block;
            font-size: 15px;
        }

        .table-keuangan {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
            text-align: center;
            font-size: 14px;
            background: white;
        }

        .table-keuangan th,
        .table-keuangan td {
            border: 2px solid #dee2e6;
            padding: 10px 12px;
            vertical-align: middle;
            white-space: nowrap;
        }

        .table-keuangan thead {
            background: #f3f4f6;
        }



        .card-title {
            font-weight: 700;
            margin-top: 0.5rem;
            color: white;
        }

        .section-title {
            border-left: 5px solid #198754;
            padding-left: 10px;
            margin-bottom: 10px;
        }

        .section-title h2 {
            font-weight: 700;
            margin-bottom: 0;
            color: #111;
        }

        .section-title p {
            margin-bottom: 0;
            color: #6c757d;
        }



        .card-label {
            background: rgba(32, 201, 151, 0.9);
            /* teal */
            color: #022c22;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }



        .card-text-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            padding: 15px;
            z-index: 2;
            color: white;
            width: 100%;
        }





        .pagination .page-link {
            color: #198754;
        }

        .pagination .page-link:hover {
            background-color: #198754;
            color: white;
        }

        .pagination .page-item.active .page-link {
            background-color: #198754;
            border-color: #198754;
            color: white
        }

        @media (max-width: 768px) {

            .table-wrapper {
                padding: 12px;
                border-radius: 10px;
            }

            .judul-laporan {
                margin-bottom: 14px;
                line-height: 1.6;
            }

            .judul-laporan b {
                font-size: 13px;
            }

            .table-keuangan {
                min-width: 750px;
                font-size: 12px;
            }

            .table-keuangan th,
            .table-keuangan td {
                padding: 8px;
            }
        }
    </style>

    <div class="container py-4">
        {{-- CARD --}}
        <div class="row g-3">


            {{-- ================= SEMUA AGENDA ================= --}}
            <div class="d-flex justify-content-between align-items-center mb-2">

                <div class="section-title">
                    <h2>Laporan Kas Lengkap</h2>
                </div>

            </div>

            <div class="card mb-1">

                <div class="card-header">
                    <p class="card-title mb-3 text-center" style="color: black">
                        Pilih tahun dan bulan terlebih dahulu untuk melihat laporan spesifik dibawah
                    </p>
                </div>

                <div class="card-body">

                    <form id="filterForm" method="GET" action="/kas-operasional" class="row g-3 align-items-end">

                        {{-- TAHUN --}}
                        <div class="col-md-4">

                            <label for="tahun" class="form-label">
                                Tahun
                            </label>

                            <select id="tahun" name="tahun" class="form-select" required>

                                <option value="" disabled>
                                    Pilih Tahun
                                </option>

                                @foreach ($availableMonthsYears as $thn => $months)
                                    <option value="{{ $thn }}" {{ $tahun == $thn ? 'selected' : '' }}>
                                        {{ $thn }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        {{-- BULAN --}}
                        <div class="col-md-4">

                            <label for="bulan" class="form-label">
                                Bulan
                            </label>

                            <select id="bulan" name="bulan" class="form-select" required>

                            </select>

                        </div>

                        {{-- BUTTON --}}
                        <div class="col-md-4 d-flex justify-content-start">

                            <button type="submit" class="btn btn-success btn-md mt-2">

                                <i class="bi bi-search"></i>
                                Tampilkan Laporan

                            </button>

                        </div>

                    </form>

                    <div id="tombolContainer" class="mt-4 d-flex flex-wrap gap-2"></div>

                </div>

            </div>
            {{-- ================= LAPORAN ================= --}}
            <div class="mt-5" id="hasil-laporan">

                @if ($dataByMonthFilter->isEmpty())
                    <div class="alert alert-secondary text-center">
                        Data laporan tidak tersedia
                    </div>
                @else
                    <div>
                        @foreach ($dataByMonthFilter as $month => $data)
                            @php
                                $dates = $data->groupBy('tanggal');

                                $dateKeys = $dates->keys();

                                $saldoAwal = $saldoAwalBulan;
                            @endphp

                            <div class="table-wrapper mb-5">

                                <div class="judul-laporan">
                                    <b>Masjid Roudhotul Jannah</b>
                                    <b>Laporan Keuangan</b>
                                    <b>Kas Operasional</b>
                                    <b>{{ $month }}</b>
                                </div>

                                <table class="table-keuangan">

                                    <thead>

                                        <tr>

                                            <th rowspan="2">Keterangan</th>

                                            {{-- kolom saldo awal --}}
                                            <th rowspan="2">Saldo Awal</th>

                                            <th colspan="{{ $dates->count() }}">
                                                Tanggal
                                            </th>

                                            <th rowspan="2">Jumlah</th>

                                        </tr>

                                        <tr>

                                            @foreach ($dateKeys as $date)
                                                <th>
                                                    {{ \Carbon\Carbon::parse($date)->format('d-M-Y') }}
                                                </th>
                                            @endforeach

                                        </tr>

                                    </thead>

                                    <tbody>

                                        {{-- SALDO AWAL --}}
                                        <tr style="font-weight:bold; background:#e0f2fe;">

                                            <td>Saldo Awal</td>

                                            {{-- hanya kolom ini yang berisi --}}
                                            <td>
                                                {{ number_format($saldoAwal, 0, ',', '.') }}
                                            </td>

                                            {{-- kolom tanggal kosong --}}
                                            @foreach ($dateKeys as $date)
                                                <td></td>
                                            @endforeach

                                            {{-- kolom jumlah kosong --}}
                                            <td></td>

                                        </tr>

                                        {{-- SPACER --}}
                                        <tr>

                                            <td colspan="{{ $dates->count() + 3 }}" style="background:#fff; height:10px;">
                                            </td>

                                        </tr>

                                        {{-- PENERIMAAN --}}
                                        <tr style="font-weight:bold; background:#f8f9fa;">

                                            <td colspan="{{ $dates->count() + 3 }}" style="text-align:left;">

                                                Penerimaan

                                            </td>

                                        </tr>

                                        @php

                                            $totalPenerimaanPerTanggal = array_fill_keys($dateKeys->toArray(), 0);

                                            $grandTotalPenerimaan = 0;

                                            $penerimaanUnik = $data->where('jenis', 'penerimaan')->unique('keterangan');

                                        @endphp

                                        @foreach ($penerimaanUnik as $item)
                                            <tr>

                                                <td>{{ $item->keterangan }}</td>

                                                <td></td>

                                                @php
                                                    $totalRow = 0;
                                                @endphp

                                                @foreach ($dateKeys as $date)
                                                    @php

                                                        $amount = $dates[$date]
                                                            ->where('keterangan', $item->keterangan)
                                                            ->sum('nominal');

                                                        $totalRow += $amount;

                                                        $totalPenerimaanPerTanggal[$date] += $amount;

                                                    @endphp

                                                    <td>
                                                        {{ number_format($amount, 0, ',', '.') }}
                                                    </td>
                                                @endforeach

                                                <td>
                                                    {{ number_format($totalRow, 0, ',', '.') }}
                                                </td>

                                                @php
                                                    $grandTotalPenerimaan += $totalRow;
                                                @endphp

                                            </tr>
                                        @endforeach

                                        {{-- TOTAL PENERIMAAN --}}
                                        <tr style="font-weight:bold; background:#e9fbe9;">

                                            <td>Total Penerimaan</td>

                                            <td></td>

                                            @foreach ($dateKeys as $date)
                                                <td>
                                                    {{ number_format($totalPenerimaanPerTanggal[$date], 0, ',', '.') }}
                                                </td>
                                            @endforeach

                                            <td>
                                                {{ number_format($grandTotalPenerimaan, 0, ',', '.') }}
                                            </td>

                                        </tr>

                                        {{-- SPACER --}}
                                        <tr>

                                            <td colspan="{{ $dates->count() + 3 }}" style="background:#fff; height:10px;">
                                            </td>

                                        </tr>

                                        {{-- PENGELUARAN --}}
                                        <tr style="font-weight:bold; background:#f8f9fa;">

                                            <td colspan="{{ $dates->count() + 3 }}" style="text-align:left;">

                                                Pengeluaran

                                            </td>

                                        </tr>

                                        @php

                                            $totalPengeluaranPerTanggal = array_fill_keys($dateKeys->toArray(), 0);

                                            $grandTotalPengeluaran = 0;

                                            $pengeluaranUnik = $data
                                                ->where('jenis', 'pengeluaran')
                                                ->unique('keterangan');

                                        @endphp

                                        @foreach ($pengeluaranUnik as $item)
                                            <tr>

                                                <td>{{ $item->keterangan }}</td>

                                                <td></td>

                                                @php
                                                    $totalRow = 0;
                                                @endphp

                                                @foreach ($dateKeys as $date)
                                                    @php

                                                        $amount = $dates[$date]
                                                            ->where('keterangan', $item->keterangan)
                                                            ->sum('nominal');

                                                        $totalRow += $amount;

                                                        $totalPengeluaranPerTanggal[$date] += $amount;

                                                    @endphp

                                                    <td>
                                                        {{ number_format($amount, 0, ',', '.') }}
                                                    </td>
                                                @endforeach

                                                <td>
                                                    {{ number_format($totalRow, 0, ',', '.') }}
                                                </td>

                                                @php
                                                    $grandTotalPengeluaran += $totalRow;
                                                @endphp

                                            </tr>
                                        @endforeach

                                        {{-- TOTAL PENGELUARAN --}}
                                        <tr style="font-weight:bold; background:#fdeeee;">

                                            <td>Total Pengeluaran</td>

                                            <td></td>

                                            @foreach ($dateKeys as $date)
                                                <td>
                                                    {{ number_format($totalPengeluaranPerTanggal[$date], 0, ',', '.') }}
                                                </td>
                                            @endforeach

                                            <td>
                                                {{ number_format($grandTotalPengeluaran, 0, ',', '.') }}
                                            </td>

                                        </tr>

                                        {{-- SPACER --}}
                                        <tr>

                                            <td colspan="{{ $dates->count() + 3 }}" style="background:#fff; height:10px;">
                                            </td>

                                        </tr>

                                        {{-- SALDO KAS --}}
                                        @php
                                            $saldoBerjalan = $saldoAwal;
                                        @endphp

                                        <tr style="font-weight:bold; background:#dbeafe;">

                                            <td>Saldo Kas Operasional</td>

                                            <td>
                                                {{ number_format($saldoAwal, 0, ',', '.') }}
                                            </td>

                                            @foreach ($dateKeys as $index => $date)
                                                @php

                                                    $penerimaan = $totalPenerimaanPerTanggal[$date] ?? 0;

                                                    $pengeluaran = $totalPengeluaranPerTanggal[$date] ?? 0;

                                                    if ($index == 0) {
                                                        $saldoBerjalan = $saldoAwal + $penerimaan - $pengeluaran;
                                                    } else {
                                                        $saldoBerjalan += $penerimaan - $pengeluaran;
                                                    }

                                                @endphp

                                                <td>
                                                    {{ number_format($saldoBerjalan, 0, ',', '.') }}
                                                </td>
                                            @endforeach

                                            <td>
                                                {{ number_format($saldoBerjalan, 0, ',', '.') }}
                                            </td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>
                        @endforeach
                    </div>
                @endif

            </div>

            <script>
                const dataBulan = @json($availableMonthsYears);

                const tahunSelect = document.getElementById('tahun');

                const bulanSelect = document.getElementById('bulan');

                function loadBulan(selectedTahun, selectedBulan = null) {

                    bulanSelect.innerHTML = '';

                    const defaultOption = document.createElement('option');

                    defaultOption.text = 'Pilih Bulan';

                    defaultOption.disabled = true;

                    bulanSelect.appendChild(defaultOption);

                    if (!dataBulan[selectedTahun]) {

                        bulanSelect.disabled = true;

                        return;
                    }

                    bulanSelect.disabled = false;

                    dataBulan[selectedTahun].forEach(function(item) {

                        const bulanNumber = String(item.bulan).padStart(2, '0');

                        const bulanNama = new Date(
                            2000,
                            item.bulan - 1
                        ).toLocaleString('id-ID', {
                            month: 'long'
                        });

                        const option = document.createElement('option');

                        option.value = bulanNumber;

                        option.text = bulanNama;

                        if (selectedBulan == bulanNumber) {
                            option.selected = true;
                        }

                        bulanSelect.appendChild(option);

                    });

                }

                // Saat tahun berubah
                tahunSelect.addEventListener('change', function() {

                    loadBulan(this.value);

                });

                // Load awal
                window.addEventListener('load', function() {

                    loadBulan(
                        "{{ $tahun }}",
                        "{{ str_pad($bulan, 2, '0', STR_PAD_LEFT) }}"
                    );

                });
            </script>



            {{-- PAGINATION --}}
            {{-- <div class="d-flex justify-content-center mt-5">
            {{ $data->links() }}
        </div> --}}

        </div>
        <script>
            // =========================
            // FILTER TANPA REFRESH
            // =========================
            document.getElementById('filterForm')
                .addEventListener('submit', function(e) {

                    // HENTIKAN REFRESH
                    e.preventDefault();

                    const tahun =
                        document.getElementById('tahun').value;

                    const bulan =
                        document.getElementById('bulan').value;

                    // loading sederhana
                    document.getElementById('hasil-laporan').innerHTML = `
                <div class="text-center py-5">
                    <div class="spinner-border text-success"></div>
                    <p class="mt-3">Memuat laporan...</p>
                </div>
            `;

                    // request ke halaman yang sama
                    fetch(`/kas-operasional?tahun=${tahun}&bulan=${bulan}`)

                        .then(response => response.text())

                        .then(html => {

                            // parsing html response
                            const parser = new DOMParser();

                            const doc = parser.parseFromString(
                                html,
                                'text/html'
                            );

                            // ambil hanya isi laporan
                            const hasil =
                                doc.querySelector('#hasil-laporan')
                                .innerHTML;

                            // replace isi lama
                            document.querySelector('#hasil-laporan')
                                .innerHTML = hasil;

                        })

                        .catch(error => {

                            console.log(error);

                            document.getElementById('hasil-laporan')
                                .innerHTML = `
                        <div class="alert alert-danger">
                            Gagal memuat laporan
                        </div>
                    `;

                        });

                });
        </script>
    @endsection

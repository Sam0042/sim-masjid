@extends('admin.layouts.app')
@section('konten')
    <!-- Modal -->
    <div style="height:90%; margin-top: 3.5rem;"class="modal fade" id="exampleModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Kas Operasional</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kas_operasional.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input required type="date" class="form-control" name="tanggal" id="tanggalInput"
                            aria-describedby="dateHelp">
                        <br>
                        <label for="keterangan_id" class="form-label">Nama Keterangan</label>
                        <select required name="keterangan_id" id="select" class="form-control">
                            <option value="" disabled selected>Pilih Keterangan</option>

                            @foreach ($keterangan as $k)
                                <option value="{{ $k->id }}">{{ $k->keterangan }}</option>
                            @endforeach
                        </select>
                        <br>
                        <label for="jenis" class="form-label">Jenis</label>
                        <select required name="jenis" id="select" class="form-control">
                            <option value="" disabled selected>Pilih Jenis Kas</option>

                            <option value="penerimaan">Penerimaan</option>
                            <option value="pengeluaran">Pengeluaran</option>
                        </select>
                        <br>
                        <label for="nominal" class="form-label">Nominal</label>
                        <input required type="number" class="form-control" name="nominal" id="nominal"
                            placeholder="Contoh: 200000">

                        <script>
                            const keteranganSelect = document.querySelector('select[name="keterangan_id"]');
                            const jenisSelect = document.querySelector('select[name="jenis"]');

                            keteranganSelect.addEventListener('change', function() {
                                const selectedText = keteranganSelect.options[keteranganSelect.selectedIndex].text;

                                if (selectedText === 'Saldo Awal') {
                                    // Pilih otomatis "Saldo Awal" di dropdown Jenis
                                    // Kalau belum ada, tambahkan dulu
                                    let saldoOption = jenisSelect.querySelector('option[value="saldo_awal"]');
                                    if (!saldoOption) {
                                        saldoOption = document.createElement('option');
                                        saldoOption.value = 'saldo_awal';
                                        saldoOption.textContent = 'Saldo Awal';
                                        jenisSelect.appendChild(saldoOption);
                                    }
                                    jenisSelect.value = 'saldo_awal';
                                } else {
                                    // Hapus pilihan "Saldo Awal" jika ada
                                    const saldoOption = jenisSelect.querySelector('option[value="saldo_awal"]');
                                    if (saldoOption) saldoOption.remove();
                                    jenisSelect.value = ""; // Reset ke default
                                }
                            });
                        </script>


                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ini batas modal -->

    {{-- modal edit --}}
    @foreach ($data as $d)
        <div style="height:90%; margin-top: 3.5rem;"class="modal fade" id="editModal{{ $d->id }}" tabindex="-1"
            aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data Kas Operasional</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('kas_operasional.update', $d->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input required type="date" class="form-control" name="tanggal" id="tanggalInput"
                                aria-describedby="dateHelp" value="{{ $d->tanggal }}">
                            <br>
                            <label for="keterangan_id" class="form-label">Nama Keterangan</label>
                            <select required name="keterangan_id" id="select" class="form-control">
                                <option value="" disabled selected>Pilih Keterangan</option>
                                @foreach ($keterangan as $k)
                                    <option value="{{ $k->id }}" {{ $d->keterangan_id == $k->id ? 'selected' : '' }}>
                                        {{ $k->keterangan }}
                                    </option>
                                @endforeach
                            </select>
                            <br>
                            <label for="jenis" class="form-label">Jenis</label>
                            <select required name="jenis" id="select" class="form-control">
                                <option value="" disabled selected>Pilih Jenis Kas</option>
                                @foreach ($jenis as $j)
                                    <option value="{{ $j }}" {{ $d->jenis == $j ? 'selected' : '' }}>
                                        {{ $j }}
                                    </option>
                                @endforeach

                            </select>
                            <br>
                            <label for="nominal" class="form-label">Nominal</label>
                            <input required type="number" class="form-control" name="nominal" id="nominal"
                                placeholder="Contoh: 200000" value="{{ $d->nominal }}">

                            <script>
                                // Daftar kombinasi tanggal dan keterangan_id yang sudah dipilih dari backend
                                const takenDatesWithKeterangan = @json($takenDatesWithKeterangan);

                                document.getElementById('tanggalInput').addEventListener('change', validateDateAndCombination);
                                document.getElementById('select').addEventListener('change', validateDateAndCombination);

                                function validateDateAndCombination() {
                                    const selectedDate = document.getElementById('tanggalInput').value;
                                    const selectedKeterangan = document.getElementById('select').value;
                                    const keteranganSelect = document.getElementById('select');

                                    // Pastikan opsi "Pilih Keterangan" tetap disable
                                    const placeholderOption = keteranganSelect.querySelector('option[value=""]');
                                    if (placeholderOption) {
                                        placeholderOption.disabled = true;
                                    }

                                    // Validasi agar hanya tanggal Jumat yang bisa dipilih
                                    const inputDate = new Date(selectedDate);
                                    const dayOfWeek = inputDate.getUTCDay();
                                    if (dayOfWeek !== 5) {
                                        alert("Silakan pilih tanggal yang jatuh pada hari Jumat.");
                                        document.getElementById('tanggalInput').value = "";
                                        return;
                                    }

                                    // Reset semua opsi keterangan untuk di-enable kembali
                                    keteranganSelect.querySelectorAll('option').forEach(option => {
                                        if (option.value !== "") {
                                            option.disabled = false; // Enable opsi selain placeholder
                                        }
                                    });

                                    // Validasi kombinasi tanggal dan keterangan
                                    const isTaken = takenDatesWithKeterangan.some(entry =>
                                        entry.tanggal === selectedDate && entry.keterangan_id == selectedKeterangan
                                    );

                                    if (isTaken) {
                                        alert("Kombinasi tanggal dan keterangan ini sudah dipilih. Silakan pilih kombinasi lain.");
                                        document.getElementById('tanggalInput').value = "";
                                        document.getElementById('select').value = "";
                                    }

                                    // Loop untuk disable opsi yang sudah terpilih di tanggal yang sama
                                    takenDatesWithKeterangan.forEach(entry => {
                                        if (entry.tanggal === selectedDate) {
                                            const option = keteranganSelect.querySelector(`option[value="${entry.keterangan_id}"]`);
                                            if (option) {
                                                option.disabled = true; // Disable opsi yang sudah terpilih
                                            }
                                        }
                                    });
                                }
                            </script>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- end modal edit --}}

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
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Final Kas Operasional</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Kas Opersional</li>
        </ol>
        <div class="card mb-4">

        </div>
        @auth


            <div class="card mb-4">
                <div class="card-header">
                    @auth
                        <a href="" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-square-plus"></i>
                        </a>

                    @endauth
                </div>

                <br><br>




                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>

                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Jenis</th>
                                <th>Nominal</th>

                                <th>Action</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <th>No</th>

                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Jenis</th>
                            <th>Nominal</th>

                            <th>Action</th>
                        </tfoot>
                        <tbody>

                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $d->tanggal }}</td>
                                    <td>{{ $d->keterangan }}</td>
                                    <td>{{ $d->jenis }}</td>
                                    <td>{{ number_format($d->nominal, 0, ',', '.') }}
                                    </td>


                                    <td>
                                        {{-- <a href="{{ route('imam.edit', $d->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i></a> --}}
                                        <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $d->id }}">
                                            <i class="fa-solid fa-pen-to-square"></i></a>

                                        <!-- ini untuk modal hapus -->
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $d->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade apus" id="exampleModal{{ $d->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Produk</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin akan menghapus data tanggal {{ $d->tanggal }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>

                                                        <form action="{{ route('kas_operasional.destroy', $d->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ini batas modal hapus -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mb-1">

                <div class="card-header">
                    <p class="card-title mb-3 text-center" style="color: black">
                        *Pilih tahun dan bulan terlebih dahulu untuk melihat laporan spesifik dibawah
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
                                <i class="fa-solid fa-file-invoice"></i> Tampilkan Laporan
                            </button>

                        </div>

                    </form>
                    <p>*Download PDF: Klik tombol <b>Tampilkan Laporan</b> terlebih dahulu.</p>
                    <div class="mb-3">
                        <a href="{{ route('kas.export.pdf') }}?tahun={{ $tahun }}&bulan={{ str_pad($bulan, 2, '0', STR_PAD_LEFT) }}"
                            id="btn-download-pdf" class="btn btn-danger">
                            <i class="fa-solid fa-file-pdf"></i> Download PDF
                        </a>
                    </div>
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

                // script baru
                // Fungsi untuk mengupdate URL tombol download
                function updateDownloadLink(tahun, bulan) {
                    const btnDownload = document.getElementById('btn-download-pdf');
                    if (btnDownload) {
                        // Kita ambil base route dari helper Laravel
                        const baseUrl = "{{ route('kas.export.pdf') }}";

                        // Format bulan agar selalu 2 digit (misal: 1 jadi 01)
                        const bulanFormatted = String(bulan).padStart(2, '0');

                        // Set URL baru ke atribut href
                        btnDownload.setAttribute('href', `${baseUrl}?tahun=${tahun}&bulan=${bulanFormatted}`);
                    }
                }

                // Integrasikan ke dalam event listener filterForm yang sudah ada
                document.getElementById('filterForm').addEventListener('submit', function(e) {
                    e.preventDefault();

                    const tahun = document.getElementById('tahun').value;
                    const bulan = document.getElementById('bulan').value;

                    // 1. Update tombol download sebelum fetch dimulai
                    updateDownloadLink(tahun, bulan);

                    // 2. Tampilkan loading di dalam #hasil-laporan
                    document.getElementById('hasil-laporan').innerHTML = `...`;

                    // 3. Fetch data (seperti yang sudah Anda buat)
                    fetch(`/kas-operasional?tahun=${tahun}&bulan=${bulan}`)
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const hasil = doc.querySelector('#hasil-laporan').innerHTML;
                            document.querySelector('#hasil-laporan').innerHTML = hasil;
                        })
                        .catch(error => {
                            console.error(error);
                        });
                });
            </script>
        @endauth
    </div>
@endsection

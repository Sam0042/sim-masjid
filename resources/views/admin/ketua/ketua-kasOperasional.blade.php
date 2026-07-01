@extends('admin.layouts.app')
@section('konten')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Final Kas Operasional</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Tables</li>
        </ol>
        @auth

            <div class="card mb-4">

                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Jenis</th>
                                <th>Nominal</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <th>No</th>

                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Jenis</th>
                            <th>Nominal</th>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-3 text-center">Print Berdasarkan Bulan dan Tahun</h5>
                </div>
                <div class="card-body">
                    <form id="printForm" class="row g-3 align-items-end" onsubmit="return false;">
                        <div class="col-md-4">
                            <label for="bulan" class="form-label">Bulan</label>
                            <select id="bulan" name="bulan" class="form-select" required>
                                <option value="" disabled selected>Pilih Bulan</option>
                                @foreach ($availableMonthsYears->unique('bulan') as $item)
                                    @php
                                        $monthNumber = str_pad($item->bulan, 2, '0', STR_PAD_LEFT);
                                        $monthName = \Carbon\Carbon::create()
                                            ->month($item->bulan)
                                            ->translatedFormat('F');
                                    @endphp
                                    <option value="{{ $monthNumber }}">{{ $monthName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select id="tahun" name="tahun" class="form-select" required>
                                <option value="" disabled selected>Pilih Tahun</option>
                                @foreach ($availableMonthsYears->unique('tahun') as $item)
                                    <option value="{{ $item->tahun }}">{{ $item->tahun }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 d-flex justify-content-start">
                            <button type="button" id="tambahBtn" class="btn btn-primary btn-md mt-2">
                                <i class="bi bi-printer-fill"></i> Tampilkan Tombol Print
                            </button>
                        </div>
                    </form>

                    <div id="tombolContainer" class="mt-4 d-flex flex-wrap gap-2"></div>
                </div>
            </div>

            <script>
                document.getElementById('tambahBtn').addEventListener('click', function() {
                    const bulan = document.getElementById('bulan').value;
                    const tahun = document.getElementById('tahun').value;

                    if (!bulan || !tahun) {
                        alert('Pilih bulan dan tahun terlebih dahulu!');
                        return;
                    }

                    const bulanNama = new Date(tahun, bulan - 1).toLocaleString('id-ID', {
                        month: 'long'
                    });
                    const container = document.getElementById('tombolContainer');

                    const tombol = document.createElement('a');
                    tombol.href = `/admin/ketua-kas/print/${tahun}/${bulan}`;
                    tombol.target = "_blank";
                    tombol.textContent = `Cetak Laporan ${bulanNama} ${tahun}`;
                    tombol.classList = "btn btn-success";
                    tombol.style.marginRight = "10px";

                    container.appendChild(tombol);
                });
            </script>
        @endauth
    </div>
@endsection

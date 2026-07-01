<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
        }

        .table-wrapper {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }

        .judul-laporan {
            text-align: center;
            margin-bottom: 15px;
        }

        .judul-laporan b {
            display: block;
        }

        table.table-keuangan {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.table-keuangan th,
        table.table-keuangan td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
        }

        table.table-keuangan thead th {
            background-color: #f2f2f2;
        }

        .text-left {
            text-align: left !important;
        }

        .bg-blue {
            background-color: #e0f2fe;
        }

        .bg-light {
            background-color: #f8f9fa;
        }

        .bg-green {
            background-color: #e9fbe9;
        }

        .bg-red {
            background-color: #fdeeee;
        }

        .bg-dark-blue {
            background-color: #dbeafe;
        }
    </style>
</head>

<body>

    @foreach ($dataByMonthFilter as $namaBulan => $data)
        @php
            $dates = $data->groupBy('tanggal');
            $dateKeys = $dates->keys();
            $saldoAwal = $saldoAwalBulan; // Pastikan variabel ini tersedia
        @endphp

        <div class="table-wrapper">
            <div class="judul-laporan">
                <b>Masjid Roudhotul Jannah</b>
                <b>Laporan Keuangan</b>
                <b>Kas Operasional</b>
                <b>{{ $namaBulan }}</b>
            </div>

            <table class="table-keuangan">
                <thead>
                    <tr>
                        <th rowspan="2">Keterangan</th>
                        <th rowspan="2">Saldo Awal</th>
                        <th colspan="{{ $dateKeys->count() }}">Tanggal</th>
                        <th rowspan="2">Jumlah</th>
                    </tr>
                    <tr>
                        @foreach ($dateKeys as $date)
                            <th>{{ \Carbon\Carbon::parse($date)->format('d-M-y') }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <!-- SALDO AWAL -->
                    <tr class="bg-blue" style="font-weight:bold;">
                        <td>Saldo Awal</td>
                        <td>{{ number_format($saldoAwal, 0, ',', '.') }}</td>
                        @foreach ($dateKeys as $date)
                            <td></td>
                        @endforeach
                        <td></td>
                    </tr>

                    <!-- PENERIMAAN -->
                    <tr class="bg-light" style="font-weight:bold;">
                        <td colspan="{{ $dateKeys->count() + 3 }}" class="text-left">Penerimaan</td>
                    </tr>
                    @php
                        $totalPenerimaanPerTanggal = array_fill_keys($dateKeys->toArray(), 0);
                        $grandTotalPenerimaan = 0;
                        $penerimaanUnik = $data->where('jenis', 'penerimaan')->unique('keterangan');
                    @endphp
                    @foreach ($penerimaanUnik as $item)
                        <tr>
                            <td class="text-left">{{ $item->keterangan }}</td>
                            <td></td>
                            @php $totalRow = 0; @endphp
                            @foreach ($dateKeys as $date)
                                @php
                                    $amount = $dates[$date]->where('keterangan', $item->keterangan)->sum('nominal');
                                    $totalRow += $amount;
                                    $totalPenerimaanPerTanggal[$date] += $amount;
                                @endphp
                                <td>{{ number_format($amount, 0, ',', '.') }}</td>
                            @endforeach
                            <td>{{ number_format($totalRow, 0, ',', '.') }}</td>
                        </tr>
                        @php $grandTotalPenerimaan += $totalRow; @endphp
                    @endforeach
                    <tr class="bg-green" style="font-weight:bold;">
                        <td>Total Penerimaan</td>
                        <td></td>
                        @foreach ($dateKeys as $date)
                            <td>{{ number_format($totalPenerimaanPerTanggal[$date], 0, ',', '.') }}</td>
                        @endforeach
                        <td>{{ number_format($grandTotalPenerimaan, 0, ',', '.') }}</td>
                    </tr>

                    <!-- PENGELUARAN -->
                    <tr class="bg-light" style="font-weight:bold;">
                        <td colspan="{{ $dateKeys->count() + 3 }}" class="text-left">Pengeluaran</td>
                    </tr>
                    @php
                        $totalPengeluaranPerTanggal = array_fill_keys($dateKeys->toArray(), 0);
                        $grandTotalPengeluaran = 0;
                        $pengeluaranUnik = $data->where('jenis', 'pengeluaran')->unique('keterangan');
                    @endphp
                    @foreach ($pengeluaranUnik as $item)
                        <tr>
                            <td class="text-left">{{ $item->keterangan }}</td>
                            <td></td>
                            @php $totalRow = 0; @endphp
                            @foreach ($dateKeys as $date)
                                @php
                                    $amount = $dates[$date]->where('keterangan', $item->keterangan)->sum('nominal');
                                    $totalRow += $amount;
                                    $totalPengeluaranPerTanggal[$date] += $amount;
                                @endphp
                                <td>{{ number_format($amount, 0, ',', '.') }}</td>
                            @endforeach
                            <td>{{ number_format($totalRow, 0, ',', '.') }}</td>
                        </tr>
                        @php $grandTotalPengeluaran += $totalRow; @endphp
                    @endforeach
                    <tr class="bg-red" style="font-weight:bold;">
                        <td>Total Pengeluaran</td>
                        <td></td>
                        @foreach ($dateKeys as $date)
                            <td>{{ number_format($totalPengeluaranPerTanggal[$date], 0, ',', '.') }}</td>
                        @endforeach
                        <td>{{ number_format($grandTotalPengeluaran, 0, ',', '.') }}</td>
                    </tr>

                    <!-- SALDO KAS -->
                    <tr class="bg-dark-blue" style="font-weight:bold;">
                        <td>Saldo Kas Operasional</td>
                        <td>{{ number_format($saldoAwal, 0, ',', '.') }}</td>
                        @php $saldoBerjalan = $saldoAwal; @endphp
                        @foreach ($dateKeys as $date)
                            @php $saldoBerjalan += ($totalPenerimaanPerTanggal[$date] - $totalPengeluaranPerTanggal[$date]); @endphp
                            <td>{{ number_format($saldoBerjalan, 0, ',', '.') }}</td>
                        @endforeach
                        <td>{{ number_format($saldoBerjalan, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endforeach

</body>

</html>

<a href="{{ route('kas_operasional.index') }}">Kembali</a>
<br>

<div>
    @foreach ($dataByMonth as $month => $data)
        <br>
        <b>Masjid Roudhotul Jannah</b><br>
        <b>Laporan Keuangan</b><br>
        <b>Kas Operasional</b><br>
        <b>{{ $month }}</b>
        <br><br>

        @php
            $dates = $data->groupBy('tanggal');
            $dateKeys = $dates->keys();
        @endphp

        <table style="width:100%; border-collapse: collapse; text-align:center;" border="1">
            <thead>
                <tr>
                    <th rowspan="2">Keterangan</th>
                    <th rowspan="2">Saldo Awal</th>
                    <th colspan="{{ $dates->count() }}">Tanggal</th>
                    <th rowspan="2">Jumlah</th>
                </tr>
                <tr>
                    @foreach ($dateKeys as $date)
                        <th>{{ \Carbon\Carbon::parse($date)->format('d-M-Y') }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                {{-- Bagian Penerimaan --}}
                <tr>
                    <th>Penerimaan</th>
                    <td></td>
                    @for ($i = 0; $i < $dates->count(); $i++)
                        <td></td>
                    @endfor
                    <td></td>
                </tr>

                @php
                    $totalPenerimaanPerTanggal = array_fill_keys($dateKeys->toArray(), 0);
                    $grandTotalPenerimaan = 0;
                @endphp

                @foreach ($penerimaan as $tanggal => $items)
                    @foreach ($items->unique('keterangan') as $item)
                        <tr>
                            <td>{{ $item->keterangan }}</td>
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
                            @php $grandTotalPenerimaan += $totalRow; @endphp
                        </tr>
                    @endforeach
                @endforeach

                {{-- Baris Total Penerimaan --}}
                <tr style="font-weight: bold; background-color: #e9fbe9;">
                    <td>Total Penerimaan</td>
                    <td></td>
                    @foreach ($dateKeys as $date)
                        <td>{{ number_format($totalPenerimaanPerTanggal[$date], 0, ',', '.') }}</td>
                    @endforeach
                    <td>{{ number_format($grandTotalPenerimaan, 0, ',', '.') }}</td>
                </tr>

                {{-- Bagian Pengeluaran --}}
                <tr>
                    <th>Pengeluaran</th>
                    <td></td>
                    @for ($i = 0; $i < $dates->count(); $i++)
                        <td></td>
                    @endfor
                    <td></td>
                </tr>

                @php
                    $totalPengeluaranPerTanggal = array_fill_keys($dateKeys->toArray(), 0);
                    $grandTotalPengeluaran = 0;
                @endphp

                @foreach ($pengeluaran as $tanggal => $items)
                    @foreach ($items->unique('keterangan') as $item)
                        <tr>
                            <td>{{ $item->keterangan }}</td>
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
                            @php $grandTotalPengeluaran += $totalRow; @endphp
                        </tr>
                    @endforeach
                @endforeach

                {{-- Baris Total Pengeluaran --}}
                <tr style="font-weight: bold; background-color: #fdeeee;">
                    <td>Total Pengeluaran</td>
                    <td></td>
                    @foreach ($dateKeys as $date)
                        <td>{{ number_format($totalPengeluaranPerTanggal[$date], 0, ',', '.') }}</td>
                    @endforeach
                    <td>{{ number_format($grandTotalPengeluaran, 0, ',', '.') }}</td>
                </tr>

                {{-- Baris Penerimaan - Pengeluaran --}}
                <tr style="font-weight: bold; background-color: #f0f0f0;">
                    <td>Penerimaan - Pengeluaran</td>
                    <td></td>
                    @foreach ($dateKeys as $date)
                        @php
                            $totalAkhirPerTanggal =
                                $totalPenerimaanPerTanggal[$date] - $totalPengeluaranPerTanggal[$date];
                        @endphp
                        <td>{{ number_format($totalAkhirPerTanggal, 0, ',', '.') }}</td>
                    @endforeach
                    <td>{{ number_format($grandTotalPenerimaan - $grandTotalPengeluaran, 0, ',', '.') }}</td>
                </tr>

                {{-- Baris Saldo Kas Operasional --}}
                <tr style="font-weight: bold; background-color: #dbeafe;">
                    <td>Saldo Kas Operasional</td>
                    <td>{{ number_format(5744490, 0, ',', '.') }}</td> {{-- contoh saldo awal dummy --}}
                    @foreach ($dateKeys as $date)
                        @php
                            $saldoPerTanggal =
                                5744490 + $totalPenerimaanPerTanggal[$date] - $totalPengeluaranPerTanggal[$date];
                        @endphp
                        <td>{{ number_format($saldoPerTanggal, 0, ',', '.') }}</td>
                    @endforeach
                    <td>
                        {{ number_format(5744490 + $grandTotalPenerimaan - $grandTotalPengeluaran, 0, ',', '.') }}
                    </td>
                </tr>

            </tbody>
        </table>
    @endforeach
</div>

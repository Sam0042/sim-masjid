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
            $saldoAwal = $data->where('keterangan', 'Saldo Awal')->sum('nominal');
        @endphp

        <table style="width:100%; border-collapse: collapse; text-align:center;" border="1">
            <thead style="background:#f3f4f6;">
                <tr>
                    <th rowspan="2">Keterangan</th>
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

                {{-- 🟦 Saldo Awal --}}
                <tr style="font-weight:bold; background:#e0f2fe;">
                    <td>Saldo Awal</td>
                    @foreach ($dateKeys as $date)
                        @php
                            $saldoTanggal = $dates[$date]->where('keterangan', 'Saldo Awal')->sum('nominal');
                        @endphp
                        <td>{{ number_format($saldoTanggal, 0, ',', '.') }}</td>
                    @endforeach
                    <td>{{ number_format($saldoAwal, 0, ',', '.') }}</td>
                </tr>

                {{-- Spasi antar bagian --}}
                <tr>
                    <td colspan="{{ $dates->count() + 2 }}" style="background:#fff; height:10px;"></td>
                </tr>

                {{-- Bagian Penerimaan --}}
                <tr style="font-weight:bold;">
                    <td colspan="{{ $dates->count() + 2 }}" style="text-align:left;">Penerimaan</td>
                </tr>

                @php
                    $totalPenerimaanPerTanggal = array_fill_keys($dateKeys->toArray(), 0);
                    $grandTotalPenerimaan = 0;
                @endphp

                @foreach ($penerimaan as $tanggal => $items)
                    @foreach ($items->unique('keterangan') as $item)
                        <tr>
                            <td>{{ $item->keterangan }}</td>
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

                {{-- Total Penerimaan --}}
                <tr style="font-weight: bold; background-color: #e9fbe9;">
                    <td>Total Penerimaan</td>
                    @foreach ($dateKeys as $date)
                        <td>{{ number_format($totalPenerimaanPerTanggal[$date], 0, ',', '.') }}</td>
                    @endforeach
                    <td>{{ number_format($grandTotalPenerimaan, 0, ',', '.') }}</td>
                </tr>

                {{-- Spasi antar bagian --}}
                <tr>
                    <td colspan="{{ $dates->count() + 2 }}" style="background:#fff; height:10px;"></td>
                </tr>

                {{-- Bagian Pengeluaran --}}
                <tr style="font-weight:bold;">
                    <td colspan="{{ $dates->count() + 2 }}" style="text-align:left;">Pengeluaran</td>
                </tr>

                @php
                    $totalPengeluaranPerTanggal = array_fill_keys($dateKeys->toArray(), 0);
                    $grandTotalPengeluaran = 0;
                @endphp

                @foreach ($pengeluaran as $tanggal => $items)
                    @foreach ($items->unique('keterangan') as $item)
                        <tr>
                            <td>{{ $item->keterangan }}</td>
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

                {{-- Total Pengeluaran --}}
                <tr style="font-weight: bold; background-color: #fdeeee;">
                    <td>Total Pengeluaran</td>
                    @foreach ($dateKeys as $date)
                        <td>{{ number_format($totalPengeluaranPerTanggal[$date], 0, ',', '.') }}</td>
                    @endforeach
                    <td>{{ number_format($grandTotalPengeluaran, 0, ',', '.') }}</td>
                </tr>

                {{-- Spasi antar bagian --}}
                <tr>
                    <td colspan="{{ $dates->count() + 2 }}" style="background:#fff; height:10px;"></td>
                </tr>

                {{-- Total Keseluruhan --}}
                <tr style="font-weight:bold; background:#d1fae5;">
                    <td>Total</td>
                    @foreach ($dateKeys as $date)
                        @php
                            $totalSemua = $totalPenerimaanPerTanggal[$date] + $totalPengeluaranPerTanggal[$date];
                        @endphp
                        <td>{{ number_format($totalSemua, 0, ',', '.') }}</td>
                    @endforeach
                    <td>{{ number_format($grandTotalPenerimaan + $grandTotalPengeluaran, 0, ',', '.') }}</td>
                </tr>

                @php
                    $saldoBerjalan = $saldoAwal;
                @endphp

                <tr style="font-weight:bold;background:#dbeafe;">
                    <td>Saldo Kas Operasional</td>
                    @foreach ($dateKeys as $index => $date)
                        @php
                            $penerimaan = $totalPenerimaanPerTanggal[$date] ?? 0;
                            $pengeluaran = $totalPengeluaranPerTanggal[$date] ?? 0;

                            // Tambahkan saldo awal hanya di awal (index pertama)
                            if ($index == 0) {
                                $saldoBerjalan = $saldoAwal + $penerimaan - $pengeluaran;
                            } else {
                                $saldoBerjalan += $penerimaan - $pengeluaran;
                            }
                        @endphp
                        <td>{{ number_format($saldoBerjalan, 0, ',', '.') }}</td>
                    @endforeach
                    <td>{{ number_format($saldoBerjalan, 0, ',', '.') }}</td>
                </tr>


            </tbody>
        </table>
    @endforeach
</div>

<a href="{{ route('kas_operasional.index') }}">Kembali</a>
<br>
{{-- @foreach ($dataByMonth as $month => $data)
    <h3>{{ $month }}</h3>
    <table border="1" style="width:100%; border-collapse:collapse; text-align:center;">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Jenis</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-M-Y') }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>{{ ucfirst($item->jenis) }}</td>
                    <td>{{ number_format($item->nominal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
@endforeach --}}

<div>
    @foreach ($dataByMonth as $month => $data)
        <br>
        <b>Masjid Roudhotul Jannah</b><br>
        <b>Laporan Keuangan</b><br>
        <b>Kas Operasional</b><br>
        <b>{{ $month }}</b>
        <br><br>

        <table style="width:100%; border-collapse: collapse; text-align:center;" border="1">
            <thead>
                <tr>
                    <th rowspan="2">Keterangan</th>
                    <th rowspan="2">Saldo Awal</th>
                    <th colspan="{{ $data->groupBy('tanggal')->count() }}">Tanggal</th>
                    <th rowspan="2">Jumlah</th>
                </tr>
                <tr>
                    @foreach ($data->groupBy('tanggal') as $date => $items)
                        <th>{{ \Carbon\Carbon::parse($date)->format('d-M-Y') }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <!-- Penerimaan Kotak Amal -->
                <tr>
                    <td>Penerimaan Kotak Amal</td>
                    <td></td>
                    @php $totalKotakAmal = 0; @endphp
                    @foreach ($data->groupBy('tanggal') as $date => $items)
                        @php
                            $amount = $kotakAmal->has($date) ? $kotakAmal[$date]->sum('nominal') : 0;
                            $totalKotakAmal += $amount;
                        @endphp
                        <td>{{ number_format($amount, 0, ',', '.') }}</td>
                    @endforeach
                    <td>{{ number_format($totalKotakAmal, 0, ',', '.') }}</td>
                </tr>

                <!-- Pengeluaran Header -->
                <tr>
                    <th>Pengeluaran</th>
                    <td></td>
                    @for ($i = 0; $i < $data->groupBy('tanggal')->count(); $i++)
                        <td></td>
                    @endfor
                    <td></td>
                </tr>

                <!-- A. Biaya Kemakmuran Masjid -->
                <tr>
                    <th><i>A. Biaya Kemakmuran Masjid</i></th>
                    <td></td>
                    @for ($i = 0; $i < $data->groupBy('tanggal')->count(); $i++)
                        <td></td>
                    @endfor
                    <td></td>
                </tr>

                {{-- Biaya Kemakmuran --}}
                @foreach (['biaya_transport_khotib', 'insentif_khotib_muazin', 'mukafahah_imam', 'ta_lim_ahad', 'tahsin_sabtu', 'konsumsi_ahad_subuh', 'mukafahah_marbot'] as $expense)
                    <tr>
                        <td>{{ ucfirst(str_replace('_', ' ', $expense)) }}</td>
                        <td></td>
                        @php $totalExpense = 0; @endphp
                        @foreach ($data->groupBy('tanggal') as $date => $items)
                            @php
                                $amount = $items->where('keterangan', $expense)->sum('nominal');
                                $totalExpense += $amount;
                            @endphp
                            <td>{{ number_format($amount, 0, ',', '.') }}</td>
                        @endforeach
                        <td>{{ number_format($totalExpense, 0, ',', '.') }}</td>
                    </tr>
                @endforeach

                <!-- B. Biaya Administrasi -->
                <tr>
                    <th><i>B. Biaya Administrasi</i></th>
                    <td></td>
                    @for ($i = 0; $i < $data->groupBy('tanggal')->count(); $i++)
                        <td></td>
                    @endfor
                    <td></td>
                </tr>

                {{-- Biaya Administrasi --}}
                @foreach (['biaya_listrik', 'biaya_internet', 'fotocopy_spanduk', 'air_minum', 'pewangi_sabun_kamper', 'biaya_distribusi_amplop', 'biaya_perbaikan_sparepart'] as $adminExpense)
                    <tr>
                        <td>{{ ucfirst(str_replace('_', ' ', $adminExpense)) }}</td>
                        <td></td>
                        @php $totalAdminExpense = 0; @endphp
                        @foreach ($data->groupBy('tanggal') as $date => $items)
                            @php
                                $amount = $items->where('keterangan', $adminExpense)->sum('nominal');
                                $totalAdminExpense += $amount;
                            @endphp
                            <td>{{ number_format($amount, 0, ',', '.') }}</td>
                        @endforeach
                        <td>{{ number_format($totalAdminExpense, 0, ',', '.') }}</td>
                    </tr>
                @endforeach

                <!-- C. Lain-lain -->
                <tr>
                    <th><i>C. Lain-lain</i></th>
                    <td></td>
                    @for ($i = 0; $i < $data->groupBy('tanggal')->count(); $i++)
                        <td></td>
                    @endfor
                    <td></td>
                </tr>

                {{-- Lain-lain --}}
                @foreach (['tukang', 'subuh_gabungan', 'taklim_ibu_ibu'] as $otherExpense)
                    <tr>
                        <td>{{ ucfirst(str_replace('_', ' ', $otherExpense)) }}</td>
                        <td></td>
                        @php $totalOtherExpense = 0; @endphp
                        @foreach ($data->groupBy('tanggal') as $date => $items)
                            @php
                                $amount = $items->where('keterangan', $otherExpense)->sum('nominal');
                                $totalOtherExpense += $amount;
                            @endphp
                            <td>{{ number_format($amount, 0, ',', '.') }}</td>
                        @endforeach
                        <td>{{ number_format($totalOtherExpense, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</div>

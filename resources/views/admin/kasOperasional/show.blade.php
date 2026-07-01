@extends('admin.layouts.app')
@section('konten')
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <br>
    <b>Masjid Roudhotul Jannah</b><br>
    <b>Laporan Keuangan</b><br>
    <b>Kas Operasional</b><br>
    <b>Desember {{ \Carbon\Carbon::parse($data->first()->tanggal)->format('Y') }}</b>

    <br>
    <table style="width:100%; border-collapse: collapse; text-align:center;" border="1">
        <thead>
            <tr>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Saldo Awal</th>
            </tr>
            <tr>
                @foreach ($tanggal as $tgl)
                    <th>{{ \Carbon\Carbon::parse($tgl)->format('d-M-y') }}</th>
                @endforeach
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <!-- Penerimaan -->
            <tr>
                <td>Saldo Awal</td>
                <td>1.391.706</td>
                <td colspan="{{ count($tanggal) + 1 }}"></td>
            </tr>
            {{-- baris kotak amal --}}
            <tr>
                <td>Penerimaan Kotak Amal</td>
                <td></td>

                {{-- Loop data --}}
                @php $total = 0; @endphp
                @foreach ($data as $d)
                    <td>{{ number_format($d->penerimaan_kotak_amal, 0, ',', '.') }}</td>
                    @php $total += $d->penerimaan_kotak_amal; @endphp
                @endforeach

                {{-- Jumlah total --}}
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>
            {{-- <tr>
                <td colspan="6" style="text-align:center;"><strong>Jumlah Penerimaan</strong></td>
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr> --}}

            <tr>
                <th>Pengeluaran</th>
                <td></td>
                @for ($i = 0; $i < count($data); $i++)
                    <td></td>
                @endfor
                <td></td>
            </tr>
            <tr>
                <th><i>A. Biaya Kemakmuran Masjid</i></th>
                <td></td>
                @for ($i = 0; $i < count($data); $i++)
                    <td></td>
                @endfor
                <td></td>
            </tr>

            <tr>
                <td>Transport Khotib</td>
                <td></td>

                {{-- Loop data --}}
                @php $total = 0; @endphp
                @foreach ($data as $d)
                    <td>{{ number_format($d->biaya_transport_khotib, 0, ',', '.') }}</td>
                    @php $total += $d->biaya_transport_khotib; @endphp
                @endforeach

                {{-- Jumlah total --}}
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>

            <tr>
                <td>Insentif Khotib Cadangan Muadzin</td>
                <td></td>

                {{-- Loop data --}}
                @php $total = 0; @endphp
                @foreach ($data as $d)
                    <td>{{ number_format($d->insentif_khotib_muazin, 0, ',', '.') }}</td>
                    @php $total += $d->insentif_khotib_muazin; @endphp
                @endforeach

                {{-- Jumlah total --}}
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>

            <tr>
                <td>Mukafahah Imam</td>
                <td></td>
                @php $total = 0; @endphp
                @foreach ($data as $d)
                    <td>{{ number_format($d->mukafahah_imam, 0, ',', '.') }}</td>
                    @php $total += $d->mukafahah_imam; @endphp
                @endforeach
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>

            <tr>
                <td>Ta'lim Ahad</td>
                <td></td>
                @php $total = 0; @endphp
                @foreach ($data as $d)
                    <td>{{ number_format($d->ta_lim_ahad, 0, ',', '.') }}</td>
                    @php $total += $d->ta_lim_ahad; @endphp
                @endforeach
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>

            <tr>
                <td>Tahsin Sabtu</td>
                <td></td>
                @php $total = 0; @endphp
                @foreach ($data as $d)
                    <td>{{ number_format($d->tahsin_sabtu, 0, ',', '.') }}</td>
                    @php $total += $d->tahsin_sabtu; @endphp
                @endforeach
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>

            <tr>
                <td>Konsumsi Jamaah Ahad Subuh</td>
                <td></td>
                @php $total = 0; @endphp
                @foreach ($data as $d)
                    <td>{{ number_format($d->konsumsi_ahad_subuh, 0, ',', '.') }}</td>
                    @php $total += $d->konsumsi_ahad_subuh; @endphp
                @endforeach
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>

            <tr>
                <td>Mukafahah Marbot Masjid</td>
                <td></td>
                @php $total = 0; @endphp
                @foreach ($data as $d)
                    <td>{{ number_format($d->mukafahah_marbot, 0, ',', '.') }}</td>
                    @php $total += $d->mukafahah_marbot; @endphp
                @endforeach
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>

            <tr>
                <th><i>B. Biaya Administrasi</i></th>
                <td></td>
                @for ($i = 0; $i < count($data); $i++)
                    <td></td>
                @endfor
                <td></td>
            </tr>
            <tr>
                <td>Biaya Listrik</td>
                <td></td>
                @php $total = 0; @endphp
                @foreach ($data as $d)
                    <td>{{ number_format($d->biaya_listrik, 0, ',', '.') }}</td>
                    @php $total += $d->biaya_listrik; @endphp
                @endforeach
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>

            <tr>
                <td>Biaya Internet</td>
                <td></td>
                @php $total = 0; @endphp
                @foreach ($data as $d)
                    <td>{{ number_format($d->biaya_internet, 0, ',', '.') }}</td>
                    @php $total += $d->biaya_internet; @endphp
                @endforeach
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>

            <tr>
                <td>Fotocopy, Spanduk, dan Cetak</td>
                <td></td>
                @php $total = 0; @endphp
                @foreach ($data as $d)
                    <td>{{ number_format($d->fotocopy_spanduk, 0, ',', '.') }}</td>
                    @php $total += $d->fotocopy_spanduk; @endphp
                @endforeach
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>

            <tr>
                <td>Air Minum</td>
                <td></td>
                @php $total = 0; @endphp
                @foreach ($data as $d)
                    <td>{{ number_format($d->air_minum, 0, ',', '.') }}</td>
                    @php $total += $d->air_minum; @endphp
                @endforeach
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>

            <tr>
                <td>Pewangi, Sabun, dan Kamper</td>
                <td></td>
                @php $total = 0; @endphp
                @foreach ($data as $d)
                    <td>{{ number_format($d->pewangi_sabun_kamper, 0, ',', '.') }}</td>
                    @php $total += $d->pewangi_sabun_kamper; @endphp
                @endforeach
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>

            <tr>
                <td>Biaya Distribusi Amplop/Kebersihan</td>
                <td></td>
                @php $total = 0; @endphp
                @foreach ($data as $d)
                    <td>{{ number_format($d->biaya_distribusi_amplop, 0, ',', '.') }}</td>
                    @php $total += $d->biaya_distribusi_amplop; @endphp
                @endforeach
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>

            <tr>
                <td>Biaya Perbaikan/Sparepart</td>
                <td></td>
                @php $total = 0; @endphp
                @foreach ($data as $d)
                    <td>{{ number_format($d->biaya_perbaikan_sparepart, 0, ',', '.') }}</td>
                    @php $total += $d->biaya_perbaikan_sparepart; @endphp
                @endforeach
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>

            <tr>
                <td>Konsumsi Malam Jumat</td>
                <td></td>
                @php $total = 0; @endphp
                @foreach ($data as $d)
                    <td>{{ number_format($d->konsumsi_malam_jumat, 0, ',', '.') }}</td>
                    @php $total += $d->konsumsi_malam_jumat; @endphp
                @endforeach
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>

            <tr>
                <td>Konsumsi Harian Dapur + Tukang</td>
                <td></td>
                @php $total = 0; @endphp
                @foreach ($data as $d)
                    <td>{{ number_format($d->konsumsi_dapur_tukang, 0, ',', '.') }}</td>
                    @php $total += $d->konsumsi_dapur_tukang; @endphp
                @endforeach
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>

            <tr>
                <th><i>C. Lain lain</i></th>
                <td></td>
                @for ($i = 0; $i < count($data); $i++)
                    <td></td>
                @endfor
                <td></td>
            </tr>

            <tr>
                <td>Tukang</td>
                <td></td>
                @php $total = 0; @endphp
                @foreach ($data as $d)
                    <td>{{ number_format($d->tukang, 0, ',', '.') }}</td>
                    @php $total += $d->tukang; @endphp
                @endforeach
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>

            <tr>
                <td>Subuh Gabungan</td>
                <td></td>
                @php $total = 0; @endphp
                @foreach ($data as $d)
                    <td>{{ number_format($d->subuh_gabungan, 0, ',', '.') }}</td>
                    @php $total += $d->subuh_gabungan; @endphp
                @endforeach
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>

            <tr>
                <td>Taklim Ibu-Ibu</td>
                <td></td>
                @php $total = 0; @endphp
                @foreach ($data as $d)
                    <td>{{ number_format($d->taklim_ibu_ibu, 0, ',', '.') }}</td>
                    @php $total += $d->taklim_ibu_ibu; @endphp
                @endforeach
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>




        </tbody>
    </table>
@endsection

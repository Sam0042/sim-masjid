<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KasOperasional;
use App\Models\SaldoAwal;
use Carbon\Carbon;

class FrontKeuanganController extends Controller
{
    public function index(Request $request)
    {
        // =========================================
        // AMBIL SALDO AWAL SISTEM
        // =========================================
        $saldoAwalSistem =
            SaldoAwal::first()->nominal ?? 0;

        // =========================================
        // DATA TERBARU
        // =========================================
        $latest = KasOperasional::latest('tanggal')->first();

        $latestBulan = Carbon::parse($latest->tanggal)->month;

        $latestTahun = Carbon::parse($latest->tanggal)->year;

        // =========================================
        // FILTER
        // =========================================
        $tahun = $request->tahun ?? $latestTahun;

        $bulan = $request->bulan ?? $latestBulan;

        // =========================================
        // DATA FILTER
        // =========================================
        $dataFilter = KasOperasional::join(
                'keterangan_kas',
                'kas_operasional.keterangan_id',
                '=',
                'keterangan_kas.id'
            )
            ->select(
                'kas_operasional.*',
                'keterangan_kas.keterangan as keterangan'
            )
            ->whereYear('kas_operasional.tanggal', $tahun)
            ->whereMonth('kas_operasional.tanggal', $bulan)
            ->orderBy('kas_operasional.tanggal', 'asc')
            ->get();

        // =========================================
        // GROUP BY BULAN
        // =========================================
        $dataByMonthFilter = $dataFilter->groupBy(function ($item) {

            return Carbon::parse($item->tanggal)
                ->translatedFormat('F Y');

        });

        // =========================================
        // HITUNG SALDO AWAL OTOMATIS
        // =========================================

        // awal bulan aktif
        $awalBulan =
            Carbon::create($tahun, $bulan, 1)
                ->startOfMonth();

        // seluruh transaksi sebelum bulan aktif
        $transaksiSebelumnya =
            KasOperasional::where(
                    'tanggal',
                    '<',
                    $awalBulan
                )
                ->get();

        // total penerimaan sebelumnya
        $totalPenerimaanSebelumnya =
            $transaksiSebelumnya
                ->where('jenis', 'penerimaan')
                ->sum('nominal');

        // total pengeluaran sebelumnya
        $totalPengeluaranSebelumnya =
            $transaksiSebelumnya
                ->where('jenis', 'pengeluaran')
                ->sum('nominal');

        // saldo awal bulan aktif
        $saldoAwalBulan =
            $saldoAwalSistem
            + $totalPenerimaanSebelumnya
            - $totalPengeluaranSebelumnya;

        // =========================================
        // DROPDOWN
        // =========================================
        $availableMonthsYears = KasOperasional::selectRaw('
                YEAR(tanggal) as tahun,
                MONTH(tanggal) as bulan
            ')
            ->distinct()
            ->orderBy('tahun', 'asc')
            ->orderBy('bulan', 'asc')
            ->get()
            ->groupBy('tahun');

        return view(
            'front.keuangan.index',
            compact(
                'dataByMonthFilter',
                'availableMonthsYears',
                'tahun',
                'bulan',
                'saldoAwalBulan'
            )
        );
    }
}
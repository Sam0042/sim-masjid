<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Galeris;
use App\Models\KasOperasional;
use App\Models\KeteranganKas;
use App\Models\KhotibMuazin;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){

        // ===== DATA LAMA =====
        $program = Agenda::count();
        $ketKas = KeteranganKas::count();
        $kas = KasOperasional::count();
        $galeri = Galeris::count();
        $khotibMuazin = KhotibMuazin::count();

        // ===== TAHUN & BULAN AKTIF =====
        $tahunAktif = $request->tahun ?? date('Y');
        $bulanAktif = $request->bulan ?? date('m');

        // ===== LIST TAHUN =====
        $listTahun = DB::table('kas_operasional')
            ->selectRaw('YEAR(tanggal) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // ===== DATA BULANAN (BAR CHART) =====
        $chartBulanan = DB::table('kas_operasional')
            ->selectRaw("
                MONTH(tanggal) as bulan,
                SUM(
                    CASE 
                        WHEN jenis = 'penerimaan' THEN nominal
                        WHEN jenis = 'saldo_awal' THEN nominal
                        WHEN jenis = 'pengeluaran' THEN -nominal
                        ELSE 0
                    END
                ) as total
            ")
            ->whereYear('tanggal', $tahunAktif)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $labels = [];
        $dataBulanan = [];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = $i;
            $dataBulanan[] = $chartBulanan[$i] ?? 0;
        }

        // ===== DATA HARIAN (AREA CHART) =====
        $chartHarian = DB::table('kas_operasional')
            ->selectRaw("
                DAY(tanggal) as hari,
                SUM(
                    CASE 
                        WHEN jenis = 'penerimaan' THEN nominal
                        WHEN jenis = 'saldo_awal' THEN nominal
                        WHEN jenis = 'pengeluaran' THEN -nominal
                        ELSE 0
                    END
                ) as total
            ")
            ->whereYear('tanggal', $tahunAktif)
            ->whereMonth('tanggal', $bulanAktif)
            ->groupBy('hari')
            ->orderBy('hari')
            ->pluck('total', 'hari');

        $labelsHarian = [];
        $dataHarian = [];

        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $bulanAktif, $tahunAktif);

        $running = 0;

        for ($i = 1; $i <= $daysInMonth; $i++) {
            $labelsHarian[] = $i;

            $value = $chartHarian[$i] ?? 0;

            $running += $value;
            $dataHarian[] = $running; // saldo berjalan harian
        }

        // Logika card pemasukan dan pengeluaran bulanan
        $pemasukanBulanIni = DB::table('kas_operasional')
        ->whereYear('tanggal', $tahunAktif)
        ->whereMonth('tanggal', $bulanAktif)
        ->where('jenis', 'Penerimaan') // sesuaikan huruf kapital database Anda kemarin
        ->sum('nominal');
        $pengeluaranBulanIni = DB::table('kas_operasional')
        ->whereYear('tanggal', $tahunAktif)
        ->whereMonth('tanggal', $bulanAktif)
        ->where('jenis', 'Pengeluaran') // sesuaikan huruf kapital database Anda kemarin
        ->sum('nominal');

        // 1. Ambil nilai dasar dari master saldo_awals
        $nominalSaldoAwal = DB::table('saldo_awals')->value('nominal') ?? 0;

        // 2. Hitung total uang masuk (penerimaan) & uang keluar (pengeluaran) dari awal sistem dibuat sampai sekarang
        // Menggunakan LOWER() untuk mengantisipasi jika di database ada perbedaan huruf besar/kecil (Penerimaan / penerimaan)
        $totalSemuaTransaksi = DB::table('kas_operasional')
            ->selectRaw("
                SUM(
                    CASE 
                        WHEN LOWER(jenis) LIKE '%penerimaan%' THEN nominal
                        WHEN LOWER(jenis) LIKE '%pengeluaran%' THEN -nominal
                        ELSE 0
                    END
                ) as total
            ")
            ->value('total') ?? 0;

        // 3. Gabungkan Saldo Awal master dengan mutasi seluruh waktu
        $saldoTerakhir = $nominalSaldoAwal + $totalSemuaTransaksi;

        return view('admin.dashboard', compact(
            'program',
            'ketKas',
            'kas',
            'galeri',
            'khotibMuazin',
            'saldoTerakhir',
            'pemasukanBulanIni',
            'pengeluaranBulanIni',

            // bar chart
            'labels',
            'dataBulanan',

            // area chart
            'labelsHarian',
            'dataHarian',

            // filter
            'tahunAktif',
            'bulanAktif',
            'listTahun'
        ));
    }
}
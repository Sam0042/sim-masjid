<?php

namespace App\Http\Controllers;

use App\Models\Galeris;
use App\Models\KasOperasional;
use App\Models\KeteranganKas;
use App\Models\KhotibMuazin;
use App\Models\PenerimaZakat;
use App\Models\Program;
use App\Models\ZakatFitrah;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class KetuaController extends Controller
{
    public function khotibMuazin()
    {
        Carbon::setLocale('id');
        $data = KhotibMuazin::all();
        $takenDates = KhotibMuazin::whereDate('tanggal', '>=', Carbon::today())
        ->pluck('tanggal')
        ->toArray();
        return view('admin.ketua.ketua-khotibMuazin',compact('data','takenDates'));
    }

     public function agenda()
    {
        $data = Program::all();
        return view('admin.ketua.ketua-agenda',compact('data'));
    }

   
    public function galeris()
    {
        $data = Galeris::all();
        return view('admin.ketua.ketua-galeris',compact('data'));
    }

    public function kasOperasionalIndexing()
    {
        $data = KasOperasional::join('keterangan_kas','keterangan_id','=','keterangan_kas.id')
        ->select('kas_operasional.*','keterangan_kas.keterangan as keterangan')
        ->orderBy('kas_operasional.tanggal', 'asc')
        ->get();
        $keterangan = KeteranganKas::all();
        $takenDates = KasOperasional::whereDate('tanggal', '>=', Carbon::today())
        ->pluck('tanggal')
        ->toArray();
        $takenDatesWithKeterangan = KasOperasional::select('tanggal', 'keterangan_id')->get();
        $jenis = ['penerimaan','pengeluaran'];

        // 🔹 Ambil daftar bulan dan tahun unik dari data
    $availableMonthsYears = KasOperasional::selectRaw('YEAR(tanggal) as tahun, MONTH(tanggal) as bulan')
        ->distinct()
        ->orderBy('tahun', 'desc')
        ->orderBy('bulan', 'desc')
        ->get();
        
        return view('admin.ketua.ketua-kasOperasional',compact('data','keterangan','takenDates','takenDatesWithKeterangan'
    ,'jenis','availableMonthsYears'));
    }

        public function kasOperasionalPrint($year, $month)
{
    // Ambil semua data berdasarkan tahun dan bulan
    $data = KasOperasional::join('keterangan_kas', 'kas_operasional.keterangan_id', '=', 'keterangan_kas.id')
        ->select('kas_operasional.*', 'keterangan_kas.keterangan as keterangan')
        ->whereYear('kas_operasional.tanggal', $year)
        ->whereMonth('kas_operasional.tanggal', $month)
        ->orderBy('kas_operasional.tanggal', 'asc')
        ->get();

    // Kelompokkan data berdasarkan bulan dan tahun
    $dataByMonth = $data->groupBy(function ($item) {
        return \Carbon\Carbon::parse($item->tanggal)->format('F Y');
    });

    $kotakAmal = KasOperasional::select('tanggal', 'nominal')
        ->where('keterangan_id', 17)
        ->whereYear('tanggal', $year)
        ->whereMonth('tanggal', $month)
        ->get()
        ->groupBy('tanggal');

    $pengeluaran = KasOperasional::select('keterangan_kas.keterangan as keterangan',
        DB::raw('DATE_FORMAT(kas_operasional.tanggal, "%M %Y") as bulan'))
        ->join('keterangan_kas', 'kas_operasional.keterangan_id', '=', 'keterangan_kas.id')
        ->where('jenis', 'pengeluaran')
        ->whereYear('kas_operasional.tanggal', $year)
        ->whereMonth('kas_operasional.tanggal', $month)
        ->get()
        ->groupBy('bulan');

    $penerimaan = KasOperasional::select('keterangan_kas.keterangan as keterangan',
        DB::raw('DATE_FORMAT(kas_operasional.tanggal, "%M %Y") as bulan'))
        ->join('keterangan_kas', 'kas_operasional.keterangan_id', '=', 'keterangan_kas.id')
        ->where('jenis', 'penerimaan')
        ->whereYear('kas_operasional.tanggal', $year)
        ->whereMonth('kas_operasional.tanggal', $month)
        ->get()
        ->groupBy('bulan');

    return view('admin.ketua.ketua-kasOperasional-print', compact(
        'data', 'dataByMonth', 'kotakAmal', 'pengeluaran', 'penerimaan'
    ));
}

}


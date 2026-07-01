<?php

namespace App\Http\Controllers;

use App\Models\KasOperasional;
use App\Models\KeteranganKas;
use App\Models\SaldoAwal;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KasOperasionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */

//     public function pront($year, $month)
// {
//     // Ambil semua data berdasarkan tahun dan bulan
//     $data = KasOperasional::join('keterangan_kas', 'kas_operasional.keterangan_id', '=', 'keterangan_kas.id')
//         ->select('kas_operasional.*', 'keterangan_kas.keterangan as keterangan')
//         ->whereYear('kas_operasional.tanggal', $year)
//         ->whereMonth('kas_operasional.tanggal', $month)
//         ->orderBy('kas_operasional.tanggal', 'asc')
//         ->get();

//     // Kelompokkan data berdasarkan bulan dan tahun
//     $dataByMonth = $data->groupBy(function ($item) {
//         return \Carbon\Carbon::parse($item->tanggal)->format('F Y');
//     });

//     $kotakAmal = KasOperasional::select('tanggal', 'nominal')
//         ->where('keterangan_id', 17)
//         ->whereYear('tanggal', $year)
//         ->whereMonth('tanggal', $month)
//         ->get()
//         ->groupBy('tanggal');

//     $pengeluaran = KasOperasional::select('keterangan_kas.keterangan as keterangan',
//         DB::raw('DATE_FORMAT(kas_operasional.tanggal, "%M %Y") as bulan'))
//         ->join('keterangan_kas', 'kas_operasional.keterangan_id', '=', 'keterangan_kas.id')
//         ->where('jenis', 'pengeluaran')
//         ->whereYear('kas_operasional.tanggal', $year)
//         ->whereMonth('kas_operasional.tanggal', $month)
//         ->get()
//         ->groupBy('bulan');

//     $penerimaan = KasOperasional::select('keterangan_kas.keterangan as keterangan',
//         DB::raw('DATE_FORMAT(kas_operasional.tanggal, "%M %Y") as bulan'))
//         ->join('keterangan_kas', 'kas_operasional.keterangan_id', '=', 'keterangan_kas.id')
//         ->where('jenis', 'penerimaan')
//         ->whereYear('kas_operasional.tanggal', $year)
//         ->whereMonth('kas_operasional.tanggal', $month)
//         ->get()
//         ->groupBy('bulan');

//     return view('admin.kasOperasional.printByMonth', compact(
//         'data', 'dataByMonth', 'kotakAmal', 'pengeluaran', 'penerimaan'
//     ));
// }

    public function index()
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

        // filter
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
        
        return view('admin.kasOperasional.index',compact('data','keterangan','takenDates','takenDatesWithKeterangan'
    ,'jenis','availableMonthsYears','dataByMonthFilter',
                'availableMonthsYears',
                'tahun',
                'bulan',
                'saldoAwalBulan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function exportPdf(Request $request)
    {
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        // filter
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

        // Ambil data berdasarkan filter tahun & bulan
        // (Gunakan logika yang sama seperti di view Anda)
        $data = KasOperasional::whereYear('tanggal', $tahun)
                              ->whereMonth('tanggal', $bulan)
                              ->get();

        // Load view khusus untuk PDF
        $pdf = Pdf::loadView('admin.kasOperasional.pdf', compact('data', 'tahun', 'bulan','dataByMonthFilter', 
    'saldoAwalBulan'))
                  ->setPaper('a4', 'landscape'); // Atur orientasi ke landscape jika tabel lebar
        
        $namaBulan = \Carbon\Carbon::create($tahun, $bulan, 1)->translatedFormat('F');
        return $pdf->download('Laporan_Keuangan_'.$namaBulan.'_'.$tahun.'.pdf');
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table('kas_operasional')->insert([
            'keterangan_id'=> $request->keterangan_id,
            'tanggal'=>$request->tanggal,
            'jenis'=>$request->jenis,
            'nominal'=>$request->nominal,
        ]);
        return redirect('admin/kas_operasional')->with('success', 'Berhasil Menambahkan Data');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = KasOperasional::find($id);
        $data->keterangan_id = $request->keterangan_id;
        $data->tanggal = $request->tanggal;
        $data->jenis = $request->jenis;
        $data->nominal = $request->nominal;
        $data->save();
        return redirect('admin/kas_operasional')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = KasOperasional::findOrFail($id);
        $data->delete();
        return redirect('admin/kas_operasional')->with('success', 'Berhasil Menghapus Data');
    }


    public function print()
{
    // Ambil semua data kas operasional dengan join ke tabel keterangan_kas
    $data = KasOperasional::join('keterangan_kas', 'kas_operasional.keterangan_id', '=', 'keterangan_kas.id')
    ->select('kas_operasional.*', 'keterangan_kas.keterangan as keterangan')
    ->orderBy('kas_operasional.tanggal', 'asc')
    ->get();


    // Kelompokkan data berdasarkan bulan dan tahun
    $dataByMonth = $data->groupBy(function ($item) {
        return \Carbon\Carbon::parse($item->tanggal)->format('F Y');
    });

    // Ambil data khusus Penerimaan Kotak Amal
    $kotakAmal = KasOperasional::select('tanggal', 'nominal')
    ->where('keterangan_id', 17) // ID keterangan untuk "Kotak Amal", sesuaikan dengan database Anda
    ->get()
    ->groupBy('tanggal');

    // $pengeluaran = KasOperasional::select('keterangan_kas.keterangan as keterangan', )
    //  ->join('keterangan_kas', 'kas_operasional.keterangan_id', '=', 'keterangan_kas.id')
    //  ->where('jenis','pengeluaran')
    //  ->get()
    //  ->groupBy('tanggal')
    //  ;
     $pengeluaran = KasOperasional::select('keterangan_kas.keterangan as keterangan', 
     DB::raw('DATE_FORMAT(kas_operasional.tanggal, "%M %Y") as bulan'))
     ->join('keterangan_kas', 'kas_operasional.keterangan_id', '=', 'keterangan_kas.id')
     ->where('jenis','pengeluaran')
     ->get()
     ->groupBy('bulan')
     ;

     $penerimaan = KasOperasional::select('keterangan_kas.keterangan as keterangan', 
     DB::raw('DATE_FORMAT(kas_operasional.tanggal, "%M %Y") as bulan'))
     ->join('keterangan_kas', 'kas_operasional.keterangan_id', '=', 'keterangan_kas.id')
     ->where('jenis','penerimaan')
     ->get()
     ->groupBy('bulan')
     ;

    

    return view('admin.kasOperasional.print', compact('data','dataByMonth', 'kotakAmal',
    'pengeluaran','penerimaan'));
}



}

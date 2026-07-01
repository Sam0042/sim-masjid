<?php

namespace App\Http\Controllers;

use App\Models\Imam;
use App\Models\ImamFardhu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImamFardhuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ImamFardhu::join('imam','imam_id','=','imam.id')
        ->select('imam_fardhu.*','imam.nama as nama')
        ->orderBy('imam_fardhu.tanggal', 'asc')
        ->get();
        $imam = Imam::all();
        $takenDates = ImamFardhu::whereDate('tanggal', '>=', Carbon::today())
        ->pluck('tanggal')
        ->toArray();
        $waktu = ['Subuh','Dzuhur','Ashar','Maghrib','Isya'];
        $takenSchedules = ImamFardhu::select('tanggal', 'waktu')->get()->toArray();

        return view('admin.imamFardhu.index',compact('data','imam','takenDates','waktu',
    'takenSchedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // DB::table('imam_fardhu')->insert([
        //     'imam_id'=> $request->imam_id,
        //     'tanggal'=>$request->tanggal,
        //     'waktu' =>$request->waktu
        // ]);

        // return redirect('admin/imamFardhu')->with('success', 'Berhasil Menambahkan Data');
         // Validasi input form
         $request->validate([
            'imam_id' => 'required',
            'tanggal' => 'required|date',
            'waktu' => 'required',
        ]);
    
        // Cek apakah kombinasi tanggal dan waktu sudah ada
        $exists = ImamFardhu::where('tanggal', $request->tanggal)
                            ->where('waktu', $request->waktu)
                            ->exists();
    
        if ($exists) {
            return back()->withErrors(['Jadwal untuk tanggal dan waktu ini sudah ada. Silakan pilih waktu lain.']);
        }
    
        // Jika tidak ada konflik, simpan jadwal
        ImamFardhu::create($request->all());
        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan');
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
        // $data = ImamFardhu::find($id);
        // $data->imam_id = $request->imam_id;
        // $data->tanggal = $request->tanggal;
        // $data->waktu = $request->waktu;
        // $data->save();
        // return redirect('admin/imamFardhu');
        
        // Validasi input
        $request->validate([
            'imam_id' => 'required',
            'tanggal' => 'required|date',
            'waktu' => 'required',
        ]);

        // Cek apakah kombinasi tanggal dan waktu sudah ada (selain untuk jadwal yang sedang diupdate)
        $exists = ImamFardhu::where('tanggal', $request->tanggal)
                            ->where('waktu', $request->waktu)
                            ->where('id', '!=', $id) // Mengecualikan jadwal yang sedang diupdate
                            ->exists();

        if ($exists) {
            return back()->withErrors(['Jadwal untuk tanggal dan waktu ini sudah ada. Silakan pilih waktu lain.']);
        }

        // Jika tidak ada konflik, update data
        $data = ImamFardhu::findOrFail($id);
        $data->imam_id = $request->imam_id;
        $data->tanggal = $request->tanggal;
        $data->waktu = $request->waktu;
        $data->save();

        return redirect('admin/imamFardhu')->with('success', 'Jadwal berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = ImamFardhu::findOrFail($id);
        $data->delete();
        return redirect('admin/imamFardhu')->with('success', 'Berhasil Menghapus Data');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\KhotibMuazin;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;


class KhotibMuazinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $data = KhotibMuazin::all();
        $takenDates = KhotibMuazin::whereDate('tanggal', '>=', Carbon::today())
        ->pluck('tanggal')
        ->toArray();
        return view('admin.khotibMuazin.index',compact('data','takenDates'));
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
        DB::table('khotib_muazins')->insert([
            'khotib'=> $request->khotib,
            'muazin'=> $request->muazin,
            'no_hp'=> $request->no_hp,
            'tanggal'=>$request->tanggal
        ]);

        return redirect('admin/khotibMuazin')->with('success', 'Berhasil Menambahkan Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(KhotibMuazin $khotibMuazin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KhotibMuazin $khotibMuazin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = KhotibMuazin::find($id);
        $data->khotib = $request->khotib;
        $data->muazin = $request->muazin;
        $data->no_hp = $request->no_hp;
        $data->tanggal = $request->tanggal;
        $data->save();
        return redirect('admin/khotibMuazin')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = KhotibMuazin::findOrFail($id);
        $data->delete();
        return redirect('admin/khotibMuazin')->with('success', 'Berhasil Menghapus Data');
    }
}

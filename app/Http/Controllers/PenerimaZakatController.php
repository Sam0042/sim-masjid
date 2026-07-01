<?php

namespace App\Http\Controllers;

use App\Models\PenerimaZakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerimaZakatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PenerimaZakat::all();
        return view('admin.penerimaZakat.index',compact('data'));
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
        DB::table('penerima_zakats')->insert([
            'nama'=> $request->nama,
            'usia'=> $request->usia,
            'jenis_kelamin'=> $request->jenis_kelamin,
            'keterangan'=> $request->keterangan,
            'alamat'=> $request->alamat,

        ]);

        return redirect('admin/penerima_zakat')->with('success', 'Berhasil Menambahkan Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(PenerimaZakat $penerimaZakat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenerimaZakat $penerimaZakat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = PenerimaZakat::find($id);
        $data->nama = $request->nama;
        $data->usia = $request->usia;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->keterangan = $request->keterangan;
        $data->alamat = $request->alamat;
        $data->save();
        return redirect('admin/penerima_zakat')->with('success', 'Data berhasil diperbarui');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = PenerimaZakat::findOrFail($id);
        $data->delete();

        return redirect('admin/penerima_zakat')->with('success', 'Berhasil Menghapus Data');
    }
}

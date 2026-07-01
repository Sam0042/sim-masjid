<?php

namespace App\Http\Controllers;

use App\Models\KeteranganKas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeteranganKasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = KeteranganKas::all();
        return view('admin.keteranganKas.index',compact('data'));
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
        $data = KeteranganKas::create([
        'keterangan' => $request->keterangan,
    ]);

        return redirect('admin/keterangan_kas')->with('success', 'Berhasil Menambahkan Data');
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
        $data = KeteranganKas::find($id);
        $data->keterangan = $request->keterangan;
        $data->save();
        return redirect('admin/keterangan_kas')->with('success', 'Data berhasil diperbarui');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = KeteranganKas::findOrFail($id);
        $data->delete();

        return redirect('admin/keterangan_kas')->with('success', 'Berhasil Menghapus Data');
    }
}

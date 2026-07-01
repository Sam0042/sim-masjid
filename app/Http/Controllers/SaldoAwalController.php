<?php

namespace App\Http\Controllers;

use App\Models\SaldoAwal;
use Illuminate\Http\Request;

class SaldoAwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SaldoAwal::first();

        return view('admin.saldoAwal.index', compact('data'));
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
    {           }

    /**
     * Display the specified resource.
     */
    public function show(SaldoAwal $saldoAwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaldoAwal $saldoAwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = SaldoAwal::findOrFail($id);
        $data->nominal = $request->nominal;
        $data->updated_at = now();
        $data->save();

        return redirect('admin/saldo-awal')
        ->with('success', 'Saldo Awal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaldoAwal $saldoAwal)
    {
        $saldoAwal->delete();

        return back()->with(
            'success',
            'Saldo awal berhasil dihapus'
        );
    }
}
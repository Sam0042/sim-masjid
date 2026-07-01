<?php

namespace App\Http\Controllers;

use App\Models\PenerimaZakat;
use App\Models\ZakatFitrah;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ZakatFitrahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ZakatFitrah::join('penerima_zakats','penerima_id','=','penerima_zakats.id')
        ->select('zakat_fitrahs.*','penerima_zakats.nama as penerima',
        'penerima_zakats.alamat as penerima_alamat', 'penerima_zakats.jenis_kelamin as penerima_jenis_kelamin',
        'penerima_zakats.usia as penerima_usia','penerima_zakats.keterangan as penerima_keterangan')
        ->orderBy('zakat_fitrahs.nama', 'asc')
        ->get();
        $penerima = PenerimaZakat::all();
        
        return view('admin.zakatFitrah.index',compact('data','penerima'));
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
         DB::table('zakat_fitrahs')->insert([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'total_zakat'=>$request->total_zakat,
            'tanggal'=>$request->tanggal,
            'penerima_id'=> $request->penerima_id,
            'status'=>$request->status,
        ]);
        return redirect('admin/zakat_fitrah')->with('success', 'Berhasil Menambahkan Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(ZakatFitrah $zakatFitrah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ZakatFitrah $zakatFitrah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = ZakatFitrah::find($id);
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->total_zakat = $request->total_zakat;
        $data->tanggal = $request->tanggal;
        $data->penerima_id = $request->penerima_id;
        $data->status = $request->status;
        $data->save();
        return redirect('admin/zakat_fitrah')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = ZakatFitrah::findOrFail($id);
        $data->delete();
        return redirect('admin/zakat_fitrah')->with('success', 'Berhasil Menghapus Data');
    }
}

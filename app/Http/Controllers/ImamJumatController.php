<?php

namespace App\Http\Controllers;

use App\Models\Imam;
use App\Models\ImamJumat;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ImamJumatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ImamJumat::join('imam','imam_id','=','imam.id')
        ->select('imam_jumat.*','imam.nama as nama')
        ->orderBy('imam_jumat.tanggal', 'asc')
        ->get();
        $imam = Imam::all();
        $takenDates = ImamJumat::whereDate('tanggal', '>=', Carbon::today())
        ->pluck('tanggal')
        ->toArray();
        
        return view('admin.imamJumat.index',compact('data','imam','takenDates'));
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
        DB::table('imam_jumat')->insert([
            'imam_id'=> $request->imam_id,
            'tanggal'=>$request->tanggal
        ]);

        return redirect('admin/imamJumat')->with('success', 'Berhasil Menambahkan Data');
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
        $data = ImamJumat::find($id);
        $data->imam_id = $request->imam_id;
        $data->tanggal = $request->tanggal;
        $data->save();
        return redirect('admin/imamJumat')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = ImamJumat::findOrFail($id);
        $data->delete();
        return redirect('admin/imamJumat')->with('success', 'Berhasil Menghapus Data');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Agenda::all();
        return view('admin.agenda.index',compact('data'));
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
 
        $request->validate([
            'foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:5120',
        ]);

         $fileName = 'foto-'.uniqid().'.'.$request->foto->extension();
         $request->foto->move(public_path('admin/assets/img/agenda'), $fileName);
        DB::table('agenda')->insert([
            'nama'=> $request->nama,
            'deskripsi'=>$request->deskripsi,
            'tanggal_mulai'=>$request->tanggal_mulai,
            'tanggal_selesai'=>$request->tanggal_selesai,
            'lokasi'=>$request->lokasi,
            'foto'=>$fileName,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('admin/agenda')->with('success', 'Berhasil Menambahkan Data');
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
        // Ambil nama foto lama langsung dengan first() agar tidak perlu foreach
        $fotoLama = DB::table('agenda')->where('id', $id)->value('foto');
    
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if (!empty($fotoLama) && file_exists(public_path('admin/assets/img/agenda/' . $fotoLama))) {
                unlink(public_path('admin/assets/img/agenda/' . $fotoLama));
            }
    
            // Proses upload foto baru
            
            $fileName = time() . '-' . $id . '.' . $request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('admin/assets/img/agenda'), $fileName);
        } else {
            $fileName = $fotoLama; // Tetap gunakan foto lama
        }
    
        // Update data 
        $data = Agenda::findOrFail($id);
        $data->nama = $request->nama;
        $data->deskripsi = $request->deskripsi;
        $data->tanggal_mulai = $request->tanggal_mulai;
        $data->tanggal_selesai = $request->tanggal_selesai;
        $data->lokasi = $request->lokasi;
        $data->foto = $fileName;
        $data->updated_at = now();
        $data->save();
    
        return redirect('admin/agenda')->with('success', 'Agenda berhasil diperbarui.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Agenda::findOrFail($id);
        $data->delete();

        

    
    // Menghapus gambar jika ada
    if ($data->foto) {
        $imagePath = public_path('admin/assets/img/agenda/' . $data->foto);
        if (file_exists($imagePath)) {
            unlink($imagePath); // Menghapus gambar
        }
    }

    // Menghapus data dari database
    $data->delete();

    return redirect('admin/agenda')->with('success', 'Berhasil Menghapus Data');
    
    }
}

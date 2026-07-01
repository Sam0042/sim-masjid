<?php

namespace App\Http\Controllers;

use App\Models\Galeris;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GalerisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $folder = DB::table('folder_galeris')->get();
        $data = Galeris::join('folder_galeris', 'galeris.folder_galeri_id', '=', 'folder_galeris.id')
    ->select('galeris.*', 'folder_galeris.nama as folder')
    ->get(); 

        return view('admin.galeris.foto.index',compact('data','folder'));
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
         $request->foto->move(public_path('admin/assets/img/galeri/foto/'), $fileName);
        DB::table('galeris')->insert([
            'nama'=> $request->nama,
            'foto'=>$fileName,
            'folder_galeri_id'=>$request->folder_galeri_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('admin/galeri')->with('success', 'Berhasil Menambahkan Data');
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

    
    public function update(Request $request, string $id)
{
    $request->validate([
        'nama' => 'required',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        'folder_galeri_id' => 'required',
    ]);

    $data = Galeris::findOrFail($id);

    $fotoLama = $data->foto;

    if ($request->hasFile('foto')) {

        // Hapus foto lama
        if (!empty($fotoLama) && file_exists(public_path('admin/assets/img/galeri/' . $fotoLama))) {
            unlink(public_path('admin/assets/img/galeri/' . $fotoLama));
        }

        // Upload foto baru
        $fileName = time() . '-' . $id . '.' . $request->foto->getClientOriginalExtension();
        $request->foto->move(public_path('admin/assets/img/galeri'), $fileName);

        $data->foto = $fileName;
    }

    $data->nama = $request->nama;
    $data->folder_galeri_id = $request->folder_galeri_id;
    $data->save();

    return redirect('admin/galeri')->with('success', 'Foto berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Galeris::findOrFail($id);
        $data->delete();

        

    
    // Menghapus gambar jika ada
    if ($data->foto) {
        $imagePath = public_path('admin/assets/img/galeri/' . $data->foto);
        if (file_exists($imagePath)) {
            unlink($imagePath); // Menghapus gambar
        }
    }

    // Menghapus data dari database
    $data->delete();

    return redirect('admin/galeri')->with('success', 'Berhasil Menghapus Data');
    
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\FolderGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FolderGaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = DB::table('kategori_galeris')->get();
        $data = FolderGaleri::join('kategori_galeris', 'folder_galeris.kategori_galeri_id', '=', 'kategori_galeris.id')
    ->select('folder_galeris.*', 'kategori_galeris.nama as kategori')
    ->get(); 

        return view('admin.galeris.folder.index',compact('data','kategori'));
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
            'thumbnail' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:5120',
        ]);

         $fileName = 'thumbnail-'.uniqid().'.'.$request->thumbnail->extension();
         $request->thumbnail->move(public_path('admin/assets/img/galeri/folder/'), $fileName);
        DB::table('folder_galeris')->insert([
            'nama'=> $request->nama,
            'thumbnail'=>$fileName,
            'kategori_galeri_id'=>$request->kategori_galeri_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('admin/folder-galeri')->with('success', 'Berhasil Menambahkan Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(FolderGaleri $folderGaleri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FolderGaleri $folderGaleri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $request->validate([
        'nama' => 'required',
        'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        'kategori_galeri_id' => 'required',
    ]);

    $data = FolderGaleri::findOrFail($id);

    // 1. Cek apakah ada file baru yang diunggah
    if ($request->hasFile('thumbnail')) {

        // 2. Hapus foto lama jika ada
        if (!empty($data->thumbnail) && file_exists(public_path('admin/assets/img/galeri/folder/' . $data->thumbnail))) {
            unlink(public_path('admin/assets/img/galeri/folder/' . $data->thumbnail));
        }

        // 3. Upload foto baru
        $file = $request->file('thumbnail');
        $fileName = time() . '-' . $file->getClientOriginalName();
        $file->move(public_path('admin/assets/img/galeri/folder/'), $fileName);

        // 4. Update nama file ke kolom thumbnail
        $data->thumbnail = $fileName;
    }

    // 5. Update field lainnya
    $data->nama = $request->nama;
    $data->kategori_galeri_id = $request->kategori_galeri_id;
    
    // Simpan perubahan
    $data->save();

    return redirect('admin/folder-galeri')->with('success', 'Foto berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = FolderGaleri::findOrFail($id);
        $data->delete();

        

    
    // Menghapus gambar jika ada
    if ($data->thumbnail) {
        $imagePath = public_path('admin/assets/img/galeri/folder/' . $data->thumbnail);
        if (file_exists($imagePath)) {
            unlink($imagePath); // Menghapus gambar
        }
    }

    // Menghapus data dari database
    $data->delete();

    return redirect('admin/folder-galeri')->with('success', 'Berhasil Menghapus Data');
    
    }
}

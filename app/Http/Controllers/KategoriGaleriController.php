<?php

namespace App\Http\Controllers;

use App\Models\KategoriGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class KategoriGaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = KategoriGaleri::all();
        return view('admin.galeris.kategori.index',compact('data'));
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
        $request->thumbnail->move(public_path('admin/assets/img/galeri/kategori/'), $fileName);

        DB::table('kategori_galeris')->insert([
            'nama'=> $request->nama,
            'thumbnail'=>$fileName,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('admin/kategori-galeri')->with('success', 'Berhasil Menambahkan Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriGaleri $kategoriGaleri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriGaleri $kategoriGaleri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
    ]);

        $data = KategoriGaleri::findOrFail($id);

        // 1. Cek apakah ada file baru yang diunggah
    if ($request->hasFile('thumbnail')) {

        // 2. Hapus foto lama jika ada
        if (!empty($data->thumbnail) && file_exists(public_path('admin/assets/img/galeri/kategori/' . $data->thumbnail))) {
            unlink(public_path('admin/assets/img/galeri/kategori/' . $data->thumbnail));
        }

        // 3. Upload foto baru
        $file = $request->file('thumbnail');
        $fileName = time() . '-' . $file->getClientOriginalName();
        $file->move(public_path('admin/assets/img/galeri/kategori/'), $fileName);

        // 4. Update nama file ke kolom thumbnail
        $data->thumbnail = $fileName;
    }

        $data->nama = $request->nama;
        $data->save();
        return redirect('admin/kategori-galeri')->with('success', 'Data berhasil diperbarui');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = KategoriGaleri::findOrFail($id);
        $data->delete();

        return redirect('admin/kategori-galeri')->with('success', 'Berhasil Menghapus Data');
    }
}

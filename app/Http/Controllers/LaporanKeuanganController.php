<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LaporanKeuangan;

class LaporanKeuanganController extends Controller
{
    public function index()
    {
        $data = LaporanKeuangan::all();
        return view('admin.laporan.index', compact('data'));
    }

    public function create()
    {
        return view('admin.laporan.create');
    }

    public function store(Request $request)
    {
          $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'file_pdf' => 'required|mimes:pdf|max:2048'
        ]);

         $fileName = 'pdf-'.uniqid().'.'.$request->file_pdf->extension();
         $request->file_pdf->move(public_path('admin/assets/pdf/laporankas'), $fileName);
        DB::table('laporan_keuangan')->insert([
            'bulan'=> $request->bulan,
            'tahun'=> $request->tahun,
            'file_pdf'=>$fileName,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('admin/laporan')->with('success', 'Berhasil Menambahkan Data');
    }

    public function update(Request $request, string $id)
    {
         // Ambil nama file lama langsung dengan first() agar tidak perlu foreach
        $fileLama = DB::table('laporan_keuangan')->where('id', $id)->value('file_pdf');
    
        if ($request->hasFile('file_pdf')) {
            // Hapus file lama jika ada
            if (!empty($fileLama) && file_exists(public_path('admin/assets/pdf/laporankas/' . $fileLama))) {
                unlink(public_path('admin/assets/pdf/laporankas/' . $fileLama));
            }
    
            // Proses upload file baru
            $fileName = 'pdf-' . $id . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('admin/assets/pdf/laporankas/'), $fileName);
        } else {
            $fileName = $fileLama; // Tetap gunakan file lama
        }
    
        // Update data file
        $data = LaporanKeuangan::findOrFail($id);
        $data->bulan = $request->bulan;
        $data->tahun = $request->tahun;
        $data->file_pdf = $fileName;
        $data->updated_at = now();
        $data->save();
    
        return redirect('admin/laporan')->with('success', 'file berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $data = LaporanKeuangan::findOrFail($id);
        $data->delete();

        

    
    // Menghapus gambar jika ada
    if ($data->file_pdf) {
        $filePath = public_path('admin/assets/pdf/laporankas/' . $data->file_pdf);
        if (file_exists($filePath)) {
            unlink($filePath); // Menghapus gambar
        }
    }

    // Menghapus data dari database
    $data->delete();

    return redirect('admin/laporan')->with('success', 'Berhasil Menghapus Data');
    
    }
}

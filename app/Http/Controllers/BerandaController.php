<?php

namespace App\Http\Controllers;

use App\Models\FolderGaleri;
use App\Models\Galeris;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\JenisProduk;
use App\Models\KategoriGaleri;
use App\Models\KhotibMuazin;
use App\Models\Agenda;
use DB; 
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

Carbon::setLocale('id');

class BerandaController extends Controller
{
    //
    public function index()
{
    $kota = 1204; // KabBogor
    $tanggal = date('Y-m-d'); // otomatis ambil hari ini

    $url = "https://api.myquran.com/v2/sholat/jadwal/{$kota}/{$tanggal}";
    $response = Http::get($url);

    $jadwal = null;
    $tanggalFormat = Carbon::parse($tanggal)->translatedFormat('l, d F Y');

    if ($response->successful()) {
        $data = $response->json();
        $jadwal = $data['data']['jadwal'];

        // format tanggal jadi: Kamis, 11 September 2025
        $tanggalFormat = \Carbon\Carbon::parse($tanggal)
            ->translatedFormat('l, d F Y');
    }

    $relatedAgenda = Agenda::orderBy('tanggal_mulai', 'asc')
    ->take(5)
    ->get();

    $relatedJumat = KhotibMuazin::orderBy('tanggal', 'asc')
    ->take(4)
    ->get();

    $relatedGaleri = Galeris ::orderBy('nama', 'desc')
    ->take(4)
    ->get();


    return view('admin.beranda', compact('jadwal', 'tanggalFormat','relatedAgenda','relatedGaleri','relatedJumat'));
}

   
}

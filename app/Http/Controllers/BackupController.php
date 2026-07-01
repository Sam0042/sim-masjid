<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function index()
{
    $path = storage_path('app/backup-temp/*.sql');
    $files = glob($path);

    // Mengurutkan file berdasarkan waktu perubahan (filemtime)
    // usort akan membandingkan dua file (a dan b) berdasarkan waktu mereka
    usort($files, function ($a, $b) {
        return filemtime($b) - filemtime($a); // $b - $a = Descending (terbaru ke terlama)
    });

    return view('admin.backup.index', compact('files'));
}

    public function run()
{
    // 1. Tentukan lokasi file backup
    $fileName = 'backup-' . date('Y-m-d_H-i-s') . '.sql';
    // Pastikan folder ini ada. Jika tidak, akan dibuat otomatis
    $path = storage_path('app/backup-temp/' . $fileName);

    // 2. Tentukan Path ke mysqldump (SESUAIKAN DENGAN LOKASI XAMPP ANDA)
    // Jika Anda pakai XAMPP standar, biasanya ada di sini:
    $dumpPath = 'C:\xampp\mysql\bin\mysqldump.exe'; 
    
    // 3. Susun perintah
    $command = "\"$dumpPath\" --user=" . env('DB_USERNAME') . 
               " --password=" . env('DB_PASSWORD') . 
               " " . env('DB_DATABASE') . " > \"$path\"";

    // 4. Eksekusi
    $output = [];
    $resultCode = 0;
    exec($command, $output, $resultCode);

    // 5. Cek apakah berhasil
    if ($resultCode === 0) {
        return back()->with('success', 'Backup berhasil! File: ' . $fileName);
    } else {
        return back()->with('error', 'Gagal Backup. Pastikan path mysqldump benar.');
    }
}

    

    public function download($fileName)
{
    $path = storage_path('app/backup-temp/' . $fileName);
    return response()->download($path);
}
}
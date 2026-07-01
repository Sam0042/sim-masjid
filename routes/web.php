<?php

use App\Http\Controllers\AgendaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\FolderGaleriController;
use App\Http\Controllers\FrontGalerisController;
use App\Http\Controllers\FrontJumatController;
use App\Http\Controllers\FrontKeuanganController;
use App\Http\Controllers\FrontProfilController;
use App\Http\Controllers\FrontAgendaController;
use App\Http\Controllers\GalerisController;
use App\Http\Controllers\KasOperasionalController;
use App\Http\Controllers\KategoriGaleriController;
use App\Http\Controllers\KeteranganKasController;
use App\Http\Controllers\KhotibMuazinController;


use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SaldoAwalController;

//untuk guest
Route::get('/', [BerandaController::class, 'index']);
Route::resource('front-agenda',FrontAgendaController::class);
Route::resource('front-galeri',FrontGalerisController::class);
Route::get('/galeri/kategori/{id}',[FrontGalerisController::class, 'kategori'])->name('front-galeri.kategori');
Route::get('/galeri/folder/{id}',[FrontGalerisController::class, 'showFolder'])->name('front-galeri.folder');
Route::resource('front-keuangan',FrontKeuanganController::class);
Route::get('/agenda/{id}', [FrontAgendaController::class, 'show'])->name('agenda.show');
Route::resource('/profil',FrontProfilController::class);
Route::resource('/front-jumat',FrontJumatController::class);
Route::get('/kas-operasional', [FrontKeuanganController::class, 'index']);

Route::group(['middleware' => ['auth', 'checkActive', 'role:ketua|ubudiyah|bendahara']], function(){
    Route::prefix('admin')->group(function(){
        Route::resource('dashboard', DashboardController::class);
    });
});


// ubudiyah
Route::group(['middleware' => ['auth', 'checkActive', 'role:ubudiyah|ketua']], function(){
    Route::prefix('admin')->group(function(){
        Route::resource('agenda',AgendaController::class);
        Route::resource('galeri',GalerisController::class);
        Route::resource('kategori-galeri',KategoriGaleriController::class);
        Route::resource('folder-galeri',FolderGaleriController::class);
        Route::resource('khotibMuazin',KhotibMuazinController::class);
    }); 
});

// bendahara
Route::group(['middleware' => ['auth', 'checkActive', 'role:bendahara|ketua']], function(){
    Route::prefix('admin')->group(function(){
        Route::resource('saldo-awal',SaldoAwalController::class);
        Route::resource('kas_operasional',KasOperasionalController::class);
        Route::resource('keterangan_kas',KeteranganKasController::class);
        Route::get('/export-pdf', [KasOperasionalController::class, 'exportPdf'])->name('kas.export.pdf');
        Route::get('/kas-operasional', [FrontKeuanganController::class, 'index']);
    }); 
});

// ketua
Route::group(['middleware' => ['auth', 'checkActive', 'role:ketua']], function(){
        Route::prefix('admin')->group(function(){
        Route::resource('ketua-profil',ProfilController::class);
    }); 
});

Auth::routes();




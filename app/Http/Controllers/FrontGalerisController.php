<?php

namespace App\Http\Controllers;

use App\Models\Galeris;
use App\Models\KategoriGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FrontGalerisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $data = KategoriGaleri::orderBy('id', 'asc')->paginate(4);
        $thumbnail = DB::table('folder_galeris')->first();
        return view('front.galeris.index',compact('data','thumbnail'));
        
    }

    public function kategori($id)
{
    $kategoris = DB::table('kategori_galeris')
        ->where('id', $id)
        ->first();
    $data = DB::table('folder_galeris')
    ->leftJoin('galeris', 'folder_galeris.id', '=', 'galeris.folder_galeri_id')
    ->where('folder_galeris.kategori_galeri_id', $id)
    ->select(
        'folder_galeris.id',
        'folder_galeris.nama',
        'folder_galeris.thumbnail',

        DB::raw('COUNT(galeris.id) as jumlah_foto')
    )

    ->groupBy(
        'folder_galeris.id',
        'folder_galeris.nama',
        'folder_galeris.thumbnail'
    )

    ->paginate(4);

    return view('front.galeris.kategori', compact('data','kategoris'));
}

public function showFolder($id)
{
    $data = DB::table('galeris')
        ->where('folder_galeri_id', $id)
        ->paginate(8);

    $folder = DB::table('folder_galeris')
        ->where('id', $id)
        ->first();

    $kategoris = DB::table('kategori_galeris')
        ->where('id', $folder->kategori_galeri_id)
        ->first();

    return view('front.galeris.show',
        compact('data', 'folder', 'kategoris'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
             // cari data agenda berdasarkan ID
    $galeris = \App\Models\Galeris::findOrFail($id);

    // ambil agenda random selain yg sedang dilihat
    $related = Galeris::where('id', '!=', $id)
                    ->inRandomOrder()
                    ->take(4)
                    ->get();
    
    // lempar data ke view
    return view('front.galeris.show', compact('galeris','related'));
   
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

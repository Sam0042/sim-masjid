<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Profil::all();
        return view('admin.profil.index',compact('data'));
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
    /*
    |--------------------------------------------------------------------------
    | FOTO SEJARAH
    |--------------------------------------------------------------------------
    */

    $fotoSejarahLama = DB::table('profils')
        ->where('id', $id)
        ->value('foto_sejarah');

    $fotoSejarah = $fotoSejarahLama;

    if ($request->hasFile('foto_sejarah')) {

        if (
            !empty($fotoSejarahLama) &&
            file_exists(public_path('admin/assets/img/sejarah/' . $fotoSejarahLama))
        ) {

            unlink(public_path('admin/assets/img/sejarah/' . $fotoSejarahLama));
        }

        $fotoSejarah = 'foto_sejarah.' .
            $request->foto_sejarah->getClientOriginalExtension();

        $request->foto_sejarah->move(
            public_path('admin/assets/img/sejarah'),
            $fotoSejarah
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FOTO STRUKTUR
    |--------------------------------------------------------------------------
    */

    $fotoStrukturLama = DB::table('profils')
        ->where('id', $id)
        ->value('foto_struktur');

    $fotoStruktur = $fotoStrukturLama;

    if ($request->hasFile('foto_struktur')) {

        if (
            !empty($fotoStrukturLama) &&
            file_exists(public_path('admin/assets/img/struktur/' . $fotoStrukturLama))
        ) {

            unlink(public_path('admin/assets/img/struktur/' . $fotoStrukturLama));
        }

        $fotoStruktur = 'foto_struktur.' .
            $request->foto_struktur->getClientOriginalExtension();

        $request->foto_struktur->move(
            public_path('admin/assets/img/struktur'),
            $fotoStruktur
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE DATA
    |--------------------------------------------------------------------------
    */

    $data = Profil::findOrFail($id);

    $data->sejarah = $request->sejarah;
    $data->visi = $request->visi;
    $data->misi = $request->misi;

    $data->alamat = $request->alamat;
    $data->telepon = $request->telepon;

    $data->instagram = $request->instagram;

    $data->foto_sejarah = $fotoSejarah;
    $data->foto_struktur = $fotoStruktur;

    $data->updated_at = now();

    $data->save();

    return redirect('admin/ketua-profil')
        ->with('success', 'Profil berhasil diperbarui.');
}

    public function destroy(string $id)
    {
        //
    }
}

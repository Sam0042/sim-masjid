<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ProfilController;
use App\Models\Profil;
use Illuminate\Http\Request;

class FrontProfilController extends Controller
{
    public function index()
    {
        $data = Profil::all();
        return view('front.profil.index',compact('data'));
    }
}

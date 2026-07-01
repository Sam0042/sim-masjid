<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index()
    {
        $data = Profil::all();
        return view('front.profil.indexf',compact('data'));
    }
}

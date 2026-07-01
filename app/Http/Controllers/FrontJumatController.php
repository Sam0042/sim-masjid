<?php

namespace App\Http\Controllers;

use App\Models\KhotibMuazin;
use Illuminate\Http\Request;

class FrontJumatController extends Controller
{
    public function index()
    {
        $data = KhotibMuazin::orderBy('tanggal', 'asc')->get();
        return view('front.jumat.index',compact('data'));
    }
}

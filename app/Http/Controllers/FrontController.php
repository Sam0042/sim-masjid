<?php

namespace App\Http\Controllers;

use App\Models\ImamJumat;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function imamJumat()
{
    $data = ImamJumat::join('imam', 'imam_id', '=', 'imam.id')
        ->select('imam_jumat.*', 'imam.nama as nama')
        ->orderBy('imam_jumat.tanggal', 'asc') // Mengurutkan berdasarkan tanggal, 'asc' berarti ascending (terlama ke terbaru)
        ->get();
    return view('front.imamJumat.index', compact('data'));
}

}

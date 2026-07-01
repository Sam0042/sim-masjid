<?php

namespace App\Http\Controllers;

use App\Models\Imam;
use App\Models\ImamFardhu;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontImamFardhuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ImamFardhu::join('imam','imam_id','=','imam.id')
        ->select('imam_fardhu.*','imam.nama as nama')
        ->orderBy('imam_fardhu.tanggal', 'asc')
        ->get();
        $imam = Imam::all();
        $takenDates = ImamFardhu::whereDate('tanggal', '>=', Carbon::today())
        ->pluck('tanggal')
        ->toArray();
        $waktu = ['Subuh','Dzuhur','Ashar','Maghrib','Isya'];
        $takenSchedules = ImamFardhu::select('tanggal', 'waktu')->get()->toArray();

        return view('front.imamFardhu.index',compact('data','imam','takenDates','waktu',
    'takenSchedules'));
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

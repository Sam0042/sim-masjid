<?php

namespace App\Http\Controllers;


use App\Models\Agenda;
use Illuminate\Http\Request;

class FrontAgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Agenda::orderBy('tanggal_mulai', 'asc')->paginate(8);

        $relatedAgenda = Agenda::orderBy('tanggal_mulai', 'asc')
    ->take(5)
    ->get();
        return view('front.agenda.index',compact('data','relatedAgenda'));
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
    $agenda = \App\Models\Agenda::findOrFail($id);

    // ambil agenda random selain yg sedang dilihat
    $related = Agenda::where('id', '!=', $id)
                    ->inRandomOrder()
                    ->take(4)
                    ->get();
    
    // lempar data ke view
    return view('front.agenda.show', compact('agenda','related'));
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

<?php

namespace App\Http\Controllers;

use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function index()
    {
        // Mengambil semua log terbaru
        $activities = Activity::latest()->paginate(20);
        return view('admin.logs.index', compact('activities'));
    }
}
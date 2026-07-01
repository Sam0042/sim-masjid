<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions; // Wajib di-import

class KeteranganKas extends Model
{
    use HasFactory;

    protected $fillable = ['keterangan'];


    public function kasOperasional()
    {
        return $this->hasMany(KasOperasional::class, 'keterangan_kas_id');
    }
}
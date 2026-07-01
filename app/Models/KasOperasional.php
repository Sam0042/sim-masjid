<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasOperasional extends Model
{
    use HasFactory;

    protected $table = 'kas_operasional';

    public function keteranganKas(){
        return $this->belongsTo(KeteranganKas::class);
    }
}

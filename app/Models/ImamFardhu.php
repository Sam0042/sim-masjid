<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImamFardhu extends Model
{
    use HasFactory;

    protected $table = 'imam_fardhu';
    protected $fillable = ['imam_id','tanggal','waktu'];

    public function imam(){
        return $this->belongsTo(Imam::class);
    }
}

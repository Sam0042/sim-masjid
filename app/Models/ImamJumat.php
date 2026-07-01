<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImamJumat extends Model
{
    use HasFactory;

    protected $table = 'imam_jumat';
    protected $fillable = ['imam_id','tanggal'];

    public function imam(){
        return $this->belongsTo(Imam::class);
    }
}

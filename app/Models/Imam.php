<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imam extends Model
{
    use HasFactory;
    protected $table = 'imam';

    protected $fillable = ['nama'];

    public function imamJumat()
    {
        return $this->hasMany(ImamJumat::class);
    }


    public function imamFardhu()
    {
        return $this->hasMany(ImamFardhu::class);
    }

}

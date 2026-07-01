<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaZakat extends Model
{
    use HasFactory;
    
    protected $table = 'penerima_zakats';

    protected $fillable = ['nama','usia','jenis_kelamin','keterangan','alamat'];

    public function zakatFitrah()
    {
        return $this->hasMany(ZakatFitrah::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZakatFitrah extends Model
{
    use HasFactory;

    protected $table = 'zakat_fitrahs';

    protected $fillable = ['nama','alamat','total_zakat','tanggal','penerima_id','status'];

    public function penerimaZakat(){
        return $this->belongsTo(PenerimaZakat::class);
    }
}

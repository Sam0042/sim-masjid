<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhotibMuazin extends Model
{
    use HasFactory;

    protected $table = 'khotib_muazins';

    protected $fillable = ['khotib','muazin','no_hp','tanggal'];
}

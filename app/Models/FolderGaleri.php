<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FolderGaleri extends Model
{
    use HasFactory;
    protected $table = 'folder_galeris';
    public function kategori()
{
    return $this->belongsTo(KategoriGaleri::class);
}

}

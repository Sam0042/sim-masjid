<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdukResource extends JsonResource
{
    public $status;
    public $message;
    public function __construct($status,$message){
        $this->status = $status;
        $this->message = $message;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => [
                'id' => $this->id,
                'kode' => $this->kode,
                'nama' => $this->nama,
                'harga_beli' => $this->harga_beli,
                'harga_jual' => $this->harga_jual,
                'stok' => $this->stok,
                'min_stok' => $this->min_stok,
                'jenis_produk_id' => $this->jenis_produk_id,
                'foto' => $this->foto,
                'jenis' => $this->jenis_produk->nama
            ],
        ];
    }
}

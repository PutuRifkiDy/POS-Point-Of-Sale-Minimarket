<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PembelianDetail extends Model
{
    use HasFactory;

    protected $table = "pembelian_detail";
    protected $primaryKey = "id_pembelian_detail";
    protected $guarded = [];

    public function produk(){
        return $this->hasOne(Produk::class, 'id_produk', 'id_produk');
    }
}

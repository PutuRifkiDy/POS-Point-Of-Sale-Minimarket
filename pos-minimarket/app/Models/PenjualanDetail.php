<?php

namespace App\Models;

use App\Models\Member;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    use HasFactory;

    protected $table = "penjualan_detail";
    protected $primaryKey = "id_penjualan_detail";
    protected $guarded = [];

    public function produk(){
        return $this->hasOne(Produk::class, 'id_produk', 'id_produk');
    }

}

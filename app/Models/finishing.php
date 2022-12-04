<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class finishing extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function detail_produk()
    {
        return $this->hasMany(detail_produk::class);
    }

    public function scopeCreateID()
    {
        $jumlah_produk = finishing::max('id');

        if ($jumlah_produk >= 99) {
            $idproduk = "F-".($jumlah_produk+1);
        }
        else if ($jumlah_produk >= 9) {
            $idproduk = "F-0".($jumlah_produk+1);
        }
        else {
            $idproduk = "F-00".($jumlah_produk+1);
        }
        return $idproduk;
    }
}

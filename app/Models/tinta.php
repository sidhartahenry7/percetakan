<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tinta extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function detail_produk()
    {
        return $this->hasMany(detail_produk::class);
    }

    public function detail_tinta()
    {
        return $this->hasMany(detail_tinta::class);
    }


    public function scopeCreateID()
    {
        $jumlah_produk = tinta::max('id');

        if ($jumlah_produk >= 99) {
            $idproduk = "T-".($jumlah_produk+1);
        }
        else if ($jumlah_produk >= 9) {
            $idproduk = "T-0".($jumlah_produk+1);
        }
        else {
            $idproduk = "T-00".($jumlah_produk+1);
        }
        return $idproduk;
    }
}

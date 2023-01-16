<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function detail_produk()
    {
        return $this->hasMany(detail_produk::class);
    }

    public function stok_cabang()
    {
        return $this->hasMany(stok_cabang::class);
    }

    public function detail_pembelian_bahan()
    {
        return $this->hasMany(detail_pembelian_bahan::class);
    }

    public function kartu_stok_bahan()
    {
        return $this->hasMany(kartu_stok_bahan::class);
    }

    public function scopeCreateID()
    {
        $jumlah_produk = produk::max('id');

        if ($jumlah_produk >= 99) {
            $idproduk = "PRO-".($jumlah_produk+1);
        }
        else if ($jumlah_produk >= 9) {
            $idproduk = "PRO-0".($jumlah_produk+1);
        }
        else {
            $idproduk = "PRO-00".($jumlah_produk+1);
        }
        return $idproduk;
    }
}

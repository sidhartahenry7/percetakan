<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_produk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function detail_transaksi()
    {
        return $this->hasMany(detail_transaksi::class);
    }

    public function kategori()
    {
        return $this->belongsTo(kategori::class);
    }

    public function detail_produk_bahan()
    {
        return $this->hasMany(detail_produk_bahan::class);
    }

    public function finishing()
    {
        return $this->belongsTo(finishing::class);
    }

    public function detail_penawaran()
    {
        return $this->hasMany(detail_penawaran::class);
    }
    
    // public function produk()
    // {
    //     return $this->belongsTo(produk::class);
    // }
    
    // public function tinta()
    // {
    //     return $this->belongsTo(tinta::class);
    // }

    // public function penggunaan_bahan()
    // {
    //     return $this->hasOne(penggunaan_bahan::class);
    // }
    
    // public function penggunaan_tinta()
    // {
    //     return $this->hasMany(penggunaan_tinta::class);
    // }

    public function scopeCreateID()
    {
        $jumlah_produk = detail_produk::max('id');

        if ($jumlah_produk >= 99) {
            $idproduk = "DPRO-".($jumlah_produk+1);
        }
        else if ($jumlah_produk >= 9) {
            $idproduk = "DPRO-0".($jumlah_produk+1);
        }
        else {
            $idproduk = "DPRO-00".($jumlah_produk+1);
        }
        return $idproduk;
    }
}

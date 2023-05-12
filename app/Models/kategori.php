<?php

namespace App\Models;

use App\Models\kategori as ModelsKategori;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function detail_produk()
    {
        return $this->hasMany(detail_produk::class);
    }

    public function cart()
    {
        return $this->hasMany(cart::class);
    }

    public function detail_penawaran()
    {
        return $this->hasMany(detail_penawaran::class);
    }
    
    public function scopeCreateID()
    {
        $jumlah_kategori = ModelsKategori::max('id');

        if ($jumlah_kategori >= 99) {
            $idkategori = "CAT-".($jumlah_kategori+1);
        }
        else if ($jumlah_kategori >= 9) {
            $idkategori = "CAT-0".($jumlah_kategori+1);
        }
        else {
            $idkategori = "CAT-00".($jumlah_kategori+1);
        }
        return $idkategori;
    }
}

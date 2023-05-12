<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bahan_setengah_jadi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function penggunaan_bahan()
    {
        return $this->hasMany(penggunaan_bahan::class);
    }
    
    public function penggunaan_tinta()
    {
        return $this->hasMany(penggunaan_tinta::class);
    }

    public function detail_finishing()
    {
        return $this->hasMany(detail_finishing::class);
    }
    
    public function detail_produk_bahan()
    {
        return $this->hasMany(detail_produk_bahan::class);
    }

    public function scopeCreateID()
    {
        $jumlah_produk = bahan_setengah_jadi::max('id');

        if ($jumlah_produk >= 99) {
            $idbahansetengahjadi = "PROCES-".($jumlah_produk+1);
        }
        else if ($jumlah_produk >= 9) {
            $idbahansetengahjadi = "PROCES-0".($jumlah_produk+1);
        }
        else {
            $idbahansetengahjadi = "PROCES-00".($jumlah_produk+1);
        }
        return $idbahansetengahjadi;
    }
    
}

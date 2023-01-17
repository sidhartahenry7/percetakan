<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cabang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pegawai()
    {
        return $this->hasMany(pegawai::class);
    }

    public function antrian()
    {
        return $this->hasMany(antrian::class);
    }

    public function stok_cabang()
    {
        return $this->hasMany(stok_cabang::class);
    }

    public function pembelian_bahan()
    {
        return $this->hasMany(pembelian_bahan::class);
    }

    public function kartu_stok_bahan()
    {
        return $this->hasMany(kartu_stok_bahan::class);
    }
    
    public function pembelian_tinta()
    {
        return $this->hasMany(pembelian_tinta::class);
    }
    
    public function kartu_stok_tinta()
    {
        return $this->hasMany(kartu_stok_tinta::class);
    }

    public function scopeCreateID()
    {
        $jumlah_cabang = cabang::max('id');

        if ($jumlah_cabang >= 99) {
            $idcabang = "S-".($jumlah_cabang+1);
        }
        else if ($jumlah_cabang >= 9) {
            $idcabang = "S-0".($jumlah_cabang+1);
        }
        else {
            $idcabang = "S-00".($jumlah_cabang+1);
        }
        return $idcabang;
    }
}

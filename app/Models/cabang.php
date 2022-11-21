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

    public function scopeCreateID()
    {
        $jumlah_cabang = cabang::max('id');

        if ($jumlah_cabang >= 99) {
            $idcabang = "CDV-".($jumlah_cabang+1);
        }
        else if ($jumlah_cabang >= 9) {
            $idcabang = "CDV-0".($jumlah_cabang+1);
        }
        else {
            $idcabang = "CDV-00".($jumlah_cabang+1);
        }
        return $idcabang;
    }
}

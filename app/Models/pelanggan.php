<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class pelanggan extends Authenticatable
{
    use HasFactory;

    protected $guarded = ['id'];

    public function antrian()
    {
        return $this->hasMany(antrian::class);
    }
    
    public function penawaran()
    {
        return $this->hasMany(penawaran::class);
    }
    
    public function status_penawaran()
    {
        return $this->hasMany(status_penawaran::class);
    }

    public function scopeCreateID()
    {
        $jumlah_pelanggan = pelanggan::max('id');

        if ($jumlah_pelanggan >= 99) {
            $idpelanggan = "CUS-".($jumlah_pelanggan+1);
        }
        else if ($jumlah_pelanggan >= 9) {
            $idpelanggan = "CUS-0".($jumlah_pelanggan+1);
        }
        else {
            $idpelanggan = "CUS-00".($jumlah_pelanggan+1);
        }
        return $idpelanggan;
    }
}

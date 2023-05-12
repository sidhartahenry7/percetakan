<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penawaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function detail_penawaran()
    {
        return $this->hasMany(detail_penawaran::class);
    }
    
    public function pelanggan()
    {
        return $this->belongsTo(pelanggan::class);
    }

    public function cabang()
    {
        return $this->belongsTo(cabang::class);
    }
    
    public function promo()
    {
        return $this->belongsTo(promo::class);
    }

    public function status_penawaran()
    {
        return $this->hasMany(status_penawaran::class);
    }
    
    public function transaksi()
    {
        return $this->hasOne(transaksi::class);
    }

    public function scopeCreateID()
    {
        $jumlah_penawaran = penawaran::max('id');

        if ($jumlah_penawaran >= 99) {
            $idpenawaran = "OFR-".($jumlah_penawaran+1);
        }
        else if ($jumlah_penawaran >= 9) {
            $idpenawaran = "OFR-0".($jumlah_penawaran+1);
        }
        else {
            $idpenawaran = "OFR-00".($jumlah_penawaran+1);
        }
        return $idpenawaran;
    }
}

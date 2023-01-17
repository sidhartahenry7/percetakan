<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembelian_tinta extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function detail_pembelian_tinta()
    {
        return $this->hasMany(detail_pembelian_tinta::class);
    }
    
    public function penerimaan_tinta()
    {
        return $this->hasOne(penerimaan_tinta::class);
    }

    public function cabang()
    {
        return $this->belongsTo(cabang::class);
    }

    public function scopeCreateID()
    {
        $jumlah_pembelian_tinta = pembelian_tinta::max('id');

        if ($jumlah_pembelian_tinta >= 99) {
            $idpembeliantinta = "TPO-".($jumlah_pembelian_tinta+1);
        }
        else if ($jumlah_pembelian_tinta >= 9) {
            $idpembeliantinta = "TPO-0".($jumlah_pembelian_tinta+1);
        }
        else {
            $idpembeliantinta = "TPO-00".($jumlah_pembelian_tinta+1);
        }
        return $idpembeliantinta;
    }
}

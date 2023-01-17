<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembelian_bahan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function detail_pembelian_bahan()
    {
        return $this->hasMany(detail_pembelian_bahan::class);
    }
    
    public function penerimaan_bahan_baku()
    {
        return $this->hasOne(penerimaan_bahan_baku::class);
    }

    public function cabang()
    {
        return $this->belongsTo(cabang::class);
    }

    public function scopeCreateID()
    {
        $jumlah_pembelian_bahan = pembelian_bahan::max('id');

        if ($jumlah_pembelian_bahan >= 99) {
            $idpembelianbahan = "BPO-".($jumlah_pembelian_bahan+1);
        }
        else if ($jumlah_pembelian_bahan >= 9) {
            $idpembelianbahan = "BPO-0".($jumlah_pembelian_bahan+1);
        }
        else {
            $idpembelianbahan = "BPO-00".($jumlah_pembelian_bahan+1);
        }
        return $idpembelianbahan;
    }
}

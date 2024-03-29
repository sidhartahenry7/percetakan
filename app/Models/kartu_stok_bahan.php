<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kartu_stok_bahan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function produk()
    {
        return $this->belongsTo(produk::class);
    }

    public function cabang()
    {
        return $this->belongsTo(cabang::class);
    }
    
    public function konversi_bahan()
    {
        return $this->hasOne(konversi_bahan::class);
    }
    
    public function transaksi()
    {
        return $this->belongsTo(transaksi::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_pembelian_bahan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pembelian_bahan()
    {
        return $this->belongsTo(pembelian_bahan::class);
    }

    public function produk()
    {
        return $this->belongsTo(produk::class);
    }
}

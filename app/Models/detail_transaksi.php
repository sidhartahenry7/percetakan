<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_transaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function detail_produk()
    {
        return $this->belongsTo(detail_produk::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(transaksi::class);
    }

    public function komplain()
    {
        return $this->hasOne(komplain::class);
    }
}

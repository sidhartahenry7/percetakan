<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_pembelian_tinta extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pembelian_tinta()
    {
        return $this->belongsTo(pembelian_tinta::class);
    }

    public function detail_tinta()
    {
        return $this->belongsTo(detail_tinta::class);
    }
}

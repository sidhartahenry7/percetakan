<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penerimaan_bahan_baku extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pembelian_bahan()
    {
        return $this->belongsTo(pembelian_bahan::class);
    }

    public function pegawai()
    {
        return $this->belongsTo(pegawai::class);
    }
}

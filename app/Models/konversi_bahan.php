<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class konversi_bahan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kartu_stok_bahan()
    {
        return $this->belongsTo(kartu_stok_bahan::class);
    }
}

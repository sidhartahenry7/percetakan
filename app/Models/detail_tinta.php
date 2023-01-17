<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_tinta extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tinta()
    {
        return $this->belongsTo(tinta::class);
    }

    public function kartu_stok_tinta()
    {
        return $this->hasMany(kartu_stok_tinta::class);
    }
}

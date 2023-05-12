<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_produk_bahan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function detail_produk()
    {
        return $this->belongsTo(detail_produk::class);
    }
    
    public function bahan_setengah_jadi()
    {
        return $this->belongsTo(bahan_setengah_jadi::class);
    }
}

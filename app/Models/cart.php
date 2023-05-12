<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pelanggan()
    {
        return $this->belongsTo(pelanggan::class);
    }

    public function detail_produk()
    {
        return $this->belongsTo(detail_produk::class);
    }
    
    public function kategori()
    {
        return $this->belongsTo(kategori::class);
    }
}

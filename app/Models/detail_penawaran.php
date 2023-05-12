<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_penawaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function penawaran()
    {
        return $this->belongsTo(penawaran::class);
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

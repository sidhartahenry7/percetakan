<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kartu_stok_tinta extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function detail_tinta()
    {
        return $this->belongsTo(detail_tinta::class);
    }

    public function cabang()
    {
        return $this->belongsTo(cabang::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penggunaan_tinta extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function bahan_setengah_jadi()
    {
        return $this->belongsTo(bahan_setengah_jadi::class);
    }

    public function detail_tinta()
    {
        return $this->belongsTo(detail_tinta::class);
    }
}

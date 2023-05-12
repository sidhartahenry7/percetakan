<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_finishing extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function finishing()
    {
        return $this->belongsTo(finishing::class);
    }
    
    public function bahan_setengah_jadi()
    {
        return $this->belongsTo(bahan_setengah_jadi::class);
    }
}

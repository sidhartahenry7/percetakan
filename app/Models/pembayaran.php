<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function biaya()
    {
        return $this->belongsTo(biaya::class);
    }

    public function pegawai()
    {
        return $this->belongsTo(pegawai::class);
    }
    
    public function cabang()
    {
        return $this->belongsTo(cabang::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status_transaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function transaksi()
    {
        return $this->belongsTo(transaksi::class);
    }
    
    public function pegawai()
    {
        return $this->belongsTo(pegawai::class);
    }
}

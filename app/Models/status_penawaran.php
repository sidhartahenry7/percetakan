<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status_penawaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function penawaran()
    {
        return $this->belongsTo(penawaran::class);
    }

    public function pegawai()
    {
        return $this->belongsTo(pegawai::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(pelanggan::class);
    }
}

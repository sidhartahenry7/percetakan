<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class jadwal_bekerja extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pegawai()
    {
        return $this->belongsTo(pegawai::class);
    }

    public function scopeListJadwal($query)
    {
        if (Auth::user()->user_role == 'Admin') {
            return $query->whereNull('pegawais.tanggal_keluar');
        }
        else if (Auth::user()->user_role == 'Kepala Toko' || Auth::user()->user_role == 'Wakil Kepala Toko') {
            return $query->whereNull('pegawais.tanggal_keluar')
                         ->where('cabang_id', '=', Auth::user()->cabang_id);
        }
        else {
            return $query->where('pegawai_id', '=', Auth::user()->id);
        }
    }
}

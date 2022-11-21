<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;

class pegawai extends Authenticatable
{
    use HasFactory;

    protected $guarded = ['id'];

    public function cabang()
    {
        return $this->belongsTo(cabang::class);
    }

    public function absensi()
    {
        return $this->hasMany(absensi::class);
    }

    public function gaji()
    {
        return $this->hasMany(gaji::class);
    }

    public function jadwal_bekerja()
    {
        return $this->hasMany(pegawai::class);
    }

    public function transaksi_pegawai()
    {
        return $this->hasMany(transaksi_pegawai::class);
    }

    public function scopeCreateID()
    {
        $jumlah_pegawai = pegawai::max('id');

        if ($jumlah_pegawai >= 99) {
            $idpegawai = "EMP-".($jumlah_pegawai+1);
        }
        else if ($jumlah_pegawai >= 9) {
            $idpegawai = "EMP-0".($jumlah_pegawai+1);
        }
        else {
            $idpegawai = "EMP-00".($jumlah_pegawai+1);
        }
        return $idpegawai;
    }

    public function scopeListPegawai($query)
    {
        if (Auth::user()->user_role == 'Admin') {
            return $query;
        } else {
            return $query->where('cabang_id', '=', Auth::user()->cabang_id)->whereNull('tanggal_keluar');
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use function PHPUnit\Framework\isNull;

class antrian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function cabang()
    {
        return $this->belongsTo(cabang::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(pelanggan::class);
    }

    public function transaksi()
    {
        return $this->hasOne(transaksi::class);
    }

    public function scopeCreateID()
    {
        $jumlah_antrian = antrian::whereDate('tanggal_antrian', '=', Carbon::today())->where('cabang_id', '=', Auth::user()->cabang_id)->max('nomor_antrian');

        if(Auth::user()->user_role == "Admin") {
            $cabang = cabang::where('id', 1)->first();
            $namacabang = $cabang->nama_cabang;
        }
        else {
            $namacabang = Auth::user()->cabang->nama_cabang;
        }

        if ($jumlah_antrian >= 99) {
            $idantrian = date('Ymd')."/".$namacabang."/".($jumlah_antrian + 1);
        }
        else if ($jumlah_antrian >= 9) {
            $idantrian = date('Ymd')."/".$namacabang."/0".($jumlah_antrian + 1);
        }
        else if ($jumlah_antrian >= 1){
            $idantrian = date('Ymd')."/".$namacabang."/00".($jumlah_antrian + 1);
        }
        else {
            $idantrian = date('Ymd')."/".$namacabang."/00".(1);
        }
        return $idantrian;
    }

    public function scopeCreateAntrian()
    {
        $jumlah_antrian = antrian::whereDate('tanggal_antrian', '=', Carbon::today())->where('cabang_id', '=', Auth::user()->cabang_id)->max('nomor_antrian');

        $nomorantrian = $jumlah_antrian+1;
        
        return $nomorantrian;
    }

    public function scopeListAntrian($query)
    {
        if (Auth::user()->user_role == 'Admin') {
            return $query;
        } else {
            return $query->where('cabang_id', '=', Auth::user()->cabang_id);
        }
    }
}

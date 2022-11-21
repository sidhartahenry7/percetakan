<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class transaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function promo()
    {
        return $this->belongsTo(promo::class);
    }
    
    public function antrian()
    {
        return $this->belongsTo(antrian::class);
    }

    public function detail_transaksi()
    {
        return $this->hasMany(detail_transaksi::class);
    }

    public function transaksi_pegawai()
    {
        return $this->hasMany(transaksi_pegawai::class);
    }

    public function scopeListAntrian($query)
    {
        if (Auth::user()->user_role == 'Admin') {
            // $query = antrian::all()->whereNotIn('id', 1);
            // $query = antrian::whereNotIn('id', transaksi::all()->pluck('antrian_id'))->get();
            return $query->whereNotIn('id', transaksi::all()->pluck('antrian_id'));
        }
        else {
            // $query = antrian::all()->whereNotIn('id', 1);
            return $query->whereNotIn('id', transaksi::all()->pluck('antrian_id'))->where('cabang_id', '=', Auth::user()->cabang_id);
        }
    }

    public function scopeCreateID()
    {
        $jumlah_transaksi = transaksi::max('id');

        if ($jumlah_transaksi >= 99) {
            $idtransaksi = "PO-".($jumlah_transaksi+1);
        }
        else if ($jumlah_transaksi >= 9) {
            $idtransaksi = "PO-0".($jumlah_transaksi+1);
        }
        else {
            $idtransaksi = "PO-00".($jumlah_transaksi+1);
        }
        return $idtransaksi;
    }
}
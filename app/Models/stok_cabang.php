<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\cabang;

class stok_cabang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function cabang()
    {
        return $this->belongsTo(cabang::class);
    }
    
    public function produk()
    {
        return $this->belongsTo(produk::class);
    }

    public function scopeListCabang($query)
    {
        if (Auth::user()->user_role == 'Admin') {
            $query = cabang::all();
            return $query;
        }
        else {
            $query = cabang::all()->where('id', '=', Auth::user()->cabang_id);
            return $query;
        }
    }

    public function scopeListStok($query)
    {
        if (Auth::user()->user_role == 'Admin') {
            return $query;
        }
        else {
            return $query->where('cabang_id', '=', Auth::user()->cabang_id);
        }
    }
}

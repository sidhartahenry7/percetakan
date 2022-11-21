<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function transaksi()
    {
        return $this->hasMany(transaksi::class);
    }

    public function scopeCreateID()
    {
        $jumlah_promo = promo::max('id');

        if ($jumlah_promo >= 99) {
            $idpromo = "PROMO-".($jumlah_promo+1);
        }
        else if ($jumlah_promo >= 9) {
            $idpromo = "PROMO-0".($jumlah_promo+1);
        }
        else {
            $idpromo = "PROMO-00".($jumlah_promo+1);
        }
        return $idpromo;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class biaya extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pembayaran()
    {
        return $this->hasMany(pembayaran::class);
    }

    public function scopeCreateID()
    {
        $jumlah = biaya::max('id');

        if ($jumlah >= 99) {
            $idbiaya = "PAY-".($jumlah+1);
        }
        else if ($jumlah >= 9) {
            $idbiaya = "PAY-0".($jumlah+1);
        }
        else {
            $idbiaya = "PAY-00".($jumlah+1);
        }
        return $idbiaya;
    }
}

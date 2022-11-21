<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class komplain extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function detail_transaksi()
    {
        return $this->belongsTo(detail_transaksi::class);
    }
}

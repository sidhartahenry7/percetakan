<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKartuStokBahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartu_stok_bahans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('cabang_id');
            $table->foreignId('produk_id');
            $table->float('quantity_masuk');
            $table->float('quantity_keluar');
            $table->float('quantity_sekarang');
            $table->string('satuan', 255);
            $table->integer('harga_beli');
            $table->float('harga_average');
            $table->string('status');
            $table->foreignId('transaksi_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kartu_stok_bahans');
    }
}

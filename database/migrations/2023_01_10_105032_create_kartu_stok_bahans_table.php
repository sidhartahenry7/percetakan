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
            $table->integer('quantity_masuk');
            $table->integer('quantity_keluar');
            $table->integer('quantity_sekarang');
            $table->string('status');
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerimaanBahanBakusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerimaan_bahan_bakus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembelian_bahan_id');
            $table->foreignId('pegawai_id');
            $table->date('tanggal_penerimaan');
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
        Schema::dropIfExists('penerimaan_bahan_bakus');
    }
}

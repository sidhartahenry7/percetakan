<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id');
            $table->string('jenis_bahan_input', 255);
            $table->string('ukuran_input', 255);
            $table->string('finishing_input', 255);
            $table->string('warna_input', 255);
            $table->foreignId('detail_produk_id');
            $table->integer('harga');
            $table->integer('jumlah_produk');
            $table->float('persen_cyan');
            $table->float('persen_magenta');
            $table->float('persen_yellow');
            $table->float('persen_black');
            $table->integer('harga_finishing');
            $table->integer('diskon');
            $table->integer('harga_custom');
            $table->text('custom')->nullable();
            $table->string('file_cetak', 255)->nullable();
            $table->integer('sub_total');
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
        Schema::dropIfExists('detail_transaksis');
    }
}

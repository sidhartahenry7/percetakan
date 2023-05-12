<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenawaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penawarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penawaran_id');
            $table->foreignId('kategori_id');
            $table->string('jenis_bahan_input', 255);
            $table->string('ukuran_input', 255);
            $table->string('finishing_input', 255);
            $table->string('warna_input', 255);
            $table->foreignId('detail_produk_id')->nullable();
            $table->integer('harga')->default(0);
            $table->integer('jumlah_produk');
            $table->float('persen_cyan')->default(0);
            $table->float('persen_magenta')->default(0);
            $table->float('persen_yellow')->default(0);
            $table->float('persen_black')->default(0);
            $table->integer('harga_finishing')->default(0);
            $table->integer('diskon')->default(0);
            $table->integer('harga_custom')->default(0);
            $table->text('custom')->nullable();
            $table->string('file_cetak', 255);
            $table->integer('sub_total')->default(0);
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
        Schema::dropIfExists('detail_penawarans');
    }
}

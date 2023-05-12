<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_produks', function (Blueprint $table) {
            $table->id();
            $table->string('id_detail_produk', 255)->unique();
            $table->string('nama_produk', 255);
            $table->string('jenis_bahan', 255);
            $table->string('ukuran', 255);
            $table->string('keterangan', 255)->nullable();
            $table->foreignId('kategori_id');
            $table->foreignId('finishing_id');
            $table->integer('status_finishing');
            $table->integer('harga');
            $table->integer('diskon')->default(0);
            $table->integer('deleted')->default(0);
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
        Schema::dropIfExists('detail_produks');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id');
            $table->foreignId('kategori_id');
            $table->string('jenis_bahan_input', 255);
            $table->string('ukuran_input', 255);
            $table->string('finishing_input', 255)->default('None');
            $table->string('warna_input', 255);
            $table->integer('jumlah_produk');
            $table->text('custom')->nullable();
            $table->string('file_cetak', 255);
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
        Schema::dropIfExists('carts');
    }
}

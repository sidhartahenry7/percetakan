<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPembelianTintasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pembelian_tintas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('detail_tinta_id');
            $table->foreignId('pembelian_tinta_id');
            $table->float('quantity');
            $table->string('satuan', 255)->default('L');
            $table->integer('harga');
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
        Schema::dropIfExists('detail_pembelian_tintas');
    }
}

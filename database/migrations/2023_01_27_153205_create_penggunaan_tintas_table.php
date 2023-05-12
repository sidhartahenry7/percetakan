<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunaanTintasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penggunaan_tintas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bahan_setengah_jadi_id');
            $table->foreignId('detail_tinta_id');
            $table->float('jumlah_pemakaian');
            $table->string('satuan', 255);
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
        Schema::dropIfExists('penggunaan_tintas');
    }
}

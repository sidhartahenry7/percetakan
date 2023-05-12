<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBahanSetengahJadisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahan_setengah_jadis', function (Blueprint $table) {
            $table->id();
            $table->string('id_bahan_setengah_jadi', 255);
            $table->string('nama_bahan_setengah_jadi', 255);
            $table->integer('harga');
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
        Schema::dropIfExists('bahan_setengah_jadis');
    }
}

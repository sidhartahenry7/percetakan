<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianTintasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_tintas', function (Blueprint $table) {
            $table->id();
            $table->string('id_pembelian_tinta', 255)->unique();
            $table->foreignId('pegawai_id');
            $table->foreignId('cabang_id');
            $table->date('tanggal_pembelian_tinta');
            $table->integer('total')->default(0);
            $table->string('status')->default('Pending');
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
        Schema::dropIfExists('pembelian_tintas');
    }
}

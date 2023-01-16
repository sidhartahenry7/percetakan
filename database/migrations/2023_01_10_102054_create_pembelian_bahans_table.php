<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianBahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_bahans', function (Blueprint $table) {
            $table->id();
            $table->string('id_pembelian_bahan', 255)->unique();
            $table->foreignId('cabang_id');
            $table->date('tanggal_pembelian_bahan');
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
        Schema::dropIfExists('pembelian_bahans');
    }
}

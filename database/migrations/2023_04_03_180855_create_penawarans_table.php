<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenawaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penawarans', function (Blueprint $table) {
            $table->id();
            $table->string('id_penawaran', 255)->unique();
            $table->foreignId('pelanggan_id');
            $table->foreignId('cabang_id');
            $table->dateTime('tanggal_penawaran');
            $table->integer('jumlah_total_item')->default(0);
            $table->integer('sub_total_transaksi')->default(0);
            $table->foreignId('promo_id')->nullable();
            $table->integer('total')->default(0);
            $table->string('status_penawaran', 255)->default('Penawaran dibuat');
            $table->string('bukti_pembayaran', 255)->nullable();
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
        Schema::dropIfExists('penawarans');
    }
}

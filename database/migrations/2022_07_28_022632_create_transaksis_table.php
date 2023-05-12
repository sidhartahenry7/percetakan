<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('id_transaksi', 255)->unique();
            $table->foreignId('penawaran_id')->nullable();
            $table->foreignId('antrian_id');
            $table->integer('jumlah_total_item')->default(0);
            $table->integer('sub_total_transaksi')->default(0);
            $table->foreignId('promo_id')->nullable();
            $table->integer('total')->default(0);
            $table->string('status_pengerjaan', 255)->default('Belum dikerjakan');
            $table->string('status_transaksi', 255)->default('Onsite');
            $table->string('bukti_pembayaran', 255)->nullable();
            $table->dateTime('estimasi_selesai')->nullable();
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
        Schema::dropIfExists('transaksis');
    }
}

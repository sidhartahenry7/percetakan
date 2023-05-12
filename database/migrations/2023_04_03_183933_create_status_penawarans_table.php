<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusPenawaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_penawarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penawaran_id');
            $table->foreignId('pegawai_id')->nullable();
            $table->foreignId('pelanggan_id')->nullable();
            $table->dateTime('tanggal_status');
            $table->string('status_penawaran', 255);
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
        Schema::dropIfExists('status_penawarans');
    }
}

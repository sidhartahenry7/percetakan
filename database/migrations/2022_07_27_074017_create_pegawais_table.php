<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('id_pegawai', 255)->unique();
            $table->string('nama_lengkap', 255);
            $table->string('alamat', 255);
            $table->string('nomor_handphone', 255)->unique();
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('rekening_bank', 255)->nullable();
            $table->string('nomor_rekening', 255)->nullable();
            $table->integer('gaji_pokok')->default(0);
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar')->nullable();
            $table->string('user_role', 255);
            $table->foreignId('cabang_id')->nullable();
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
        Schema::dropIfExists('pegawais');
    }
}

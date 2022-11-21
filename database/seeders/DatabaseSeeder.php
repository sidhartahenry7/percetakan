<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\pegawai;
use App\Models\cabang;
use App\Models\produk;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        cabang::factory(1)->create();

        pegawai::factory(5)->create();

        produk::factory(4)->create();

    }
}

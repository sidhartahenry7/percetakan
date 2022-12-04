<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cabangs')->insert([
            'id_cabang' => 'CDV-001',
            'nama_cabang' => 'Cabang 1',
            'alamat' => 'Jalan Coba No. 1',
            'longitude' => '112.6871203',
            'latitude' => '-7.2630996',
            'nomor_telepon' => '5600123'
        ]);
    }
}

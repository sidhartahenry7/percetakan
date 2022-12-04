<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pelanggans')->insert([
            'id_pelanggan' => 'CUS-001',
            'nama_pelanggan' => 'Tanoto',
            'nomor_handphone' => '085540003000'
        ]);
        DB::table('pelanggans')->insert([
            'id_pelanggan' => 'CUS-002',
            'nama_pelanggan' => 'Timothy',
            'nomor_handphone' => '086630002000'
        ]);
        DB::table('pelanggans')->insert([
            'id_pelanggan' => 'CUS-003',
            'nama_pelanggan' => 'Kelvin',
            'nomor_handphone' => '087760005000'
        ]);
        DB::table('pelanggans')->insert([
            'id_pelanggan' => 'CUS-004',
            'nama_pelanggan' => 'Bryan',
            'nomor_handphone' => '088890008000'
        ]);
        DB::table('pelanggans')->insert([
            'id_pelanggan' => 'CUS-005',
            'nama_pelanggan' => 'Jason',
            'nomor_handphone' => '089980009000'
        ]);
    }
}

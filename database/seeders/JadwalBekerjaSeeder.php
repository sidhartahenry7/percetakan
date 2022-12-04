<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class JadwalBekerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '2',
            'hari' => 'Monday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('15:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '2',
            'hari' => 'Tuesday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('15:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '2',
            'hari' => 'Wednesday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('15:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '2',
            'hari' => 'Thursday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('15:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '2',
            'hari' => 'Friday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('15:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '2',
            'hari' => 'Saturday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('15:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '2',
            'hari' => 'Sunday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('15:00:00')
        ]);

        //Wakil Kepala Toko
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '3',
            'hari' => 'Monday',
            'jam_masuk' => Carbon::parse('15:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '3',
            'hari' => 'Tuesday',
            'jam_masuk' => Carbon::parse('15:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '3',
            'hari' => 'Wednesday',
            'jam_masuk' => Carbon::parse('15:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '3',
            'hari' => 'Thursday',
            'jam_masuk' => Carbon::parse('15:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '3',
            'hari' => 'Friday',
            'jam_masuk' => Carbon::parse('15:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '3',
            'hari' => 'Saturday',
            'jam_masuk' => Carbon::parse('15:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '3',
            'hari' => 'Sunday',
            'jam_masuk' => Carbon::parse('15:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);

        //Kasir 1
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '4',
            'hari' => 'Monday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '4',
            'hari' => 'Tuesday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '4',
            'hari' => 'Wednesday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '4',
            'hari' => 'Thursday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '4',
            'hari' => 'Friday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '4',
            'hari' => 'Saturday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '4',
            'hari' => 'Sunday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);

        //Kasir 2
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '5',
            'hari' => 'Monday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '5',
            'hari' => 'Tuesday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '5',
            'hari' => 'Wednesday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '5',
            'hari' => 'Thursday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '5',
            'hari' => 'Friday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '5',
            'hari' => 'Saturday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '5',
            'hari' => 'Sunday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);

        //Kasir 3
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '6',
            'hari' => 'Monday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '6',
            'hari' => 'Tuesday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '6',
            'hari' => 'Wednesday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '6',
            'hari' => 'Thursday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '6',
            'hari' => 'Friday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '6',
            'hari' => 'Saturday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '6',
            'hari' => 'Sunday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);

        


        //Operator Printer 1
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '13',
            'hari' => 'Monday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '13',
            'hari' => 'Tuesday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '13',
            'hari' => 'Wednesday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '13',
            'hari' => 'Thursday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '13',
            'hari' => 'Friday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '13',
            'hari' => 'Saturday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '13',
            'hari' => 'Sunday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);

        //Operator Printer 2
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '14',
            'hari' => 'Monday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '14',
            'hari' => 'Tuesday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '14',
            'hari' => 'Wednesday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '14',
            'hari' => 'Thursday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '14',
            'hari' => 'Friday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '14',
            'hari' => 'Saturday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '14',
            'hari' => 'Sunday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);

        //Operator Printer 3
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '15',
            'hari' => 'Monday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '15',
            'hari' => 'Tuesday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '15',
            'hari' => 'Wednesday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '15',
            'hari' => 'Thursday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '15',
            'hari' => 'Friday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '15',
            'hari' => 'Saturday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '15',
            'hari' => 'Sunday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);

        //Desainer 1
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '7',
            'hari' => 'Monday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '7',
            'hari' => 'Tuesday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '7',
            'hari' => 'Wednesday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '7',
            'hari' => 'Thursday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '7',
            'hari' => 'Friday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '7',
            'hari' => 'Saturday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '7',
            'hari' => 'Sunday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);

        //Desainer 2
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '8',
            'hari' => 'Monday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '8',
            'hari' => 'Tuesday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '8',
            'hari' => 'Wednesday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '8',
            'hari' => 'Thursday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '8',
            'hari' => 'Friday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '8',
            'hari' => 'Saturday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '8',
            'hari' => 'Sunday',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'jam_keluar' => Carbon::parse('12:00:00')
        ]);

        //Desainer 3
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '9',
            'hari' => 'Monday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '9',
            'hari' => 'Tuesday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '9',
            'hari' => 'Wednesday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '9',
            'hari' => 'Thursday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '9',
            'hari' => 'Friday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '9',
            'hari' => 'Saturday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '9',
            'hari' => 'Sunday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);

        //Desainer 4
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '10',
            'hari' => 'Monday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '10',
            'hari' => 'Tuesday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '10',
            'hari' => 'Wednesday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '10',
            'hari' => 'Thursday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '10',
            'hari' => 'Friday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '10',
            'hari' => 'Saturday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '10',
            'hari' => 'Sunday',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'jam_keluar' => Carbon::parse('18:00:00')
        ]);

        //Desainer 5
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '11',
            'hari' => 'Monday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '11',
            'hari' => 'Tuesday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '11',
            'hari' => 'Wednesday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '11',
            'hari' => 'Thursday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '11',
            'hari' => 'Friday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '11',
            'hari' => 'Saturday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '11',
            'hari' => 'Sunday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);

        //Desainer 6
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '12',
            'hari' => 'Monday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '12',
            'hari' => 'Tuesday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '12',
            'hari' => 'Wednesday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '12',
            'hari' => 'Thursday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '12',
            'hari' => 'Friday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '12',
            'hari' => 'Saturday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
        DB::table('jadwal_bekerjas')->insert([
            'pegawai_id' => '12',
            'hari' => 'Sunday',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'jam_keluar' => Carbon::parse('00:00:00')
        ]);
    }
}

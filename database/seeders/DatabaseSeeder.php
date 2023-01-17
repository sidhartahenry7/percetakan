<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\pegawai;
use App\Models\cabang;
use App\Models\jadwal_bekerja;
use App\Models\produk;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Cabang
        DB::table('cabangs')->insert([
            'id_cabang' => 'S-001',
            'nama_cabang' => 'Cabang 1',
            'alamat' => 'Jalan Coba No. 1',
            'longitude' => '112.6871203',
            'latitude' => '-7.2630996',
            'nomor_telepon' => '5600123'
        ]);

        DB::table('pegawais')->insert([
            'id_pegawai' => 'EMP-001',
            'nama_lengkap' => 'David',
            'alamat' => 'Jalan Tes No. 1',
            'nomor_handphone' => '081122334455',
            'email' => 'david@gmail.com',
            'password' => Hash::make('password'),
            'tanggal_masuk' => '2022-11-01',
            'user_role' => 'Admin'
        ]);
        DB::table('pegawais')->insert([
            'id_pegawai' => 'EMP-002',
            'nama_lengkap' => 'Alvin',
            'alamat' => 'Jalan Tes No. 2',
            'nomor_handphone' => '081122334466',
            'email' => 'alvin@gmail.com',
            'password' => Hash::make('password'),
            'rekening_bank' => 'BCA',
            'nomor_rekening' => '1122334455',
            'gaji_pokok' => '150000',
            'tanggal_masuk' => '2022-11-01',
            'user_role' => 'Kepala Toko',
            'cabang_id' => '1'
        ]);
        DB::table('pegawais')->insert([
            'id_pegawai' => 'EMP-003',
            'nama_lengkap' => 'Hansel',
            'alamat' => 'Jalan Tes No. 3',
            'nomor_handphone' => '081122334477',
            'email' => 'hansel@gmail.com',
            'password' => Hash::make('password'),
            'rekening_bank' => 'BCA',
            'nomor_rekening' => '1122334466',
            'gaji_pokok' => '150000',
            'tanggal_masuk' => '2022-11-01',
            'user_role' => 'Wakil Kepala Toko',
            'cabang_id' => '1'
        ]);
        DB::table('pegawais')->insert([
            'id_pegawai' => 'EMP-004',
            'nama_lengkap' => 'Budi',
            'alamat' => 'Jalan Tes No. 4',
            'nomor_handphone' => '081122334488',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password'),
            'rekening_bank' => 'BNI',
            'nomor_rekening' => '1122334477',
            'gaji_pokok' => '100000',
            'tanggal_masuk' => '2022-11-01',
            'user_role' => 'Kasir',
            'cabang_id' => '1'
        ]);
        DB::table('pegawais')->insert([
            'id_pegawai' => 'EMP-005',
            'nama_lengkap' => 'Kainen',
            'alamat' => 'Jalan Tes No. 5',
            'nomor_handphone' => '081122334499',
            'email' => 'kainen@gmail.com',
            'password' => Hash::make('password'),
            'rekening_bank' => 'BNI',
            'nomor_rekening' => '1122334488',
            'gaji_pokok' => '100000',
            'tanggal_masuk' => '2022-11-01',
            'user_role' => 'Kasir',
            'cabang_id' => '1'
        ]);
        DB::table('pegawais')->insert([
            'id_pegawai' => 'EMP-006',
            'nama_lengkap' => 'Abed',
            'alamat' => 'Jalan Tes No. 6',
            'nomor_handphone' => '081122335599',
            'email' => 'abed@gmail.com',
            'password' => Hash::make('password'),
            'rekening_bank' => 'BRI',
            'nomor_rekening' => '1122334499',
            'gaji_pokok' => '100000',
            'tanggal_masuk' => '2022-11-01',
            'user_role' => 'Kasir',
            'cabang_id' => '1'
        ]);
        DB::table('pegawais')->insert([
            'id_pegawai' => 'EMP-007',
            'nama_lengkap' => 'Michael',
            'alamat' => 'Jalan Tes No. 7',
            'nomor_handphone' => '081122336699',
            'email' => 'michael@gmail.com',
            'password' => Hash::make('password'),
            'rekening_bank' => 'BRI',
            'nomor_rekening' => '1122335599',
            'gaji_pokok' => '100000',
            'tanggal_masuk' => '2022-11-01',
            'user_role' => 'Desainer',
            'cabang_id' => '1'
        ]);
        DB::table('pegawais')->insert([
            'id_pegawai' => 'EMP-008',
            'nama_lengkap' => 'Lie',
            'alamat' => 'Jalan Tes No. 8',
            'nomor_handphone' => '081122337799',
            'email' => 'lie@gmail.com',
            'password' => Hash::make('password'),
            'rekening_bank' => 'Bank Mandiri',
            'nomor_rekening' => '1122336699',
            'gaji_pokok' => '100000',
            'tanggal_masuk' => '2022-11-01',
            'user_role' => 'Desainer',
            'cabang_id' => '1'
        ]);
        DB::table('pegawais')->insert([
            'id_pegawai' => 'EMP-009',
            'nama_lengkap' => 'Kevin',
            'alamat' => 'Jalan Tes No. 9',
            'nomor_handphone' => '081122338899',
            'email' => 'kevin@gmail.com',
            'password' => Hash::make('password'),
            'rekening_bank' => 'Bank Mandiri',
            'nomor_rekening' => '1122337799',
            'gaji_pokok' => '100000',
            'tanggal_masuk' => '2022-11-01',
            'user_role' => 'Desainer',
            'cabang_id' => '1'
        ]);
        DB::table('pegawais')->insert([
            'id_pegawai' => 'EMP-010',
            'nama_lengkap' => 'Vincent',
            'alamat' => 'Jalan Tes No. 10',
            'nomor_handphone' => '081122339999',
            'email' => 'vincent@gmail.com',
            'password' => Hash::make('password'),
            'rekening_bank' => 'BCA',
            'nomor_rekening' => '1122338899',
            'gaji_pokok' => '100000',
            'tanggal_masuk' => '2022-11-01',
            'user_role' => 'Desainer',
            'cabang_id' => '1'
        ]);
        DB::table('pegawais')->insert([
            'id_pegawai' => 'EMP-011',
            'nama_lengkap' => 'Enrico',
            'alamat' => 'Jalan Tes No. 11',
            'nomor_handphone' => '081122449999',
            'email' => 'enrico@gmail.com',
            'password' => Hash::make('password'),
            'rekening_bank' => 'BCA',
            'nomor_rekening' => '1122339999',
            'gaji_pokok' => '100000',
            'tanggal_masuk' => '2022-11-01',
            'user_role' => 'Desainer',
            'cabang_id' => '1'
        ]);
        DB::table('pegawais')->insert([
            'id_pegawai' => 'EMP-012',
            'nama_lengkap' => 'Billy',
            'alamat' => 'Jalan Tes No. 12',
            'nomor_handphone' => '081122559999',
            'email' => 'billy@gmail.com',
            'password' => Hash::make('password'),
            'rekening_bank' => 'BNI',
            'nomor_rekening' => '1122449999',
            'gaji_pokok' => '100000',
            'tanggal_masuk' => '2022-11-01',
            'user_role' => 'Desainer',
            'cabang_id' => '1'
        ]);
        DB::table('pegawais')->insert([
            'id_pegawai' => 'EMP-013',
            'nama_lengkap' => 'William',
            'alamat' => 'Jalan Tes No. 13',
            'nomor_handphone' => '081122669999',
            'email' => 'william@gmail.com',
            'password' => Hash::make('password'),
            'rekening_bank' => 'BNI',
            'nomor_rekening' => '1122559999',
            'gaji_pokok' => '100000',
            'tanggal_masuk' => '2022-11-01',
            'user_role' => 'Operator Printer',
            'cabang_id' => '1'
        ]);
        DB::table('pegawais')->insert([
            'id_pegawai' => 'EMP-014',
            'nama_lengkap' => 'Thomas',
            'alamat' => 'Jalan Tes No. 14',
            'nomor_handphone' => '081122779999',
            'email' => 'thomas@gmail.com',
            'password' => Hash::make('password'),
            'rekening_bank' => 'BRI',
            'nomor_rekening' => '1122669999',
            'gaji_pokok' => '100000',
            'tanggal_masuk' => '2022-11-01',
            'user_role' => 'Operator Printer',
            'cabang_id' => '1'
        ]);
        DB::table('pegawais')->insert([
            'id_pegawai' => 'EMP-015',
            'nama_lengkap' => 'Aldo',
            'alamat' => 'Jalan Tes No. 15',
            'nomor_handphone' => '081122889999',
            'email' => 'aldo@gmail.com',
            'password' => Hash::make('password'),
            'rekening_bank' => 'BRI',
            'nomor_rekening' => '1122779999',
            'gaji_pokok' => '100000',
            'tanggal_masuk' => '2022-11-01',
            'user_role' => 'Operator Printer',
            'cabang_id' => '1'
        ]);

        //Pelanggan
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

        //Jadwal Bekerja
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

        //Kepala Toko
        DB::table('absensis')->insert([
            'pegawai_id' => '2',
            'tanggal_masuk' => '2022-11-01',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('15:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '2',
            'tanggal_masuk' => '2022-11-02',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('15:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '2',
            'tanggal_masuk' => '2022-11-03',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('15:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '2',
            'tanggal_masuk' => '2022-11-04',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('15:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '2',
            'tanggal_masuk' => '2022-11-05',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('15:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '2',
            'tanggal_masuk' => '2022-11-06',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('15:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '2',
            'tanggal_masuk' => '2022-11-07',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('15:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '2',
            'tanggal_masuk' => '2022-11-08',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('15:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '2',
            'tanggal_masuk' => '2022-11-09',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('15:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '2',
            'tanggal_masuk' => '2022-11-10',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('15:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);

        //Wakil Kepala Toko
        DB::table('absensis')->insert([
            'pegawai_id' => '3',
            'tanggal_masuk' => '2022-11-01',
            'jam_masuk' => Carbon::parse('15:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '3',
            'tanggal_masuk' => '2022-11-02',
            'jam_masuk' => Carbon::parse('15:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '3',
            'tanggal_masuk' => '2022-11-03',
            'jam_masuk' => Carbon::parse('15:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '3',
            'tanggal_masuk' => '2022-11-04',
            'jam_masuk' => Carbon::parse('15:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '3',
            'tanggal_masuk' => '2022-11-05',
            'jam_masuk' => Carbon::parse('15:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '3',
            'tanggal_masuk' => '2022-11-06',
            'jam_masuk' => Carbon::parse('15:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '3',
            'tanggal_masuk' => '2022-11-07',
            'jam_masuk' => Carbon::parse('15:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '3',
            'tanggal_masuk' => '2022-11-08',
            'jam_masuk' => Carbon::parse('15:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '3',
            'tanggal_masuk' => '2022-11-09',
            'jam_masuk' => Carbon::parse('15:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '3',
            'tanggal_masuk' => '2022-11-10',
            'jam_masuk' => Carbon::parse('15:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);

        //Kasir 1
        DB::table('absensis')->insert([
            'pegawai_id' => '4',
            'tanggal_masuk' => '2022-11-01',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '4',
            'tanggal_masuk' => '2022-11-02',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '4',
            'tanggal_masuk' => '2022-11-03',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '4',
            'tanggal_masuk' => '2022-11-04',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '4',
            'tanggal_masuk' => '2022-11-05',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '4',
            'tanggal_masuk' => '2022-11-06',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '4',
            'tanggal_masuk' => '2022-11-07',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '4',
            'tanggal_masuk' => '2022-11-08',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '4',
            'tanggal_masuk' => '2022-11-09',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '4',
            'tanggal_masuk' => '2022-11-10',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);

        //Desainer 1
        DB::table('absensis')->insert([
            'pegawai_id' => '7',
            'tanggal_masuk' => '2022-11-01',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '7',
            'tanggal_masuk' => '2022-11-02',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '7',
            'tanggal_masuk' => '2022-11-03',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '7',
            'tanggal_masuk' => '2022-11-07',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '7',
            'tanggal_masuk' => '2022-11-05',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '7',
            'tanggal_masuk' => '2022-11-06',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '7',
            'tanggal_masuk' => '2022-11-07',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '7',
            'tanggal_masuk' => '2022-11-08',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '7',
            'tanggal_masuk' => '2022-11-09',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '7',
            'tanggal_masuk' => '2022-11-10',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);

        //Desainer 2
        DB::table('absensis')->insert([
            'pegawai_id' => '8',
            'tanggal_masuk' => '2022-11-01',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '8',
            'tanggal_masuk' => '2022-11-02',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '8',
            'tanggal_masuk' => '2022-11-03',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '8',
            'tanggal_masuk' => '2022-11-07',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '8',
            'tanggal_masuk' => '2022-11-05',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '8',
            'tanggal_masuk' => '2022-11-06',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '8',
            'tanggal_masuk' => '2022-11-07',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '8',
            'tanggal_masuk' => '2022-11-08',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '8',
            'tanggal_masuk' => '2022-11-09',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '8',
            'tanggal_masuk' => '2022-11-10',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);

        //Operator Printer 1
        DB::table('absensis')->insert([
            'pegawai_id' => '13',
            'tanggal_masuk' => '2022-11-01',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '13',
            'tanggal_masuk' => '2022-11-02',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '13',
            'tanggal_masuk' => '2022-11-03',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '13',
            'tanggal_masuk' => '2022-11-07',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '13',
            'tanggal_masuk' => '2022-11-05',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '13',
            'tanggal_masuk' => '2022-11-06',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '13',
            'tanggal_masuk' => '2022-11-07',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '13',
            'tanggal_masuk' => '2022-11-08',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '13',
            'tanggal_masuk' => '2022-11-09',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '13',
            'tanggal_masuk' => '2022-11-10',
            'jam_masuk' => Carbon::parse('06:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('12:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);

        //Kasir 2
        DB::table('absensis')->insert([
            'pegawai_id' => '5',
            'tanggal_masuk' => '2022-11-01',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('18:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '5',
            'tanggal_masuk' => '2022-11-02',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('18:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '5',
            'tanggal_masuk' => '2022-11-03',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('18:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '5',
            'tanggal_masuk' => '2022-11-04',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('18:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '5',
            'tanggal_masuk' => '2022-11-05',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('18:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);

        //Desainer 3
        DB::table('absensis')->insert([
            'pegawai_id' => '9',
            'tanggal_masuk' => '2022-11-01',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('18:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '9',
            'tanggal_masuk' => '2022-11-02',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('18:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '9',
            'tanggal_masuk' => '2022-11-03',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('18:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '9',
            'tanggal_masuk' => '2022-11-04',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('18:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '9',
            'tanggal_masuk' => '2022-11-05',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('18:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);

        //Desainer 4
        DB::table('absensis')->insert([
            'pegawai_id' => '10',
            'tanggal_masuk' => '2022-11-01',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('18:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '10',
            'tanggal_masuk' => '2022-11-02',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('18:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '10',
            'tanggal_masuk' => '2022-11-03',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('18:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '10',
            'tanggal_masuk' => '2022-11-04',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('18:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '10',
            'tanggal_masuk' => '2022-11-05',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('18:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);

        //Operator Printer 2
        DB::table('absensis')->insert([
            'pegawai_id' => '14',
            'tanggal_masuk' => '2022-11-01',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('18:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '14',
            'tanggal_masuk' => '2022-11-02',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('18:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '14',
            'tanggal_masuk' => '2022-11-03',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('18:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '14',
            'tanggal_masuk' => '2022-11-04',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('18:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '14',
            'tanggal_masuk' => '2022-11-05',
            'jam_masuk' => Carbon::parse('12:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('18:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);

        //Kasir 3
        DB::table('absensis')->insert([
            'pegawai_id' => '6',
            'tanggal_masuk' => '2022-11-01',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '6',
            'tanggal_masuk' => '2022-11-02',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '6',
            'tanggal_masuk' => '2022-11-03',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '6',
            'tanggal_masuk' => '2022-11-04',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '6',
            'tanggal_masuk' => '2022-11-05',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);

        //Desainer 5
        DB::table('absensis')->insert([
            'pegawai_id' => '11',
            'tanggal_masuk' => '2022-11-01',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '11',
            'tanggal_masuk' => '2022-11-02',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '11',
            'tanggal_masuk' => '2022-11-03',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '11',
            'tanggal_masuk' => '2022-11-04',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '11',
            'tanggal_masuk' => '2022-11-05',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);

        //Desainer 6
        DB::table('absensis')->insert([
            'pegawai_id' => '12',
            'tanggal_masuk' => '2022-11-01',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '12',
            'tanggal_masuk' => '2022-11-02',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '12',
            'tanggal_masuk' => '2022-11-03',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '12',
            'tanggal_masuk' => '2022-11-04',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '12',
            'tanggal_masuk' => '2022-11-05',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);

        //Operator Printer 3
        DB::table('absensis')->insert([
            'pegawai_id' => '15',
            'tanggal_masuk' => '2022-11-01',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '15',
            'tanggal_masuk' => '2022-11-02',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '15',
            'tanggal_masuk' => '2022-11-03',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '15',
            'tanggal_masuk' => '2022-11-04',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
        DB::table('absensis')->insert([
            'pegawai_id' => '15',
            'tanggal_masuk' => '2022-11-05',
            'jam_masuk' => Carbon::parse('18:00:00'),
            'longitude_masuk' => '112.6871203',
            'latitude_masuk' => '-7.2630996',
            'tanggal_keluar' => '2022-11-01',
            'jam_keluar' => Carbon::parse('00:00:00'),
            'longitude_keluar' => '112.6871203',
            'latitude_keluar' => '-7.2630996',
            'status' => 'hadir',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}

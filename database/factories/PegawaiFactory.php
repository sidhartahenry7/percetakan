<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_pegawai' => $this->faker->numerify('EMP-###'),
            'nama_lengkap' => $this->faker->name(),
            'alamat' => 'Jalan Tes No. '.$this->faker->randomNumber(2, false),
            'nomor_handphone' => $this->faker->unique()->randomNumber(7, true),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'password',
            'rekening_bank' => $this->faker->word(),
            'nomor_rekening' => $this->faker->randomNumber(7, true),
            'tanggal_masuk' => $this->faker->date(),
            'user_role' => $this->faker->word(),
            'cabang_id' => 1
        ];
    }
}

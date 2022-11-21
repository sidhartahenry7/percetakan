<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_produk' => $this->faker->numerify('PRD-###'),
            'nama_produk' => $this->faker->sentence(3),
            'spesifikasi' => $this->faker->sentence(15),
            'harga' => $this->faker->randomNumber(4, true),
            'jumlah_stok' => $this->faker->randomNumber(3, false)
        ];
    }
}

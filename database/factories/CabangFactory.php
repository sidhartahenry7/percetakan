<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CabangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_cabang' => $this->faker->numerify('CDV-###'),
            'alamat' => 'Jalan '.$this->faker->word().' No. '.$this->faker->randomNumber(2, false),
            'longitude' => $this->faker->randomFloat(2, -7, 0),
            'latitude' => $this->faker->randomFloat(2, 10, 20),
            'nomor_telepon' => $this->faker->randomNumber(7, true)
        ];
    }
}

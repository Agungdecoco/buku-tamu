<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConsultantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // return [
        //     'nip' => $this->faker->randomNumber(8),
        //     'nama_konsultan' => $this->faker->name,
        //     'tlp_konsultan' => $this->faker->phoneNumber,
        //     'email_konsultan' => $this->faker->unique()->safeEmail(),
        //     'jabatan_konsultan' => $this->faker->randomElement(['konsultan dastik', 'kepala dastik']),
        //     'isActive' => $this->faker->randomElement(['1', '0']),
        // ];
    }
}

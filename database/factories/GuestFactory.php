<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory(1)->create()->first();
        return [
            'nip' => $this->faker->randomNumber(8),
            'users_id' => $user->id,
            'nama_tamu' => $this->faker->name,
            'tlp_tamu' => $this->faker->phoneNumber,
            'jabatan_tamu' => $this->faker->randomElement(['Kepala Dinas', 'Sekertaris', 'Kepala Departemen']),
            'instansi' => $this->faker->company,
            'foto' => $this->faker->imageUrl(640, 480, 'people'),
        ];
    }
}

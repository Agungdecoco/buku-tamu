<?php

namespace Database\Factories;

use App\Models\Guest;
use App\Models\Consultant;
use Illuminate\Database\Eloquent\Factories\Factory;

class QueueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    //  protected $model = YourModel::class;
    private $startDate = '2023-01-01';
    private $endDate = '2024-12-01';

    public function definition()
    {
        $guest = Guest::all('nip');
        $consultant = Consultant::all('nip');

        $endDate = new \DateTime($this->endDate);
        $startDate = new \DateTime($this->startDate);
        $differenceInDays = $this->faker->unique()->numberBetween(0, $endDate->diff($startDate)->days);
        $tgl = date('Y-m-d', strtotime("{$this->startDate} +{$differenceInDays} days"));

        $tipe_konsultasi = $this->faker->randomElement(['offline', 'online']);
        $ruang = $tipe_konsultasi === 'offline'
            ? $this->faker->randomElement(['Ruang1', 'Ruang2', 'Ruang3'])
            : 'link';

        return [
            'tgl_konsultasi' => $tgl,
            'sesi' => $this->faker->randomElement(['pagi1', 'pagi2', 'siang']),
            'consultants_nip' => $this->faker->randomElement($consultant),
            'guests_nip' => $this->faker->randomElement($guest),
            'topik' => $this->faker->text(),
            'tipe_konsultasi' => $tipe_konsultasi,
            'ruang' => $ruang,
            'anggota1' => $this->faker->name,
            'anggota2' => $this->faker->name,
            'anggota3' => $this->faker->name,
        ];
    }
}

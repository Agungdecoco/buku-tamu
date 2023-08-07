<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Guest;
use App\Models\Queue;
use App\Models\Consultant;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QueueControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function it_edit_queue()
    {
        $user = User::factory()->create([
            'status' => 'admin',
        ]);

        $user_guest = User::factory()->create([
            'status' => $this->faker->randomElement(['VIP', 'NONVIP']),
        ]);

        $guest = Guest::factory()->create([
            'nip' => '1234567890',
            'users_id' => $user_guest->id,
            'nama_tamu' => $this->faker->name,
            'tlp_tamu' => $this->faker->phoneNumber,
            'jabatan_tamu' => $this->faker->randomElement(['Kepala Dinas', 'Sekertaris', 'Kepala Departemen']),
            'instansi' => $this->faker->company,
            'foto' => $this->faker->imageUrl(640, 480, 'people'),
        ]);

        $consultant = Consultant::factory()->create([
            'nip' => '1234567890',
            'nama_konsultan' => $this->faker->name,
            'tlp_konsultan' => $this->faker->phoneNumber,
            'email_konsultan' => $this->faker->unique()->safeEmail(),
            'jabatan_konsultan' => $this->faker->randomElement(['konsultan dastik', 'kepala dastik']),
            'isActive' => $this->faker->randomElement(['1', '0']),
        ]);

        $queue = Queue::factory()->create([
            'tgl_konsultasi' => $this->faker->date(),
            'sesi' => $this->faker->randomElement(['Pagi', 'Siang', 'Siang2']),
            'consultants_nip' => '1234567890',
            'guests_nip' => '1234567890',
            'topik' => $this->faker->text(),
            'tipe_konsultasi' => $this->faker->randomElement(['Konsultasi', 'Konsultasi', 'Konsultasi']),
            'ruang' => $this->faker->randomElement(['Ruang1', 'Ruang2', 'Ruang3']),
            'anggota1' => $this->faker->text(),
            'anggota2' => $this->faker->text(),
            'anggota3' => $this->faker->text(),
        ]);

        $response = $this->actingAs($user)
            ->post(route('admin-request-update', $queue->id), [
                'ruang' => 'ruang 4',
            ]);

        $response->assertStatus(302);

        $response->assertRedirect(route('admin-request'));
    }
}

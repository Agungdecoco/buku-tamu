<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PhpOffice\PhpSpreadsheet\Calculation\Category;


class LoginControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function guest_can_view_login_page()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('login.index');
    }

    /** @test */
    public function guest_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'status' => $this->faker->randomElement(['NONVIP', 'VIP', 'consultant']),
            'remember_token' => Str::random(10),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret',
        ]);

        $response->assertStatus(302);
    }
}

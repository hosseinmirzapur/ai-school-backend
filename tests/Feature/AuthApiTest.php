<?php

namespace Tests\Feature;

use App\Models\Student;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    public function test_login()
    {
        /** @var Student $student */
        $student = Student::all()->random();

        $this->post('/api/auth/login', [
            'username' => $student->username,
            'password' => 'password',
        ], [
            'Accept' => 'application/json'
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'student', 'token'
            ]);
    }

    public function test_logout()
    {
        $this->actingAs(Student::all()->random())
            ->post('/api/auth/logout')
            ->assertStatus(200);

        $this->assertTrue(true);
    }
}

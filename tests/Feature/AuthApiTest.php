<?php

namespace Tests\Feature;

use App\Models\Student;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    /**
     * @return void
     */
    public function test_login(): void
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

    /**
     * @return void
     */
    public function test_logout(): void
    {
        $this->actingAs(Student::all()->random())
            ->post('/api/auth/logout')
            ->assertStatus(200);

        $this->assertTrue(true);
    }
}

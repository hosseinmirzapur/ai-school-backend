<?php

namespace Tests\Feature;

use App\Models\Student;
use Tests\TestCase;

class PageApiTest extends TestCase
{
    public function test_home_returns_required_data()
    {
        $response = $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )
            ->get('/api/pages/home');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'profile', 'notifications', 'monthlyMarks'
        ]);
    }
}

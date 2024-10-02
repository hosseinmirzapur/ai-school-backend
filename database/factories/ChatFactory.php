<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Chat>
 */
class ChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'identifier' => $this->faker->uuid(),
            'title' => $this->faker->sentence(),
            'type' => $this->faker->randomElement(['casual', 'quiz']),
            'score' => $this->faker->numberBetween(0, 20),
            'active' => $this->faker->boolean(),
            'student_id' => Student::all()->random()->id,
        ];
    }
}

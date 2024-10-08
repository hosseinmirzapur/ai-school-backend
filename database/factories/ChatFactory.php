<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\Student;
use App\Models\Subject;
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
        $type = $this->faker->randomElement(['casual', 'quiz']);

        return [
            'identifier' => $this->faker->uuid(),
            'type' => $type,
            'subject_id' => $type === 'casual' ? null : Subject::all()->random()->id,
            'score' => $this->faker->numberBetween(0, 20),
            'active' => $this->faker->boolean(),
            'student_id' => Student::all()->random()->id,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Dictation;
use App\Models\DictationSubmission;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DictationSubmission>
 */
class DictationSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dictation_id' => Dictation::all()->random()->id,
            'student_id' => Student::all()->random()->id,
            'score' => $this->faker->randomElement([
                null, $this->faker->numberBetween(10, 20)
            ]),
            'image' => $this->faker->imageUrl(),
            'text' => $this->faker->paragraph(20),
        ];
    }
}

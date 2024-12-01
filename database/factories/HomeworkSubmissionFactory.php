<?php

namespace Database\Factories;

use App\Models\Homework;
use App\Models\HomeworkSubmission;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HomeworkSubmission>
 */
class HomeworkSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'homework_id' => Homework::all()->random()->id,
            'student_id' => Student::all()->random()->id,
            'submission_file' => $this->faker->imageUrl(),
            'grade' => $this->faker->numberBetween(1, 100),
            'feedback' => $this->faker->paragraph(),
            'submitted_at' => $this->faker->date(),
            'graded_at' => $this->faker->date(),
        ];
    }
}

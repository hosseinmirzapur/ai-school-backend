<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Quiz>
 */
class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text(),
            'subject_id' => Subject::all()->random()->id,
            'lesson_id' => Lesson::all()->random()->id,
            'teacher_id' => Teacher::all()->random()->id,
            'total_marks' => $this->faker->numberBetween(20,100),
        ];
    }
}

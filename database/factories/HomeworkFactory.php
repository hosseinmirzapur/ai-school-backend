<?php

namespace Database\Factories;

use App\Models\Homework;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Homework>
 */
class HomeworkFactory extends Factory
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
            'description' => $this->faker->paragraph(),
            'subject_id' => Subject::all()->random()->id,
            'lesson_id' => Lesson::all()->random()->id,
            'teacher_id' => Teacher::all()->random()->id,
            'due_date' => $this->faker->date(),
        ];
    }
}

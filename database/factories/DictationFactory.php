<?php

namespace Database\Factories;

use App\Models\Dictation;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Dictation>
 */
class DictationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'text' => $this->faker->paragraph(40),
            'lesson_id' => Lesson::all()->random()->id
        ];
    }
}

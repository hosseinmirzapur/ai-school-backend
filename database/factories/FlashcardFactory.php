<?php

namespace Database\Factories;

use App\Models\Flashcard;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Flashcard>
 */
class FlashcardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence() . '?',
            'answer' => $this->faker->word(),
            'image' => $this->faker->imageUrl(width: 400, height: 400),
            'lesson_id' => Lesson::all()->random()->id
        ];
    }
}

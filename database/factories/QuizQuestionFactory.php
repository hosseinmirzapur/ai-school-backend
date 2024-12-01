<?php

namespace Database\Factories;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<QuizQuestion>
 */
class QuizQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text' => $this->faker->text(),
            'type' => $this->faker
                ->randomElement(QuizQuestion::TYPES),
            'options' => $this->faker
                ->randomElement(
                    $this->faker
                        ->words(6)
                ),
            'quiz_id' => Quiz::all()->random()->id,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizSubmission;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<QuizSubmission>
 */
class QuizSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quiz_id' => Quiz::all()->random()->id,
            'student_id' => Student::all()->random()->id,
            'answers' => [
                [
                    'question_id' => QuizQuestion::all()->random()->id,
                    'answer' => $this->faker->words(asText: true),
                ],
                [
                    'question_id' => QuizQuestion::all()->random()->id,
                    'answer' => $this->faker->words(asText: true),
                ],
                [
                    'question_id' => QuizQuestion::all()->random()->id,
                    'answer' => $this->faker->words(asText: true),
                ],
                [
                    'question_id' => QuizQuestion::all()->random()->id,
                    'answer' => $this->faker->words(asText: true),
                ]
            ],
            'score' => $this->faker->randomElement(
                [
                    $this->faker->randomFloat(2, 1, 100),
                    null
                ]
            ),
            'feedback' => $this->faker->paragraph(),
            'submitted_at' => $this->faker->randomElement(
                [null, $this->faker->dateTime()]
            ),
            'graded_at' => $this->faker->randomElement(
                [null, $this->faker->dateTime()]
            ),
        ];
    }
}

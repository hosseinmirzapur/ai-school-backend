<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'role' => $this->faker->randomElement(['bot', 'user']),
            'content' => $this->faker->paragraph(),
            'has_file' => $this->faker->boolean(),
            'has_voice' => $this->faker->boolean(),
            'chat_id' => Chat::all()->random()->id
        ];
    }
}

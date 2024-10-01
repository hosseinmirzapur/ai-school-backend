<?php

namespace Database\Factories;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Slider>
 */
class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => $this->faker->imageUrl(width: 400, height: 300),
            'order' => $this->faker->numberBetween(0, 20),
            'lesson_id' => $this->faker->numberBetween(1, 6),
        ];
    }
}

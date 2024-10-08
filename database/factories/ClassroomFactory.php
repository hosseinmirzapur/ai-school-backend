<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Classroom>
 */
class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'grade' => $this->faker->numberBetween(1, 6),
            'school_id' => School::all()->random()->id,
        ];
    }
}

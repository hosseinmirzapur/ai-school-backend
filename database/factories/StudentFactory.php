<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\School;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'mobile' => $this->faker->phoneNumber(),
            'password' => Hash::make('password'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'dob' => $this->faker->date(),
            'school_id' => School::all()->random()->id,
            'classroom_id' => Classroom::all()->random()->id,
        ];
    }
}

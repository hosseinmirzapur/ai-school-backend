<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title(),
            'description' => $this->faker->text(),
            'thumbnail' => $this->faker->imageUrl(width: 400, height: 300),
            'file' => 'https://videos.pexels.com/video-files/6521834/6521834-uhd_3840_2160_30fps.mp4',
            'lesson_id' => Lesson::all()->random()->id,
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bar = $this->command->getOutput()->createProgressBar(20);

        for ($i = 0; $i < 20; $i++) {
            Video::factory()->create();
            $bar->advance();
        }
        $bar->finish();

        $this->command->getOutput()->success('Videos created successfully!');
    }
}

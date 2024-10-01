<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bar = $this->command->getOutput()->createProgressBar(20);

        for ($i = 0; $i < 20; $i++) {
            Slider::factory()->create();
            $bar->advance();
        }
        $bar->finish();

        $this->command->getOutput()->success('Sliders have been created!');
    }
}

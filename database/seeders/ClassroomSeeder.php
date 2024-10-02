<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bar = $this->command->getOutput()->createProgressBar(6);

        for ($i = 1; $i <= 10; $i++) {
            Classroom::factory()->create();
            $bar->advance();
        }
        $bar->finish();

        $this->command->getOutput()->success("Classrooms created!");
    }
}

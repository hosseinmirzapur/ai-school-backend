<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bar = $this->command->getOutput()->createProgressBar(40);
        for ($i = 0; $i < 40; $i++) {
            Student::factory()->create();
            $bar->advance();
        }
        $bar->finish();

        $this->command->getOutput()->success('Students created successfully!');
    }
}

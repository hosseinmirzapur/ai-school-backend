<?php

namespace Database\Seeders;

use App\Models\QuizSubmission;
use Illuminate\Database\Seeder;

class QuizSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        QuizSubmission::factory(10)->create();
    }
}

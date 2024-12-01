<?php

namespace Database\Seeders;

use App\Models\HomeworkSubmission;
use Illuminate\Database\Seeder;

class HomeworkSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomeworkSubmission::factory(10)->create();
    }
}

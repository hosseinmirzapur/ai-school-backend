<?php

namespace Database\Seeders;

use App\Models\DictationSubmission;
use Illuminate\Database\Seeder;

class DictationSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DictationSubmission::factory(20)->create();
        $this->command
            ->getOutput()
            ->success('Done creating 20 random dictation submissions');
    }
}

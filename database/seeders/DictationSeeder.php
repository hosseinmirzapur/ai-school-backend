<?php

namespace Database\Seeders;

use App\Models\Dictation;
use Illuminate\Database\Seeder;

class DictationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dictation::factory(20)->create();

        $this->command
            ->getOutput()
            ->success('20 random dictation item created.');
    }
}

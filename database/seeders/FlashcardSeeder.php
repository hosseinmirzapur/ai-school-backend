<?php

namespace Database\Seeders;

use App\Models\Flashcard;
use Illuminate\Database\Seeder;

class FlashcardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Flashcard::factory(20)->create();
    }
}

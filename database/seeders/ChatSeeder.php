<?php

namespace Database\Seeders;

use App\Models\Chat;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bar = $this->command->getOutput()->createProgressBar(30);

        for ($i = 0; $i < 30; $i++) {
            Chat::factory()->create();
            $bar->advance();
        }
        $bar->finish();

        $this->command->getOutput()->success('Chats created successfully!');

    }
}

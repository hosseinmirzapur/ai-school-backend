<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = 'Test School';
        $school = School::firstOrCreate([
            'name' => $name,
            'slug' => Str::slug($name)
        ]);

        $this->command->getOutput()->success("School name: {$school->name} created!");
    }
}

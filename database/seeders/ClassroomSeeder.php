<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\School;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = 'Math 101';
        $classroom = Classroom::firstOrCreate([
            'name' => $name,
            'slug' => Str::slug($name),
            'school_id' => School::firstOrFail()->id
        ]);

        $this->command->getOutput()->success("Classroom {$classroom->name} created|existed!}");
    }
}

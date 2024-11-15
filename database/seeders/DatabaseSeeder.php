<?php

namespace Database\Seeders;

use App\Models\DictationSubmission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ClassroomSeeder::class,
            SubjectSeeder::class,
            LessonSeeder::class,
            SliderSeeder::class,
            VideoSeeder::class,
            FlashcardSeeder::class,
            TeacherSeeder::class,
            DailyScheduleSeeder::class,
            StudentSeeder::class,
            ChatSeeder::class,
            MessageSeeder::class,
            DictationSeeder::class,
            DictationSubmission::class
        ]);
    }
}

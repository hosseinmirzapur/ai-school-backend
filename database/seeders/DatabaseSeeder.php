<?php

namespace Database\Seeders;

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
            // These seeders must be called respectively, part 1:
            SchoolSeeder::class,
            RoleSeeder::class,
            AdminSeeder::class,
            ClassroomSeeder::class,
            DailyScheduleSeeder::class,
            // part 2:
            SubjectSeeder::class,
            LessonSeeder::class,
            VideoSeeder::class,
            FlashcardSeeder::class,
            // part 3:
            StudentSeeder::class,
            ChatSeeder::class,
            MessageSeeder::class,

            // These seeders can be called in any order
            TeacherSeeder::class,
            NotificationSeeder::class,
        ]);
    }
}

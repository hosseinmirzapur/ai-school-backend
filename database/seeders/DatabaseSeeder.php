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
            SchoolSeeder::class,
            RoleSeeder::class,
            AdminSeeder::class,
            ClassroomSeeder::class,
            SubjectSeeder::class,
            LessonSeeder::class,
            SliderSeeder::class, // todo
            VideoSeeder::class, // todo
            FlashcardSeeder::class, // todo
            TeacherSeeder::class,
            DailyScheduleSeeder::class,
            StudentSeeder::class, // todo
            ChatSeeder::class, // todo
            MessageSeeder::class, // todo
            NotificationSeeder::class, // todo
        ]);
    }
}

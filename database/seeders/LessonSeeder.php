<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = Subject::whereIn('id', [1, 2, 3, 4, 5])->get();
        $lessons = [
            [
                'name' => 'درس ۱',
                'slug' => Str::slug('unit 1')
            ],
            [
                'name' => 'درس ۲',
                'slug' => Str::slug('unit 2')
            ],
            [
                'name' => 'درس ۳',
                'slug' => Str::slug('unit 3')
            ],
            [
                'name' => 'درس ۴',
                'slug' => Str::slug('unit 4')
            ],
            [
                'name' => 'درس ۵',
                'slug' => Str::slug('unit 5')
            ],

        ];
        foreach ($subjects as $subject) {
            foreach ($lessons as $lesson) {
                Lesson::firstOrCreate([
                    'slug' => $lesson['slug'],
                    'name' => $lesson['name'],
                    'subject_id' => $subject->id,
                ]);
            }
        }

        $this->command->getOutput()->success('Subjects created successfully!');
    }
}

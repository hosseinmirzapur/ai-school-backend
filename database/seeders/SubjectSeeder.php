<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            [
                'name' => 'ریاضی',
                'slug' => Str::slug('math'),
            ],
            [
                'name' => 'علوم تجربی',
                'slug' => Str::slug('science'),
            ],
            [
                'name' => 'ادبیات فارسی',
                'slug' => Str::slug('literature'),
            ],
            [
                'name' => 'مطالعات اجتماعی',
                'slug' => Str::slug('social'),
            ],
            [
                'name' => 'زبان انگلیسی',
                'slug' => Str::slug('english'),
            ]
        ];

        foreach ($subjects as $subject) {
            Subject::firstOrCreate($subject);
        }

        $this->command->getOutput()->success("Done creating subjects!");
    }
}

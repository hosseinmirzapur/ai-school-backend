<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            [
                'name' => 'علی محمدی',
                'mobile' => '09123456789',
                'password' => Hash::make('12345678'),
                'school_id' => School::first()->id,
                'subject_id' => 1 // math
            ],
            [
                'name' => 'محمد حسینی',
                'mobile' => '09120897456',
                'password' => Hash::make('12345678'),
                'school_id' => School::first()->id,
                'subject_id' => 2 // science
            ],
            [
                'name' => 'حسین محمدی',
                'mobile' => '09116215342',
                'password' => Hash::make('12345678'),
                'school_id' => School::first()->id,
                'subject_id' => 3 // farsi
            ],
            [
                'name' => 'مجتبی زاهدی',
                'mobile' => '091003564789',
                'password' => Hash::make('12345678'),
                'school_id' => School::first()->id,
                'subject_id' => 4 // social
            ],
            [
                'name' => 'علی زارعی',
                'mobile' => '0931234567',
                'password' => Hash::make('12345678'),
                'school_id' => School::first()->id,
                'subject_id' => 5 // english
            ]
        ];
        foreach ($teachers as $teacher) {
            Teacher::firstOrCreate($teacher);
        }
        $this->command->getOutput()->success('Teachers created successfully!');
    }
}

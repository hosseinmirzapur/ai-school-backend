<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\DailySchedule;
use Illuminate\Database\Seeder;

class DailyScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classroom = Classroom::firstOrFail();

        $schedules = [
            'sat' => [
                [
                    'subject_id' => 1,
                    'start_time' => '08:00',
                    'end_time' => '09:30',
                    'teacher_id' => 1
                ],
                [
                    'subject_id' => 2,
                    'start_time' => '09:45',
                    'end_time' => '11:00',
                    'teacher_id' => 2
                ],
                [
                    'subject_id' => 3,
                    'start_time' => '11:15',
                    'end_time' => '12:20',
                    'teacher_id' => 3
                ]
            ],
            'sun' => [
                [
                    'subject_id' => 2,
                    'start_time' => '08:00',
                    'end_time' => '09:15',
                    'teacher_id' => 2
                ],
                [
                    'subject_id' => 3,
                    'start_time' => '09:30',
                    'end_time' => '11:20',
                    'teacher_id' => 3
                ],
                [
                    'subject_id' => 4,
                    'start_time' => '11:30',
                    'end_time' => '12:45',
                    'teacher_id' => 4
                ],
                [
                    'subject_id' => 5,
                    'start_time' => '13:15',
                    'end_time' => '14:30',
                    'teacher_id' => 5
                ]
            ],
            'mon' => [
                [
                    'subject_id' => 1,
                    'start_time' => '08:00',
                    'end_time' => '09:15',
                    'teacher_id' => 1
                ],
                [
                    'subject_id' => 2,
                    'start_time' => '09:30',
                    'end_time' => '11:20',
                    'teacher_id' => 2
                ],
                [
                    'subject_id' => 4,
                    'start_time' => '11:30',
                    'end_time' => '12:45',
                    'teacher_id' => 4
                ],
                [
                    'subject_id' => 5,
                    'start_time' => '13:15',
                    'end_time' => '14:30',
                    'teacher_id' => 5
                ]
            ],
            'tue' => [
                [
                    'subject_id' => 3,
                    'start_time' => '08:00',
                    'end_time' => '09:15',
                    'teacher_id' => 3
                ],
                [
                    'subject_id' => 1,
                    'start_time' => '09:30',
                    'end_time' => '11:20',
                    'teacher_id' => 3
                ],
                [
                    'subject_id' => 2,
                    'start_time' => '11:30',
                    'end_time' => '12:45',
                    'teacher_id' => 2
                ],
                [
                    'subject_id' => 3,
                    'start_time' => '13:15',
                    'end_time' => '14:30',
                    'teacher_id' => 3
                ]
            ],
            'wed' => [
                [
                    'subject_id' => 1,
                    'start_time' => '08:00',
                    'end_time' => '09:15',
                    'teacher_id' => 1
                ],
                [
                    'subject_id' => 4,
                    'start_time' => '09:30',
                    'end_time' => '11:20',
                    'teacher_id' => 4
                ],
                [
                    'subject_id' => 5,
                    'start_time' => '11:30',
                    'end_time' => '12:45',
                    'teacher_id' => 5
                ],
                [
                    'subject_id' => 2,
                    'start_time' => '13:15',
                    'end_time' => '14:30',
                    'teacher_id' => 2
                ]
            ],
            'thu' => [
                [
                    'subject_id' => 3,
                    'start_time' => '08:00',
                    'end_time' => '09:15',
                    'teacher_id' => 3
                ],
                [
                    'subject_id' => 4,
                    'start_time' => '09:30',
                    'end_time' => '11:20',
                    'teacher_id' => 4
                ],
            ],
        ];

        foreach ($schedules as $dow => $items) {
            foreach ($items as $item) {
                DailySchedule::firstOrCreate([
                    'dow' => $dow,
                    'start_time' => $item['start_time'],
                    'end_time' => $item['end_time'],
                    'classroom_id' => $classroom->id,
                    'subject_id' => $item['subject_id'],
                    'teacher_id' => $item['teacher_id'],
                ]);
            }
        }

        $this->command->getOutput()->success('Daily schedules have been created.');
    }
}

<?php

namespace App\Services;

use App\Models\Student;

class PageService
{
    /**
     * @return array
     */
    public function home(): array
    {
        /** @var Student $student */
        $student = auth()->user();

        $profile = [
            'fullname' => $student->name,
            'email' => $student->email,
            'grade' => $student->classroom->grade
        ];

        $notifications = $student->notifications;

        $monthlyMarks = [
            'student' => $student->marksForChart(
                [now()->year, now()->month >= 9 ? now()->year + 1 : now()->year - 1]
            ),
            'classroom' => $student->classroom->marksForChart(
                [now()->year, now()->month >= 9 ? now()->year + 1 : now()->year - 1]
            )
        ];

        $marksPerSubject = [
            'student' => $student->marksPerSubject(),
            'classroom' => $student->classroom->marksPerSubject()
        ];

        return [
            'profile' => $profile,
            'notifications' => $notifications,
            'monthlyMarks' => $monthlyMarks,
            'marksPerSubject' => $marksPerSubject
        ];
    }

    /**
     * @return array
     */
    public function sources(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function weeklySchedule(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function notifications(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function settings(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function chat(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function aboutUs(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function contactUs(): array
    {
        return [];
    }
}

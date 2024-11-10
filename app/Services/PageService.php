<?php

namespace App\Services;

use App\Models\Chat;
use App\Models\DailySchedule;
use App\Models\Lesson;
use App\Models\SiteSettings;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Collection;

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
        $subjects = Subject::select(['name', 'slug', 'image'])->get();

        return [
            'sources' => $subjects
        ];
    }

    /**
     * @return array
     */
    public function weeklySchedule(): array
    {
        /** @var Student $student */
        $student = auth()->user();

        $weeklySchedule = $student
            ->classroom
            ->dailySchedules()
            ->with('subject')
            ->orderBy('start_time')
            ->get()
            ->groupBy('dow');
        $resData = [];
        $index = 0;
        /**
         * @var string $day
         * @var Collection<DailySchedule> $schedules
         */
        foreach ($weeklySchedule as $day => $schedules) {
            $resData[$index]['day'] = $this->formatDay($day);
            $resData[$index]['subjects'] = $schedules;
            $resData[$index]['fullDuration'] = $schedules->sum('duration');
            $index++;
        }

        return [
            'schedule' => $resData,
        ];
    }

    private function formatDay(string $day): string {
        return match($day) {
            'sat' => 'saturday',
            'sun' => 'sunday',
            'mon' => 'monday',
            'tue' => 'tuesday',
            'wed' => 'wednesday',
            'thu' => 'thursday',
        };
    }

    /**
     * @return array
     */
    public function notifications(): array
    {
        $notifications = []; // empty for now

        return [
            'notifications' => $notifications
        ];
    }

    /**
     * @return array
     */
    public function settings(): array
    {
        return [
            'settings' => []
        ];
    }

    /**
     * @return array
     */
    public function chat(): array
    {
        /** @var Student $student */
        $student = auth()->user();

        // fetching only the last 24 hours student chats
        $chats = $student
            ->chats()
            ->where('active', true)
            ->where('type', 'casual')
            ->whereDate(
                'created_at',
                '>=',
                now()->subDay()
            )
            ->select([
                'identifier', 'type', 'score', 'active'
            ])
            ->get();

        return [
            'chats' => $chats
        ];
    }

    /**
     * @return array
     */
    public function aboutUs(): array
    {
        return [
            'aboutUs' => SiteSettings::aboutUs()
        ];
    }

    /**
     * @return array
     */
    public function contactUs(): array
    {
        return [
            'contactUs' => SiteSettings::contactUs()
        ];
    }

    public function lessons(Subject $subject): array
    {
        $lessons = $subject->lessons;

        return [
            'lessons' => $lessons
        ];
    }

    /**
     * @param Lesson $lesson
     * @return array
     */
    public function sliders(Lesson $lesson): array
    {
        return [
            'sliders' => $lesson->sliders
        ];
    }

    /**
     * @param Lesson $lesson
     * @return array
     */
    public function videos(Lesson $lesson): array
    {
        return [
            'videos' => $lesson->videos
        ];
    }

    /**
     * @param Lesson $lesson
     * @return array
     */
    public function flashcards(Lesson $lesson): array
    {
        return [
            'flashcards' => $lesson->flashcards
        ];
    }

    /**
     * @param Chat $chat
     * @return array
     */
    public function messages(Chat $chat): array
    {
        $messages = $chat->messages;

        return [
            'messages' => $messages
        ];
    }
}

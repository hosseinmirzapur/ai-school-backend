<?php

namespace App\Services;

use App\Models\Chat;
use App\Models\DailySchedule;
use App\Models\Flashcard;
use App\Models\Homework;
use App\Models\HomeworkSubmission;
use App\Models\Lesson;
use App\Models\SiteSettings;
use App\Models\Slider;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Video;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

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
        $subjects = Subject::select(['name', 'image', 'id'])->get();
        $resData = [];
        /** @var Subject $subject */
        foreach ($subjects as $subject) {
            $resData[] = [
                'id' => $subject->id,
                'title' => $subject->name,
                'imageSrc' => $subject->image ? Storage::url($subject->image) : null,
            ];
        }

        return [
            'sources' => $resData
        ];
    }

    /**
     * @return array
     */
    public function weeklySchedule(): array
    {
        /** @var Student $student */
        $student = auth()->user();

        $order = [
            'sat', 'sun', 'mon', 'tue', 'wed', 'thu'
        ];
        $weeklySchedule = $student
            ->classroom
            ->dailySchedules()
            ->with('subject')
            ->orderBy('start_time')
            ->get()
            ->groupBy('dow')
            ->sortby(function ($schedules, $dow) use ($order) {
                return array_search($dow, $order);
            });
        $resData = [];
        $index = 0;
        /**
         * @var string $day
         * @var Collection<DailySchedule> $schedules
         */
        foreach ($weeklySchedule as $day => $schedules) {
            $resData[$index]['day'] = $this->formatDay($day);
            $resData[$index]['subjects'] = $schedules->map(function (DailySchedule $schedule) {
                return [
                    'title' => $schedule->subject->name,
                    'duration' => $schedule->duration,
                ];
            });
            $resData[$index]['fullDuration'] = $schedules->sum('duration');
            $index++;
        }

        return [
            'schedule' => $resData,
        ];
    }

    private function formatDay(string $day): string
    {
        return match ($day) {
            'sat' => 'saturday',
            'sun' => 'sunday',
            'mon' => 'monday',
            'tue' => 'tuesday',
            'wed' => 'wednesday',
            'thu' => 'thursday',
            default => 'friday'
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

    public function lessons(Subject $subject, bool $load): array
    {
        $query = Lesson::query()->where('subject_id', $subject->id);
        if ($load) {
            $query = $query->with([
                'flashcards', 'videos', 'sliders'
            ]);
        }
        $lessons = $query
            ->get()
            ->map(function (Lesson $lesson) {
                return [
                    'id' => $lesson->id,
                    'name' => $lesson->name,
                    'flashcards' => $lesson->flashcards->map(function (Flashcard $flashcard) {
                        return [
                            'id' => $flashcard->id,
                            'question' => $flashcard->question,
                            'answer' => $flashcard->answer,
                            'image' => $flashcard->image ? Storage::url($flashcard->image) : null,
                        ];
                    }),
                    'sliders' => $lesson->sliders()
                        ->orderByDesc('order')
                        ->get()
                        ->map(function (Slider $slider) {
                            return [
                                'id' => $slider->id,
                                'image' => $slider->image ? Storage::url($slider->image) : null,
                                'order' => $slider->order,
                            ];
                        }),
                    'videos' => $lesson->videos->map(function (Video $video) {
                        return [
                            'id' => $video->id,
                            'title' => $video->title,
                            'description' => $video->description,
                            'thumbnail' => $video->thumbnail,
                            'file' => $video->file,
                        ];
                    }),
                ];
            });

        return [
            'lessons' => $lessons,
            'subject' => [
                'title' => $subject->name,
                'id' => $subject->id
            ]
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

    /**
     * @return array
     */
    public function homework(): array
    {
        $homework = Homework::with([
            'subject', 'lesson', 'teacher', 'submissions'
        ])
            ->get()
            ->map(function (Homework $homework) {
                return [
                    'id' => $homework->id,
                    'title' => $homework->title,
                    'description' => $homework->description,
                    'subject' => $homework->subject->name,
                    'lesson' => $homework->lesson->name,
                    'teacher' => $homework->teacher->name,
                    'due_date' => $homework->due_date,
                    'status' => $homework->decideStatus()
                ];
            });

        /** @var Student $student */
        $student = auth()->user();

        $submissions = $student->homeworkSubmissions()
            ->get()
            ->map(function (HomeworkSubmission $submission) {
                return [
                    'id' => $submission->id,
                    'subject' => $submission->homework->subject->name,
                    'lesson' => $submission->homework->lesson->name,
                    'homework_title' => $submission->homework->title,
                    'submitted_at' => $submission->submitted_at,
                    'grade' => $submission->grade,
                    'graded_at' => $submission->graded_at,
                    'feedback' => $submission->feedback,
                    'file' => $submission->submission_file ? Storage::url($submission->submission_file) : null,
                ];
            });

        return [
            'homework' => $homework,
            'submissions' => $submissions
        ];
    }

    public function quiz()
    {
        // todo: implement this
    }
}

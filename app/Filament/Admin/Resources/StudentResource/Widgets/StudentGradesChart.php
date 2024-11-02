<?php

namespace App\Filament\Admin\Resources\StudentResource\Widgets;

use App\Models\Chat;
use App\Models\Student;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class StudentGradesChart extends ChartWidget
{
    protected static ?string $heading = 'نمودار میانگین نمرات دانش آموزان';
    protected int|string|array $columnSpan = '1';
    protected static ?string $pollingInterval = null;

    protected function getData(): array
    {
        $query = Chat::query();

        if ($this->filter) {
            $query->where('student_id', $this->filter);
        }

        $data = Trend::query(
            $query->where('type', 'quiz')
        )
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->average('score');

        return [
            'datasets' => [
                [
                    'label' => 'میانگین نمرات دانش آموزان طی هر ماه',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            /** @phpstan-ignore-next-line */
            'labels' => $data->map(fn(TrendValue $value) => verta($value->date)->format('%B %Y')),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getFilters(): ?array
    {
        $students = Student::query()
            ->whereHas('chats', function ($builder) {
                $builder->where('type', 'quiz');
            })
            ->pluck('username', 'id');
        return $students->toArray();
    }
}

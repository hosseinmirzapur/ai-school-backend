<?php

namespace App\Filament\Admin\Resources\StudentResource\Widgets;

use App\Models\Chat;
use App\Models\Student;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class ChatUsageChart extends ChartWidget
{
    protected static ?string $heading = 'مصرف چت ماهیانه دانش آموزان';
    protected static ?string $pollingInterval = null;
    public ?string $filter = null;
    protected int | string | array $columnSpan = '1';

    protected function getData(): array
    {
        $query = Chat::query();
        if ($this->filter) {
            $query->where('student_id', $this->filter);
        }
        $data = Trend::query($query)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear()
            )
            ->perMonth()
            ->count();
        return [
            'datasets' => [
                [
                    'label' => 'چت های ایجاد شده',
                    'data' => $data->map(fn(TrendValue $value) => intval($value->aggregate))
                ]
            ],
            /** @phpstan-ignore-next-line */
            'labels' => $data->map(fn(TrendValue $value) => verta($value->date)->format('%B %Y'))
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getFilters(): ?array
    {
        $filters = Student::select(['students.id', 'students.username'])
            ->pluck('students.username', 'students.id');

        return $filters->toArray();
    }
}

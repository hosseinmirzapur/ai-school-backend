<?php

namespace App\Filament\Exports;

use App\Models\Student;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class StudentExporter extends Exporter
{
    protected static ?string $model = Student::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('#'),
            ExportColumn::make('name')
                ->label('نام کامل'),
            ExportColumn::make('mobile')
                ->label('شماره موبایل'),
            ExportColumn::make('email')
                ->label('ایمیل'),
            ExportColumn::make('username')
                ->label('نام کاربری'),
            ExportColumn::make('gender')
                ->label('جنسیت')
                ->formatStateUsing(fn(string $state) => match ($state) {
                    'male' => 'پسر',
                    'female' => 'دختر',
                    default => 'تعیین نشده'
                }),
            ExportColumn::make('dob')
                ->label('تاریخ تولد')
                /** @phpstan-ignore-next-line */
                ->formatStateUsing(fn(string $state) => verta($state)->format('Y/m/d')),
            ExportColumn::make('classroom.name')
                ->label('نام کلاس')
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'فرایند خروجی گرفتن از دانش آموزان موفقیت آمیز بود و ' . number_format($export->successful_rows) . 'دانش آموز ' . ' در خروجی قرار گرفت.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . 'دانش آموز' . ' دارای خطا در گرفتن خروجی بودند.';
        }

        return $body;
    }


}

<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\StudentResource\Pages;
use App\Filament\Exports\StudentExporter;
use App\Models\Student;
use Exception;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\Exports\Models\Export;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Storage;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;
    protected static ?string $label = 'دانش آموز';
    protected static ?string $pluralLabel = 'دانش آموزان';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';


    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('نام کامل'),
            Select::make('gender')
                ->label('جنسیت')
                ->options([
                    'male' => 'پسر',
                    'female' => 'دختر',
                    'null' => 'تعیین نشده'
                ])
                ->native(false),
            DatePicker::make('dob')
                ->label('تاریخ تولد')
                ->timezone('Asia/Tehran')
                ->format('Y/m/d')
                ->native(false)
        ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Tables\Actions\ExportAction::make('students')
                    ->after(function () {
                        $id = Export::query()->latest()->first()->id;
                        $path = "filament_exports/$id/export-$id-students.xlsx";
                        $stdCount = Student::count();
                        $waitBaseTime = 0.05;
                        // wait until the file is created
                        sleep($stdCount * $waitBaseTime);

                        if (Storage::disk('public')->exists($path)) {
                            return response()->stream(
                                function () use ($path, $id) {
                                    $stream = Storage::disk('public')->readStream($path);
                                    fpassthru($stream);
                                    fclose($stream);

                                    Storage::disk('public')->deleteDirectory('filament_exports/' . $id);
                                    Export::truncate();
                                },
                                200,
                                [
                                    'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                    'Content-Disposition' => "attachment; filename=export-$id-students.xlsx",
                                ]
                            );
                        } else {
                            abort(404);
                        }
                    })
                    ->exporter(StudentExporter::class)
                    ->formats([
                        ExportFormat::Xlsx
                    ])
                    ->label('خروجی اکسل دانش آموزان')
                    ->icon('heroicon-o-cloud-arrow-down')
                    ->color('primary')
            ])
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('نام کامل')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextInputColumn::make('mobile')
                    ->label('شماره موبایل')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextInputColumn::make('email')
                    ->label('ایمیل')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextInputColumn::make('username')
                    ->label('نام کاربری')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label('جنسیت')
                    ->toggleable()
                    ->formatStateUsing(function (string $state) {
                        return match ($state) {
                            'male' => 'پسر',
                            'female' => 'دختر',
                            default => 'تعیین نشده'
                        };
                    }),
                Tables\Columns\TextColumn::make('dob')
                    ->label('تاریخ تولد')
                    ->date('Y/m/d')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('classroom.name')
                    ->label('نام کلاس')
                    ->toggleable()
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('gender')
                    ->label('جنسیت')
                    ->options([
                        'male' => 'پسر',
                        'female' => 'دختر',
                        'null' => 'تعیین نشده'
                    ])
                    ->native(false)
            ])
            ->actions(
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                ])
            )
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ExportBulkAction::make('students')
                        ->exporter(StudentExporter::class)
                        ->formats([
                            ExportFormat::Xlsx
                        ])
                        ->label('خروجی اکسل دانش آموزان')
                        ->icon('heroicon-o-cloud-arrow-down')
                        ->color('primary')
                        ->after(function () {
                            $id = Export::query()->latest()->first()->id;
                            $path = "filament_exports/$id/export-$id-students.xlsx";
                            $stdCount = Student::count();
                            $waitBaseTime = 0.05;
                            // wait until the file is created
                            sleep($stdCount * $waitBaseTime);

                            if (Storage::disk('public')->exists($path)) {
                                return response()->stream(
                                    function () use ($path, $id) {
                                        $stream = Storage::disk('public')->readStream($path);
                                        fpassthru($stream);
                                        fclose($stream);

                                        Storage::disk('public')->deleteDirectory('filament_exports/' . $id);
                                        Export::truncate();
                                    },
                                    200,
                                    [
                                        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                        'Content-Disposition' => "attachment; filename=export-$id-students.xlsx",
                                    ]
                                );
                            } else {
                                abort(404);
                            }
                        })
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            // todo: add some widgets
        ];
    }
}

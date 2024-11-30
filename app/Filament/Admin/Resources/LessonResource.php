<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\LessonResource\Pages;
use App\Filament\Admin\Resources\LessonResource\RelationManagers\FlashcardsRelationManager;
use App\Filament\Admin\Resources\LessonResource\RelationManagers\SlidersRelationManager;
use App\Filament\Admin\Resources\LessonResource\RelationManagers\VideosRelationManager;
use App\Models\Lesson;
use App\Models\Subject;
use Exception;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;
    protected static ?string $label = 'درس';
    protected static ?string $pluralLabel = 'درس ها';
    protected static ?string $navigationGroup = 'محتوای درسی';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark-square';

    /**
     * @return bool
     */
    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        $subjects = Subject::all()->pluck('name', 'id');

        return $form
            ->schema([
                TextInput::make('name')
                    ->label('اسم درس')
                    ->helperText('عنوان کتابی که میخواهید ایجاد کنید را در این قسمت بنویسید')
                    ->required(),
                TextInput::make('slug')
                    ->label('شناسه')
                    ->helperText('این فیلد به صورت خودکار پر میشود')
                    ->default(
                        Str::lower(Str::random(10))
                    ),
                Select::make('subject_id')
                    ->label('کتاب درسی')
                    ->options($subjects)
                    ->native(false)
            ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        $filterOptions = Subject::all()->pluck('name', 'id');

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#'),
                Tables\Columns\TextColumn::make('subject.name')
                    ->searchable()
                    ->label('نام کتاب'),
                Tables\Columns\TextInputColumn::make('name')
                    ->searchable()
                    ->label('نام درس'),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->label('شناسه')
            ])
            ->actions(
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->label('مدیریت')
                        ->tooltip('ویرایش درس یا محتوای آن'),
                    Tables\Actions\ViewAction::make()
                        ->tooltip('نمایش جزییات درس و محتوای آن'),
                    Tables\Actions\DeleteAction::make(),
                ])
            )
            ->filters([
                Tables\Filters\SelectFilter::make('subject_to_find')
                    ->label('درس')
                    ->options($filterOptions)
                    ->attribute('subject_id')
                    ->native(false)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            SlidersRelationManager::class,
            VideosRelationManager::class,
            FlashcardsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLessons::route('/'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
            'view' => Pages\ViewLesson::route('/{record}'),
        ];
    }
}

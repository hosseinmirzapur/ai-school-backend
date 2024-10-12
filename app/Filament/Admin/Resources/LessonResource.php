<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\LessonResource\Pages;
use App\Filament\Admin\Resources\LessonResource\RelationManagers\FlashcardsRelationManager;
use App\Filament\Admin\Resources\LessonResource\RelationManagers\SlidersRelationManager;
use App\Filament\Admin\Resources\LessonResource\RelationManagers\VideosRelationManager;
use App\Models\Lesson;
use App\Models\Subject;
use Exception;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;
    protected static ?string $label = 'درس';
    protected static ?string $pluralLabel = 'درس ها';
    protected static ?string $navigationGroup = 'محتوای درسی';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark-square';

    public static function canCreate(): bool
    {
        return false;
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
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
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
            FlashcardsRelationManager::class
        ]; // todo: implement relations tables
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

<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\FlashcardResource\Pages;
use App\Models\Flashcard;
use App\Models\Lesson;
use App\Models\Subject;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FlashcardResource extends Resource
{
    protected static ?string $model = Flashcard::class;

    protected static ?string $pluralModelLabel = 'فلش کارت ها';
    protected static ?string $modelLabel = 'فلش کارت';

    protected static ?string $navigationLabel = 'فلش کارت ها';
    protected static ?string $navigationGroup = 'محتوای درسی';

    protected static ?string $navigationIcon = 'tabler-cards';

    public static function form(Form $form): Form
    {
        $subjects = Subject::with('lessons')->get();
        $selectOptions = [];

        /** @var Subject $subject */
        foreach ($subjects as $subject) {
            /** @var Lesson $lesson */
            foreach ($subject->lessons as $lesson) {
                $selectOptions[$subject->name][$lesson->id] = "$lesson->name - $subject->name";
            }
        }

        return $form
            ->schema([
                TextInput::make('question')
                    ->label('سوال')
                    ->helperText('متن سوالی که میخواهید روی فلش کارت نمایش داده شود')
                    ->required(),
                TextInput::make('answer')
                    ->label('جواب')
                    ->helperText('متن جوابی که دانش آموز بعد از چرخاندن کارت میبیند')
                    ->required(),
                Select::make('lesson_id')
                    ->label('کتاب - درس')
                    ->options($selectOptions)
                    ->searchable(),
                FileUpload::make('image')
                    ->label('عکس (اختیاری)')
                    ->helperText('عکسی که میخواهید بر روی فلش کارت نمایش داده شود')
                    ->nullable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextInputColumn::make('question')
                    ->label('سوال'),
                Tables\Columns\TextInputColumn::make('answer')
                    ->label('جواب'),
                Tables\Columns\ImageColumn::make('image')
                    ->label('تصویر')
                    ->square()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFlashcards::route('/'),
            'create' => Pages\CreateFlashcard::route('/create'),
            'edit' => Pages\EditFlashcard::route('/{record}/edit'),
        ];
    }
}

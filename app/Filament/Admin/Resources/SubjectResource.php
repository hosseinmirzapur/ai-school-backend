<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SubjectResource\Pages;
use App\Filament\Admin\Resources\SubjectResource\RelationManagers\LessonsRelationManager;
use App\Models\Subject;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;
    protected static ?string $modelLabel = 'کتاب';
    protected static ?string $pluralModelLabel = 'کتاب ها';

    protected static ?string $navigationLabel = 'کتاب ها';
    protected static ?string $navigationGroup = 'محتوای درسی';

    protected static ?string $navigationIcon = 'tabler-book';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('اسم کتاب')
                    ->helperText('عنوان کتابی که میخواهید ایجاد کنید را در این قسمت بنویسید')
                    ->required(),
                TextInput::make('slug')
                    ->label('شناسه')
                    ->default(
                        Str::lower(Str::random(10))
                    )
                    ->autocomplete()
                    ->disabled(),
                FileUpload::make('image')
                    ->label('عکس')
                    ->nullable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable(),
                TextInputColumn::make('name')
                    ->label('اسم کتاب'),
                Tables\Columns\TextColumn::make('slug')
                    ->label('شناسه')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('عکس')
                    ->square()

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()
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
            LessonsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubjects::route('/'),
            'create' => Pages\CreateSubject::route('/create'),
            'edit' => Pages\EditSubject::route('/{record}/edit'),
            'view' => Pages\ViewSubject::route('/{record}'),
        ];
    }
}

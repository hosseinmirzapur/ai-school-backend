<?php

namespace App\Filament\Admin\Resources\SubjectResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class LessonsRelationManager extends RelationManager
{
    protected static string $relationship = 'lessons';
    protected static ?string $label = 'درس';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('نام درس')
                    ->required()
                    ->helperText('نام درسی که میخواهید را اینجا وارد نمایید')
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label('شناسه')
                    ->required()
                    ->helperText('این فیلد به صورت خودکار تولید میشود')
                    ->default(
                        Str::lower(
                            Str::random(10)
                        )
                    )
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('درس ها')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#'),
                Tables\Columns\TextColumn::make('name')
                    ->label('درس')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('شناسه')
                    ->searchable()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

}

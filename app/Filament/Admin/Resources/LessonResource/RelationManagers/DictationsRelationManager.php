<?php

namespace App\Filament\Admin\Resources\LessonResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DictationsRelationManager extends RelationManager
{
    protected static string $relationship = 'dictations';

    protected static ?string $label = 'دیکته';
    protected static ?string $pluralLabel = 'دیکته ای';

    protected static ?string $badge = 'دیکته ها';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('عنوان'),
                Forms\Components\RichEditor::make('text')
                    ->label('متن املا')
                    ->helperText('در این قسمت میتوانید متنی که برای املای این درس است را وارد نمایید')
                    ->disableGrammarly()
                    ->disableToolbarButtons([
                        'attachFiles'
                    ])
                    ->required(),
                Forms\Components\FileUpload::make('voice')
                    ->label('فایل صوتی')
                    ->helperText('فایل صوتی املای درس که دانش آموزان با شنیدن آن باید متن آن را ارسال کنند')
                    ->acceptedFileTypes(['audio/*'])
            ])->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('دیکته ها')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#'),
                Tables\Columns\TextInputColumn::make('title')
                    ->label('عنوان'),
                Tables\Columns\TextColumn::make('lesson.name')
                    ->label('نام درس'),
                Tables\Columns\TextColumn::make('text')
                    ->label('متن دیکته')
                    ->words(6)
                    ->html(),
                Tables\Columns\ViewColumn::make('voice')
                    ->label('فایل صوتی')
                    ->view('filament.tables.columns.audio-column')
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}

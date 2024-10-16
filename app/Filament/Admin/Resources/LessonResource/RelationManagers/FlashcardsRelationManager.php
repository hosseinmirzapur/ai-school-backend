<?php

namespace App\Filament\Admin\Resources\LessonResource\RelationManagers;

use Exception;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class FlashcardsRelationManager extends RelationManager
{
    protected static string $relationship = 'flashcards';
    protected static ?string $label = 'فلش کارت';
    protected static ?string $pluralLabel = 'فلش کارتی';

    protected static ?string $badge = 'فلش کارت ها';

    /**
     * @throws Exception
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('question')
                    ->label('متن سوال')
                    ->helperText('این متن بر روی فلش کارت نمایش داده میشود')
                    ->required(),
                Forms\Components\RichEditor::make('answer')
                    ->label('جواب')
                    ->helperText('این متن پشت فلش کارت نمایش داده میشود')
                    ->disableGrammarly()
                    ->disableToolbarButtons([
                        'attachFiles'
                    ])
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->label('عکسی که در پس زمینه فلش کارت دیده میشود')
                    ->image()
                    ->imageEditor()
                    ->imageEditorMode(2)
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                        null
                    ])
                    ->imageEditorEmptyFillColor('#000000')
                    ->uploadingMessage('در حال آپلود...')
            ])
            ->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('فلش کارت ها')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#'),
                Tables\Columns\TextInputColumn::make('question')
                    ->label('متن سوال')
                    ->tooltip('این متن بر روی فلش کارت نمایش داده میشود')
                    ->searchable()
                    ->rules([
                        'required', 'max:255', 'string'
                    ]),
                Tables\Columns\TextColumn::make('answer')
                    ->label('جواب')
                    ->tooltip('این متن پشت فلش کارت نمایش داده میشود')
                    ->searchable()
                    ->html(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('عکس')
                    ->tooltip('عکسی که در پس زمینه فلش کارت دیده میشود')
                    ->square()
                    ->height(90)
                    ->toggleable()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                    ->button()
                    ->outlined()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

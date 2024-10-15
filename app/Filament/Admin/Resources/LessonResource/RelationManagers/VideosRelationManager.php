<?php

namespace App\Filament\Admin\Resources\LessonResource\RelationManagers;

use App\Models\Video;
use Exception;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class VideosRelationManager extends RelationManager
{
    protected static string $relationship = 'videos';
    protected static ?string $label = 'ویدئو';
    protected static ?string $pluralLabel = 'ویدئو ها';
    protected static ?string $badge = 'ویدئو ها';

    /**
     * @throws Exception
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('عنوان')
                    ->required(),
                Forms\Components\RichEditor::make('description')
                    ->label('توضیحات')
                    ->disableToolbarButtons([
                        'attachFiles'
                    ])
                    ->disableGrammarly(),
                Forms\Components\FileUpload::make('thumbnail')
                    ->label('عکس پیش نمایش')
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
                    ->uploadingMessage('در حال آپلود...'),
                Forms\Components\FileUpload::make('file')
                    ->label('فایل ویدئو')
                    ->acceptedFileTypes([
                        'video/mp4',
                        'video/webm',
                        'video/ogg'
                    ])
                    ->maxSize(200_000) // in kilobytes
                    ->uploadingMessage('در حال آپلود...')
            ])->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('ویدئو ها')
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable(),
                Tables\Columns\TextInputColumn::make('title')
                    ->label('عنوان')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('توضیحات')
                    ->searchable()
                    ->tooltip(fn(Video $video) => $video->description)
                    ->words(5),
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('تصویر پیش نمایش')
                    ->square()
                    ->height(80)
                    ->checkFileExistence(false),
                Tables\Columns\TextColumn::make('file')
                    ->label('ویدئو')
                    ->formatStateUsing(function ($state) {
                        return "
                            <video width='150' height='100' controls>
                                <source src=$state type='video/mp4'>
                                Your browser does not support the video tag.
                            </video>";
                    })
                    ->html()
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

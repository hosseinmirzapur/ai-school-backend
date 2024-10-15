<?php

namespace App\Filament\Admin\Resources\LessonResource\RelationManagers;

use App\Models\Slider;
use Exception;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class SlidersRelationManager extends RelationManager
{
    protected static string $relationship = 'sliders';

    protected static ?string $label = 'اسلایدر';
    protected static ?string $pluralLabel = 'اسلایدری';
    protected static ?string $badge = 'اسلایدر ها';

    /**
     * @throws Exception
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->label('عکس اسلایدر')
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
                    ->required()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->defaultSort('order', 'desc')
            ->heading('اسلایدر ها')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#'),
                Tables\Columns\ImageColumn::make('image')
                    ->label('عکس اسلایدر')
                    ->square()
                    ->height(90),
                Tables\Columns\SelectColumn::make('order')
                    ->label('اولویت نمایش')
                    ->sortable()
                    ->tooltip('اولویت نمایش هر چه بیشتر باشد اسلاید جلوتر نمایش داده میشود')
                    ->options(function (Slider $slider) {
                        $count = $slider->lesson->sliders()->count();
                        return range(0, $count + 1);
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ ثبت')
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

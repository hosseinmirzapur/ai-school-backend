<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DictationResource\Pages;
use App\Models\DictationSubmission;
use Exception;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DictationSubmissionResource extends Resource
{
    protected static ?string $model = DictationSubmission::class;
    protected static ?string $label = 'املا ارسال شده';
    protected static ?string $pluralLabel = 'املا های ارسال شده';
    protected static ?string $navigationGroup = 'محتوای درسی';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-pencil';

    /**
     * @return bool
     */
    public static function canCreate(): bool
    {
        return false;
    }

    /**
     * This function is only used for edit purposes
     * @param Form $form
     * @return Form
     */
    public static function form(Form $form): Form
    {
        return $form->schema([
            Textarea::make('text')
                ->label('متن ارسالی')
                ->readOnly()
                ->rows(10),
            ViewField::make('image')
                ->label('عکس ارسالی')
                ->view('filament.forms.components.image-field')
        ])
            ->columns(1);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('dictation.title')
                    ->label('عنوان دیکته'),
                Tables\Columns\TextColumn::make('student.username')
                    ->label('دانش آموز'),
                Tables\Columns\TextInputColumn::make('score')
                    ->label('نمره'),
                Tables\Columns\ImageColumn::make('image')
                    ->label('تصویر ارسالی')
                    ->square(),
                Tables\Columns\TextColumn::make('text')
                    ->label('متن ارسالی')->words(6),
                TextColumn::make('created_at')
                    ->sortable()
                    ->label('تاریخ ارسال')
            ])
            ->filters([
                Tables\Filters\Filter::make('not_score')
                    ->query(fn(Builder $query) => $query->whereNull('score'))
                    ->label('نمره داده نشده ها')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListDictations::route('/'),
        ];
    }
}

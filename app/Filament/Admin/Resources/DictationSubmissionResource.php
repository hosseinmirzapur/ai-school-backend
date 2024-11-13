<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DictationResource\Pages;
use App\Models\DictationSubmission;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DictationSubmissionResource extends Resource
{
    protected static ?string $model = DictationSubmission::class;
    protected static ?string $label = 'املا ارسال شده';
    protected static ?string $pluralLabel = 'املا های ارسال شده';
    protected static ?string $navigationGroup = 'محتوای درسی';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-pencil';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table // todo
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
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

<?php

namespace App\Filament\Admin\Resources\DictationResource\Pages;

use App\Filament\Admin\Resources\DictationSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDictations extends ListRecords
{
    protected static string $resource = DictationSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

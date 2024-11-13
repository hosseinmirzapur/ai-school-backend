<?php

namespace App\Filament\Admin\Resources\DictationResource\Pages;

use App\Filament\Admin\Resources\DictationSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDictation extends EditRecord
{
    protected static string $resource = DictationSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

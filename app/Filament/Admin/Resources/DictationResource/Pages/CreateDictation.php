<?php

namespace App\Filament\Admin\Resources\DictationResource\Pages;

use App\Filament\Admin\Resources\DictationSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDictation extends CreateRecord
{
    protected static string $resource = DictationSubmissionResource::class;
}

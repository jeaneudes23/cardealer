<?php

namespace App\Filament\Resources\ModelResource\Pages;

use App\Filament\Resources\ModelResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewModel extends ViewRecord
{
    protected static string $resource = ModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

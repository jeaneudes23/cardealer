<?php

namespace App\Filament\Resources\MakeResource\Pages;

use App\Filament\Resources\MakeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMake extends ViewRecord
{
    protected static string $resource = MakeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

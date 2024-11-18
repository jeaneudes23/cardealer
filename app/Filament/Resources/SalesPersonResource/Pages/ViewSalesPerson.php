<?php

namespace App\Filament\Resources\SalesPersonResource\Pages;

use App\Filament\Resources\SalesPersonResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSalesPerson extends ViewRecord
{
    protected static string $resource = SalesPersonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

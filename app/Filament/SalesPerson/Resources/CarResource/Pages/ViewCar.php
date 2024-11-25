<?php

namespace App\Filament\SalesPerson\Resources\CarResource\Pages;

use App\Filament\SalesPerson\Resources\CarResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCar extends ViewRecord
{
    protected static string $resource = CarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

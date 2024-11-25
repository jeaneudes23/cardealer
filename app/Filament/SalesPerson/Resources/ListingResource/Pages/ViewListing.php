<?php

namespace App\Filament\SalesPerson\Resources\ListingResource\Pages;

use App\Filament\SalesPerson\Resources\ListingResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewListing extends ViewRecord
{
    protected static string $resource = ListingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

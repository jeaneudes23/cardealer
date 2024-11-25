<?php

namespace App\Filament\SalesPerson\Resources\SaleResource\Pages;

use App\Filament\SalesPerson\Resources\SaleResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ViewRecord;

class ViewSale extends ViewRecord
{
    protected static string $resource = SaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

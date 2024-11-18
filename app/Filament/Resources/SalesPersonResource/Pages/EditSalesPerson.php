<?php

namespace App\Filament\Resources\SalesPersonResource\Pages;

use App\Filament\Resources\SalesPersonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSalesPerson extends EditRecord
{
    protected static string $resource = SalesPersonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

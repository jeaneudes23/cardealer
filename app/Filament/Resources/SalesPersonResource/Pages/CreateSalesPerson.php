<?php

namespace App\Filament\Resources\SalesPersonResource\Pages;

use App\Filament\Resources\SalesPersonResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSalesPerson extends CreateRecord
{
    protected static string $resource = SalesPersonResource::class;
}

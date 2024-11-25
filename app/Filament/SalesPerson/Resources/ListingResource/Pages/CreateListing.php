<?php

namespace App\Filament\SalesPerson\Resources\ListingResource\Pages;

use App\Filament\SalesPerson\Resources\ListingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateListing extends CreateRecord
{
    protected static string $resource = ListingResource::class;
}

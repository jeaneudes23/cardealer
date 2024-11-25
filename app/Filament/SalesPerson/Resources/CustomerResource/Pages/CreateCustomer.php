<?php

namespace App\Filament\SalesPerson\Resources\CustomerResource\Pages;

use App\Filament\SalesPerson\Resources\CustomerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;
}

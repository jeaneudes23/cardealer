<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
      $user = User::first();
      Notification::make()
      ->title('Hello')
      ->body('Notify this fuckin shit man')
      ->sendToDatabase($user);

      return $data;
    }
}

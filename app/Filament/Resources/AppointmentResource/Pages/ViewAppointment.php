<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Filament\Resources\AppointmentResource;
use App\Filament\SalesPerson\Resources\AppointmentResource as ResourcesAppointmentResource;
use App\Models\User;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Notifications\Actions\Action as ActionsAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewAppointment extends ViewRecord
{
  protected static string $resource = AppointmentResource::class;

  protected function getHeaderActions(): array
  {
    return [
      Action::make('Appoint')
        ->form([
          Select::make('sales_person_id')
            ->relationship('salesPerson', 'name')
            ->preload()
            ->required()
            ->default($this->getRecord()->sales_person_id)
            ->searchable()
        ])
        ->color('gray')
        ->action(function (array $data) {
          $this->getRecord()->update([
            'sales_person_id' => $data['sales_person_id']
          ]);

          Notification::make()
            ->title('New appointment')
            ->actions([
              ActionsAction::make('View')
                ->url(fn() => ResourcesAppointmentResource::getUrl('view', ['record' => $this->getRecord()->id]))
            ])
            ->sendToDatabase(User::find($this->getRecord()->sales_person_id));

          Notification::make()
            ->title("Appointment assigned to ".$this->getRecord()->salesPerson->name)
            ->success()
            ->send();
        }),
      Actions\EditAction::make(),

    ];
  }
}

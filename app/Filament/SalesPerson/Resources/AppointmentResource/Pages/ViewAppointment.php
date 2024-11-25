<?php

namespace App\Filament\SalesPerson\Resources\AppointmentResource\Pages;

use App\Filament\SalesPerson\Resources\AppointmentResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Livewire\Notifications;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewAppointment extends ViewRecord
{
  protected static string $resource = AppointmentResource::class;

  protected function getHeaderActions(): array
  {
    return [
      Actions\EditAction::make(),
      Action::make('Respond')
        ->form([
          Group::make()
            ->columns(2)
            ->schema([
              Select::make('status')
                ->options([
                  'pending' => 'Pending',
                  'cancelled' => 'Cancelled',
                  'scheduled' => 'Scheduled',
                  'completed' => 'Completed'
                ])
                ->native(0)
                ->default('pending'),
              DateTimePicker::make('date')
              ->required()
              ->default(Carbon::parse($this->getRecord()->date))
              ->native(0),
              Textarea::make('sales_person_message')
              ->default($this->getRecord()->sales_person_message)
                ->columnSpanFull(),
            ])
        ])
        ->action(function(array $data) {
          $this->getRecord()->update($data);
          Notification::make()
            ->title("Feeback sent to customer")
            ->success()
            ->send();
          $this->refreshFormData(['status','sales_person_message','date']);
        })
        ->successRedirectUrl(fn () => AppointmentResource::getUrl('view', ['record' => $this->getRecord()->id]))
    ];
  }
}

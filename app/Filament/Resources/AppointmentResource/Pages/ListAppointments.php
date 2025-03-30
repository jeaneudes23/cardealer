<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Filament\Resources\AppointmentResource;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Resources\Pages\ListRecords;

class ListAppointments extends ListRecords
{
    protected static string $resource = AppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('Report')
            ->color('gray')
            ->icon('heroicon-o-calendar')
            ->action(function(array $data) {
              return redirect()->route('report.index',$data);
            })
            ->form([
              Group::make()
              ->columns(2)
              ->schema([
                DatePicker::make('from')
                ->required(),
                DatePicker::make('to')
                ->required(),
              ])
            ])
            
        ];
    }
}

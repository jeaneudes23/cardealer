<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\AppointmentResource;
use App\Models\Appointment;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TodaysAppointments extends BaseWidget
{

  protected int | string | array $columnSpan = 'full';

  protected static ?string $heading = "Upcoming Appointments";

  public function table(Table $table): Table
  {
    return $table
      ->query(Appointment::where('status', 'scheduled')->whereBetween('date', [now()->startOfDay(), now()->endOfWeek()]))
      ->columns([
        Tables\Columns\TextColumn::make('customer.name')
          ->numeric()
          ->searchable(),
        Tables\Columns\TextColumn::make('salesPerson.name')
          ->numeric()
          ->searchable(),
        Tables\Columns\TextColumn::make('car.name')
          ->numeric(),
        Tables\Columns\TextColumn::make('date')
          ->dateTime()
          ->sortable(),
      ])
      ->recordUrl(fn(Appointment $record) => AppointmentResource::getUrl('view', ['record' => $record->id]));
  }
}

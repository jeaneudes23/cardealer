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

  public function table(Table $table): Table
  {
    return $table
      ->query(
        Appointment::whereDate('date', today())
      )
      ->columns([
        Tables\Columns\TextColumn::make('customer.name')
          ->numeric()
          ->searchable(),
        Tables\Columns\TextColumn::make('car.name')
          ->numeric(),
        Tables\Columns\TextColumn::make('staff.name')
          ->numeric()
          ->searchable(),
        Tables\Columns\TextColumn::make('date')
          ->dateTime()
          ->sortable(),
        Tables\Columns\TextColumn::make('status')
          ->badge(),
      ])
      ->recordUrl(fn (Appointment $record) => AppointmentResource::getUrl('view', ['record'=>$record->id]));
  }
}

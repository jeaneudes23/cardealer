<?php

namespace App\Filament\SalesPerson\Widgets;

use App\Filament\Resources\AppointmentResource;
use App\Models\Appointment;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class UpcomingManagerAppointments extends BaseWidget
{

  protected int | string | array $columnSpan = 'full';

  protected static ?string $heading = "Upcoming Appointments";


  public function table(Table $table): Table

  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('customer.name')
          ->numeric()
          ->searchable(),
        Tables\Columns\TextColumn::make('car.name')
          ->numeric(),
        Tables\Columns\TextColumn::make('date')
          ->dateTime()
          ->sortable(),
      ])
      ->query(Appointment::where('sales_person_id', Auth::user()->id)->where('status', 'scheduled')->whereBetween('date', [now()->startOfDay(), now()->endOfWeek()]))
      ->actions([])
      ->defaultSort('date', 'asc');
  }
}

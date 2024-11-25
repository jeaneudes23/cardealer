<?php

namespace App\Livewire;

use App\Filament\Resources\AppointmentResource;
use App\Models\Appointment;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class CustomerAppointmentsTable extends BaseWidget
{

  public function table(Table $table): Table
  {
    return $table
      ->query(
        Appointment::query()->where('customer_id', Auth::user()->id)
      )
      ->columns([
        // ...
        TextColumn::make('car.name'),
        TextColumn::make('salesPerson.name'),
        TextColumn::make('status')
          ->sortable()
          ->badge()
          ->color(fn(string $state) => match ($state) {
            'pending' => 'gray',
            'cancelled' => 'danger',
            'approved' => 'success',
            'completed' => 'info',
            default => 'gray'
          }),
        TextColumn::make('date')
          ->sortable()
          ->dateTime(),
        TextColumn::make('created_at')
          ->sortable()
          ->dateTime()
      ])
      ->filters([
        SelectFilter::make('status')
          ->options([
            'pending' => 'Pending',
            'cancelled' => 'Cancelled',
            'approved' => 'Approved',
            'completed' => 'Completed'
          ])
      ])
      ->actions([
        ViewAction::make()
          ->form(fn(Form $form) => AppointmentResource::form($form))
      ]);
  }
}

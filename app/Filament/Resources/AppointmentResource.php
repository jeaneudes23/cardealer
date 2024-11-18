<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Filament\Resources\AppointmentResource\RelationManagers;
use App\Models\Appointment;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AppointmentResource extends Resource
{
  protected static ?string $model = Appointment::class;

  protected static ?string $navigationIcon = 'heroicon-o-calendar';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make()
          ->columns(2)
          ->schema([
            Forms\Components\Select::make('customer_id')
              ->required()
              ->relationship('customer', 'name')
              ->searchable(),
            Forms\Components\Select::make('car_id')
              ->relationship('car', 'name')
              ->searchable(),
            Forms\Components\Select::make('sales_person_id')
              ->relationship('salesPerson', 'name')
              ->searchable(),
            Forms\Components\DateTimePicker::make('date')
              ->required(),
            Forms\Components\Textarea::make('message')
              ->columnSpanFull(),
            Forms\Components\Select::make('status')
              ->options([
                'pending' => 'Pending',
                'cancelled' => 'Cancelled',
                'scheduled' => 'Scheduled',
                'completed' => 'Completed'
              ])
              ->native(0)
              ->default('pending'),
          ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('customer.name')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('car.name')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('salesPerson.name')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('date')
          ->dateTime()
          ->sortable(),
        Tables\Columns\TextColumn::make('status')
          ->badge()
          ->color(fn(string $state) => match ($state) {
            'pending' => 'gray',
            'scheduled' => 'success',
            'cancelled' => 'danger',
            'completed' => 'info',
            default => 'gray'
          }),
        Tables\Columns\TextColumn::make('created_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
        Tables\Columns\TextColumn::make('updated_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
      ])
      ->defaultSort('created_at','desc')
      ->filters([
        //
      ])
      ->actions([
        Tables\Actions\ViewAction::make(),
        Tables\Actions\EditAction::make(),
      ])
      ->bulkActions([
        Tables\Actions\BulkActionGroup::make([
          Tables\Actions\DeleteBulkAction::make(),
        ]),
      ]);
  }

  public static function getRelations(): array
  {
    return [
      //
    ];
  }

  public static function getPages(): array
  {
    return [
      'index' => Pages\ListAppointments::route('/'),
      'create' => Pages\CreateAppointment::route('/create'),
      'view' => Pages\ViewAppointment::route('/{record}'),
      'edit' => Pages\EditAppointment::route('/{record}/edit'),
    ];
  }
}

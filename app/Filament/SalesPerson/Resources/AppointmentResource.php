<?php

namespace App\Filament\SalesPerson\Resources;

use App\Filament\SalesPerson\Resources\AppointmentResource\Pages;
use App\Filament\SalesPerson\Resources\AppointmentResource\RelationManagers;
use App\Models\Appointment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class AppointmentResource extends Resource
{
  protected static ?string $model = Appointment::class;

  protected static ?string $navigationIcon = 'heroicon-o-calendar';

  public static function canEdit(Model $record): bool
  {
    return false;
  }

  public static function canCreate(): bool
  {
    return false;
  }

  public static function canView(Model $record): bool
  {
    return $record->sales_person_id == Auth::user()->id;
  }
  
  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\Select::make('customer_id')
          ->relationship('customer', 'name')
          ->required(),
        Forms\Components\Select::make('car_id')
          ->relationship('car', 'name'),
        Forms\Components\Select::make('sales_person_id')
          ->relationship('salesPerson', 'name'),
        Forms\Components\DateTimePicker::make('date')
          ->required(),
        Forms\Components\Textarea::make('message')
          ->columnSpanFull(),
        Forms\Components\TextInput::make('status')
          ->required(),
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
        Tables\Columns\TextColumn::make('status'),
        Tables\Columns\TextColumn::make('created_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
        Tables\Columns\TextColumn::make('updated_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
      ])
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
      ])
      ->modifyQueryUsing(fn (Builder $query) => $query->where('sales_person_id', Auth::user()->id));
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

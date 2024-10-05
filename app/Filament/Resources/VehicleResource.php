<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Resources\VehicleResource\RelationManagers;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleResource extends Resource
{
  protected static ?string $model = Vehicle::class;

  protected static ?string $navigationIcon = 'ionicon-car-sport';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\TextInput::make('brand_id')
          ->numeric(),
        Forms\Components\TextInput::make('model_id')
          ->numeric(),
        Forms\Components\TextInput::make('quality'),
        Forms\Components\TextInput::make('year')
          ->required(),
        Forms\Components\TextInput::make('price')
          ->required()
          ->numeric()
          ->prefix('$'),
        Forms\Components\TextInput::make('mileage')
          ->numeric(),
        Forms\Components\TextInput::make('vin')
          ->required()
          ->maxLength(255),
        Forms\Components\TextInput::make('colors'),
        Forms\Components\TextInput::make('status')
          ->required(),
        Forms\Components\TextInput::make('images')
          ->required(),
        Forms\Components\Textarea::make('description')
          ->columnSpanFull(),
        Forms\Components\TextInput::make('is_active')
          ->required()
          ->numeric()
          ->default(1),
        Forms\Components\TextInput::make('is_featured')
          ->required()
          ->numeric()
          ->default(0),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('brand_id')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('model_id')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('quality'),
        Tables\Columns\TextColumn::make('year'),
        Tables\Columns\TextColumn::make('price')
          ->money()
          ->sortable(),
        Tables\Columns\TextColumn::make('mileage')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('vin')
          ->searchable(),
        Tables\Columns\TextColumn::make('status'),
        Tables\Columns\TextColumn::make('is_active')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('is_featured')
          ->numeric()
          ->sortable(),
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
      'index' => Pages\ListVehicles::route('/'),
      'create' => Pages\CreateVehicle::route('/create'),
      'view' => Pages\ViewVehicle::route('/{record}'),
      'edit' => Pages\EditVehicle::route('/{record}/edit'),
    ];
  }
}

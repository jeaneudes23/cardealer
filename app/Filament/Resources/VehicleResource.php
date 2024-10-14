<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Resources\VehicleResource\RelationManagers;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleResource extends Resource
{
  protected static ?string $model = Vehicle::class;

  protected static ?string $navigationIcon = 'ionicon-car-sport';
  protected static ?string $navigationGroup = 'Vehicles';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make()
          ->columns(2)
          ->schema([
            Select::make('make_id')
              ->relationship('make', 'name')
              ->searchable()
              ->preload(),
            Select::make('model_id')
              ->preload()
              ->relationship(name: 'model', titleAttribute: 'name', modifyQueryUsing: fn(Builder $query, Get $get) => $query->where('make_id', $get('make_id')))
              ->searchable(),
            Select::make('categories')
              ->multiple()
              ->preload()
              ->searchable()
              ->relationship('categories', 'name'),
            Forms\Components\TextInput::make('year')
              ->required(),
            FileUpload::make('image')
          ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\ImageColumn::make('image')
          ->sortable(),
        Tables\Columns\TextColumn::make('model.name')
          ->searchable()
          ->sortable(),
        Tables\Columns\TextColumn::make('year')
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

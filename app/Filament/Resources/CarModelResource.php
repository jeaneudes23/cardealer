<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarModelResource\Pages;
use App\Filament\Resources\CarModelResource\RelationManagers;
use App\Models\CarModel;
use Filament\Forms;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CarModelResource extends Resource
{
  protected static ?string $model = CarModel::class;

  protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';
  protected static ?string $navigationGroup = 'Cars';
  protected static ?string $navigationLabel = 'Models';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\Section::make('')
          ->columns(2)
          ->schema([
            Forms\Components\Select::make('brand_id')
              ->relationship('brand', 'name')
              ->searchable()
              ->preload(),
            Forms\Components\TextInput::make('name')
              ->required()
              ->unique(ignoreRecord:true)
              ->maxLength(255),
            Toggle::make('is_featured'),
          ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('brand.name')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('name')
          ->searchable(),
        Tables\Columns\TextColumn::make('slug')
          ->searchable(),
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
      'index' => Pages\ListCarModels::route('/'),
      'create' => Pages\CreateCarModel::route('/create'),
      'view' => Pages\ViewCarModel::route('/{record}'),
      'edit' => Pages\EditCarModel::route('/{record}/edit'),
    ];
  }
}

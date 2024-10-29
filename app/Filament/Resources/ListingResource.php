<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ListingResource\Pages;
use App\Filament\Resources\ListingResource\RelationManagers;
use App\Models\Listing;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ListingResource extends Resource
{
  protected static ?string $model = Listing::class;

  protected static ?string $navigationIcon = 'ionicon-car-outline';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make()
          ->columns(2)
          ->schema([
            Forms\Components\Select::make('car_id')
              ->relationship('car', 'name')
              ->searchable()
              ->required(),
            Forms\Components\Select::make('condition')
              ->options([
                'new' => 'New',
                'used' => 'Used',
              ])
              ->native(0)
              ->required(),
            Forms\Components\TextInput::make('title')
              ->required()
              ->maxLength(255),
            Forms\Components\TextInput::make('vin'),
            Forms\Components\TextInput::make('mileage')
              ->numeric(),
            Forms\Components\TextInput::make('price')
              ->required()
              ->numeric()
              ->prefix(fn(Get $get) => Str::upper($get('currency'))),
            Forms\Components\Select::make('currency')
              ->options([
                'rwf' => 'RWF',
                'usd' => 'USD',
              ])
              ->native(0)
              ->live(),
            Forms\Components\Toggle::make('is_negotiable'),
            Forms\Components\FileUpload::make('cover_image')
              ->image()
              ->columnSpanFull()
              ->required(),
            Forms\Components\FileUpload::make('images')
              ->image()
              ->columnSpanFull()
              ->maxFiles(4)
              ->multiple(),
            Forms\Components\Toggle::make('is_available'),
          ])

      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('title')
          ->wrap()
          ->lineClamp(1)
          ->searchable(),
        Tables\Columns\TextColumn::make('car.name')
          ->searchable()
          ->sortable(),
        Tables\Columns\TextColumn::make('condition'),
        Tables\Columns\TextColumn::make('mileage')
          ->numeric()
          ->toggleable(isToggledHiddenByDefault: true)
          ->sortable(),
        Tables\Columns\TextColumn::make('vin')
          ->toggleable(isToggledHiddenByDefault: true)
          ->searchable(),
        Tables\Columns\TextColumn::make('price')
          ->suffix(fn (Listing $record) => Str::upper(' '.$record->currency))
          ->sortable(),
        Tables\Columns\ImageColumn::make('cover_image')
        ->toggleable(isToggledHiddenByDefault: true),
        Tables\Columns\ToggleColumn::make('is_negotiable')
          ->toggleable(isToggledHiddenByDefault: true)
          ->sortable(),
        Tables\Columns\ToggleColumn::make('is_available')
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
      'index' => Pages\ListListings::route('/'),
      'create' => Pages\CreateListing::route('/create'),
      'view' => Pages\ViewListing::route('/{record}'),
      'edit' => Pages\EditListing::route('/{record}/edit'),
    ];
  }
}

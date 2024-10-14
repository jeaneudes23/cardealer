<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ModelResource\Pages;
use App\Filament\Resources\ModelResource\RelationManagers;
use App\Models\Brand;
use App\Models\Model;
use App\Models\VehicleModel;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;


class ModelResource extends Resource
{
  protected static ?string $model = VehicleModel::class;

  protected static ?string $navigationIcon = 'ionicon-barcode-outline';
  protected static ?string $navigationGroup = 'Vehicles';
  protected static ?string $modelLabel = 'Model';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\Section::make('')
          ->columns(2)
          ->schema([
            Forms\Components\Select::make('make_id')
            ->relationship('make','name')
            ->searchable()
            ->preload(),
            Forms\Components\TextInput::make('name')
              ->required()
              ->maxLength(255),
          ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\ImageColumn::make('make.image')
        ->label('Make'),
        Tables\Columns\TextColumn::make('name')
          ->description(fn (VehicleModel $record) => $record->make->name)
          ->searchable(),
        Tables\Columns\TextColumn::make('slug')
          ->searchable()
          ->toggleable(isToggledHiddenByDefault: true),
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
      'index' => Pages\ListModels::route('/'),
      'create' => Pages\CreateModel::route('/create'),
      'view' => Pages\ViewModel::route('/{record}'),
      'edit' => Pages\EditModel::route('/{record}/edit'),
    ];
  }
}

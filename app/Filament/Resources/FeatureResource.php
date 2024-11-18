<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeatureResource\Pages;
use App\Filament\Resources\FeatureResource\RelationManagers;
use App\Models\Feature;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeatureResource extends Resource
{
  protected static ?string $model = Feature::class;

  protected static ?string $navigationIcon = 'heroicon-o-star';
  protected static ?string $navigationGroup = 'Content Management';


  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make()
        ->schema([
          Forms\Components\TextInput::make('title')
          ->required()
          ->maxLength(255),
        Forms\Components\Textarea::make('description')
          ->required()
          ->maxLength(255),
        ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('title')
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
      'index' => Pages\ListFeatures::route('/'),
      'create' => Pages\CreateFeature::route('/create'),
      'view' => Pages\ViewFeature::route('/{record}'),
      'edit' => Pages\EditFeature::route('/{record}/edit'),
    ];
  }
}

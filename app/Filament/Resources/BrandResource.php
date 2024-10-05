<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Filament\Resources\BrandResource\RelationManagers;
use App\Models\Brand;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class BrandResource extends Resource
{
  protected static ?string $model = Brand::class;

  protected static ?string $navigationIcon = 'ionicon-help-buoy-outline';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\Section::make('')
          ->columns(2)
          ->schema([
            Forms\Components\TextInput::make('name')
              ->live(onBlur: true)
              ->afterStateUpdated(fn($state, Set $set) => $set('slug', Str::slug($state)))
              ->required()
              ->maxLength(255),
            Forms\Components\Toggle::make('is_active')
            ->default(1),
            Forms\Components\FileUpload::make('image')
              ->image(),
            Forms\Components\Hidden::make('slug'),
          ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')
          ->searchable(),
        Tables\Columns\ImageColumn::make('image'),
        Tables\Columns\TextColumn::make('slug')
          ->searchable(),
        Tables\Columns\ToggleColumn::make('is_active'),
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
      'index' => Pages\ListBrands::route('/'),
      'create' => Pages\CreateBrand::route('/create'),
      'view' => Pages\ViewBrand::route('/{record}'),
      'edit' => Pages\EditBrand::route('/{record}/edit'),
    ];
  }
}

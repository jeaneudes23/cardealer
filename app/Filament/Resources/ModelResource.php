<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ModelResource\Pages;
use App\Filament\Resources\ModelResource\RelationManagers;
use App\Models\Brand;
use App\Models\Model;
use Filament\Forms;
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
  protected static ?string $model = Model::class;

  protected static ?string $navigationIcon = 'ionicon-barcode-outline';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\Section::make('')
          ->columns(2)
          ->schema([
            Forms\Components\Select::make('brand_id')
            ->relationship('brand','name')
            ->searchable()
            ->preload(),
            Forms\Components\TextInput::make('name')
              ->live(onBlur: true)
              ->afterStateUpdated(fn($state, Get $get , Set $set) => $set('slug', Str::slug(Brand::find($get('brand_id'))->name.'-'.$state)))
              ->required()
              ->maxLength(255),
            Forms\Components\Toggle::make('is_active')
              ->default(1),
            Forms\Components\Hidden::make('slug'),
          ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\ImageColumn::make('brand.image')
        ->label('Brand'),
        Tables\Columns\TextColumn::make('name')
          ->searchable(),
        Tables\Columns\TextColumn::make('slug')
          ->searchable(),
        Tables\Columns\TextColumn::make('is_active')
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
      'index' => Pages\ListModels::route('/'),
      'create' => Pages\CreateModel::route('/create'),
      'view' => Pages\ViewModel::route('/{record}'),
      'edit' => Pages\EditModel::route('/{record}/edit'),
    ];
  }
}

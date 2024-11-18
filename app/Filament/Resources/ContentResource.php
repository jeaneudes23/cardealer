<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContentResource\Pages;
use App\Filament\Resources\ContentResource\RelationManagers;
use App\Models\Content;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContentResource extends Resource
{
  protected static ?string $model = Content::class;

  protected static ?string $navigationIcon = 'ionicon-aperture-outline';
  protected static ?string $navigationGroup = 'Content Management';

  public static function canCreate(): bool
  {
    return Content::count() == 0;
  }

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make()
          ->columns(2)
          ->schema([
            Forms\Components\FileUpload::make('hero_section_image')
              ->required(),
            Forms\Components\TextInput::make('hero_section_badge')
              ->required()
              ->maxLength(255),
            Forms\Components\TextInput::make('hero_section_title')
              ->required()
              ->maxLength(255),
            Forms\Components\TextInput::make('hero_section_description')
              ->required()
              ->maxLength(255),
          ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        ImageColumn::make('hero_section_image')
        ->circular(),
        Tables\Columns\TextColumn::make('hero_section_title')
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
      'index' => Pages\ListContents::route('/'),
      'create' => Pages\CreateContent::route('/create'),
      'view' => Pages\ViewContent::route('/{record}'),
      'edit' => Pages\EditContent::route('/{record}/edit'),
    ];
  }
}

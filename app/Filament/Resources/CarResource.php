<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarResource\Pages;
use App\Filament\Resources\CarResource\RelationManagers;
use App\Models\Car;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CarResource extends Resource
{
  protected static ?string $model = Car::class;

  protected static ?string $navigationIcon = 'ionicon-car-sport';
  protected static ?string $navigationGroup = 'Cars';


  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Tabs::make()
          ->columnSpanFull()
          ->schema([
            Tab::make('Basic Info')
            ->columns(2)
              ->schema([
                TextInput::make('name')->required(),
                Select::make('brand_id')
                  ->relationship('brand', 'name')
                  ->searchable()
                  ->preload(),
                Select::make('car_model_id')
                  ->preload()
                  ->relationship(name: 'model', titleAttribute: 'name', modifyQueryUsing: fn(Builder $query, Get $get) => $query->where('brand_id', $get('brand_id')))
                  ->searchable(),
                Select::make('types')
                  ->multiple()
                  ->preload()
                  ->searchable()
                  ->relationship('types', 'name'),
                Toggle::make('is_featured'),
                Forms\Components\TextInput::make('year')
                  ->numeric()
                  ->maxValue(3000)
                  ->required(),
                FileUpload::make('image')
                ->required(),
                Textarea::make('summary')

              ]),
            Tab::make('Overview')
              ->schema([
                TagsInput::make('features')
                ->placeholder('New Feature')
                ->columnSpanFull(),
                RichEditor::make('overview')
              ]),
            Tab::make('Engine')
            ->columns(2)
            ->schema([
              TextInput::make('engine_type'),
              TextInput::make('horse_power'),
              TextInput::make('top_speed'),
              TextInput::make('fuel_type'),
            ]),
            Tab::make('Transmission')
            ->columns(2)
            ->schema([
              TextInput::make('transmission_type')
              ->datalist([
                'Manual', 'Automatic', 'Semi-Automatic'
              ]),
              TextInput::make('number_of_gears')
              ->numeric(),
            ]),
            Tab::make('Capacity')
            ->columns(2)
            ->schema([
              TextInput::make('fuel_tank_capacity'),
              TextInput::make('number_of_seats')
              ->numeric(),
            ]),
            Tab::make('Measurements')
            ->columns(2)
            ->schema([
              TextInput::make('width'),
              TextInput::make('height'),
              TextInput::make('curb_weight'),
              TextInput::make('payload'),
            ])
            
          ]),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('model.name')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('year'),
        Tables\Columns\ImageColumn::make('image'),
        Tables\Columns\TextColumn::make('slug')
          ->searchable(),
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
      'index' => Pages\ListCars::route('/'),
      'create' => Pages\CreateCar::route('/create'),
      'view' => Pages\ViewCar::route('/{record}'),
      'edit' => Pages\EditCar::route('/{record}/edit'),
    ];
  }
}

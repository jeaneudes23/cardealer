<?php

namespace App\Filament\SalesPerson\Resources;

use App\Filament\SalesPerson\Resources\CarResource\Pages;
use App\Filament\SalesPerson\Resources\CarResource\RelationManagers;
use App\Models\Car;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CarResource extends Resource
{
    protected static ?string $model = Car::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->image(),
                Forms\Components\Textarea::make('summary')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('overview')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('features'),
                Forms\Components\TextInput::make('is_featured')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('reviews_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('average_rating')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Forms\Components\Select::make('brand_id')
                    ->relationship('brand', 'name')
                    ->required(),
                Forms\Components\TextInput::make('car_model_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('year')
                    ->required(),
                Forms\Components\TextInput::make('engine_type')
                    ->maxLength(255),
                Forms\Components\TextInput::make('fuel_type')
                    ->maxLength(255),
                Forms\Components\TextInput::make('horse_power')
                    ->maxLength(255),
                Forms\Components\TextInput::make('top_speed')
                    ->maxLength(255),
                Forms\Components\TextInput::make('transmission_type')
                    ->maxLength(255),
                Forms\Components\TextInput::make('number_of_gears')
                    ->numeric(),
                Forms\Components\TextInput::make('fuel_tank_capacity')
                    ->maxLength(255),
                Forms\Components\TextInput::make('number_of_seats')
                    ->numeric(),
                Forms\Components\TextInput::make('width')
                    ->maxLength(255),
                Forms\Components\TextInput::make('height')
                    ->maxLength(255),
                Forms\Components\TextInput::make('curb_weight')
                    ->maxLength(255),
                Forms\Components\TextInput::make('payload')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('is_featured')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reviews_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('average_rating')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('brand.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('car_model_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('year'),
                Tables\Columns\TextColumn::make('engine_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fuel_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('horse_power')
                    ->searchable(),
                Tables\Columns\TextColumn::make('top_speed')
                    ->searchable(),
                Tables\Columns\TextColumn::make('transmission_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('number_of_gears')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fuel_tank_capacity')
                    ->searchable(),
                Tables\Columns\TextColumn::make('number_of_seats')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('width')
                    ->searchable(),
                Tables\Columns\TextColumn::make('height')
                    ->searchable(),
                Tables\Columns\TextColumn::make('curb_weight')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payload')
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
            'index' => Pages\ListCars::route('/'),
            'create' => Pages\CreateCar::route('/create'),
            'view' => Pages\ViewCar::route('/{record}'),
            'edit' => Pages\EditCar::route('/{record}/edit'),
        ];
    }
}

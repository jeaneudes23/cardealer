<?php

namespace App\Filament\SalesPerson\Resources;

use App\Filament\SalesPerson\Resources\ListingResource\Pages;
use App\Filament\SalesPerson\Resources\ListingResource\RelationManagers;
use App\Models\Listing;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ListingResource extends Resource
{
    protected static ?string $model = Listing::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('car_id')
                    ->relationship('car', 'name')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('overview')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('condition')
                    ->required(),
                Forms\Components\TextInput::make('mileage')
                    ->maxLength(255),
                Forms\Components\TextInput::make('vin')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\TextInput::make('currency')
                    ->required(),
                Forms\Components\FileUpload::make('cover_image')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('images')
                    ->required(),
                Forms\Components\TextInput::make('is_negotiable')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('is_available')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('car.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('condition'),
                Tables\Columns\TextColumn::make('mileage')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vin')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('currency'),
                Tables\Columns\ImageColumn::make('cover_image'),
                Tables\Columns\TextColumn::make('is_negotiable')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('is_available')
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
            'index' => Pages\ListListings::route('/'),
            'create' => Pages\CreateListing::route('/create'),
            'view' => Pages\ViewListing::route('/{record}'),
            'edit' => Pages\EditListing::route('/{record}/edit'),
        ];
    }
}

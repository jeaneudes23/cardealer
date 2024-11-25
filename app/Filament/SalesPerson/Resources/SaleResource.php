<?php

namespace App\Filament\SalesPerson\Resources;

use App\Filament\SalesPerson\Resources\SaleResource\Pages;
use App\Filament\SalesPerson\Resources\SaleResource\RelationManagers;
use App\Models\Sale;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function getNavigationBadge(): ?string
    {
      return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
              Section::make()
              ->columns(2)
              ->schema([
                Forms\Components\Select::make('listing_id')
                  ->relationship('listing', 'title')
                  ->searchable()
                  ->preload()
                  ->required(),
                Forms\Components\Select::make('customer_id')
                  ->relationship('customer', 'name')
                  ->createOptionForm(fn ($form) => CustomerResource::form($form))
                  ->searchable()
                  ->preload()
                  ->required(),
                Hidden::make('sales_person_id')
                ->default(Auth::user()->id),
                Forms\Components\TextInput::make('sale_price')
                  ->required()
                  ->minValue(0)
                  ->maxValue(2147483647)
                  ->prefix('RWF')
                  ->numeric(),
                Forms\Components\DateTimePicker::make('sale_date')
                  ->default(now())
                  ->required(),
              ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->where('sales_person_id', Auth::user()->id))
            ->columns([
                Tables\Columns\TextColumn::make('listing.title')
                ->wrap()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sale_price')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sale_date')
                    ->date()
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
            'index' => Pages\ListSales::route('/'),
            'create' => Pages\CreateSale::route('/create'),
            'view' => Pages\ViewSale::route('/{record}'),
            'edit' => Pages\EditSale::route('/{record}/edit'),
        ];
    }
}

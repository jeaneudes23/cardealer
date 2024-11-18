<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SalesPersonResource\Pages;
use App\Filament\Resources\SalesPersonResource\RelationManagers;
use App\Models\SalesPerson;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SalesPersonResource extends Resource
{
  protected static ?string $model = SalesPerson::class;

  protected static ?string $navigationIcon = 'heroicon-o-users';
  protected static ?string $navigationGroup = 'Management';

  public static function form(Form $form): Form
  {
    return CustomerResource::form($form);
  }

  public static function getNavigationBadge(): ?string
  {
    return static::getModel()::count();
  }


  public static function table(Table $table): Table
  {
    return CustomerResource::table($table);
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
      'index' => Pages\ListSalesPeople::route('/'),
      'create' => Pages\CreateSalesPerson::route('/create'),
      'view' => Pages\ViewSalesPerson::route('/{record}'),
      'edit' => Pages\EditSalesPerson::route('/{record}/edit'),
    ];
  }
}

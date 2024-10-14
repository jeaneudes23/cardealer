<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class CustomerResource extends Resource
{
  protected static ?string $model = Customer::class;

  protected static ?string $navigationIcon = 'heroicon-o-users';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make()
          ->columns(2)
          ->schema([
            Forms\Components\TextInput::make('name')
              ->required()
              ->maxLength(255),
            Forms\Components\TextInput::make('email')
              ->email()
              ->required()
              ->maxLength(255),
            Forms\Components\TextInput::make('password')
              ->required(fn (string $context): bool => $context == 'create')
              ->password()
              ->maxLength(255),
            Select::make('role')
              ->options([
                'admin' => 'Admin',
                'customer' => 'Customer'
              ])
              ->hiddenOn('create')
              ->native(0)
              ->required(),
          ])
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')
          ->searchable(),
        Tables\Columns\TextColumn::make('email')
          ->searchable(),
        Tables\Columns\TextColumn::make('email_verified_at')
          ->toggleable(isToggledHiddenByDefault: true)
          ->dateTime()
          ->sortable(),
        Tables\Columns\TextColumn::make('role'),
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
      'index' => Pages\ListCustomers::route('/'),
      'create' => Pages\CreateCustomer::route('/create'),
      'view' => Pages\ViewCustomer::route('/{record}'),
      'edit' => Pages\EditCustomer::route('/{record}/edit'),
    ];
  }
}

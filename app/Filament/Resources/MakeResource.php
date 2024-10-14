<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MakeResource\Pages;
use App\Filament\Resources\MakeResource\RelationManagers;
use App\Models\Make;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MakeResource extends Resource
{
    protected static ?string $model = Make::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $navigationGroup = 'Vehicles';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
          Forms\Components\Section::make('')
            ->columns(2)
            ->schema([
              Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
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
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
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
            'index' => Pages\ListMakes::route('/'),
            'create' => Pages\CreateMake::route('/create'),
            'view' => Pages\ViewMake::route('/{record}'),
            'edit' => Pages\EditMake::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\SalesPerson\Resources;

use App\Filament\Resources\AppointmentResource as ResourcesAppointmentResource;
use App\Filament\SalesPerson\Resources\AppointmentResource\Pages;
use App\Filament\SalesPerson\Resources\AppointmentResource\RelationManagers;
use App\Models\Appointment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class AppointmentResource extends Resource
{
  protected static ?string $model = Appointment::class;

  protected static ?string $navigationIcon = 'heroicon-o-calendar';

  public static function canEdit(Model $record): bool
  {
    return false;
  }

  public static function canCreate(): bool
  {
    return false;
  }

  public static function canView(Model $record): bool
  {
    return $record->sales_person_id == Auth::user()->id;
  }
  
  public static function form(Form $form): Form
  {
    return ResourcesAppointmentResource::form($form);
  }

  public static function table(Table $table): Table
  {
    return ResourcesAppointmentResource::table($table)
      ->actions([
        Tables\Actions\ViewAction::make(),
        Tables\Actions\EditAction::make(),
      ])
      ->bulkActions([
        Tables\Actions\BulkActionGroup::make([
          Tables\Actions\DeleteBulkAction::make(),
        ]),
      ])
      ->modifyQueryUsing(fn (Builder $query) => $query->where('sales_person_id', Auth::user()->id));
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
      'index' => Pages\ListAppointments::route('/'),
      'create' => Pages\CreateAppointment::route('/create'),
      'view' => Pages\ViewAppointment::route('/{record}'),
      'edit' => Pages\EditAppointment::route('/{record}/edit'),
    ];
  }
}

<?php

namespace App\Filament\Resources\Vehicules;

use App\Filament\Resources\Vehicules\Pages\CreateVehicule;
use App\Filament\Resources\Vehicules\Pages\EditVehicule;
use App\Filament\Resources\Vehicules\Pages\ListVehicules;
use App\Filament\Resources\Vehicules\Pages\ViewVehicule;
use App\Filament\Resources\Vehicules\Schemas\VehiculeForm;
use App\Filament\Resources\Vehicules\Schemas\VehiculeInfolist;
use App\Filament\Resources\Vehicules\Tables\VehiculesTable;
use App\Models\Vehicule;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VehiculeResource extends Resource
{
    protected static ?string $model = Vehicule::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Schema $schema): Schema
    {
        return VehiculeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VehiculeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VehiculesTable::configure($table);
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
            'index' => ListVehicules::route('/'),
            'create' => CreateVehicule::route('/create'),
            'view' => ViewVehicule::route('/{record}'),
            'edit' => EditVehicule::route('/{record}/edit'),
        ];
    }
}

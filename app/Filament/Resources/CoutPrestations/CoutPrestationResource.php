<?php

namespace App\Filament\Resources\CoutPrestations;

use App\Filament\Resources\CoutPrestations\Pages\CreateCoutPrestation;
use App\Filament\Resources\CoutPrestations\Pages\EditCoutPrestation;
use App\Filament\Resources\CoutPrestations\Pages\ListCoutPrestations;
use App\Filament\Resources\CoutPrestations\Pages\ViewCoutPrestation;
use App\Filament\Resources\CoutPrestations\Schemas\CoutPrestationForm;
use App\Filament\Resources\CoutPrestations\Schemas\CoutPrestationInfolist;
use App\Filament\Resources\CoutPrestations\Tables\CoutPrestationsTable;
use App\Models\CoutPrestation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CoutPrestationResource extends Resource
{
    protected static ?string $model = CoutPrestation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Schema $schema): Schema
    {
        return CoutPrestationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CoutPrestationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CoutPrestationsTable::configure($table);
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
            'index' => ListCoutPrestations::route('/'),
            'create' => CreateCoutPrestation::route('/create'),
            'view' => ViewCoutPrestation::route('/{record}'),
            'edit' => EditCoutPrestation::route('/{record}/edit'),
        ];
    }
}

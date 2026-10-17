<?php

namespace App\Filament\Resources\TempsSupplementaires;

use App\Filament\Resources\TempsSupplementaires\Pages\CreateTempsSupplementaire;
use App\Filament\Resources\TempsSupplementaires\Pages\EditTempsSupplementaire;
use App\Filament\Resources\TempsSupplementaires\Pages\ListTempsSupplementaires;
use App\Filament\Resources\TempsSupplementaires\Pages\ViewTempsSupplementaire;
use App\Filament\Resources\TempsSupplementaires\Schemas\TempsSupplementaireForm;
use App\Filament\Resources\TempsSupplementaires\Schemas\TempsSupplementaireInfolist;
use App\Filament\Resources\TempsSupplementaires\Tables\TempsSupplementairesTable;
use App\Models\TempsSupplementaire;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TempsSupplementaireResource extends Resource
{
    protected static ?string $model = TempsSupplementaire::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Schema $schema): Schema
    {
        return TempsSupplementaireForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TempsSupplementaireInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TempsSupplementairesTable::configure($table);
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
            'index' => ListTempsSupplementaires::route('/'),
            'create' => CreateTempsSupplementaire::route('/create'),
            'view' => ViewTempsSupplementaire::route('/{record}'),
            'edit' => EditTempsSupplementaire::route('/{record}/edit'),
        ];
    }
}

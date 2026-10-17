<?php

namespace App\Filament\Resources\ComposantDefecteuxRemplaces;

use App\Filament\Resources\ComposantDefecteuxRemplaces\Pages\CreateComposantDefecteuxRemplace;
use App\Filament\Resources\ComposantDefecteuxRemplaces\Pages\EditComposantDefecteuxRemplace;
use App\Filament\Resources\ComposantDefecteuxRemplaces\Pages\ListComposantDefecteuxRemplaces;
use App\Filament\Resources\ComposantDefecteuxRemplaces\Pages\ViewComposantDefecteuxRemplace;
use App\Filament\Resources\ComposantDefecteuxRemplaces\Schemas\ComposantDefecteuxRemplaceForm;
use App\Filament\Resources\ComposantDefecteuxRemplaces\Schemas\ComposantDefecteuxRemplaceInfolist;
use App\Filament\Resources\ComposantDefecteuxRemplaces\Tables\ComposantDefecteuxRemplacesTable;
use App\Models\ComposantDefecteuxRemplace;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ComposantDefecteuxRemplaceResource extends Resource
{
    protected static ?string $model = ComposantDefecteuxRemplace::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Schema $schema): Schema
    {
        return ComposantDefecteuxRemplaceForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ComposantDefecteuxRemplaceInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ComposantDefecteuxRemplacesTable::configure($table);
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
            'index' => ListComposantDefecteuxRemplaces::route('/'),
            'create' => CreateComposantDefecteuxRemplace::route('/create'),
            'view' => ViewComposantDefecteuxRemplace::route('/{record}'),
            'edit' => EditComposantDefecteuxRemplace::route('/{record}/edit'),
        ];
    }
}

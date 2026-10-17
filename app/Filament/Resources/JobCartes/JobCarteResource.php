<?php

namespace App\Filament\Resources\JobCartes;

use App\Filament\Resources\JobCartes\Pages\CreateJobCarte;
use App\Filament\Resources\JobCartes\Pages\EditJobCarte;
use App\Filament\Resources\JobCartes\Pages\FicheJobCarte;
use App\Filament\Resources\JobCartes\Pages\ListJobCartes;
use App\Filament\Resources\JobCartes\Pages\ViewJobCarte;
use App\Filament\Resources\JobCartes\Schemas\JobCarteForm;
use App\Filament\Resources\JobCartes\Schemas\JobCarteInfolist;
use App\Filament\Resources\JobCartes\Tables\JobCartesTable;
use App\Models\JobCarte;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JobCarteResource extends Resource
{
    protected static ?string $model = JobCarte::class;

    protected static string|BackedEnum|null $navigationIcon = null; //Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return JobCarteForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return JobCarteInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JobCartesTable::configure($table);
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
            'index' => ListJobCartes::route('/'),
            'create' => CreateJobCarte::route('/create'),
            'view' => ViewJobCarte::route('/{record}'),
            'edit' => EditJobCarte::route('/{record}/edit'),
            'fiche' => FicheJobCarte::route('/{record}/fiche'),
        ];
    }
}

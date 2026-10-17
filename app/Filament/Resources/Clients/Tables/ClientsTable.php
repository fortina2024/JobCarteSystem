<?php

namespace App\Filament\Resources\Clients\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ClientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom')
                    ->searchable()
                    ->sortable(),
                /*TextColumn::make('telephone')
                    ->searchable(),*/
                TextColumn::make('display_time_zone')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jobCartes')
                    ->label('Nbre Job Cartes')
                    ->getStateUsing(fn ($record) => $record->jobCartes()->count())
                    ->sortable(),
                TextColumn::make('jobCartes_2')
                    ->label('Signé')
                    ->getStateUsing(fn ($record) => $record->jobCartes()->count())
                    ->sortable(),
                TextColumn::make('jobCartes_3')
                    ->label('Non signé')
                    ->getStateUsing(fn ($record) => $record->jobCartes()->count())
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

}

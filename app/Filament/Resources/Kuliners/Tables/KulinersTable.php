<?php

namespace App\Filament\Resources\Kuliners\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class KulinersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\ImageColumn::make('image'),
                TextColumn::make('province.name')
                    ->label('Provinsi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nama Kuliner')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('province_id')
                    ->relationship('province', 'name')
                    ->label('Filter Provinsi'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

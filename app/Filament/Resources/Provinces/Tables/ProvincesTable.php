<?php

namespace App\Filament\Resources\Provinces\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProvincesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->circular()
                    ->defaultImageUrl(fn($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->name)),
                TextColumn::make('name')
                    ->label('Nama Provinsi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('code')
                    ->label('Kode')
                    ->searchable()
                    ->badge(),
                TextColumn::make('wisatas_count')
                    ->counts('wisatas')
                    ->label('Wisata')
                    ->badge()
                    ->color('success'),
                TextColumn::make('tradisis_count')
                    ->counts('tradisis')
                    ->label('Tradisi')
                    ->badge()
                    ->color('info'),
                TextColumn::make('kuliners_count')
                    ->counts('kuliners')
                    ->label('Kuliner')
                    ->badge()
                    ->color('warning'),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diupdate')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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

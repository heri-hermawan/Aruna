<?php

namespace App\Filament\Resources\Wisatas\Schemas;

use Filament\Schemas\Schema;

class WisataForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('province_id')
                    ->relationship('province', 'name')
                    ->required()
                    ->searchable(),
                \Filament\Forms\Components\TextInput::make('name')
                    ->required(),
                \Filament\Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                // \Filament\Forms\Components\TextInput::make('address'),
                // \Filament\Forms\Components\TextInput::make('price')
                //     ->numeric()
                //     ->prefix('Rp'),
                \Filament\Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('images/wisata'),
            ]);
    }
}

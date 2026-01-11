<?php

namespace App\Filament\Resources\Tradisis\Schemas;

use Filament\Schemas\Schema;

class TradisiForm
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
                \Filament\Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('images/tradisi'),
            ]);
    }
}

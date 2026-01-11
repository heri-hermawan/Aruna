<?php

namespace App\Filament\Resources\Peraturans\Schemas;

use Filament\Schemas\Schema;

class PeraturanForm
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
                \Filament\Forms\Components\Select::make('category')
                    ->options([
                        'pemerintah' => 'Pemerintah',
                        'adat' => 'Hukum Adat',
                        'wilayah' => 'Peraturan Wilayah',
                    ])
                    ->required(),
                \Filament\Forms\Components\TextInput::make('document')
                    ->label('Link Dokumen'),
                \Filament\Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('images/peraturan'),
            ]);
    }
}

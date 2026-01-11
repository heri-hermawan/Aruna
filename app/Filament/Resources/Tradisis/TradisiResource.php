<?php

namespace App\Filament\Resources\Tradisis;

use App\Filament\Resources\Tradisis\Pages\CreateTradisi;
use App\Filament\Resources\Tradisis\Pages\EditTradisi;
use App\Filament\Resources\Tradisis\Pages\ListTradisis;
use App\Filament\Resources\Tradisis\Schemas\TradisiForm;
use App\Filament\Resources\Tradisis\Tables\TradisisTable;
use App\Models\Tradisi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TradisiResource extends Resource
{
    protected static ?string $model = Tradisi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    protected static string|\UnitEnum|null $navigationGroup = 'Konten';

    protected static ?int $navigationSort = 30;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return TradisiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TradisisTable::configure($table);
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
            'index' => ListTradisis::route('/'),
            'create' => CreateTradisi::route('/create'),
            'edit' => EditTradisi::route('/{record}/edit'),
        ];
    }
}

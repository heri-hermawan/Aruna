<?php

namespace App\Filament\Resources\Wisatas;

use App\Filament\Resources\Wisatas\Pages\CreateWisata;
use App\Filament\Resources\Wisatas\Pages\EditWisata;
use App\Filament\Resources\Wisatas\Pages\ListWisatas;
use App\Filament\Resources\Wisatas\Schemas\WisataForm;
use App\Filament\Resources\Wisatas\Tables\WisatasTable;
use App\Models\Wisata;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WisataResource extends Resource
{
    protected static ?string $model = Wisata::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinePhoto;

    protected static ?string $navigationGroup = 'Konten';

    protected static ?int $navigationSort = 20;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return WisataForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WisatasTable::configure($table);
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
            'index' => ListWisatas::route('/'),
            'create' => CreateWisata::route('/create'),
            'edit' => EditWisata::route('/{record}/edit'),
        ];
    }
}

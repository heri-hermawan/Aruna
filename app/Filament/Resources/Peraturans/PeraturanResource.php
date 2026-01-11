<?php

namespace App\Filament\Resources\Peraturans;

use App\Filament\Resources\Peraturans\Pages\CreatePeraturan;
use App\Filament\Resources\Peraturans\Pages\EditPeraturan;
use App\Filament\Resources\Peraturans\Pages\ListPeraturans;
use App\Filament\Resources\Peraturans\Schemas\PeraturanForm;
use App\Filament\Resources\Peraturans\Tables\PeraturansTable;
use App\Models\Peraturan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PeraturanResource extends Resource
{
    protected static ?string $model = Peraturan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static string|\UnitEnum|null $navigationGroup = 'Konten';

    protected static ?int $navigationSort = 50;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return PeraturanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PeraturansTable::configure($table);
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
            'index' => ListPeraturans::route('/'),
            'create' => CreatePeraturan::route('/create'),
            'edit' => EditPeraturan::route('/{record}/edit'),
        ];
    }
}

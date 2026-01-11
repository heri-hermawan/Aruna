<?php

namespace App\Filament\Resources\Peraturans\Pages;

use App\Filament\Resources\Peraturans\PeraturanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPeraturans extends ListRecords
{
    protected static string $resource = PeraturanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\Tradisis\Pages;

use App\Filament\Resources\Tradisis\TradisiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTradisis extends ListRecords
{
    protected static string $resource = TradisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

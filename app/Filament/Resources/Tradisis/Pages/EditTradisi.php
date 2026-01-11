<?php

namespace App\Filament\Resources\Tradisis\Pages;

use App\Filament\Resources\Tradisis\TradisiResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTradisi extends EditRecord
{
    protected static string $resource = TradisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\Peraturans\Pages;

use App\Filament\Resources\Peraturans\PeraturanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPeraturan extends EditRecord
{
    protected static string $resource = PeraturanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\LightingPageResource\Pages;

use App\Filament\Resources\LightingPageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLightingPage extends EditRecord
{
    protected static string $resource = LightingPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

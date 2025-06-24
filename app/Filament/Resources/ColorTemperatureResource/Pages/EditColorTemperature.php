<?php

namespace App\Filament\Resources\ColorTemperatureResource\Pages;

use App\Filament\Resources\ColorTemperatureResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditColorTemperature extends EditRecord
{
    protected static string $resource = ColorTemperatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

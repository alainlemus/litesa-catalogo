<?php

namespace App\Filament\Resources\ColorTemperatureResource\Pages;

use App\Filament\Resources\ColorTemperatureResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListColorTemperatures extends ListRecords
{
    protected static string $resource = ColorTemperatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

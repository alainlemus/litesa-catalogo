<?php

namespace App\Filament\Resources\ProductUseResource\Pages;

use App\Filament\Resources\ProductUseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductUses extends ListRecords
{
    protected static string $resource = ProductUseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

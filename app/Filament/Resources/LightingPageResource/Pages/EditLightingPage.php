<?php

namespace App\Filament\Resources\LightingPageResource\Pages;

use App\Filament\Resources\LightingPageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLightingPage extends EditRecord
{
    protected static string $resource = LightingPageResource::class;

    /** La ruta índice abre el registro único (evita error 500 al entrar por la URL directa). */
    public function mount(int|string|null $record = null): void
    {
        parent::mount($record ?? \App\Models\LightingPage::query()->firstOrFail()->getKey());
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

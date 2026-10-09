<?php

namespace App\Filament\Resources\AboutPageSettingResource\Pages;

use App\Filament\Resources\AboutPageSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAboutPageSetting extends EditRecord
{
    protected static string $resource = AboutPageSettingResource::class;

    /** La ruta índice abre el registro único (evita error 500 al entrar por la URL directa). */
    public function mount(int|string|null $record = null): void
    {
        parent::mount($record ?? \App\Models\AboutPageSetting::query()->firstOrFail()->getKey());
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\ServicesPageSettingResource\Pages;

use App\Filament\Resources\ServicesPageSettingResource;
use App\Models\ServicesPageSetting;
use Filament\Resources\Pages\EditRecord;

class EditServicesPageSetting extends EditRecord
{
    protected static string $resource = ServicesPageSettingResource::class;

    /** Ruta /admin/services-page-settings → abre el registro único. */
    public function mount(int|string|null $record = null): void
    {
        parent::mount($record ?? ServicesPageSetting::current()->getKey());
    }
}

<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Jobs\SendNewBlogPostEmails;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterUpdate(): void
    {
        if($this->record->status === 'published') {
            logger('Se llama job para envio de correos al editar una entrada: ' . $this->record->title);
            dispatch(new SendNewBlogPostEmails($this->record));
        }
    }
}

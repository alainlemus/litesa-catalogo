<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Jobs\SendNewBlogPostEmails;
use App\Mail\NewBlogPostNotification;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;
use function dispatch;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function afterCreate(): void
    {
        if($this->record->status === 'published') {
            logger('Se llama job para envio de correos al crear una nueva entrada: ' . $this->record->title);
            dispatch(new SendNewBlogPostEmails($this->record));
        }
    }
}

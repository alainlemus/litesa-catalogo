<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Jobs\SendNewBlogPostEmails;
use App\Mail\NewBlogPostNotification;
use App\Models\Post;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;
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

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (!empty($data['title'])) {
            $baseSlug = Str::slug($data['title']);
            $slug = $baseSlug;
            $counter = 1;

            while (Post::where('slug', $slug)->exists()) {
                $slug = "{$baseSlug}-{$counter}";
                $counter++;
            }

            $data['slug'] = $slug;
        }

        return $data;
    }
}

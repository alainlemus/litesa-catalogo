<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Jobs\SendNewBlogPostEmails;
use App\Models\Post;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

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

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (!empty($data['title'])) {
            $baseSlug = Str::slug($data['title']);
            $slug = $baseSlug;
            $counter = 1;

            while (Post::where('slug', $slug)->where('id', '!=', $this->getRecord()->id)->exists()) {
                $slug = "{$baseSlug}-{$counter}";
                $counter++;
            }

            $data['slug'] = $slug;
        }

        return $data;
    }
}

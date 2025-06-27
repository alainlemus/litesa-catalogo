<?php

namespace App\Livewire\Blog;

use App\Models\Post;
use Livewire\Component;

class ShowPost extends Component
{
    public Post $post;

    public function mount(string $slug)
    {
        $this->post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.blog.show-post')
            ->with('title', $this->post->title)
            ->with('layout', 'layouts.app'); // Cambia a tu layout principal si es diferente
    }
}

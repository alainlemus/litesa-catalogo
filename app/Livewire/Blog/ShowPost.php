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
        $related = Post::where('status', 'published')
            ->where('id', '!=', $this->post->id)
            ->latest()
            ->take(3)
            ->get();

        return view('livewire.blog.show-post', compact('related'));
    }
}

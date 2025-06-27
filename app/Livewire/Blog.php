<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class Blog extends Component
{
    public $posts = [];

    public function mount(){
        $this->posts = Post::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.blog');
    }
}

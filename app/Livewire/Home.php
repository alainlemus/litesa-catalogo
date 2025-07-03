<?php

namespace App\Livewire;

use App\Models\AboutPageSetting;
use App\Models\MediaFile;
use App\Models\Post;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Livewire\Component;

class Home extends Component
{
    public $headerImage = null;
    public $cardImage = null;

    public $testimonials = null;
    public $posts = [];

    public $page = null;
    public $seo = null;

    public function mount(){
        $this->headerImage = MediaFile::where('name', 'Header')->first();
        $this->cardImage = MediaFile::where('name', 'Card')->first();
        $this->testimonials = Testimonial::all();
        $this->posts = Post::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        $this->page = AboutPageSetting::first();
        $this->page = SiteSetting::first();
    }

    public function render()
    {
        return view('livewire.home');
    }
}

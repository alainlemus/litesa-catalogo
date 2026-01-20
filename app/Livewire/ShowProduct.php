<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\SiteSetting;
use Livewire\Component;

class ShowProduct extends Component
{
    public $product;
    public $whatsapp = null;

    public function mount($slug)
    {
        $this->product = Product::with(['variants', 'photos', 'uses'])->where('slug', $slug)->firstOrFail();
        $this->whatsapp = SiteSetting::find(1)->whatsapp;
    }

    public function render()
    {
        return view('livewire.show-product');
    }
}

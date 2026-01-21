<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\SiteSetting;
use Livewire\Component;

class ShowProduct extends Component
{
    public $product;
    public $whatsapp = null;
    public $similares = [];

    public function mount($slug)
    {
        $this->product = Product::with(['variants', 'photos', 'uses', 'category'])->where('slug', $slug)->firstOrFail();
        $this->whatsapp = SiteSetting::find(1)->whatsapp;
        // Buscar productos similares por categoría, excluyendo el actual
        $this->similares = Product::with('photos')
            ->where('category_id', $this->product->category_id)
            ->where('id', '!=', $this->product->id)
            ->limit(4)
            ->get();
    }

    public function render()
    {
        return view('livewire.show-product', [
            'similares' => $this->similares,
        ]);
    }
}

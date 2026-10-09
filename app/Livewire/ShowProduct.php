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
        $this->whatsapp = SiteSetting::current()?->whatsapp;
        // Buscar productos similares por categoría, excluyendo el actual
        $useIds = $this->product->uses->pluck('id');

        $this->similares = Product::with('photos')
            ->where('id', '!=', $this->product->id)
            ->where(function ($query) use ($useIds) {
                // Misma categoría si la tiene; si no, productos que comparten algún uso
                if ($this->product->category_id) {
                    $query->where('category_id', $this->product->category_id);
                } else {
                    $query->whereHas('uses', fn ($q) => $q->whereIn('product_uses.id', $useIds));
                }
            })
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

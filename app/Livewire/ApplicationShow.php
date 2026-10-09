<?php

namespace App\Livewire;

use App\Models\ProductUse;
use Livewire\Component;

class ApplicationShow extends Component
{
    public ProductUse $use;

    public function mount(string $slug)
    {
        $this->use = ProductUse::all()->firstWhere('slug', $slug) ?? abort(404);
    }

    public function render()
    {
        return view('livewire.application-show', [
            'products' => $this->use->products()->with(['photos', 'category'])->get(),
            'others' => ProductUse::where('id', '!=', $this->use->id)->get(),
        ]);
    }
}

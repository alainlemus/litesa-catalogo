<?php

namespace App\Livewire;

use App\Models\ProductUse;
use Livewire\Component;

class Applications extends Component
{
    public function render()
    {
        return view('livewire.applications', [
            'uses' => ProductUse::withCount('products')->with(['products' => fn ($q) => $q->with('photos')->limit(1)])->get(),
        ]);
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductUse;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class Catalog extends Component
{
    use WithPagination;
    public $search = ''; // Propiedad para el término de búsqueda
    public $selectedUse = null;

    protected $paginationTheme = 'tailwind';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectedUse()
    {
        $this->resetPage();
    }

    public function showProductDetails($productId)
    {
        return redirect()->route('product.show', ['id' => $productId]);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $products = Product::with(['variants', 'photos', 'uses'])
            ->when($this->search, function ($query) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($this->search) . '%']);
            })
            ->when($this->selectedUse, function ($query) {
                $query->whereHas('uses', function ($q) {
                    $q->where('product_uses.id', $this->selectedUse);
                });
            })
            ->paginate(9);

        $places = ProductUse::all()->pluck('name', 'id');

        return view('livewire.catalog', compact('products', 'places'));
    }
}

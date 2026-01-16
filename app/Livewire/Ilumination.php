<?php

namespace App\Livewire;

use App\Models\LightingPage;
use App\Models\MediaFile;
use App\Models\Product;
use Livewire\Component;

class Ilumination extends Component
{
    public $firstImage = null;
    public $secondImage = null;
    public $lighting = null;
    public $heroImage = null;
    public $newProducts = [];

    public function mount()
    {
        $this->firstImage = MediaFile::where('name', 'Alumbrado')->first();
        $this->secondImage = MediaFile::where('name', 'Iluminacion')->first();
        $this->heroImage = MediaFile::where('name', 'HeaderIluminacion')->first();
        $this->lighting = LightingPage::first();
        $this->newProducts = Product::with('photos')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
    }

    public function render()
    {
        return view('livewire.ilumination', [
            'newProducts' => $this->newProducts,
        ]);
    }
}

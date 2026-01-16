<?php

namespace App\Livewire;

use App\Models\LightingPage;
use App\Models\MediaFile;
use Livewire\Component;

class Ilumination extends Component
{
    public $firstImage = null;
    public $secondImage = null;
    public $lighting = null;
    public $heroImage = null;

    public function mount()
    {
        $this->firstImage = MediaFile::where('name', 'Alumbrado')->first();
        $this->secondImage = MediaFile::where('name', 'Iluminacion')->first();
        $this->heroImage = MediaFile::where('name', 'HeaderIluminacion')->first();
        $this->lighting = LightingPage::first();
    }

    public function render()
    {
        return view('livewire.ilumination');
    }
}
